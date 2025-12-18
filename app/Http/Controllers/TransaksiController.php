<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Motor;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with(['motor.pelanggan'])->paginate(10);
        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $motor = Motor::all();
        return view('transaksi.create', compact('motor'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nostruk' => 'required|integer|unique:transaksi,nostruk',
            'nopolisi' => 'required|exists:motor,nopolisi',
            'tanggal' => 'required|date',
        ]);

        Transaksi::create([
            'nostruk' => $request->nostruk,
            'nopolisi' => $request->nopolisi,
            'tanggal' => $request->tanggal,
            'totalbiaya' => '0',
            'terbilang' => '',
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load(['details.item', 'motor.pelanggan']);
        return view('transaksi.show', compact('transaksi'));
    }

    public function edit(Transaksi $transaksi)
    {
        $motor = Motor::all();
        return view('transaksi.edit', compact('transaksi', 'motor'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'nopolisi' => 'required|exists:motor,nopolisi',
            'tanggal' => 'required|date',
        ]);

        $transaksi->update($request->only(['nopolisi', 'tanggal']));

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diupdate!');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus!');
    }

    /**
     * Tampilkan halaman invoice
     */
    public function invoice($nostruk)
    {
        $transaksi = Transaksi::with(['details.item', 'motor.pelanggan'])
            ->where('nostruk', $nostruk)
            ->firstOrFail();

        return view('transaksi.invoice', compact('transaksi'));
    }

    /**
     * Cetak invoice dan update status ke selesai
     */
    public function cetakInvoice($nostruk)
    {
        $transaksi = Transaksi::where('nostruk', $nostruk)->firstOrFail();
        
        // Update status ke selesai ketika invoice dicetak
        $transaksi->update(['status' => 'selesai']);

        return redirect()->route('transaksi.invoice', $nostruk)
            ->with('success', 'Invoice berhasil dicetak! Status transaksi diubah ke Selesai.');
    }

    /**
     * Update status transaksi
     */
    public function updateStatus(Request $request, $nostruk)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai',
        ]);

        $transaksi = Transaksi::where('nostruk', $nostruk)->firstOrFail();
        $transaksi->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status transaksi berhasil diubah ke ' . ucfirst($request->status) . '!');
    }
}
