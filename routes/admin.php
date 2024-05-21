<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CustomerController;

Route::resource('customers', CustomerController::class);
Route::put('customers/{customer}/update-password', [CustomerController::class, 'updatePassword'])->name('customers.update_password');

Route::get('/', fn () => redirect('dashboard'));
Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
