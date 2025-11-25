<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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
Route::post('/login-huella', [LoginController::class, 'loginHuella'])->name('login.huella');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas de registro
Route::get('/registro', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/registro', [RegisterController::class, 'register']);
Route::get('/registro/exitoso', [RegisterController::class, 'registroExitoso'])->name('registro.exitoso');

// Rutas protegidas
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/aprendiz/dashboard', function () {
        return view('dashboard');
    })->name('aprendiz.dashboard');

    Route::get('/instructor/dashboard', function () {
        return view('dashboard');
    })->name('instructor.dashboard');

    // Rutas de registro para personal (protegidas)
    Route::get('/admin/registro-personal', [RegisterController::class, 'showStaffRegistrationForm'])->name('register.staff');
    Route::post('/admin/registro-personal', [RegisterController::class, 'registerStaff']);
});

// Rutas de recuperación de contraseña
Route::get('/password/reset', [LoginController::class, 'showPasswordResetForm'])->name('password.request');
Route::post('/password/email', [LoginController::class, 'sendPasswordResetLink'])->name('password.email');