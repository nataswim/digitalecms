@extends('layouts.app')

@section('title', 'Vérification de l\'email')

@section('content')
<div class="min-vh-100 d-flex align-items-center bg-gradient-to-b from-blue-50 to-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <!-- Logo et Titre -->
                <div class="text-center mb-4">
                    <div class="mb-3">
                        <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" 
                             style="width: 100px; height: 100px;">
                            <i class="fas fa-envelope-open-text text-info" style="font-size: 3rem;"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-2">Vérifiez votre adresse email</h2>
                    <p class="text-muted">
                        Merci de vous être inscrit ! Avant de commencer, pourriez-vous vérifier votre 
                        adresse email en cliquant sur le lien que nous venons de vous envoyer ?
                    </p>
                </div>

                <!-- Carte de vérification -->
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <!-- Status Message -->
                        @if (session('status') == 'verification-link-sent')
                            <div class="alert alert-success bg-success bg-opacity-10 border-0 mb-4">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                    <div>
                                        <strong>Email envoyé !</strong>
                                        <p class="mb-0 small mt-1">
                                            Un nouveau lien de vérification a été envoyé à votre adresse email.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Instructions -->
                        <div class="alert alert-info bg-info bg-opacity-10 border-0 mb-4">
                            <h6 class="alert-heading">
                                <i class="fas fa-info-circle me-2"></i>
                                Instructions
                            </h6>
                            <ol class="mb-0 small ps-3">
                                <li class="mb-2">Consultez votre boîte de réception</li>
                                <li class="mb-2">Recherchez l'email de vérification</li>
                                <li class="mb-2">Cliquez sur le lien de vérification</li>
                                <li>Vous serez automatiquement connecté</li>
                            </ol>
                        </div>

                        <!-- Resend Verification Email Form -->
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <div class="text-center mb-4">
                                <p class="text-muted mb-3">
                                    Si vous n'avez pas reçu l'email, nous pouvons vous en envoyer un autre.
                                </p>
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>
                                    Renvoyer l'email de vérification
                                </button>
                            </div>
                        </form>

                        <!-- Divider -->
                        <div class="position-relative mb-4">
                            <hr>
                            <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small">
                                ou
                            </span>
                        </div>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}" class="text-center">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                Se déconnecter
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Aide supplémentaire -->
                <div class="row g-3 mt-4">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm bg-light h-100">
                            <div class="card-body p-4">
                                <h6 class="fw-bold mb-3">
                                    <i class="fas fa-search text-warning me-2"></i>
                                    Email introuvable ?
                                </h6>
                                <ul class="mb-0 small text-muted ps-3">
                                    <li class="mb-2">Vérifiez votre dossier spam/courrier indésirable</li>
                                    <li class="mb-2">Recherchez un email de <strong>{{ config('app.name') }}</strong></li>
                                    <li>Attendez quelques minutes et vérifiez à nouveau</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm bg-light h-100">
                            <div class="card-body p-4">
                                <h6 class="fw-bold mb-3">
                                    <i class="fas fa-headset text-primary me-2"></i>
                                    Besoin d'aide ?
                                </h6>
                                <div class="small text-muted">
                                    <p class="mb-2">
                                        Vous rencontrez des difficultés ? Contactez notre support.
                                    </p>
                                    <a href="{{ route('contact') }}" class="text-decoration-none">
                                        <i class="fas fa-arrow-right me-2"></i>
                                        Contacter le support
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informations de sécurité -->
                <div class="alert alert-warning bg-warning bg-opacity-10 border-0 mt-4">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-shield-alt text-warning me-2 mt-1"></i>
                        <div class="small">
                            <strong>Sécurité :</strong> Ne partagez jamais le lien de vérification avec quelqu'un d'autre. 
                            Si vous n'avez pas créé ce compte, ignorez cet email.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.bg-gradient-to-b {
    background: linear-gradient(to bottom, #eff6ff, #ffffff);
}

.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important;
}

.btn-primary {
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(13, 110, 253, 0.3);
}

@media (max-width: 768px) {
    .card-body {
        padding: 2rem !important;
    }
}
</style>
@endpush