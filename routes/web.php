<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Página de inicio
Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::get('/inicio', function () {
    return view('inicio');
});

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Ruta del dashboard (protegida)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');


