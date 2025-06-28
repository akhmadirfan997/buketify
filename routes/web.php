<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BuyerController;

Route::get('/', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }
    if (Auth::user()->role === 'admin') {
        return redirect()->route('products.index');
    }
    return redirect()->route('buyer.dashboard');
});

Route::middleware(['auth', 'admin'])->resource('products', ProductController::class);

Route::middleware(['auth', 'user'])->get('/buyer', [BuyerController::class, 'dashboard'])->name('buyer.dashboard');

Auth::routes();
