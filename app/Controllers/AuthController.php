<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;

// Pastikan nama class sudah benar: AuthController
class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        // Cara yang lebih baik untuk memuat model
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // Jika sudah login, redirect ke dashboard sesuai role
        if (session()->get('isLoggedIn')) {
            $role = session()->get('user_role');
            if ($role == 'gudang') {
                return redirect()->to('/gudang/dashboard');
            } elseif ($role == 'dapur') {
                return redirect()->to('/dapur/dashboard');
            }
        }

        // Tampilkan halaman login
        return view('auth/login');
    }

public function login()
{
    // Debug: Log request method
    log_message('info', 'Login method called. Request method: ' . $this->request->getMethod());
    
    // Hanya proses jika metodenya POST
    if ($this->request->getMethod() === 'post') {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Debug: Log input data
        log_message('info', 'Login attempt - Email: ' . $email);

        // Validasi input
        if (empty($email) || empty($password)) {
            log_message('error', 'Empty email or password');
            return redirect()->back()->with('error', 'Email dan password harus diisi!');
        }

        // Cari user berdasarkan email
        $user = $this->userModel->where('email', $email)->first();
        
        // Debug: Log user found
        log_message('info', 'User found: ' . ($user ? 'YES' : 'NO'));

        // Cocokkan password dengan MD5
        if ($user && $user['password'] === md5($password)) {
            // Debug: Log successful login
            log_message('info', 'Login successful for user: ' . $user['name']);

            // Set session
            session()->set([
                'isLoggedIn' => true,
                'user_id'    => $user['id'],
                'user_name'  => $user['name'],
                'user_email' => $user['email'],
                'user_role'  => $user['role'],
            ]);

            // Debug: Log redirect
            log_message('info', 'Redirecting to dashboard for role: ' . $user['role']);

            // Arahkan ke dashboard yang sesuai
            if ($user['role'] === 'gudang') {
                return redirect()->to('/gudang/dashboard');
            } else {
                return redirect()->to('/dapur/dashboard');
            }
        } else {
            // Debug: Log failed login
            log_message('error', 'Login failed - Invalid credentials');
            return redirect()->back()->with('error', 'Email atau password yang Anda masukkan salah.');
        }
    }

    // Debug: Log GET request
    log_message('info', 'Showing login form');
    return view('auth/login');
}

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login'); // Arahkan ke /login, bukan "login"
    }
}