<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ContractController;

Route::resource('customers', CustomerController::class);
Route::put('customers/{customer}/update-password', [CustomerController::class, 'updatePassword'])->name('customers.update_password');
Route::resource('contracts', ContractController::class);

Route::get('/', fn () => redirect('dashboard'));
Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
