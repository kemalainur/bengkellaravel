<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class AdvisorPelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::paginate(10);
        return view('pelanggan.index', [
            'pelanggan' => $pelanggan,
            'routePrefix' => 'advisor.pelanggan'
        ]);
    }

    public function create()
    {
        return view('pelanggan.create', ['routePrefix' => 'advisor.pelanggan']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'idpelanggan' => 'required|unique:pelanggan,idpelanggan',
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('advisor.pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    public function edit($idpelanggan)
    {
        $pelanggan = Pelanggan::findOrFail($idpelanggan);
        return view('pelanggan.edit', [
            'pelanggan' => $pelanggan,
            'routePrefix' => 'advisor.pelanggan'
        ]);
    }

    public function update(Request $request, $idpelanggan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        $pelanggan = Pelanggan::findOrFail($idpelanggan);
        $pelanggan->update($request->only(['nama', 'alamat']));

        return redirect()->route('advisor.pelanggan.index')->with('success', 'Pelanggan berhasil diupdate!');
    }

    public function destroy($idpelanggan)
    {
        $pelanggan = Pelanggan::findOrFail($idpelanggan);
        $pelanggan->delete();
        return redirect()->route('advisor.pelanggan.index')->with('success', 'Pelanggan berhasil dihapus!');
    }
}
