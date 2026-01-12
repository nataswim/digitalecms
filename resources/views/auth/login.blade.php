@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="min-vh-100 d-flex align-items-center bg-gradient-to-b from-blue-50 to-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <!-- Logo et Titre -->
                <div class="text-center mb-4">
                    <div class="mb-3">
                        <i class="fas fa-swimmer text-primary" style="font-size: 3rem;"></i>
                    </div>
                    <h2 class="fw-bold mb-2">Digital’SOS </h2>
                    <p class="text-muted">Connectez-vous pour accéder à votre compte</p>
                </div>

                <!-- Carte de connexion -->
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="alert alert-success bg-success bg-opacity-10 border-0 mb-4">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
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
                                       autofocus 
                                       autocomplete="username">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-4">
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
                                           autocomplete="current-password">
                                    <button class="btn btn-outline-secondary" 
                                            type="button" 
                                            id="togglePassword">
                                        <i class="fas fa-eye" id="toggleIcon"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           id="remember_me" 
                                           name="remember">
                                    <label class="form-check-label" for="remember_me">
                                        Se souvenir de moi
                                    </label>
                                </div>
                                
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-decoration-none small">
                                        Mot de passe oublié ?
                                    </a>
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-sign-in-alt me-2"></i>
                                    Se connecter
                                </button>
                            </div>

                            <!-- Divider -->
                            <div class="position-relative mb-4">
                                <hr>
                                <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small">
                                    ou
                                </span>
                            </div>

                            <!-- Register Link -->
                            <div class="text-center">
                                <p class="text-muted mb-0">
                                    Vous n'avez pas de compte ?
                                    <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">
                                        Créer un compte
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Comptes de test (développement uniquement) -->
                @if(config('app.env') === 'local')
                <div class="card border-0 shadow-sm mt-4 bg-light">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3">
                            <i class="fas fa-flask text-warning me-2"></i>
                            Comptes de test
                        </h6>
                        <div class="small">
                            <div class="mb-2">
                                <strong>Admin :</strong> 
                                <code class="bg-white px-2 py-1 rounded">admin@sport.fr</code> / 
                                <code class="bg-white px-2 py-1 rounded">password</code>
                            </div>
                            <div class="mb-2">
                                <strong>Manager :</strong> 
                                <code class="bg-white px-2 py-1 rounded">hassan@nataswim.fr</code> / 
                                <code class="bg-white px-2 py-1 rounded">password</code>
                            </div>
                            <div>
                                <strong>User :</strong> 
                                <code class="bg-white px-2 py-1 rounded">lucas@nageur.fr</code> / 
                                <code class="bg-white px-2 py-1 rounded">password</code>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

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
/* Gradient Background */
.bg-gradient-to-b {
    background: linear-gradient(to bottom, #eff6ff, #ffffff);
}

/* Card Hover Effect */
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important;
}

/* Input Focus Effect */
.form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
}

/* Button Hover Effect */
.btn-primary {
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(13, 110, 253, 0.3);
}

/* Remember Me Checkbox */
.form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

/* Code styling */
code {
    font-size: 0.875em;
}

/* Responsive */
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