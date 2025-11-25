<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - IDENTITY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --verde-sena: #2E8B57;
            --verde-claro: #3CB371;
        }
        
        body {
            background: linear-gradient(135deg, var(--verde-sena) 0%, var(--verde-claro) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .login-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .btn-sena {
            background-color: var(--verde-sena);
            border-color: var(--verde-sena);
            color: white;
        }
        
        .btn-sena:hover {
            background-color: var(--verde-claro);
            border-color: var(--verde-claro);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card login-card">
                    <div class="card-body p-5">
                        <!-- Logo -->
                        <div class="text-center mb-4">
                            <div class="bg-success text-white p-3 rounded-circle d-inline-block">
                                <i class="fas fa-id-card fa-2x"></i>
                            </div>
                            <h3 class="mt-3 text-success">IDENTITY</h3>
                            <p class="text-muted">Iniciar Sesión</p>
                        </div>

                        <!-- Formulario de Login -->
                        <form method="POST" action="{{ url('/login') }}">
                            @csrf

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope text-muted"></i>
                                    </span>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           required 
                                           autofocus
                                           placeholder="usuario@sena.edu.co">
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Contraseña -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock text-muted"></i>
                                    </span>
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           required
                                           placeholder="Ingresa tu contraseña">
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Recordarme -->
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Recordar sesión</label>
                            </div>

                            <!-- Botón de Login -->
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-sena btn-lg">
                                    <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                                </button>
                            </div>

                            <!-- Enlaces adicionales -->
                            <div class="text-center">
                                <a href="#" class="text-decoration-none text-muted">
                                    <small><i class="fas fa-question-circle me-1"></i>¿Olvidaste tu contraseña?</small>
                                </a>
                            </div>
                        </form>

                        <!-- Información del sistema -->
                        <div class="mt-4 pt-3 border-top text-center">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Sistema IDENTITY - Centro de la Innovación Agroindustrial y de Servicios
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>