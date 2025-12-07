<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;

// =======================
// PUBLIC ROUTES
// =======================

Route::get('/', function (Request $request) {
    $categories = Category::withCount('products')->get();

    $productsQuery = Product::query();

    if ($request->filled('category') && Category::find($request->category)) {
        $productsQuery->where('category_id', $request->category);
    }

    if ($request->filled('search')) {
        $productsQuery->where('name', 'like', '%' . $request->search . '%');
    }

    if ($request->sort === 'price_asc') {
        $productsQuery->orderBy('price', 'asc');
    } elseif ($request->sort === 'price_desc') {
        $productsQuery->orderBy('price', 'desc');
    }

    $products = $productsQuery->get();

    return view('welcome', [
        'products' => $products,
        'categories' => $categories,
        'selectedCategory' => $request->category,
        'sort' => $request->sort,
        'search' => $request->search,
    ]);
})->name('welcome');

// =======================
// AUTH ROUTES
// =======================

Route::get('/login', [AuthController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/register', fn() => view('auth.register'))->middleware('guest')->name('register');
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

Route::get('/forgot-password', fn() => view('auth.forgot-password'))->middleware('guest')->name('password.request');
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    $status = Password::sendResetLink($request->only('email'));

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', fn($token) => view('auth.reset-password', ['token' => $token]))
    ->middleware('guest')->name('password.reset');

Route::get('/profile', fn() => view('auth.profile'))->middleware('auth')->name('profile');

// =======================
// SHOP ROUTES
// =======================

Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop/{id}', [ShopController::class, 'detail'])->name('shop.detail');
Route::get('/product_detail/{id}', [ShopController::class, 'show'])->name('product.detail');
Route::get('/shop/show/{id}', [ShopController::class, 'show'])->name('shop.show');

// =======================
// CART & CHECKOUT ROUTES
// =======================

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    // Semua user bisa lihat halaman checkout (tampilan saja)
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

    // Hanya user biasa yang boleh melakukan aksi pembelian
    Route::middleware(\App\Http\Middleware\PreventAdminPurchase::class)->group(function () {
        // Cart actions
        Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
        Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
        Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

        // Checkout actions
        Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
        Route::post('/checkout-selected', [CheckoutController::class, 'checkoutSelected'])->name('checkout.selected');
        Route::post('/checkout/direct/{id}', [CheckoutController::class, 'direct'])->name('checkout.direct');
        Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
        Route::post('/checkout/finalize', [CheckoutController::class, 'finalize'])->name('checkout.finalize');
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

        // Payment methods
        Route::get('/checkout/bank', [CheckoutController::class, 'bankTransfer'])->name('checkout.bank');
        Route::get('/checkout/cod', [CheckoutController::class, 'cod'])->name('checkout.cod');
        Route::get('/checkout/ewallet', [CheckoutController::class, 'eWallet'])->name('checkout.ewallet');
    });
});

// =======================
// ORDERS & CONTACT ROUTES
// =======================

Route::get('/orders', [OrderController::class, 'index'])->middleware('auth')->name('orders');
Route::get('/orders/{id}', [OrderController::class, 'show'])->middleware('auth')->name('orders.show');
Route::get('/contact', fn() => view('pages.contact'))->name('contact');

// =======================
// ADDRESS ROUTES
// =======================

Route::get('/address/create', [AddressController::class, 'create'])->middleware('auth')->name('address.create');
Route::post('/address/store', [AddressController::class, 'store'])->middleware('auth')->name('address.store');

// =======================
// ADMIN ROUTES
// =======================

Route::prefix('admin')
    ->middleware(['auth', \App\Http\Middleware\IsAdmin::class])->name('admin.')->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index'])->name('index');

        Route::resource('products', ProductController::class);

        // Users (resourceful)
        Route::resource('users', UsersController::class);

        // Orders
        Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
        Route::put('/orders/{order}/update-status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::get('/users/{user}/orders', [\App\Http\Controllers\Admin\OrderController::class, 'userOrders']) ->name('users.orders');
        Route::put('/orders/{order}/update-shipping', [\App\Http\Controllers\Admin\OrderController::class, 'updateShipping'])->name('orders.updateShipping');



        // Reports & Sales
        Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
        Route::get('/sales', [AdminController::class, 'sales'])->name('sales');

        // Settings
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
    });
