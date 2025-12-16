<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Motor;
use App\Models\Item;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_pelanggan' => Pelanggan::count(),
            'total_motor' => Motor::count(),
            'total_item' => Item::count(),
            'total_transaksi' => Transaksi::count(),
        ];

        return view('dashboard', $data);
    }
}
