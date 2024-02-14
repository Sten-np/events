<?php

use App\Http\Controllers\admin as admin;
use App\Http\Controllers\open as open;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('layouts.layoutpublic');
})->name('home');

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::resource('admin/events', admin\EventController::class);
    Route::resource('admin/users', admin\UserController::class);
    Route::get('admin/users/{user}/delete' , [Admin\UserController::class, 'delete'])
        ->name('users.delete');
});

Route::group(['middleware' => ['auth', 'role:admin|organizer']], function () {
    Route::get('/admin', function () {
        return view('layouts.layoutadmin');
    })->name('admin');
    Route::resource('admin/events', admin\EventController::class);
    Route::get('admin/events/{event}/delete' , [Admin\EventController::class, 'delete'])
        ->name('events.delete');
});

Route::get('events', [open\OpenEventController::class, 'index'])->name('events');



Route::get('/cart', [open\CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [open\CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/remove/{rowId}', [open\CartController::class, 'removeFromCart'])->name('cart.remove');
Route::put('cart/update/{rowId}', [open\CartController::class, 'updateCart'])->name('cart.update');

Route::post('/checkout', [open\CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');


Route::get('/dashboard', function () {
    return view('layouts.layoutpublic');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
