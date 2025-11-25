<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\TipoDocumento;
use App\Models\Regional;
use App\Models\Centro;
use App\Models\Programa;
use App\Models\Grupo;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $tiposDocumento = TipoDocumento::all();
        $programas = Programa::where('estado', 'activo')->get();
        $grupos = Grupo::all();
        
        return view('auth.register', compact('tiposDocumento', 'programas', 'grupos'));
    }

    public function register(Request $request)
    {
        Log::info('=== REGISTER START ===', $request->all());

        // Validación básica
        $request->validate([
            'tipo_documento_id' => 'required|exists:tipo_documento,id',
            'numero_documento' => 'required|string|max:50|unique:usuarios',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|string|email|max:150|unique:usuarios',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try {
            // Usar valores por defecto para testing
            $rolAprendiz = Rol::where('nombre', 'Aprendiz')->first();
            $regionalBoyaca = Regional::where('codigo', 'RBOY')->first();
            $centroPrincipal = Centro::first();

            if (!$rolAprendiz || !$regionalBoyaca || !$centroPrincipal) {
                throw new \Exception('Datos de referencia no encontrados');
            }

            Log::info('Datos de referencia OK:', [
                'rol' => $rolAprendiz->id,
                'regional' => $regionalBoyaca->id,
                'centro' => $centroPrincipal->id
            ]);

            // Crear usuario con datos mínimos
            $usuarioData = [
                'tipo_documento_id' => $request->tipo_documento_id,
                'numero_documento' => $request->numero_documento,
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'email' => $request->email,
                'telefono' => $request->telefono ?? '0000000000',
                'tipo_sangre' => $request->tipo_sangre ?? 'O+',
                'fecha_nacimiento' => $request->fecha_nacimiento ?? '2000-01-01',
                'rol_id' => $rolAprendiz->id,
                'regional_id' => $regionalBoyaca->id,
                'centro_id' => $centroPrincipal->id,
                'programa_id' => $request->programa_id ?? 1,
                'grupo_id' => $request->grupo_id ?? 1,
                'password' => Hash::make($request->password),
                'estado_registro' => 'pendiente',
                'codigo_verificacion' => Str::random(40),
                'estado' => 'inactivo'
            ];

            Log::info('Intentando crear usuario con:', $usuarioData);

            // Intentar crear de diferentes formas
            $usuario = null;
            
            // Método 1: Eloquent create
            try {
                $usuario = Usuario::create($usuarioData);
                Log::info('✓ Usuario creado con Eloquent create()');
            } catch (\Exception $e) {
                Log::error('Método 1 falló: ' . $e->getMessage());
                
                // Método 2: Eloquent save
                try {
                    $usuario = new Usuario($usuarioData);
                    $usuario->save();
                    Log::info('✓ Usuario creado con Eloquent save()');
                } catch (\Exception $e) {
                    Log::error('Método 2 falló: ' . $e->getMessage());
                    
                    // Método 3: DB directo
                    try {
                        $usuarioId = DB::table('usuarios')->insertGetId($usuarioData);
                        $usuario = Usuario::find($usuarioId);
                        Log::info('✓ Usuario creado con DB directo');
                    } catch (\Exception $e) {
                        Log::error('Método 3 falló: ' . $e->getMessage());
                        throw new \Exception('Todos los métodos de creación fallaron: ' . $e->getMessage());
                    }
                }
            }

            if ($usuario) {
                Log::info('=== REGISTRO EXITOSO ===', [
                    'id' => $usuario->id,
                    'documento' => $usuario->numero_documento
                ]);

                // Verificar en BD
                $verificado = DB::table('usuarios')->where('id', $usuario->id)->first();
                Log::info('Verificación en BD:', (array)$verificado);

                return redirect()->route('registro.exitoso')
                    ->with('success', 'Registro exitoso!');
            }

        } catch (\Exception $e) {
            Log::error('=== ERROR CRÍTICO ===', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function registroExitoso()
    {
        return view('auth.registration-success');
    }
}