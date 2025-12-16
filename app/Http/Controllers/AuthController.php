<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Session::get('admin_logged_in')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'password' => 'required|numeric',
        ]);

        $pegawai = Pegawai::where('nama', $request->nama)
                          ->where('id_pegawai', $request->password)
                          ->first();

        if ($pegawai) {
            Session::put('admin_logged_in', true);
            Session::put('id_pegawai', $pegawai->id_pegawai);
            Session::put('nama', $pegawai->nama);
            Session::put('jabatan', $pegawai->jabatan);

            return redirect()->route('dashboard');
        }

        return back()->withErrors(['login' => 'Nama atau ID Pegawai salah!']);
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }
}
