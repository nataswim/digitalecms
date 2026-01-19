@extends('layouts.app')

@section('title', 'Mot de passe oublié')

@section('content')
<div class="min-vh-100 d-flex align-items-center bg-gradient-to-b from-blue-50 to-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <!-- Logo et Titre -->
                <div class="text-center mb-4">
                    <div class="mb-3">
                        <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" 
                             style="width: 80px; height: 80px;">
                            <i class="fas fa-key text-warning" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-2">Mot de passe oublié ?</h2>
                    <p class="text-muted">
                        Pas de problème. Indiquez-nous votre adresse email et nous vous enverrons 
                        un lien pour réinitialiser votre mot de passe.
                    </p>
                </div>

                <!-- Carte de réinitialisation -->
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="alert alert-success bg-success bg-opacity-10 border-0 mb-4">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <!-- Email -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold">
                                    <i class="fas fa-envelope me-2 text-primary"></i>
                                    Adresse email
                                </label>
                                <input type="email" 
                                       class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       placeholder="votre@email.com"
                                       required 
                                       autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>
                                    Envoyer le lien de réinitialisation
                                </button>
                            </div>

                            <!-- Back to Login -->
                            <div class="text-center">
                                <a href="{{ route('login') }}" class="text-decoration-none">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Retour à la connexion
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Information supplémentaire -->
                <div class="card border-0 shadow-sm mt-4 bg-light">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            Informations
                        </h6>
                        <ul class="mb-0 small text-muted">
                            <li class="mb-2">Le lien de réinitialisation sera envoyé à votre adresse email</li>
                            <li class="mb-2">Le lien est valable pendant 60 minutes</li>
                            <li class="mb-2">Si vous ne recevez pas l'email, vérifiez vos spams</li>
                            <li>Vous pouvez demander un nouveau lien si nécessaire</li>
                        </ul>
                    </div>
                </div>

                <!-- Retour à l'accueil -->
                <div class="text-center mt-4">
                    <a href="{{ route('home') }}" class="text-decoration-none text-muted">
                        <i class="fas fa-home me-2"></i>
                        Retour à l'accueil
                    </a>
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

.form-control:focus {
    border-color: #11767e;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
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