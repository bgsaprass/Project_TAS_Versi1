<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba autentikasi
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Restore cart from DB if exists
            try {
                $cart = \App\Models\Cart::where('user_id', Auth::id())->first();
                if ($cart && is_array($cart->data)) {
                    // merge DB cart into session cart
                    $sessionCart = session('cart', []);
                    $merged = array_replace_recursive($sessionCart, $cart->data ?: []);
                    session(['cart' => $merged]);
                }
            } catch (\Exception $e) {
                // ignore
            }

            // ensure cart row exists
            \App\Models\Cart::firstOrCreate(['user_id' => Auth::id()]);

            return redirect()->intended('/');
        }

        // Jika gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        // Before logout, persist session cart to DB so it survives logout
        try {
            if (Auth::check()) {
                $cartData = session('cart', []);
                \App\Models\Cart::updateOrCreate(
                    ['user_id' => Auth::id()],
                    ['data' => $cartData]
                );
            }
        } catch (\Exception $e) {
            // ignore
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    public function changeForm()
    {
        return view('auth.change-password');
    }
   public function changePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password'     => 'required|min:6|confirmed',
    ]);

    $user = User::findOrFail(Auth::id()); // ambil ulang sebagai model Eloquent

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Password lama salah']);
    }

    $user->password = Hash::make($request->new_password);
    $user->save(); // sekarang pasti dikenali IDE dan jalan

    return redirect()->route('profile')->with('success', 'Password berhasil diubah');
}

}
