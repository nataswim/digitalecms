@extends('layouts.app')

@section('title', 'À propos')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <section class="bg-primary text-white py-5">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3">À propos de nous</h1>
            <p class="lead">Découvrez notre mission et nos valeurs</p>
        </div>
    </section>

    <!-- Mission -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-4" 
                         style="width: 80px; height: 80px;">
                        <i class="fas fa-bullseye text-primary fa-3x"></i>
                    </div>
                    <h2 class="fw-bold mb-4">Notre mission</h2>
                    <p class="text-muted mb-3">
                        Fournir une plateforme complète et intuitive pour la gestion sportive, 
                        permettant aux entraîneurs, athlètes et passionnés de sport d'optimiser 
                        leurs performances et d'atteindre leurs objectifs.
                    </p>
                    <p class="text-muted">
                        Nous croyons que la technologie peut transformer la manière dont les sportifs 
                        s'entraînent, progressent et atteignent l'excellence.
                    </p>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body p-5">
                            <div class="row g-4">
                                <div class="col-6 text-center">
                                    <div class="display-4 fw-bold text-primary mb-2">7+</div>
                                    <p class="text-muted mb-0">Rôles disponibles</p>
                                </div>
                                <div class="col-6 text-center">
                                    <div class="display-4 fw-bold text-success mb-2">32+</div>
                                    <p class="text-muted mb-0">Permissions</p>
                                </div>
                                <div class="col-6 text-center">
                                    <div class="display-4 fw-bold text-warning mb-2">100%</div>
                                    <p class="text-muted mb-0">Personnalisable</p>
                                </div>
                                <div class="col-6 text-center">
                                    <div class="display-4 fw-bold text-info mb-2">24/7</div>
                                    <p class="text-muted mb-0">Support</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Valeurs -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Nos valeurs</h2>
                <p class="text-muted">Les principes qui guident notre travail</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 60px; height: 60px;">
                                <i class="fas fa-lightbulb text-primary fa-2x"></i>
                            </div>
                            <h5 class="fw-bold mb-3">Innovation</h5>
                            <p class="text-muted mb-0">
                                Nous développons constamment de nouvelles fonctionnalités pour répondre aux besoins évolutifs des sportifs.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 60px; height: 60px;">
                                <i class="fas fa-shield-alt text-success fa-2x"></i>
                            </div>
                            <h5 class="fw-bold mb-3">Sécurité</h5>
                            <p class="text-muted mb-0">
                                Protection maximale de vos données avec un système de permissions robuste et sécurisé.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 60px; height: 60px;">
                                <i class="fas fa-users text-warning fa-2x"></i>
                            </div>
                            <h5 class="fw-bold mb-3">Communauté</h5>
                            <p class="text-muted mb-0">
                                Une plateforme conçue pour favoriser l'entraide et le partage entre passionnés de sport.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Équipe -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Notre équipe</h2>
                <p class="text-muted">Passionnés de sport et de technologie</p>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-5 text-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-4" 
                                 style="width: 100px; height: 100px;">
                                <i class="fas fa-swimmer text-primary" style="font-size: 3rem;"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Une équipe dédiée à votre réussite</h4>
                            <p class="text-muted mb-0">
                                Notre équipe combine expertise sportive et compétences techniques pour créer 
                                la meilleure plateforme de gestion sportive. Nous sommes à votre écoute pour 
                                améliorer continuellement votre expérience.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="fw-bold mb-3">Rejoignez-nous</h2>
            <p class="lead mb-4">Faites partie de notre communauté sportive</p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('contact') }}" class="btn btn-light btn-lg px-4">
                    <i class="fas fa-envelope me-2"></i>Nous contacter
                </a>
                @guest
                <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4">
                    <i class="fas fa-user-plus me-2"></i>S'inscrire
                </a>
                @endguest
            </div>
        </div>
    </section>
</div>
@endsection