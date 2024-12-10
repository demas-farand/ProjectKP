<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function create()
    {
        // Mengambil semua role untuk ditampilkan di dropdown
        $roles = Role::all();
        return view('role.create', compact('roles'));
    }

    // Menyimpan user baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        // Membuat user baru
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // Hash password sebelum disimpan
        ]);

        // Menyimpan role yang dipilih untuk user
        $user->roles()->attach($request->role_id);

        // Redirect ke halaman pengaturan dengan pesan sukses
        return redirect()->route('pengaturan')->with('success', 'User created successfully');
    }
}
