<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Motor;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Session::get('admin_logged_in')) {
            return $this->redirectByRole(Session::get('jabatan'));
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

            return $this->redirectByRole($pegawai->jabatan);
        }

        return back()->withErrors(['login' => 'Nama atau ID Pegawai salah!']);
    }

    /**
     * Redirect berdasarkan role/jabatan
     */
    private function redirectByRole($jabatan)
    {
        switch ($jabatan) {
            case 'Partman':
                return redirect()->route('partman.dashboard');
            case 'Service Advisor':
                return redirect()->route('advisor.dashboard');
            case 'Admin':
            default:
                return redirect()->route('admin.dashboard');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }

    /**
     * Tampilkan form login pelanggan
     */
    public function showCustomerLogin()
    {
        if (Session::get('customer_logged_in')) {
            return redirect()->route('customer.dashboard');
        }
        return view('auth.customer-login');
    }

    /**
     * Login pelanggan dengan nama dan nomor motor
     */
    public function customerLogin(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'nopolisi' => 'required|string',
        ]);

        // Cari motor dengan no polisi dan nama pelanggan
        $motor = Motor::where('nopolisi', $request->nopolisi)
                      ->whereHas('pelanggan', function ($query) use ($request) {
                          $query->where('nama', 'like', '%' . $request->nama . '%');
                      })
                      ->first();

        if ($motor) {
            Session::put('customer_logged_in', true);
            Session::put('customer_nopolisi', $motor->nopolisi);
            Session::put('customer_nama', $motor->pelanggan->nama);
            Session::put('customer_id', $motor->pelanggan->idpelanggan);

            return redirect()->route('customer.dashboard');
        }

        return back()->withErrors(['login' => 'Nama atau Nomor Polisi tidak ditemukan!']);
    }

    /**
     * Logout pelanggan
     */
    public function customerLogout()
    {
        Session::forget(['customer_logged_in', 'customer_nopolisi', 'customer_nama', 'customer_id']);
        return redirect()->route('customer.login');
    }
}
