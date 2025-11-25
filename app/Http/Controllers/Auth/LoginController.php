<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\HuellaDigital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
     * Procesa el login tradicional con documento y contraseña
     */
    public function login(Request $request)
    {
        $request->validate([
            'numero_documento' => 'required|string',
            'password' => 'required|string',
        ]);

        // Buscar usuario por número de documento
        $usuario = Usuario::where('numero_documento', $request->numero_documento)
                         ->with(['rol', 'centro', 'regional', 'programa', 'grupo'])
                         ->first();

        if (!$usuario) {
            throw ValidationException::withMessages([
                'numero_documento' => __('El número de documento no está registrado en el sistema.'),
            ]);
        }

        // Verificar contraseña
        if (!Hash::check($request->password, $usuario->password)) {
            throw ValidationException::withMessages([
                'numero_documento' => __('La contraseña es incorrecta.'),
            ]);
        }

        // Verificar estado de la cuenta
        if ($usuario->estado !== 'activo') {
            $estado = $usuario->estado;
            $mensaje = match($estado) {
                'inactivo' => 'Su cuenta está inactiva. Contacte al administrador del sistema.',
                'suspendido' => 'Su cuenta ha sido suspendida. Contacte al administrador del sistema.',
                default => 'Su cuenta no está activa.'
            };
            
            throw ValidationException::withMessages([
                'numero_documento' => __($mensaje),
            ]);
        }

        // Verificar estado de registro
        if (!$usuario->esVerificado()) {
            $estadoRegistro = $usuario->estado_registro;
            $mensaje = match($estadoRegistro) {
                'pendiente' => 'Su registro está pendiente de verificación por el personal del SENA.',
                'rechazado' => 'Su registro ha sido rechazado. Motivo: ' . ($usuario->motivo_rechazo ?? 'No especificado'),
                default => 'Su registro requiere verificación.'
            };
            
            throw ValidationException::withMessages([
                'numero_documento' => __($mensaje),
            ]);
        }

        // Si pasa todas las validaciones, iniciar sesión
        Auth::login($usuario, $request->filled('remember'));
        $request->session()->regenerate();

        // Registrar el acceso exitoso
        $this->registrarAccesoExitoso($usuario, 'contraseña');

        return $this->authenticated($request, $usuario);
    }

    /**
     * Procesa el login con huella digital
     */
    public function loginHuella(Request $request)
    {
        $request->validate([
            'numero_documento' => 'required|string',
            'template_huella' => 'required|string',
        ]);

        // Buscar usuario
        $usuario = Usuario::where('numero_documento', $request->numero_documento)
                         ->with(['rol', 'centro', 'regional'])
                         ->first();

        if (!$usuario) {
            throw ValidationException::withMessages([
                'numero_documento' => __('El número de documento no está registrado en el sistema.'),
            ]);
        }

        // Verificar estado de la cuenta
        if ($usuario->estado !== 'activo') {
            throw ValidationException::withMessages([
                'numero_documento' => __('Su cuenta no está activa. Contacte al administrador.'),
            ]);
        }

        // Verificar estado de registro
        if (!$usuario->esVerificado()) {
            throw ValidationException::withMessages([
                'numero_documento' => __('Su registro no ha sido verificado. Contacte al administrador.'),
            ]);
        }

        // Verificar huella digital
        if ($this->verificarHuella($usuario, $request->template_huella)) {
            Auth::login($usuario);
            $request->session()->regenerate();

            // Registrar el acceso exitoso por huella
            $this->registrarAccesoExitoso($usuario, 'huella_digital');

            return $this->authenticated($request, $usuario);
        }

        throw ValidationException::withMessages([
            'numero_documento' => __('La huella digital no coincide.'),
        ]);
    }

    /**
     * Verifica la huella digital (simulación - en producción usar SDK real)
     */
    private function verificarHuella(Usuario $usuario, string $templateHuella): bool
    {
        // Buscar huellas activas del usuario
        $huellas = HuellaDigital::where('usuario_id', $usuario->id)
                               ->where('activa', true)
                               ->get();

        // Si no tiene huellas registradas
        if ($huellas->isEmpty()) {
            \Log::warning("Usuario {$usuario->numero_documento} intentó acceso por huella pero no tiene huellas registradas");
            return false;
        }

        foreach ($huellas as $huella) {
            // En un sistema real, aquí se usaría un SDK de huella digital
            // como DigitalPersona, Neurotechnology, etc.
            if ($this->compararTemplates($huella->template_huella, $templateHuella)) {
                // Registrar el acceso por huella
                $this->registrarAccesoHuella($usuario, $huella);
                return true;
            }
        }

        // Log de intento fallido
        \Log::warning("Intento fallido de acceso por huella - Usuario: {$usuario->numero_documento}");

        return false;
    }

    /**
     * Comparación de templates de huella (SIMULACIÓN)
     * En producción usar SDK especializado
     */
    private function compararTemplates(string $templateAlmacenado, string $templateIngresado): bool
    {
        // Simulación: en producción esto sería con algoritmo de matching
        // Por ahora, simulamos que coinciden si tienen más del 80% de similitud
        similar_text($templateAlmacenado, $templateIngresado, $porcentaje);
        
        // Log para debugging
        \Log::info("Comparación de huella - Similitud: {$porcentaje}%");
        
        return $porcentaje > 80;
    }

    /**
     * Registra el acceso por huella digital
     */
    private function registrarAccesoHuella(Usuario $usuario, HuellaDigital $huella)
    {
        \Log::info("Acceso por huella digital - Usuario: {$usuario->numero_documento}, Dedo: {$huella->dedo}, Calidad: {$huella->calidad}");
    }

    /**
     * Registra acceso exitoso
     */
    private function registrarAccesoExitoso(Usuario $usuario, string $metodo)
    {
        \Log::info("Acceso exitoso - Usuario: {$usuario->numero_documento}, Método: {$metodo}, Rol: {$usuario->rol->nombre}");
    }

    /**
     * Maneja el redireccionamiento después del login exitoso
     */
    protected function authenticated(Request $request, $usuario)
    {
        // Registrar información de la sesión
        $request->session()->put('user_info', [
            'nombre_completo' => $usuario->nombre_completo,
            'rol' => $usuario->rol->nombre,
            'centro' => $usuario->centro->nombre,
            'regional' => $usuario->regional->nombre,
            'foto_url' => $usuario->foto_url,
            'programa' => $usuario->programa->nombre ?? 'N/A',
            'grupo' => $usuario->grupo->nombre ?? 'N/A'
        ]);

        // Redireccionar según el rol con mensaje de bienvenida
        $ruta = match($usuario->rol->nombre) {
            'Aprendiz' => [
                'route' => 'aprendiz.dashboard',
                'message' => 'Bienvenido al panel de Aprendiz'
            ],
            'Instructor' => [
                'route' => 'instructor.dashboard', 
                'message' => 'Bienvenido al panel de Instructor'
            ],
            'Administrativo' => [
                'route' => 'dashboard',
                'message' => 'Bienvenido al panel Administrativo'
            ],
            'Funcionario' => [
                'route' => 'dashboard',
                'message' => 'Bienvenido al panel de Funcionario'
            ],
            default => [
                'route' => 'dashboard',
                'message' => 'Bienvenido al sistema IDENTITY'
            ]
        };

        return redirect()->route($ruta['route'])
                        ->with('success', $ruta['message'] . ', ' . $usuario->nombres . '!');
    }

    /**
     * Cierra la sesión del usuario
     */
    public function logout(Request $request)
    {
        // Registrar cierre de sesión
        if (Auth::check()) {
            $usuario = Auth::user();
            \Log::info("Cierre de sesión - Usuario: {$usuario->numero_documento}");
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
                ->with('info', 'Ha cerrado sesión exitosamente.');
    }

    /**
     * Muestra formulario para recuperar contraseña
     */
    public function showPasswordResetForm()
    {
        return view('auth.password-reset');
    }

    /**
     * Maneja solicitud de recuperación de contraseña
     */
    public function sendPasswordResetLink(Request $request)
    {
        $request->validate([
            'numero_documento' => 'required|string',
            'email' => 'required|email',
        ]);

        $usuario = Usuario::where('numero_documento', $request->numero_documento)
                         ->where('email', $request->email)
                         ->where('estado', 'activo')
                         ->where('estado_registro', 'verificado')
                         ->first();

        if ($usuario) {
            // Aquí se implementaría el envío de email para reset de contraseña
            \Log::info("Solicitud de reset de contraseña - Usuario: {$usuario->numero_documento}");
            
            return back()->with('success', 'Se ha enviado un enlace de recuperación a su correo electrónico.');
        }

        return back()->with('error', 'No se encontró una cuenta activa con los datos proporcionados.');
    }
}