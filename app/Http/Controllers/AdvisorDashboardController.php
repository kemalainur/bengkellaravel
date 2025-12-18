<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Motor;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class AdvisorDashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_pelanggan' => Pelanggan::count(),
            'total_motor' => Motor::count(),
            // Count transactions this month instead (since pelanggan/motor don't have created_at)
            'transaksi_bulan' => Transaksi::whereMonth('tanggal', now()->month)
                ->whereYear('tanggal', now()->year)
                ->count(),
            'transaksi_pending_count' => Transaksi::where('status', 'pending')->count(),
        ];

        // Transaksi pending (perlu diproses)
        $data['transaksi_pending'] = Transaksi::with(['motor.pelanggan'])
            ->where('status', 'pending')
            ->orderBy('tanggal', 'desc')
            ->take(5)
            ->get();

        // Pelanggan terbaru (order by idpelanggan since no created_at)
        $data['pelanggan_terbaru'] = Pelanggan::orderBy('idpelanggan', 'desc')
            ->take(5)
            ->get();

        // Motor terbaru (order by nopolisi since no created_at)
        $data['motor_terbaru'] = Motor::with('pelanggan')
            ->orderBy('nopolisi', 'desc')
            ->take(5)
            ->get();

        return view('advisor.dashboard', $data);
    }
}
