<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - IDENTITY SENA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --verde-sena: #2E8B57;
            --verde-claro: #3CB371;
            --verde-oscuro: #1E6B47;
        }
        
        .password-reset-container {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--verde-oscuro) 0%, var(--verde-sena) 50%, var(--verde-claro) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .password-reset-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
        }
        
        .password-reset-header {
            background: linear-gradient(135deg, var(--verde-sena) 0%, var(--verde-oscuro) 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .password-reset-body {
            padding: 2rem;
        }
        
        .btn-reset {
            background: var(--verde-sena);
            border: none;
            color: white;
            padding: 12px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .btn-reset:hover {
            background: var(--verde-oscuro);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="password-reset-container">
        <div class="password-reset-card">
            <div class="password-reset-header">
                <h4><i class="fas fa-key me-2"></i>RECUPERAR CONTRASEÑA</h4>
                <p class="mb-0">Sistema IDENTITY - SENA</p>
            </div>
            <div class="password-reset-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="numero_documento" class="form-label">Número de Documento *</label>
                        <input type="text" class="form-control" id="numero_documento" name="numero_documento" 
                               placeholder="Ingrese su número de documento" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico *</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               placeholder="Ingrese su correo electrónico registrado" required>
                    </div>

                    <button type="submit" class="btn btn-reset mb-3">
                        <i class="fas fa-paper-plane me-2"></i>Enviar Enlace de Recuperación
                    </button>

                    <div class="text-center">
                        <a href="{{ route('login') }}" class="text-decoration-none text-muted">
                            <small><i class="fas fa-arrow-left me-1"></i>Volver al login</small>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>