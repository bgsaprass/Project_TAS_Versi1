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
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\OrderController;

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
// CART ROUTES
// =======================
Route::get('/cart', [CartController::class, 'index'])->middleware('auth')->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->middleware('auth')->name('cart.add');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->middleware('auth')->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->middleware('auth')->name('cart.remove');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/checkout-selected', [CheckoutController::class, 'checkoutSelected'])->name('checkout.selected');



// =======================
// CHECKOUT & PAYMENT ROUTES
// =======================

Route::get('/checkout', [CheckoutController::class, 'index'])->middleware('auth')->name('checkout');
Route::post('/checkout-selected', [CheckoutController::class, 'checkoutSelected'])->middleware('auth')->name('checkout.selected');
Route::post('/checkout/direct/{id}', [CheckoutController::class, 'direct'])->middleware('auth')->name('checkout.direct');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->middleware('auth')->name('checkout.process');

Route::get('/payment/bank', fn() => view('pages.payments.bank'))->name('payment.bank');
Route::get('/payment/cod', fn() => view('pages.payments.cod'))->name('payment.cod');
Route::get('/payment/ewallet', fn() => view('pages.payments.ewallet'))->name('payment.ewallet');

// =======================
// ORDERS & CONTACT ROUTES
// =======================

Route::get('/orders', [OrderController::class, 'index'])->middleware('auth')->name('orders');
Route::get('/contact', fn() => view('pages.contact'))->name('contact');

// =======================
// ADDRESS ROUTES
// =======================

Route::get('/address/create', [AddressController::class, 'create'])->middleware('auth')->name('address.create');
Route::post('/address/store', [AddressController::class, 'store'])->middleware('auth')->name('address.store');

// =======================
// ADMIN ROUTES
// =======================

Route::prefix('admin')->middleware(['auth', IsAdmin::class])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('index');
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');

    Route::resource('products', ProductController::class);
    Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/{order}/update-shipping', [\App\Http\Controllers\Admin\OrderController::class, 'updateShipping'])->name('orders.updateShipping');
});
