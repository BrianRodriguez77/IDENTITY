<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - IDENTITY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-id-card me-2"></i>IDENTITY
            </a>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text text-light me-3">
                    <i class="fas fa-user me-1"></i>
                    {{ Auth::user()->nombres }} {{ Auth::user()->apellidos }}
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-sign-out-alt me-1"></i>Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5>Información del Usuario</h5>
                                <p><strong>Nombre:</strong> {{ Auth::user()->nombres }} {{ Auth::user()->apellidos }}</p>
                                <p><strong>Documento:</strong> {{ Auth::user()->numero_documento }}</p>
                                <p><strong>Rol:</strong> <span class="badge bg-primary">{{ Auth::user()->rol->nombre }}</span></p>
                                <p><strong>Centro:</strong> {{ Auth::user()->centro->nombre }}</p>
                                <p><strong>Regional:</strong> {{ Auth::user()->regional->nombre }}</p>
                                
                                @if(Auth::user()->programa)
                                    <p><strong>Programa:</strong> {{ Auth::user()->programa->nombre }}</p>
                                @endif
                                
                                @if(Auth::user()->grupo)
                                    <p><strong>Grupo:</strong> {{ Auth::user()->grupo->nombre }}</p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <h5>Información Médica</h5>
                                <p><strong>Tipo de Sangre:</strong> {{ Auth::user()->tipo_sangre }}</p>
                                
                                @if(Auth::user()->carnet)
                                    <div class="alert alert-info">
                                        <h6><i class="fas fa-id-card me-2"></i>Información del Carnet</h6>
                                        <p class="mb-1"><strong>Código de Barras:</strong> {{ Auth::user()->carnet->codigo_barras }}</p>
                                        <p class="mb-1"><strong>Fecha Emisión:</strong> {{ Auth::user()->carnet->fecha_emision }}</p>
                                        <p class="mb-1"><strong>Fecha Vencimiento:</strong> {{ Auth::user()->carnet->fecha_vencimiento }}</p>
                                        <p class="mb-0"><strong>Estado:</strong> 
                                            <span class="badge bg-success">{{ Auth::user()->carnet->estadoCarnet->nombre }}</span>
                                        </p>
                                    </div>
                                @else
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        No tienes un carnet asignado.
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card text-center h-100">
                                    <div class="card-body">
                                        <i class="fas fa-id-card fa-3x text-success mb-3"></i>
                                        <h5>Mi Carnet Digital</h5>
                                        <p class="text-muted">Ver y gestionar tu carnet digital</p>
                                        <button class="btn btn-outline-success btn-sm">Ver Carnet</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card text-center h-100">
                                    <div class="card-body">
                                        <i class="fas fa-user-edit fa-3x text-info mb-3"></i>
                                        <h5>Mi Perfil</h5>
                                        <p class="text-muted">Actualizar información personal</p>
                                        <button class="btn btn-outline-info btn-sm">Editar Perfil</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card text-center h-100">
                                    <div class="card-body">
                                        <i class="fas fa-laptop fa-3x text-warning mb-3"></i>
                                        <h5>Mis Equipos</h5>
                                        <p class="text-muted">Registrar equipos personales</p>
                                        <button class="btn btn-outline-warning btn-sm">Gestionar Equipos</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>