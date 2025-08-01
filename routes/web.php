<?php
use App\Models\Product;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'getTop']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
Route::get('/register', [UserController::class, 'showRegister']);

Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/update/{id}/{qty}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/cart/remove-selected', [CartController::class, 'removeSelected'])->name('cart.removeSelected');
    Route::get('/profile', [UserController::class, 'show']);
    Route::patch('/profile/{user}', [UserController::class, 'update']);
});

Route::middleware([IsAdmin::class])->group(function () {
    Route::get('/dashboard', [ProductController::class, 'indexAdmin']);
    Route::get('/dashboard/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/dashboard', [ProductController::class, 'store'])->name('products.store');
    Route::get('/dashboard/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::patch('/dashboard/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::patch('/dashboard/{product}/ishide', [ProductController::class, 'updateishide'])->name('products.updateishide');
    Route::delete('/dashboard/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});