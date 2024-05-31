<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Menampilkan form registrasi
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses registrasi pengguna baru
    public function register(Request $request)
    {
        // Validasi data input
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'nik' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Jika validasi gagal, kembali ke halaman sebelumnya dengan error dan input lama
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Membuat pengguna baru dengan data yang valid
        $user = User::create([
            'fullname' => $request->fullname,
            'nik' => $request->nik,
            'email' => $request->email,
            'address' => $request->address,
            'password' => Hash::make($request->password), // Hashing password
            'role_id' => 2, // Set role pengguna (non-admin)
        ]);

        // Melakukan login otomatis setelah registrasi berhasil
        Auth::login($user);

        // Redirect ke halaman daftar mobil
        return redirect()->route('cars.index');
    }

    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login pengguna
    public function login(Request $request)
    {
        // Mengambil kredensial dari input
        $credentials = $request->only('email', 'password');

        // Validasi data input
        $validator = Validator::make($credentials, [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        // Jika validasi gagal, kembali ke halaman sebelumnya dengan error dan input lama
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Coba melakukan login dengan kredensial yang diberikan
        if (Auth::attempt($credentials)) {
            // Regenerasi sesi untuk keamanan
            $request->session()->regenerate();

            // Mengambil pengguna yang sedang login
            $user = Auth::user();

            // Redirect berdasarkan peran pengguna
            if ($user->role_id == 1) {
                return redirect()->route('admin.dashboard'); // Admin
            } else if ($user->role_id == 2) {
                return redirect()->route('cars.index'); // Pengguna biasa
            }
        }

        // Jika login gagal, kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Proses logout pengguna
    public function logout(Request $request)
    {
        // Melakukan logout
        Auth::logout();

        // Menginvalidasi sesi pengguna
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman utama
        return redirect('/');
    }
}
