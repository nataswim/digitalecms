<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Mon Espace') - {{ config('app.name', 'Digital’SOS') }}</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- ============================================
         CHARTE GRAPHIQUE AQUATIQUE - CSS PERSONNALISÉS
         ============================================ -->
    
    <!-- 1. Variables CSS -->
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    
    <!-- 2. Utilitaires -->
    <link rel="stylesheet" href="{{ asset('css/utilities.css') }}">
    
    <!-- 3. Styles personnalisés -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    
    <!-- 4. Composants -->
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    
    <!-- 5. Animations -->
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">
    
    <!-- Styles de page spécifiques -->
    @stack('styles')
    
    <style>
        /* Style de base */
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
        
        /* Alerts avec icônes */
        .alert {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
    </style>
</head>
<body>
    {{-- Header user --}}
    @include('layouts.partials.user-header')
    
    <!-- Contenu principal -->
    <main>
        <!-- Messages flash -->
        @if(session('success'))
            <div class="container-lg mb-4 fade-in-down">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>Succès !</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        
        @if(session('error'))
            <div class="container-lg mb-4 fade-in-down">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong>Erreur !</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        
        @if(session('warning'))
            <div class="container-lg mb-4 fade-in-down">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Attention !</strong> {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        
        @if(session('info'))
            <div class="container-lg mb-4 fade-in-down">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Info !</strong> {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        
        <!-- Contenu de la page -->
        <div class="container-lg fade-in">
            @yield('content')
        </div>
    </main>
    
    {{-- Footer user --}}
    @include('layouts.partials.user-footer')
    
    <!-- Scripts -->
    
    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
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