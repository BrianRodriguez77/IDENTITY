<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - IDENTITY SENA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --verde-sena: #2E8B57;
            --verde-claro: #3CB371;
            --verde-oscuro: #1E6B47;
        }
        
        .login-container {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--verde-oscuro) 0%, var(--verde-sena) 50%, var(--verde-claro) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
        }
        
        .login-header {
            background: linear-gradient(135deg, var(--verde-sena) 0%, var(--verde-oscuro) 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .login-body {
            padding: 2rem;
        }
        
        .btn-login {
            background: var(--verde-sena);
            border: none;
            color: white;
            padding: 12px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .btn-login:hover {
            background: var(--verde-oscuro);
            transform: translateY(-2px);
        }
        
        .form-control:focus {
            border-color: var(--verde-sena);
            box-shadow: 0 0 0 0.2rem rgba(46, 139, 87, 0.25);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h4><i class="fas fa-id-card me-2"></i>IDENTITY</h4>
                <p class="mb-0">Sistema de Carnet Digital</p>
                <small>Centro de la Innovación Agroindustrial y de Servicios</small>
            </div>
            <div class="login-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="numero_documento" class="form-label">Número de Documento</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="fas fa-id-card text-muted"></i>
                            </span>
                            <input type="text" class="form-control @error('numero_documento') is-invalid @enderror" 
                                   id="numero_documento" name="numero_documento" 
                                   value="{{ old('numero_documento') }}" 
                                   placeholder="Ingrese su número de documento" required autofocus>
                        </div>
                        @error('numero_documento')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="fas fa-lock text-muted"></i>
                            </span>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" 
                                   placeholder="Ingrese su contraseña" required>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Recordar sesión</label>
                    </div>

                    <button type="submit" class="btn btn-login mb-3">
                        <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                    </button>

                    <div class="text-center">
                        <a href="{{ route('inicio') }}" class="text-decoration-none text-muted">
                            <small><i class="fas fa-arrow-left me-1"></i>Volver al inicio</small>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>