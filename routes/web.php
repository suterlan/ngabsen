<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Imah\PermissionController;
use App\Http\Controllers\Imah\RoleController;
use App\Http\Controllers\Imah\TemaUndanganController;
use App\Http\Controllers\Imah\UndanganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Imah\UserController;
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

Route::get('/', [AuthenticatedSessionController::class, 'create'])->middleware('guest');

// Route::permanentRedirect('/panto', 'login');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::prefix('imah')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::controller(UserController::class)->group(function () {
            Route::get('/users', 'index')->name('users');
            Route::get('/users/tambah', 'create')->name('users.create');
            Route::post('/users', 'store')->name('users.store');
            Route::get('/users/{user}', 'edit');
            Route::patch('/users/{user}', 'update');
            Route::delete('/users/{user}', 'destroy');
        });
        Route::controller(RoleController::class)->group(function () {
            Route::get('/roles', 'index')->name('roles');
            Route::post('/roles', 'store')->name('roles.store');
            Route::put('/roles/{role}', 'update')->name('roles.update');
            Route::delete('/roles/{role}', 'destroy')->name('roles.delete');
        });
        Route::controller(PermissionController::class)->group(function () {
            Route::get('/permission', 'index')->name('permission');
            Route::post('/permission', 'store')->name('permission.store');
            Route::put('/permission/{permission}', 'update')->name('permission.update');
            Route::delete('/permission/{permission}', 'destroy')->name('permission.delete');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
