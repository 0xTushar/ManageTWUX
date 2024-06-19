<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TokenController;
use App\Http\Controllers\Admin\TwitterController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Permissions
    Route::resource('permissions', PermissionController::class, ['except' => ['store', 'update', 'destroy']]);

    // Roles
    Route::resource('roles', RoleController::class, ['except' => ['store', 'update', 'destroy']]);

    // Users
    Route::resource('users', UserController::class, ['except' => ['store', 'update', 'destroy']]);

    // Twitter
    Route::post('twitters/csv', [TwitterController::class, 'csvStore'])->name('twitters.csv.store');
    Route::put('twitters/csv', [TwitterController::class, 'csvUpdate'])->name('twitters.csv.update');
    Route::resource('twitters', TwitterController::class, ['except' => ['store', 'update', 'destroy']]);

    // Tokens
    Route::post('tokens/csv', [TokenController::class, 'csvStore'])->name('tokens.csv.store');
    Route::put('tokens/csv', [TokenController::class, 'csvUpdate'])->name('tokens.csv.update');
    Route::resource('tokens', TokenController::class, ['except' => ['store', 'update', 'destroy']]);
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
    if (file_exists(app_path('Http/Controllers/Auth/UserProfileController.php'))) {
        Route::get('/', [UserProfileController::class, 'show'])->name('show');
    }
});
