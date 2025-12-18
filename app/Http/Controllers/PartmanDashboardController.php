<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class PartmanDashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_item' => Item::count(),
            'total_sparepart' => Item::where('jenis', 'sparepart')->count(),
            'total_jasa' => Item::where('jenis', 'jasa')->count(),
            'stok_rendah' => Item::where('qty', '<', 5)->count(),
        ];

        // Item dengan stok rendah
        $data['item_stok_rendah'] = Item::where('qty', '<', 5)
            ->orderBy('qty', 'asc')
            ->take(5)
            ->get();

        // Item terbaru ditambahkan (order by iditem since no created_at column)
        $data['item_terbaru'] = Item::orderBy('iditem', 'desc')
            ->take(5)
            ->get();

        return view('partman.dashboard', $data);
    }
}
