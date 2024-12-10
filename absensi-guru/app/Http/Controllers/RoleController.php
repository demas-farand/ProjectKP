<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        return view('pengaturan', compact('roles'));
    }

    // Menampilkan form untuk membuat role baru
    public function createRole()
    {
        return view('role.createRole');
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:255|unique:roles,name',
        ]);

        Role::create(['name' => $request->role_name]);

        return redirect()->route('pengaturan')->with('success', 'Role created successfully');
    }

    public function edit(Role $role)
    {
        // Menampilkan form edit role
        return view('role.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'role_name' => 'required|string|max:255|unique:roles,name,' . $role->id,
        ]);

        $role->update(['name' => $request->role_name]);

        return redirect()->route('pengaturan')->with('success', 'Role updated successfully');
    }

    // Menampilkan form untuk membuat user baru dengan role
    public function createUser()
    {
        // Mengambil semua role dari database
        $roles = Role::all();

        // Mengirimkan data roles ke view
        return view('role.create', compact('roles'));
    }

    // Menyimpan user baru ke database
    public function storeUser(Request $request)
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
            'password' => Hash::make($request->password),
        ]);

        // Menyimpan role yang dipilih untuk user
        $user->roles()->attach($request->role_id);

        // Redirect ke halaman pengaturan dengan pesan sukses
        return redirect()->route('pengaturan')->with('success', 'User created successfully');
    }



}
