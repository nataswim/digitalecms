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
                        Digital’SOS
                    </h1>
                    <h2>
                        - Digital Sport Organisation System - Plateforme tout-en-un -
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


</div>
@endsection