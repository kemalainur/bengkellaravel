<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class MotorController extends Controller
{
    public function index()
    {
        $motor = Motor::with('pelanggan')->paginate(10);
        return view('motor.index', compact('motor'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::all();
        return view('motor.create', compact('pelanggan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nopolisi' => 'required|unique:motor,nopolisi',
            'idpelanggan' => 'required|exists:pelanggan,idpelanggan',
            'nomesin' => 'nullable|string',
            'tipe' => 'nullable|string',
            'tahun' => 'nullable|integer',
            'norangka' => 'nullable|string',
        ]);

        Motor::create($request->all());

        return redirect()->route('motor.index')->with('success', 'Motor berhasil ditambahkan!');
    }

    public function edit(Motor $motor)
    {
        $pelanggan = Pelanggan::all();
        return view('motor.edit', compact('motor', 'pelanggan'));
    }

    public function update(Request $request, Motor $motor)
    {
        $request->validate([
            'nomesin' => 'nullable|string',
            'tipe' => 'nullable|string',
            'tahun' => 'nullable|integer',
            'norangka' => 'nullable|string',
        ]);

        $motor->update($request->only(['nomesin', 'tipe', 'tahun', 'norangka']));

        return redirect()->route('motor.index')->with('success', 'Motor berhasil diupdate!');
    }

    public function destroy(Motor $motor)
    {
        $motor->delete();
        return redirect()->route('motor.index')->with('success', 'Motor berhasil dihapus!');
    }
}
