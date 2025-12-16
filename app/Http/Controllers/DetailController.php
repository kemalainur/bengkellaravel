<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Item;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    // Helper function for terbilang
    private function penyebut($nilai) {
        $nilai = abs($nilai);
        $huruf = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas"];
        $temp = "";

        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } else if ($nilai < 20) {
            $temp = $this->penyebut($nilai - 10) . " Belas";
        } else if ($nilai < 100) {
            $temp = $this->penyebut(intval($nilai / 10)) . " Puluh" . $this->penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " Seratus" . $this->penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = $this->penyebut(intval($nilai / 100)) . " Ratus" . $this->penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " Seribu" . $this->penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = $this->penyebut(intval($nilai / 1000)) . " Ribu" . $this->penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = $this->penyebut(intval($nilai / 1000000)) . " Juta" . $this->penyebut($nilai % 1000000);
        }

        return $temp;
    }

    private function terbilang($nilai) {
        if ($nilai < 0) {
            return "Minus" . $this->penyebut($nilai);
        }
        return trim($this->penyebut($nilai));
    }

    public function create($nostruk)
    {
        $transaksi = Transaksi::findOrFail($nostruk);
        $items = Item::where('qty', '>', 0)->get();
        return view('detail.create', compact('transaksi', 'items'));
    }

    public function store(Request $request, $nostruk)
    {
        $request->validate([
            'iditem' => 'required|exists:item,iditem',
            'banyaknya' => 'required|integer|min:1',
        ]);

        $item = Item::findOrFail($request->iditem);
        
        // Check stock
        if ($item->qty < $request->banyaknya) {
            return back()->withErrors(['banyaknya' => 'Stok tidak cukup! Stok tersedia: ' . $item->qty]);
        }

        // Calculate total
        $harga_numeric = (int) preg_replace('/\D/', '', $item->harga);
        $hargatotal = $harga_numeric * $request->banyaknya;

        // Create detail
        Detail::create([
            'nostruk' => $nostruk,
            'iditem' => $request->iditem,
            'banyaknya' => $request->banyaknya,
            'hargatotal' => number_format($hargatotal, 0, '', '.'),
        ]);

        // Reduce stock
        $item->decrement('qty', $request->banyaknya);

        // Update transaksi total
        $this->updateTransaksiTotal($nostruk);

        return redirect()->route('transaksi.show', $nostruk)->with('success', 'Detail berhasil ditambahkan!');
    }

    public function edit($nostruk, $id)
    {
        $detail = Detail::findOrFail($id);
        $transaksi = Transaksi::findOrFail($nostruk);
        return view('detail.edit', compact('detail', 'transaksi'));
    }

    public function update(Request $request, $nostruk, $id)
    {
        $request->validate([
            'banyaknya' => 'required|integer|min:1',
        ]);

        $detail = Detail::findOrFail($id);
        $item = $detail->item;
        
        // Calculate new hargatotal
        $harga_numeric = (int) preg_replace('/\D/', '', $item->harga);
        $hargatotal = $harga_numeric * $request->banyaknya;

        $detail->update([
            'banyaknya' => $request->banyaknya,
            'hargatotal' => number_format($hargatotal, 0, '', '.'),
        ]);

        // Update transaksi total
        $this->updateTransaksiTotal($nostruk);

        return redirect()->route('transaksi.show', $nostruk)->with('success', 'Detail berhasil diupdate!');
    }

    public function destroy($nostruk, $id)
    {
        $detail = Detail::findOrFail($id);
        
        // Restore stock
        $detail->item->increment('qty', $detail->banyaknya);
        
        $detail->delete();

        // Update transaksi total
        $this->updateTransaksiTotal($nostruk);

        return redirect()->route('transaksi.show', $nostruk)->with('success', 'Detail berhasil dihapus!');
    }

    private function updateTransaksiTotal($nostruk)
    {
        $transaksi = Transaksi::findOrFail($nostruk);
        $details = Detail::where('nostruk', $nostruk)->get();
        
        $total = 0;
        foreach ($details as $detail) {
            $total += (int) preg_replace('/\D/', '', $detail->hargatotal);
        }

        $transaksi->update([
            'totalbiaya' => number_format($total, 0, '', '.'),
            'terbilang' => $this->terbilang($total) . ' Rupiah',
        ]);
    }
}
