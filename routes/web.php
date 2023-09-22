<?php

use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', [UserController::class, 'dashbord'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/', [UserController::class, 'index'])->name('home');
Route::resource('products', ProductController::class)->middleware(['auth', 'role:admin']);

Route::middleware("auth")->group(function () {

    Route::get('product/{product}', [UserController::class, 'show'])->name("product.show");
    Route::post('payment/process-payment/{string}/{price}', [UserController::class, 'processPayment'])->name('processPayment');
    Route::get('order/{order}/cancle', [UserController::class, 'cancleOrder'])->name('cancle.order');

    Route::get('user/{user}/status', [UserController::class,'changeStatus'])->name('user.status');
});
