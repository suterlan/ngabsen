<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\backend\AttendanceController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\JabatanController;
use App\Http\Controllers\backend\KehadiranController;
use App\Http\Controllers\backend\MonitoringPresensiController;
use App\Http\Controllers\backend\PermissionController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\SettingsController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\DashboardController as ControllersDashboardController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\PresensiController as ControllersPresensiController;
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

Route::get('/', [AuthenticatedSessionController::class, 'create'])->middleware('guest');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware(['role:super-admin|admin'])->group(function () {
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            // Route Users Settings
            Route::controller(UserController::class)->group(function () {
                Route::get('/users', 'index')->name('users')->middleware('permission:view-users');
                Route::get('/users/tambah', 'create')->name('users.create')->middleware('permission:create-users');
                Route::post('/users', 'store')->name('users.store')->middleware('permission:store-users');
                Route::get('/users/{user}', 'edit')->name('users.edit')->middleware('permission:edit-users');
                Route::patch('/users/{user}', 'update')->name('users.update')->middleware('permission:update-users');
                Route::delete('/users/{user}', 'destroy')->name('users.destroy')->middleware('permission:delete-users');
                Route::put('/users/change-role/{user}', 'changeRole')->name('users.role')->middleware('permission:change-role-users');
            });
            Route::controller(RoleController::class)->group(function () {
                Route::get('/roles', 'index')->name('roles')->middleware('permission:view-role');
                Route::post('/roles', 'store')->name('roles.store')->middleware('permission:create-role|store-role');
                Route::put('/roles/{role}', 'update')->name('roles.update')->middleware('permission:edit-role|update-role');
                Route::delete('/roles/{role}', 'destroy')->name('roles.delete')->middleware('permission:delete-role');
            });
            Route::controller(PermissionController::class)->group(function () {
                Route::get('/permission', 'index')->name('permission')->middleware('permission:view-permission');
                Route::post('/permission', 'store')->name('permission.store')->middleware('permission:create-permission|store-permission');;
                Route::put('/permission/{permission}', 'update')->name('permission.update')->middleware('permission:edit-permission|update-permission');
                Route::delete('/permission/{permission}', 'destroy')->name('permission.delete')->middleware('permission:delete-permission');
            });

            Route::controller(AttendanceController::class)->group(function () {
                Route::get('/attendance', 'index')->name('attendance.index');
                Route::get('/attendance/create', 'create')->name('attendance.create');
                Route::post('/attendance', 'store')->name('attendance.store');
                Route::get('/attendance/edit/{attendance}', 'edit')->name('attendance.edit');
                Route::put('/attendance/{attendance}', 'update')->name('attendance.update');
                Route::delete('/attendance/{attendance}', 'destroy')->name('attendance.delete');
            });

            Route::resource('/jabatan', JabatanController::class)->except(['create', 'show', 'edit']);

            //Route Monitoring
            Route::controller(MonitoringPresensiController::class)->group(function () {
                Route::get('/monitoring/presensi', 'presensi')->name('monitoring-presensi');
            });

            // Route Data Kehadiran
            Route::controller(KehadiranController::class)->group(function () {
                Route::get('/presences', 'index')->name('presences.index');
                Route::get('/presences/{attendance}', 'show')->name('presences.show');
                Route::get('/presences/{attendance}/izin', 'showIzin')->name('presences.izin');
                Route::post('/presences/{attendance}/izin-accepted', 'approveIzin')->name('presences.acceptedizin');
                Route::get('/presences/{attendance}/not-present', 'notPresent')->name('presences.notpresent');
                Route::post('/presences/{attendance}/not-present', 'Present')->name('presences.present');
            });

            // Route Settings
            Route::controller(SettingsController::class)->group(function () {
                Route::get('/settings', 'index')->name('settings');
                Route::post('/settings', 'store')->name('settings.store');
            });
        });
    });
});

Route::get('/dashboard', [ControllersDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(ControllersPresensiController::class)->group(function () {
        Route::get('/presensi', 'index')->name('presensi.index');
        Route::get('/presensi/{attendance}', 'show')->name('presensi.show');
        Route::post('/presensi', 'store')->name('presensi.store');
    });

    Route::get('/riwayat-presensi', [HistoryController::class, 'index'])->name('history');

    Route::controller(IzinController::class)->group(function () {
        Route::get('/izin', 'index')->name('izin');
        Route::get('/izin/create', 'create')->name('izin.create');
        Route::post('/izin', 'store')->name('izin.store');
    });
});


require __DIR__ . '/auth.php';
