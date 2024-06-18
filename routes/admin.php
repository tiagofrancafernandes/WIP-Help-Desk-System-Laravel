<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CustomerUserController;
use App\Http\Controllers\Admin\ContractController;

Route::prefix('customers')->name('customers.')->group(function () {
    Route::resource('users', CustomerUserController::class);
    Route::put('users/{user}/update-password', [CustomerUserController::class, 'updatePassword'])->name('user.update_password');
});

Route::resource('contracts', ContractController::class);

Route::get('/', fn () => redirect('dashboard'));
Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
