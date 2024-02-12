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
});

Route::group(['middleware' => ['auth', 'role:admin|organizer']], function () {
    Route::get('/admin', function () {
        return view('layouts.layoutadmin');
    });
    Route::resource('admin/events', admin\EventController::class);
});

Route::get('events', [open\OpenEventController::class, 'index'])->name('events');



Route::get('/dashboard', function () {
    return view('layouts.layoutpublic');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
