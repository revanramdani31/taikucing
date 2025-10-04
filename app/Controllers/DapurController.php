<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DapurController extends BaseController
{
    public function index() 
    {
        // Cek apakah user sudah login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Cek role
        if (session()->get('user_role') !== 'dapur') {
            return redirect()->to('/login')->with('error', 'Akses ditolak!');
        }

        return view('dapur/dashboard');
    }
}