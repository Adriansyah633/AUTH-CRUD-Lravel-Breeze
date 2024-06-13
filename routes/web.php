<?php
 
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ShopController;
 
Route::get('/', function () {
    return view('welcome');
});
 
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
 
Route::middleware(['auth', 'admin'])->group(function () {
 
    Route::get('admin/dashboard', [HomeController::class, 'index']);
 
    Route::get('/admin/products', [ProductsController::class, 'index'])->name('admin/products')->name('admin.products');
    Route::get('/admin/products/create', [ProductsController::class, 'create'])->name('admin/products/create');
    Route::post('/admin/products/save', [ProductsController::class, 'save'])->name('admin/products/save');
    Route::get('/admin/products/edit/{id}', [ProductsController::class, 'edit'])->name('admin/products/edit');
    Route::put('/admin/products/edit/{id}', [ProductsController::class, 'update'])->name('admin/products/update');
    Route::get('/admin/products/delete/{id}', [ProductsController::class, 'delete'])->name('admin/products/delete');
});
Route::get('/dashboard', [ShopController::class, 'index'])->name('dashboard');
 
require __DIR__.'/auth.php';