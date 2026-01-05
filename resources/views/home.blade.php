@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 to-white">
    <!-- Hero Section -->
    <section class="py-5 text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="mb-4">
                        <i class="fas fa-swimmer text-primary" style="font-size: 4rem;"></i>
                    </div>
                    <h1 class="display-4 fw-bold mb-4">
                        MyCreaNet Digital Solutions
                    </h1>
                    <h2>
                        - Gestion Sportive Simplifiée -
                    </h2>
                    <p class="lead text-muted mb-5">
                        Plateforme de gestion digitale.
                    
                    </p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        @guest
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5">
                            <i class="fas fa-user-plus me-2"></i>Commencer gratuitement
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg px-5">
                            <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                        </a>
                        @else
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-5">
                            <i class="fas fa-tachometer-alt me-2"></i>Tableau de bord
                        </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Fonctionnalités principales</h2>
                <p class="text-muted">Tout ce dont vous avez besoin pour réussir</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4 text-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 60px; height: 60px;">
                                <i class="fas fa-users text-primary fa-2x"></i>
                            </div>
                            <h5 class="fw-bold mb-3">Gestion des utilisateurs</h5>
                            <p class="text-muted mb-0">
                                Système complet de gestion des utilisateurs avec rôles et permissions personnalisables.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4 text-center">
                            <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 60px; height: 60px;">
                                <i class="fas fa-clipboard-list text-success fa-2x"></i>
                            </div>
                            <h5 class="fw-bold mb-3">Programmes d'entraînement</h5>
                            <p class="text-muted mb-0">
                                Créez et suivez des programmes personnalisés pour tous les niveaux sportifs.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4 text-center">
                            <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 60px; height: 60px;">
                                <i class="fas fa-chart-line text-warning fa-2x"></i>
                            </div>
                            <h5 class="fw-bold mb-3">Suivi des performances</h5>
                            <p class="text-muted mb-0">
                                Analysez vos progrès avec des statistiques détaillées et des graphiques.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="fw-bold mb-3">Prêt à commencer ?</h2>
            <p class="lead mb-4">Rejoignez notre communauté sportive dès aujourd'hui</p>
            @guest
            <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5">
                <i class="fas fa-rocket me-2"></i>Créer un compte
            </a>
            @endguest
        </div>
    </section>
</div>
@endsection