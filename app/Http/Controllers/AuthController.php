<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;

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
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
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

        // ✔ Cek apakah username terdaftar

        if (!Auth::attempt($request->only('username', 'password'))) {
            return back()->withErrors([
                'username' => 'Username atau password salah.'
            ]);
        }

        // ✔ Login berhasil
        $request->session()->regenerate();

        return redirect()->route('dashboard.index');
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
        $user = Auth::user() ?? User::findOrFail(1);
        
        Auth::setUser($user); // pastikan auth()->user() tidak null
        
        return view('admin.admin_profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user() ?? User::findOrFail(1);
    
        Auth::setUser($user); // pastikan auth()->user() tidak null
        
        $request->validate([
            'username'     => 'required|string|max:50|unique:users,username,' . $user->id,
            'nama_depan'   => 'nullable|string|max:255',
            'nama_belakang'=> 'nullable|string|max:255',
            'no_telepon' => [
                'nullable',
                'regex:/^08[0-9]{8,13}$/'
            ],
            'email'        => 'required|email|unique:users,email,' . $user->id,
            'password'     => 'nullable|min:6|confirmed',
            'foto'         => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('foto')) {

            $foto = $request->file('foto');

            // Validasi resolusi aman
            list($width, $height) = getimagesize($foto);
            if ($width > 3000 || $height > 3000) {
                return back()->withErrors(['foto' => 'Resolusi terlalu besar. Maksimal 3000x3000 px.']);
            }

            // Delete foto lama
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            // Simpan foto baru
            $filename = uniqid() . '.' . $foto->getClientOriginalExtension();
            $user->foto = $foto->storeAs('photos', $filename, 'public');
        }

         // Update data lain
        $user->username      = $request->username;
        $user->nama_depan    = $request->nama_depan;
        $user->nama_belakang = $request->nama_belakang;
        $user->no_telepon    = $request->no_telepon;
        $user->email         = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
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
