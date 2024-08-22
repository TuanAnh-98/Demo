<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Models\Product;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/danh-sach-san-pham', function () {
    $products = Product::all();
    return view('productlist', ['products' => $products]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {

    Route::post('/orders/create', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/create', [OrderController::class, 'showCreateForm'])->name('orders.createForm');
    Route::get('/orders/success', [OrderController::class, 'success'])->name('orders.success');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.edit');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('products', ProductController::class);


    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::post('/add-to-cart/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
});

require __DIR__ . '/auth.php';
