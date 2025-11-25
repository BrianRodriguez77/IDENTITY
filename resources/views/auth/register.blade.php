<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - IDENTITY SENA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --verde-sena: #2E8B57;
            --verde-claro: #3CB371;
            --verde-oscuro: #1E6B47;
        }
        
        .register-container {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--verde-oscuro) 0%, var(--verde-sena) 50%, var(--verde-claro) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .register-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            overflow: hidden;
            width: 100%;
            max-width: 800px;
        }
        
        .register-header {
            background: linear-gradient(135deg, var(--verde-sena) 0%, var(--verde-oscuro) 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .register-body {
            padding: 2rem;
            max-height: 70vh;
            overflow-y: auto;
        }
        
        .btn-register {
            background: var(--verde-sena);
            border: none;
            color: white;
            padding: 12px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .btn-register:hover {
            background: var(--verde-oscuro);
            transform: translateY(-2px);
        }
        
        .form-control:focus {
            border-color: var(--verde-sena);
            box-shadow: 0 0 0 0.2rem rgba(46, 139, 87, 0.25);
        }
        
        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
        }
        
        .step {
            text-align: center;
            flex: 1;
        }
        
        .step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
            font-weight: bold;
        }
        
        .step.active .step-number {
            background: var(--verde-sena);
            color: white;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <h4><i class="fas fa-id-card me-2"></i>REGISTRO IDENTITY</h4>
                <p class="mb-0">Centro de la Innovación Agroindustrial y de Servicios</p>
                <small>Complete sus datos para obtener su carnet digital</small>
            </div>
            <div class="register-body">
                <div class="step-indicator">
                    <div class="step active">
                        <div class="step-number">1</div>
                        <small>Datos Personales</small>
                    </div>
                    <div class="step">
                        <div class="step-number">2</div>
                        <small>Información Académica</small>
                    </div>
                    <div class="step">
                        <div class="step-number">3</div>
                        <small>Seguridad</small>
                    </div>
                </div>

                <form method="POST" action="{{ route('register') }}" id="registrationForm">
                    @csrf
                    
                    <!-- Paso 1: Datos Personales -->
                    <div class="step-content" id="step1">
                        <h5 class="mb-4">Datos Personales</h5>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tipo_documento_id" class="form-label">Tipo de Documento *</label>
                                <select class="form-select" id="tipo_documento_id" name="tipo_documento_id" required>
                                    <option value="">Seleccione...</option>
                                    @foreach($tiposDocumento as $tipo)
                                        <option value="{{ $tipo->id }}">{{ $tipo->nombre }} ({{ $tipo->abreviatura }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="numero_documento" class="form-label">Número de Documento *</label>
                                <input type="text" class="form-control" id="numero_documento" name="numero_documento" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombres" class="form-label">Nombres *</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="apellidos" class="form-label">Apellidos *</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Correo Electrónico *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" id="telefono" name="telefono">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tipo_sangre" class="form-label">Tipo de Sangre *</label>
                                <select class="form-select" id="tipo_sangre" name="tipo_sangre" required>
                                    <option value="">Seleccione...</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento *</label>
                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="button" class="btn btn-success" onclick="nextStep(2)">Siguiente <i class="fas fa-arrow-right ms-1"></i></button>
                        </div>
                    </div>

                    <!-- Paso 2: Información Académica -->
                    <div class="step-content" id="step2" style="display: none;">
                        <h5 class="mb-4">Información Académica</h5>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="programa_id" class="form-label">Programa de Formación *</label>
                                <select class="form-select" id="programa_id" name="programa_id" required>
                                    <option value="">Seleccione su programa...</option>
                                    @foreach($programas as $programa)
                                        <option value="{{ $programa->id }}">{{ $programa->nombre }} ({{ $programa->codigo }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="grupo_id" class="form-label">Grupo *</label>
                                <select class="form-select" id="grupo_id" name="grupo_id" required>
                                    <option value="">Seleccione su grupo...</option>
                                    @foreach($grupos as $grupo)
                                        <option value="{{ $grupo->id }}">{{ $grupo->nombre }} - {{ $grupo->jornada }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Importante:</strong> Su registro será verificado por el personal del SENA antes de activar su cuenta y generar su carnet digital.
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-outline-secondary" onclick="prevStep(1)"><i class="fas fa-arrow-left me-1"></i> Anterior</button>
                            <button type="button" class="btn btn-success" onclick="nextStep(3)">Siguiente <i class="fas fa-arrow-right ms-1"></i></button>
                        </div>
                    </div>

                    <!-- Paso 3: Seguridad -->
                    <div class="step-content" id="step3" style="display: none;">
                        <h5 class="mb-4">Seguridad y Términos</h5>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Contraseña *</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <div class="form-text">Mínimo 8 caracteres</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Confirmar Contraseña *</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terminos" name="terminos" required>
                                <label class="form-check-label" for="terminos">
                                    Acepto los <a href="#" data-bs-toggle="modal" data-bs-target="#terminosModal">términos y condiciones</a> del uso del sistema IDENTITY
                                </label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-outline-secondary" onclick="prevStep(2)"><i class="fas fa-arrow-left me-1"></i> Anterior</button>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-user-plus me-2"></i>Completar Registro
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Términos y Condiciones -->
    <div class="modal fade" id="terminosModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Términos y Condiciones - IDENTITY</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h6>1. Uso del Sistema</h6>
                    <p>El sistema IDENTITY es propiedad del SENA y está destinado exclusivamente para uso institucional.</p>
                    
                    <h6>2. Datos Personales</h6>
                    <p>La información proporcionada será utilizada únicamente para fines institucionales y de identificación.</p>
                    
                    <h6>3. Responsabilidades</h6>
                    <p>El usuario es responsable de mantener la confidencialidad de sus credenciales de acceso.</p>
                    
                    <h6>4. Carnet Digital</h6>
                    <p>El carnet digital es propiedad del SENA y debe ser utilizado únicamente por el titular.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let currentStep = 1;

        function showStep(step) {
            document.querySelectorAll('.step-content').forEach(el => {
                el.style.display = 'none';
            });
            document.getElementById(`step${step}`).style.display = 'block';
            
            // Actualizar indicadores
            document.querySelectorAll('.step').forEach((el, index) => {
                if (index + 1 <= step) {
                    el.classList.add('active');
                } else {
                    el.classList.remove('active');
                }
            });
        }

        function nextStep(step) {
            if (validateStep(currentStep)) {
                currentStep = step;
                showStep(step);
            }
        }

        function prevStep(step) {
            currentStep = step;
            showStep(step);
        }

        function validateStep(step) {
            // Validación básica del paso actual
            const stepElement = document.getElementById(`step${step}`);
            const inputs = stepElement.querySelectorAll('input[required], select[required]');
            
            for (let input of inputs) {
                if (!input.value) {
                    alert('Por favor, complete todos los campos obligatorios.');
                    input.focus();
                    return false;
                }
            }
            
            return true;
        }

        // Inicializar
        showStep(1);
    </script>
</body>
</html>