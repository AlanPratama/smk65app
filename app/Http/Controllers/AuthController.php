<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginSiswa()
    {
        return view('auth.loginSiswa');
    }

    public function loginSiswaProcess(Request $req)
    {
        $siswa = Siswa::firstWhere('username', $req->username);

        if (!$siswa) {
            return redirect()->back()->with('error', 'AKUN SISWA TIDAK DITEMUKAN!');
        }

        if (!Hash::check($req->password, $siswa->password)) {
            return redirect()->back()->with('error', 'PASSWORD SALAH!');
        }

        Auth::attempt(['username' => $req->username, 'password' => $req->password]);


        return redirect('/siswa/beranda')->with('success', 'BERHASIL LOGIN!');
    }






    public function loginGuru()
    {
        return view('auth.loginGuru');
    }

    public function loginGuruProcess(Request $req)
    {
        $guru = Guru::firstWhere('username', $req->username);

        if (!$guru) {
            return redirect()->back()->with('error', 'AKUN SISWA TIDAK DITEMUKAN!');
        }

        if (!Hash::check($req->password, $guru->password)) {
            return redirect()->back()->with('error', 'PASSWORD SALAH!');
        }

        Auth::guard('guru')->attempt(['username' => $req->username, 'password' => $req->password]);


        return redirect('/guru/dashboard')->with('success', 'BERHASIL LOGIN!');
    }



    // FUNCTION LOGOUT
    public function logout()
    {
        if (Auth::user()) {
            Auth::logout();

            return redirect('/auth/siswa');
        }

        Auth::guard('guru')->logout();

        return redirect('/auth/guru');
    }
}
