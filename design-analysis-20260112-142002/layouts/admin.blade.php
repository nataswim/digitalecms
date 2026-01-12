<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Administration') - {{ config('app.name', 'Digital’SOS') }}</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- ============================================
         CHARTE GRAPHIQUE AQUATIQUE - CSS PERSONNALISÉS
         ============================================ -->
    
    <!-- 1. Variables CSS (Couleurs, fonts, spacings) -->
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    
    <!-- 2. Utilitaires (Classes helper) -->
    <link rel="stylesheet" href="{{ asset('css/utilities.css') }}">
    
    <!-- 3. Styles personnalisés (Titres nataswim, backgrounds) -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    
    <!-- 4. Composants (Cards, buttons, forms, tables) -->
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    
    <!-- 5. Animations (Fade, slide, scale, wave) -->
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">
    
    <!-- Styles de page spécifiques -->
    @stack('styles')
    
    <style>
        /* Style de base pour le body */
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif;
            background-color: var(--color-light, #f8f9fa);
            color: var(--color-dark, #212529);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Container principal */
        main {
            flex: 1;
            padding-top: 2rem;
            padding-bottom: 2rem;
        }
        
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
        
        /* Amélioration de la lisibilité */
        * {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        /* Container avec largeur max */
        .container-custom {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }
        
        /* Page header */
        .page-header {
            background: linear-gradient(135deg, #00acc0, #0173b4);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .page-header h1 {
            margin: 0;
            font-weight: 700;
        }
        
        .page-header .breadcrumb {
            background: transparent;
            margin: 0;
            padding: 0;
        }
        
        .page-header .breadcrumb-item,
        .page-header .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.9);
        }
        
        .page-header .breadcrumb-item.active {
            color: white;
        }
        
        .page-header .breadcrumb-item + .breadcrumb-item::before {
            color: rgba(255, 255, 255, 0.6);
        }
        
        /* Alerts avec icônes */
        .alert {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .alert-icon {
            font-size: 1.25rem;
            flex-shrink: 0;
        }
    </style>
</head>
<body>
    {{-- Navigation admin --}}
    @include('layouts.partials.admin-nav-horizontal')
    
    <!-- Contenu principal -->
    <main>
        <!-- En-tête de page (optionnel) -->
        @hasSection('page-header')
            <div class="page-header fade-in">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h1>@yield('page-title')</h1>
                            @hasSection('breadcrumb')
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0 mt-2">
                                        @yield('breadcrumb')
                                    </ol>
                                </nav>
                            @endif
                        </div>
                        <div class="mt-3 mt-md-0">
                            @yield('page-actions')
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        <!-- Messages flash -->
        @if(session('success'))
            <div class="container-fluid mb-4 fade-in-down">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle alert-icon"></i>
                    <div class="flex-grow-1">
                        <strong>Succès !</strong> {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        
        @if(session('error'))
            <div class="container-fluid mb-4 fade-in-down">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle alert-icon"></i>
                    <div class="flex-grow-1">
                        <strong>Erreur !</strong> {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        
        @if(session('warning'))
            <div class="container-fluid mb-4 fade-in-down">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle alert-icon"></i>
                    <div class="flex-grow-1">
                        <strong>Attention !</strong> {{ session('warning') }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        
        @if(session('info'))
            <div class="container-fluid mb-4 fade-in-down">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="fas fa-info-circle alert-icon"></i>
                    <div class="flex-grow-1">
                        <strong>Info !</strong> {{ session('info') }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        
        <!-- Contenu de la page -->
        <div class="container-fluid fade-in">
            @yield('content')
        </div>
    </main>
    
    {{-- Footer admin --}}
    @include('layouts.partials.admin-footer')
    
    <!-- Scripts -->
    
    <!-- Bootstrap Bundle (inclut Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery (si nécessaire pour vos plugins) -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <!-- Scripts personnalisés -->
    <script>
        // Auto-hide alerts après 5 secondes
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
        
        // Confirmation de suppression
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('form[data-confirm]');
            deleteForms.forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    const message = form.getAttribute('data-confirm') || 'Êtes-vous sûr de vouloir supprimer cet élément ?';
                    if (!confirm(message)) {
                        e.preventDefault();
                    }
                });
            });
        });
        
        // Tooltips Bootstrap
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Popovers Bootstrap
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
    </script>
    
    <!-- Scripts de page spécifiques -->
    @stack('scripts')
</body>
</html>