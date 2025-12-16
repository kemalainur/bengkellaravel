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
}
