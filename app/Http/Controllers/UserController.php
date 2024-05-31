<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    // Menampilkan profil pengguna yang sedang login
    public function profile()
    {
        $user = Auth::user(); // Mengambil data pengguna yang sedang login
        return view('pages.profile.index', compact('user'));
    }

    // Menampilkan form edit profil pengguna yang sedang login
    public function edit_profile()
    {
        $user = Auth::user(); // Mengambil data pengguna yang sedang login
        return view('pages.profile.edit', compact('user'));
    }

    // Memperbarui profil pengguna yang sedang login
    public function update_profile(Request $request)
    {
        $userId = Auth::id(); // Mengambil id pengguna yang sedang login
        $user = User::findOrFail($userId); // Mengambil instance User berdasarkan id pengguna yang sedang login

        // Validasi data yang dikirim oleh pengguna
        $request->validate([
            'fullname' => 'required|string|max:255',
            'role_id' => 'required|integer',
            'nik' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'address' => 'nullable|string|max:255',
        ]);

        $user->update($request->all()); // Update data pengguna berdasarkan input

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully');
    }

    // Menampilkan daftar semua pengguna untuk admin
    public function index()
    {
        $roles = Role::all(); // Mengambil semua data pengguna
        $users = User::all(); // Mengambil semua data pengguna
        return view('pages.admin.users.index', compact('users','roles'));
    }

    // Menampilkan form pembuatan pengguna baru untuk admin
    public function create()
    {
        $roles = Role::all(); // Mengambil semua data pengguna
        return view('pages.admin.users.create',compact('roles'));
    }

    // Menyimpan pengguna baru ke dalam database
    public function store(Request $request)
    {
        // Validasi data yang dikirim oleh pengguna
        $request->validate([
            'fullname' => 'required|string|max:255',
            'role_id' => 'required|integer',
            'nik' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'address' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([ // Membuat pengguna baru berdasarkan input pengguna
            'fullname' => $request->fullname,
            'role_id' => $request->role_id,
            'nik' => $request->nik,
            'email' => $request->email,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }

    // Menampilkan detail pengguna tertentu untuk admin
    public function show(User $user)
    {
        $roles = Role::all(); // Mengambil semua data pengguna
        return view('pages.admin.users.show', compact('user','roles'));
    }

    // Menampilkan form pengeditan pengguna tertentu untuk admin
    public function edit(User $user)
    {
        $roles = Role::all(); // Mengambil semua data pengguna
        return view('pages.admin.users.edit', compact('user','roles'));
    }

    // Memperbarui data pengguna tertentu berdasarkan input admin
    public function update(Request $request, User $user)
    {
        // Validasi data yang dikirim oleh admin
        $request->validate([
            'fullname' => 'required|string|max:255',
            'role_id' => 'required|integer',
            'nik' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'address' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = $request->all();

        if ($request->filled('password')) { // Jika password diisi, maka hash password baru
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']); // Jika password tidak diisi, hapus key 'password' dari data
        }

        $user->update($data); // Memperbarui data pengguna berdasarkan input admin

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    // Menghapus pengguna tertentu dari database
    public function destroy(User $user)
    {
        $user->delete(); // Menghapus pengguna berdasarkan ID yang diberikan
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
