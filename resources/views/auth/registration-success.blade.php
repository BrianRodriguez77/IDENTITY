<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Exitoso - IDENTITY SENA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --verde-sena: #2E8B57;
            --verde-claro: #3CB371;
            --verde-oscuro: #1E6B47;
        }
        
        .success-container {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--verde-oscuro) 0%, var(--verde-sena) 50%, var(--verde-claro) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .success-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            overflow: hidden;
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        
        .success-header {
            background: linear-gradient(135deg, var(--verde-sena) 0%, var(--verde-oscuro) 100%);
            color: white;
            padding: 3rem 2rem;
        }
        
        .success-body {
            padding: 3rem 2rem;
        }
        
        .success-icon {
            font-size: 4rem;
            color: var(--verde-sena);
            margin-bottom: 1.5rem;
        }
        
        .btn-success-custom {
            background: var(--verde-sena);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-success-custom:hover {
            background: var(--verde-oscuro);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-card">
            <div class="success-header">
                <div class="success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3>¡Registro Exitoso!</h3>
            </div>
            <div class="success-body">
                <p class="lead">Su registro ha sido recibido correctamente.</p>
                <p class="text-muted">
                    Su cuenta está pendiente de verificación por parte del personal del SENA. 
                    Una vez verificada, recibirá un correo electrónico con las instrucciones 
                    para activar su cuenta y obtener su carnet digital.
                </p>
                <div class="mt-4">
                    <a href="{{ route('inicio') }}" class="btn btn-success-custom me-3">
                        <i class="fas fa-home me-2"></i>Volver al Inicio
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline-success">
                        <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>