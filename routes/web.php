<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Admin\ProductController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\IsAdmin;


Route::get('/', function () {
    $products = Product::all();
    return view('welcome', compact('products'));
})->middleware('auth')->name('welcome');

Route::get('/login', [AuthController::class, 'index'])
    ->name('login')
    ->middleware('guest');

Route::get('/register', function () {
    return view('auth.register');
})->middleware('guest')->name('register');

Route::post('/register', function (Request $request) {
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:6',
    ]);

    \App\Models\User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'role' => 'user',
    ]);

    return redirect()->route('login')->with('status', 'Account created. Please login.');
})->middleware('guest');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->Middleware('auth');

Route::get('/profile', function () {
    return view('auth.profile');
})->middleware('auth')->name('profile');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Illuminate\Http\Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink($request->only('email'));

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::get('/cart', function () {
    return view('pages.cart');
})->middleware('auth')->name('cart');

Route::get('/orders', function () {
    return view('pages.orders');
})->middleware('auth')->name('orders');



Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/product_detail/{id}', [ShopController::class, 'show'])->name('product_detail');


Route::prefix('admin')->middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('products', ProductController::class);
});

Route::get(uri: 'checkout', action: function () {
return view('pages.checkout');
})->middleware('auth')->name('checkout');

Route::get('/contact', function () {
    return view('pages.contact');
})->middleware('auth')->name('contact');
