<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $nopolisi = Session::get('customer_nopolisi');
        
        // Ambil motor milik pelanggan
        $motor = Motor::where('nopolisi', $nopolisi)->first();

        // Ambil semua transaksi untuk motor ini
        $transaksi = Transaksi::with(['details.item'])
            ->where('nopolisi', $nopolisi)
            ->orderBy('tanggal', 'desc')
            ->get();

        // Transaksi aktif (belum selesai)
        $transaksiAktif = $transaksi->whereIn('status', ['pending', 'proses']);

        // Transaksi selesai
        $transaksiSelesai = $transaksi->where('status', 'selesai');

        return view('customer.dashboard', compact('motor', 'transaksi', 'transaksiAktif', 'transaksiSelesai'));
    }

    /**
     * Lihat detail transaksi
     */
    public function showTransaksi($nostruk)
    {
        $nopolisi = Session::get('customer_nopolisi');

        $transaksi = Transaksi::with(['details.item', 'motor.pelanggan'])
            ->where('nostruk', $nostruk)
            ->where('nopolisi', $nopolisi)
            ->firstOrFail();

        return view('customer.transaksi', compact('transaksi'));
    }
}
