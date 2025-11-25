<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IDENTITY - Sistema de Carnet Digital SENA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Incluir nuestro archivo CSS personalizado -->
    <link href="{{ asset('css/PaginaPrincipal.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Alertas de sesión -->
    @if(session('success'))
    <div class="alert-container">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="alert-container">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif

    @if(session('info'))
    <div class="alert-container">
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle me-2"></i>
            {{ session('info') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif

    <!-- Encabezado -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <!-- Logo del proyecto -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <div class="logo-container">
                    <img src="{{ asset('images/LogoPrincipal.jpg') }}" alt="IDENTITY" class="logo-principal">
                    <div class="brand-text">
                        <h1 class="brand-title">IDENTITY</h1>
                        <p class="brand-subtitle">Sistema de Carnet Digital SENA</p>
                    </div>
                </div>
            </a>
            
            <!-- Botones de navegación -->
            <div class="navbar-nav ms-auto">
                @auth
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-2"></i>{{ Auth::user()->nombres }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ url('/login') }}" class="btn btn-sena me-2">
                        <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-hero-register">
                        <i class="fas fa-user-plus me-2"></i>Registrarse
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Sección Hero - Bienvenida -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content fade-in-up">
                        <h1 class="hero-title">Bienvenido a IDENTITY</h1>
                        <p class="hero-subtitle">
                            Sistema integral de identificación digital para la comunidad del 
                            <strong>Centro de la Innovación Agroindustrial y de Servicios</strong> del SENA. 
                            Transformamos la identificación tradicional en una experiencia digital segura, 
                            eficiente y moderna.
                        </p>
                        <div class="hero-buttons">
                            <a href="#saberes" class="btn btn-hero-primary">
                                <i class="fas fa-book me-2"></i>Conoce Más
                            </a>
                            @auth
                                <a href="{{ route('dashboard') }}" class="btn btn-hero-secondary">
                                    <i class="fas fa-id-card me-2"></i>Mi Carnet Digital
                                </a>
                            @else
                                <a href="{{ url('/login') }}" class="btn btn-hero-secondary">
                                    <i class="fas fa-id-card me-2"></i>Acceder a Mi Carnet
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-hero-register">
                                    <i class="fas fa-user-plus me-2"></i>Registrarse
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image-container fade-in-up">
                        <img src="{{ asset('images/LogoSena.png') }}" alt="SENA" class="hero-logo-sena">
                        <div class="hero-badge pulse">
                            <i class="fas fa-star me-2"></i>Tu identidad digital en el SENA
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección Nuestros Saberes -->
    <section id="saberes" class="saberes-section">
        <div class="container">
            <h2 class="section-title fade-in-up">Nuestros Saberes</h2>
            <p class="section-subtitle fade-in-up">Conoce los fundamentos que guían nuestro proyecto</p>
            
            <div class="row g-4">
                <!-- Misión -->
                <div class="col-md-4 fade-in-up">
                    <div class="card card-custom text-center">
                        <div class="card-body">
                            <div class="feature-icon">
                                <i class="fas fa-bullseye"></i>
                            </div>
                            <h4 class="card-title-custom">Misión</h4>
                            <p class="card-text-custom">
                                Digitalizar y optimizar el proceso de identificación en el SENA mediante 
                                carnets digitales con tecnología de código de barras y huella dactilar, 
                                garantizando seguridad, eficiencia y accesibilidad para toda la comunidad educativa.
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Visión -->
                <div class="col-md-4 fade-in-up">
                    <div class="card card-custom text-center">
                        <div class="card-body">
                            <div class="feature-icon">
                                <i class="fas fa-eye"></i>
                            </div>
                            <h4 class="card-title-custom">Visión</h4>
                            <p class="card-text-custom">
                                Ser el sistema de identificación digital líder en los centros SENA, 
                                implementando tecnologías innovadoras que mejoren la experiencia 
                                de usuarios y fortalezcan la seguridad institucional.
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Objetivo -->
                <div class="col-md-4 fade-in-up">
                    <div class="card card-custom text-center">
                        <div class="card-body">
                            <div class="feature-icon">
                                <i class="fas fa-flag"></i>
                            </div>
                            <h4 class="card-title-custom">Objetivo Principal</h4>
                            <p class="card-text-custom">
                                Crear un ecosistema digital unificado de identificación que permita 
                                el control de acceso, registro de equipos y seguimiento de actividades 
                                mediante carnets digitales únicos e intransferibles.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Por qué nace el proyecto -->
            <div class="porque-nace-section fade-in-up">
                <div class="porque-nace-content">
                    <h3 class="text-center mb-5" style="color: var(--verde-oscuro); font-weight: 700;">¿Por qué nace IDENTITY?</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="lead" style="color: var(--verde-oscuro);">
                                IDENTITY surge como respuesta a la necesidad de modernizar 
                                los sistemas de identificación en el SENA, específicamente 
                                en el <strong>Centro de la Innovación Agroindustrial y de Servicios</strong> 
                                de Puerto Boyacá.
                            </p>
                            <ul class="benefits-list mt-4">
                                <li><i class="fas fa-check-circle"></i> Eliminar el uso de carnets físicos susceptibles a pérdida o daño</li>
                                <li><i class="fas fa-check-circle"></i> Agilizar procesos de acceso y control</li>
                                <li><i class="fas fa-check-circle"></i> Implementar tecnología de punta accesible</li>
                                <li><i class="fas fa-check-circle"></i> Reducir costos de impresión y reposición</li>
                                <li><i class="fas fa-check-circle"></i> Mejorar la seguridad institucional</li>
                                <li><i class="fas fa-check-circle"></i> Facilitar el registro de equipos personales</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5 style="color: var(--verde-sena); margin-bottom: 1.5rem;">Lo que pretendemos lograr:</h5>
                            <div class="tech-card">
                                <ul class="list-unstyled">
                                    <li class="mb-3"><i class="fas fa-arrow-right me-2"></i> Digitalización completa del proceso de identificación</li>
                                    <li class="mb-3"><i class="fas fa-arrow-right me-2"></i> Reducción de tiempos en controles de acceso</li>
                                    <li class="mb-3"><i class="fas fa-arrow-right me-2"></i> Mayor seguridad con sistemas biométricos</li>
                                    <li class="mb-3"><i class="fas fa-arrow-right me-2"></i> Registro digital de equipos y pertenencias</li>
                                    <li class="mb-3"><i class="fas fa-arrow-right me-2"></i> Control de asistencia automatizado</li>
                                    <li><i class="fas fa-arrow-right me-2"></i> Sistema escalable para todos los centros SENA</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección Herramientas e Implementación -->
    <section class="herramientas-section">
        <div class="container">
            <h2 class="section-title fade-in-up">Herramientas e Implementación</h2>
            <p class="section-subtitle fade-in-up">Tecnologías y metodologías que hacen posible IDENTITY</p>
            
            <div class="tech-grid">
                <div class="tech-item fade-in-up">
                    <i class="fab fa-laravel tech-icon text-danger"></i>
                    <h5>Laravel Framework</h5>
                    <p class="text-muted">Backend robusto y seguro con autenticación avanzada</p>
                </div>
                
                <div class="tech-item fade-in-up">
                    <i class="fab fa-bootstrap tech-icon text-primary"></i>
                    <h5>Bootstrap 5</h5>
                    <p class="text-muted">Diseño responsive y moderno para todos los dispositivos</p>
                </div>
                
                <div class="tech-item fade-in-up">
                    <i class="fas fa-database tech-icon text-info"></i>
                    <h5>MySQL/phpMyAdmin</h5>
                    <p class="text-muted">Gestión eficiente y segura de base de datos</p>
                </div>
                
                <div class="tech-item fade-in-up">
                    <i class="fas fa-shield-alt tech-icon text-warning"></i>
                    <h5>Seguridad Integrada</h5>
                    <p class="text-muted">Protección avanzada de datos y autenticación multifactor</p>
                </div>
            </div>
            
            <div class="row mt-5">
                <div class="col-md-6 fade-in-up">
                    <div class="tech-card">
                        <i class="fas fa-project-diagram"></i>
                        <h4>Metodología Ágil Scrum</h4>
                        <p>
                            Desarrollo iterativo e incremental con sprints definidos, 
                            permitiendo adaptación constante a los requerimientos del proyecto 
                            y entrega continua de valor. Gestión eficiente del tiempo y recursos.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 fade-in-up">
                    <div class="tech-card">
                        <i class="fas fa-id-card"></i>
                        <h4>Carnet Digital Inteligente</h4>
                        <p>
                            Acceso mediante código de barras único, huella dactilar o QR. 
                            Registro de equipos personales, control de accesos en tiempo real 
                            y seguimiento de actividades con total seguridad y eficiencia.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Nueva sección de características -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card card-custom">
                        <div class="card-body text-center">
                            <h3 class="card-title-custom mb-4">Características Principales</h3>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <i class="fas fa-fingerprint fa-2x text-success mb-2"></i>
                                    <h5>Autenticación Biométrica</h5>
                                    <p class="text-muted">Acceso seguro con huella digital</p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <i class="fas fa-qrcode fa-2x text-info mb-2"></i>
                                    <h5>Códigos QR Dinámicos</h5>
                                    <p class="text-muted">Escaneo rápido y seguro</p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <i class="fas fa-mobile-alt fa-2x text-warning mb-2"></i>
                                    <h5>Acceso Móvil</h5>
                                    <p class="text-muted">Disponible en cualquier dispositivo</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Registro (Call to Action) -->
    <section class="hero-section" style="padding: 80px 0;">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h2 class="hero-title mb-4">¿Listo para unirte a IDENTITY?</h2>
                    <p class="hero-subtitle mb-5">
                        Regístrate ahora y forma parte de la transformación digital del SENA. 
                        Obtén tu carnet digital y disfruta de todos los beneficios.
                    </p>
                    <div class="hero-buttons justify-content-center">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-hero-primary btn-lg">
                                <i class="fas fa-tachometer-alt me-2"></i>Ir al Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-hero-primary btn-lg">
                                <i class="fas fa-user-plus me-2"></i>Registrarse Ahora
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-hero-secondary btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pie de página -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="row">
                    <!-- Información del proyecto -->
                    <div class="col-md-4 mb-4 fade-in-up">
                        <img src="{{ asset('images/LogoPrincipal.jpg') }}" alt="IDENTITY" class="footer-logo">
                        <h5 class="footer-title">IDENTITY Project</h5>
                        <p>Sistema de Carnet Digital SENA</p>
                        <div class="d-flex gap-3 mt-4">
                            <div class="bg-white p-3 rounded text-center">
                                <img src="{{ asset('images/LogoSena.png') }}" alt="SENA" style="height: 40px;">
                            </div>
                            <div class="bg-white p-3 rounded text-center">
                                <span class="text-success fw-bold fs-4">ID</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Creadores -->
                    <div class="col-md-4 mb-4 fade-in-up">
                        <h5 class="footer-title"><i class="fas fa-users me-2"></i>Desarrollado por</h5>
                        <ul class="footer-links">
                            <li><a href="#"><i class="fas fa-user me-2"></i>Brian Estevent Rodriguez Vanegas</a></li>
                            <li><a href="#"><i class="fas fa-user me-2"></i>Juan Sebastian Rubio Torres</a></li>
                        </ul>
                        <div class="mt-4">
                            <p>
                                <strong><i class="fas fa-laptop-code me-2"></i>Análisis y Desarrollo de Software</strong><br>
                                <i class="fas fa-users me-2"></i>Grupo 2978583
                            </p>
                        </div>
                    </div>
                    
                    <!-- Centro -->
                    <div class="col-md-4 mb-4 fade-in-up">
                        <h5 class="footer-title"><i class="fas fa-building me-2"></i>Centro de Formación</h5>
                        <ul class="footer-links">
                            <li><a href="#"><i class="fas fa-university me-2"></i>Centro de la Innovación Agroindustrial y de Servicios</a></li>
                            <li><a href="#"><i class="fas fa-map-marker-alt me-2"></i>SENA Regional Boyacá</a></li>
                            <li><a href="#"><i class="fas fa-location-dot me-2"></i>Municipio de Puerto Boyacá</a></li>
                        </ul>
                        <div class="mt-4">
                            <p>
                                <i class="fas fa-copyright me-2"></i> 2024 IDENTITY - Todos los derechos reservados
                            </p>
                        </div>
                    </div>
                </div>
                
                <hr class="footer-divider">
                
                <div class="footer-bottom fade-in-up">
                    <p class="quote-text">
                        <i class="fas fa-quote-left me-2"></i>
                        Formando líderes para la transformación digital del sector agroindustrial
                        <i class="fas fa-quote-right ms-2"></i>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animación de elementos al hacer scroll
        document.addEventListener('DOMContentLoaded', function() {
            const fadeElements = document.querySelectorAll('.fade-in-up');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animation = 'fadeInUp 0.8s ease-out forwards';
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });
            
            fadeElements.forEach(element => {
                observer.observe(element);
            });

            // Auto-ocultar alertas después de 5 segundos
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });

            // Smooth scroll para enlaces internos
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>