<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class AdvisorMotorController extends Controller
{
    public function index()
    {
        $motor = Motor::with('pelanggan')->paginate(10);
        return view('motor.index', [
            'motor' => $motor,
            'routePrefix' => 'advisor.motor'
        ]);
    }

    public function create()
    {
        $pelanggan = Pelanggan::all();
        return view('motor.create', [
            'pelanggan' => $pelanggan,
            'routePrefix' => 'advisor.motor'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nopolisi' => 'required|unique:motor,nopolisi',
            'idpelanggan' => 'required|exists:pelanggan,idpelanggan',
            'nomesin' => 'nullable|string',
            'tipe' => 'nullable|string',
            'tahun' => 'nullable|string',
            'norangka' => 'nullable|string',
        ]);

        Motor::create($request->all());

        return redirect()->route('advisor.motor.index')->with('success', 'Motor berhasil ditambahkan!');
    }

    public function edit($nopolisi)
    {
        $motor = Motor::findOrFail($nopolisi);
        $pelanggan = Pelanggan::all();
        return view('motor.edit', [
            'motor' => $motor,
            'pelanggan' => $pelanggan,
            'routePrefix' => 'advisor.motor'
        ]);
    }

    public function update(Request $request, $nopolisi)
    {
        $request->validate([
            'idpelanggan' => 'required|exists:pelanggan,idpelanggan',
            'nomesin' => 'nullable|string',
            'tipe' => 'nullable|string',
            'tahun' => 'nullable|string',
            'norangka' => 'nullable|string',
        ]);

        $motor = Motor::findOrFail($nopolisi);
        $motor->update($request->only(['idpelanggan', 'nomesin', 'tipe', 'tahun', 'norangka']));

        return redirect()->route('advisor.motor.index')->with('success', 'Motor berhasil diupdate!');
    }

    public function destroy($nopolisi)
    {
        $motor = Motor::findOrFail($nopolisi);
        $motor->delete();
        return redirect()->route('advisor.motor.index')->with('success', 'Motor berhasil dihapus!');
    }
}
