<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;


use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;

class AuthController extends Controller
{
    function login() {
        return view('layouts.login');
    }

    function authenticating(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/'],
        ],[
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.regex' => 'Kata sandi harus mengandung huruf dan angka.',
        ]);

        if (Auth::attempt($credentials)) {
            if (is_null(Auth::user()->email_verified_at)) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Anda harus memverifikasi email terlebih dahulu. Silakan cek email Anda.',
                ])->onlyInput('email');
            }
            // Check if user role is 'user'
            if (Auth::user()->role !== 'user') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Anda tidak memiliki akses sebagai user.',
                ])->onlyInput('email');
            }
            $request->session()->regenerate();
           
            return redirect()->intended('beranda');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showResendEmailForm()
    {
        return view('layouts.resend-email');
    }

    public function handleResendEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Anda belum membuat akun dengan email ini.',
            ])->withInput();
        }

        if ($user->email_verified_at) {
            return back()->withErrors([
                'email' => 'Email sudah diaktivasi.',
            ])->withInput();
        }

        // Login terlebih dahulu untuk bisa mengakses email verification
        Auth::login($user);

        if (!Auth::check()) {
            return back()->withErrors([
                'email' => 'Gagal login untuk mengirim verifikasi.',
            ])->withInput();
        }

        // Kirim ulang email verifikasi
        event(new Registered(Auth::user()));

        return back()->with('status', 'Link verifikasi telah dikirim ke email Anda.');
    }

    function register(){
        return view('layouts.register');
    }

    function createUser(Request $request){
        $credentials = $request->validate([
            'name' => ['required', 'string', 'min:3', 'regex:/^[A-Za-z\s]+$/'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/'],
            'password_confirmation' => ['required', 'same:password'],
        ],[
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa huruf.',
            'name.min' => 'Nama minimal 3 karakter.',
            'name.regex' => 'Nama hanya boleh berisi huruf dan spasi',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.regex' => 'Kata sandi harus mengandung huruf dan angka.',
            'password_confirmation.required' => 'Konfirmasi kata sandi wajib diisi.',
            'password_confirmation.same' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password']),
            'role' => 'user'
        ]);

        Auth::login($user);

        event(new Registered($user));

        return redirect("/email/verify");

    }

    function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    function login_admin() {
        return view('layouts.login-admin');
    }

    function authenticating_admin(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/'],
        ],[
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.regex' => 'Kata sandi harus mengandung huruf dan angka.',
        ]);
 
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == 'user') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Anda tidak memiliki akses sebagai admin.',
                ])->onlyInput('email');
            }
            $request->session()->regenerate();
 
            return redirect()->intended(route('dashboard'));
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Handle pendaftaran POST
    public function postPendaftaran(Request $request) {
        if (Auth::check() && Auth::user()->role === 'user') {
            // Validate and process pendaftaran data here
            // For now, just redirect to pembayaran page
            return redirect()->route('pembayaran');
        } else {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus login sebagai user untuk melakukan pendaftaran.']);
        }
    }

    // Handle pembayaran POST
    public function postPembayaran(Request $request) {
        if (Auth::check() && Auth::user()->role === 'user') {
            // Validate and process pembayaran data here
            // For now, just redirect to beranda with success message
            return redirect()->route('beranda')->with('success', 'Pembayaran berhasil diproses.');
        } else {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus login sebagai user untuk melakukan pembayaran.']);
        }
    }
}
