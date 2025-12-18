<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Motor;
use App\Models\Item;
use App\Models\Transaksi;
use App\Models\Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Statistik umum
        $data = [
            'total_pelanggan' => Pelanggan::count(),
            'total_motor' => Motor::count(),
            'total_item' => Item::count(),
            'total_transaksi' => Transaksi::count(),
        ];

        // Pendapatan hari ini - use REPLACE to remove dots from formatted numbers
        $data['pendapatan_hari'] = Transaksi::whereDate('tanggal', today())
            ->selectRaw('SUM(CAST(REPLACE(totalbiaya, ".", "") AS UNSIGNED)) as total')
            ->value('total') ?? 0;

        // Pendapatan bulan ini
        $data['pendapatan_bulan'] = Transaksi::whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->selectRaw('SUM(CAST(REPLACE(totalbiaya, ".", "") AS UNSIGNED)) as total')
            ->value('total') ?? 0;

        // Total pendapatan
        $data['total_pendapatan'] = Transaksi::selectRaw('SUM(CAST(REPLACE(totalbiaya, ".", "") AS UNSIGNED)) as total')
            ->value('total') ?? 0;

        // Transaksi terbaru
        $data['transaksi_terbaru'] = Transaksi::with(['motor.pelanggan'])
            ->orderBy('tanggal', 'desc')
            ->take(5)
            ->get();

        // Statistik status transaksi
        $data['transaksi_pending'] = Transaksi::where('status', 'pending')->count();
        $data['transaksi_proses'] = Transaksi::where('status', 'proses')->count();
        $data['transaksi_selesai'] = Transaksi::where('status', 'selesai')->count();

        // Pendapatan per bulan (6 bulan terakhir)
        $data['chart_labels'] = [];
        $data['chart_data'] = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $data['chart_labels'][] = $date->format('M Y');
            $data['chart_data'][] = Transaksi::whereMonth('tanggal', $date->month)
                ->whereYear('tanggal', $date->year)
                ->selectRaw('SUM(CAST(REPLACE(totalbiaya, ".", "") AS UNSIGNED)) as total')
                ->value('total') ?? 0;
        }

        return view('admin.dashboard', $data);
    }

    /**
     * Halaman laporan keuangan
     */
    public function laporan(Request $request)
    {
        $startDate = $request->get('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', now()->format('Y-m-d'));

        // Transaksi dalam rentang tanggal
        $transaksi = Transaksi::with(['motor.pelanggan', 'details.item'])
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->orderBy('tanggal', 'desc')
            ->get();

        // Total pendapatan - sum after removing dots from formatted numbers
        $totalPendapatan = $transaksi->sum(function($t) {
            return (int) str_replace('.', '', $t->totalbiaya);
        });

        // Item terlaris
        $itemTerlaris = Detail::join('item', 'detail.iditem', '=', 'item.iditem')
            ->join('transaksi', 'detail.nostruk', '=', 'transaksi.nostruk')
            ->whereBetween('transaksi.tanggal', [$startDate, $endDate])
            ->select('item.namaitem', DB::raw('SUM(detail.banyaknya) as total_terjual'))
            ->groupBy('item.namaitem')
            ->orderBy('total_terjual', 'desc')
            ->take(10)
            ->get();

        return view('admin.laporan', compact('transaksi', 'totalPendapatan', 'itemTerlaris', 'startDate', 'endDate'));
    }
}
