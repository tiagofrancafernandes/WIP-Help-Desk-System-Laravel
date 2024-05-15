<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CustomerController;

Route::resource('customers', CustomerController::class);

Route::get('/', fn () => redirect('dashboard'));
Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
