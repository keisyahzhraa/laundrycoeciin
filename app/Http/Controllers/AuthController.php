<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    // ===== REGISTER =====
    
    public function showRegisterForm()
    {
        return view('auth.register');
    }
    
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Simpan user baru
        $user = User::create([
            'username'     => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard.index')->with('success', 'Registrasi berhasil!');
    }

    // ===== LOGIN =====

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username'    => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard.index');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // === Edit Profile ===

    public function editProfile()
    {
        $user = Auth::user();
        return view('admin.admin_profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username'     => 'required|string|max:50|unique:users,username,' . $user->id,
            'nama_depan'   => 'nullable|string|max:255',
            'nama_belakang'=> 'nullable|string|max:255',
            'no_telepon'   => 'nullable|string|max:20',
            'email'        => 'required|email|unique:users,email,' . $user->id,
            'password'     => 'nullable|min:6|confirmed',
            'foto'         => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Update foto jika diupload
         if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('photos', 'public');
            $user->foto = $path;
        }

         // Update data lain
        $user->username      = $request->username;
        $user->nama_depan    = $request->nama_depan;
        $user->nama_belakang = $request->nama_belakang;
        $user->no_telepon    = $request->no_telepon;
        $user->alamat        = $request->alamat;
        $user->email         = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();
        Auth::setUser($user);

        return redirect()->route('admin.profile')->with('success', 'Profil berhasil diperbarui.');
    }

    // === Lupa Password ===
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-pw'); // arahkan ke file Blade
    }

    // === Proses Reset Password Manual ===
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed', // karena di form ada password + konfirmasi
        ]);

        $user = User::where('email', $request->email)->first();

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Password berhasil diubah. Silakan login kembali.');
    }
}
