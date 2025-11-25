<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Muestra el formulario de login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Procesa el intento de login
     */
    public function login(Request $request)
    {
        // Validación de campos
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Intentar autenticación
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();

            // Redireccionar según el tipo de usuario
            return redirect()->intended('/dashboard');
        }

        // Si la autenticación falla
        throw ValidationException::withMessages([
            'email' => __('Las credenciales proporcionadas no son válidas.'),
        ]);
    }

    /**
     * Cierra la sesión del usuario
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}