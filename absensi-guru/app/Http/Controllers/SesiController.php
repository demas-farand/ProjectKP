<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\absensi\Guru;

class SesiController extends Controller
{
    function index()
    {
        return view('login.login');
    }

    function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $infologin = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            if (Auth::user()->role == 'Admin' || Auth::user()->role == 'User') {
                return redirect('dashboard');
            }
        } else {
            $guru = Guru::where('username', $request->username)->first();
            if ($guru && Hash::check($request->password, $guru->password)) {
                Auth::login($guru);
                return redirect('dashboard');
            }
        }

        return redirect('')->withErrors('Username dan Password yang dimasukan tidak sesuai')->withInput();
    }
    public function apiLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $infologin = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            if (Auth::user()->role == 'Admin' || Auth::user()->role == 'User') {
                return response()->json(['success' => true, 'message' => 'Login successful', 'user' => Auth::user()], 200);
            }
        } else {
            $guru = Guru::where('username', $request->username)->first();
            if ($guru && Hash::check($request->password, $guru->password)) {
                Auth::login($guru);
                return response()->json(['success' => true, 'message' => 'Login successful', 'user' => Auth::user()], 200);
            }
        }

        return response()->json(['success' => false, 'message' => 'Invalid username or password'], 401);
    }

    function logout()
    {
        Auth::logout();
        return redirect('');
    }
}
