@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
<div class="min-vh-100 d-flex align-items-center bg-gradient-to-b from-blue-50 to-white py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <!-- Logo et Titre -->
                <div class="text-center mb-4">
                    <div class="mb-3">
                        <i class="fas fa-swimmer text-primary" style="font-size: 3rem;"></i>
                    </div>
                    <h2 class="fw-bold mb-2">Créer un compte</h2>
                    <p class="text-muted">Rejoignez notre platforme</p>
                </div>

                <!-- Carte d'inscription -->
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row g-4">
                                <!-- Name -->
                                <div class="col-12">
                                    <label for="name" class="form-label fw-semibold">
                                        <i class="fas fa-user me-2 text-primary"></i>
                                        Nom complet
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           placeholder="Jean Dupont"
                                           required 
                                           autofocus 
                                           autocomplete="name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="col-12">
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
                                           autocomplete="username">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="col-md-6">
                                    <label for="password" class="form-label fw-semibold">
                                        <i class="fas fa-lock me-2 text-primary"></i>
                                        Mot de passe
                                    </label>
                                    <div class="input-group">
                                        <input type="password" 
                                               class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                               id="password" 
                                               name="password" 
                                               placeholder="••••••••"
                                               required 
                                               autocomplete="new-password">
                                        <button class="btn btn-outline-secondary" 
                                                type="button" 
                                                id="togglePassword">
                                            <i class="fas fa-eye" id="toggleIcon"></i>
                                        </button>
                                    </div>
                                    <small class="text-muted">Min. 8 caractères</small>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password Confirmation -->
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label fw-semibold">
                                        <i class="fas fa-lock me-2 text-primary"></i>
                                        Confirmer
                                    </label>
                                    <input type="password" 
                                           class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           placeholder="••••••••"
                                           required 
                                           autocomplete="new-password">
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Terms & Conditions -->
                            <div class="form-check mt-4">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="terms" 
                                       name="terms" 
                                       required>
                                <label class="form-check-label small" for="terms">
                                    J'accepte les 
                                    <a href="{{ route('terms') }}" target="_blank">conditions d'utilisation</a> 
                                    et la 
                                    <a href="{{ route('privacy') }}" target="_blank">politique de confidentialité</a>
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mt-4 mb-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-user-plus me-2"></i>
                                    Créer mon compte
                                </button>
                            </div>

                            <!-- Divider -->
                            <div class="position-relative mb-4">
                                <hr>
                                <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small">
                                    ou
                                </span>
                            </div>

                            <!-- Login Link -->
                            <div class="text-center">
                                <p class="text-muted mb-0">
                                    Vous avez déjà un compte ?
                                    <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">
                                        Se connecter
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Retour à l'accueil -->
                <div class="text-center mt-4">
                    <a href="{{ route('home') }}" class="text-decoration-none text-muted">
                        <i class="fas fa-arrow-left me-2"></i>
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
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
}

.btn-primary {
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(13, 110, 253, 0.3);
}

.form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

@media (max-width: 768px) {
    .card-body {
        padding: 2rem !important;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Toggle password visibility
document.getElementById('togglePassword').addEventListener('click', function() {
    const password = document.getElementById('password');
    const icon = document.getElementById('toggleIcon');
    
    if (password.type === 'password') {
        password.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        password.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
});
</script>
@endpush