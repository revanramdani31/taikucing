<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class GudangController extends BaseController
{
    public function index() // ✅ Ganti dari 'gudang' ke 'index'
    {
        // Cek apakah user sudah login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Cek role
        if (session()->get('user_role') !== 'gudang') {
            return redirect()->to('/login')->with('error', 'Akses ditolak!');
        }

        return view('gudang/dashboard');
    }
}