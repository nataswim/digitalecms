@extends('layouts.app')

@section('title', 'Confirmer le mot de passe')

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
                            <i class="fas fa-shield-alt text-warning" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-2">Zone sécurisée</h2>
                    <p class="text-muted">
                        Cette action nécessite une confirmation. Veuillez entrer votre mot de passe 
                        pour continuer.
                    </p>
                </div>

                <!-- Carte de confirmation -->
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf

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
                                           autocomplete="current-password"
                                           autofocus>
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

                            <!-- Information -->
                            <div class="alert alert-info bg-info bg-opacity-10 border-0 mb-4">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-info-circle text-info me-2 mt-1"></i>
                                    <small class="mb-0">
                                        Pour votre sécurité, nous devons vérifier votre identité avant de 
                                        procéder à cette action sensible.
                                    </small>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-check me-2"></i>
                                    Confirmer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Aide -->
                <div class="card border-0 shadow-sm mt-4 bg-light">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3">
                            <i class="fas fa-question-circle text-primary me-2"></i>
                            Besoin d'aide ?
                        </h6>
                        <div class="small text-muted">
                            <p class="mb-2">
                                Si vous avez oublié votre mot de passe, vous pouvez en demander un nouveau.
                            </p>
                            <a href="{{ route('password.request') }}" class="text-decoration-none">
                                <i class="fas fa-arrow-right me-2"></i>
                                Réinitialiser mon mot de passe
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Retour -->
                <div class="text-center mt-4">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none text-muted">
                        <i class="fas fa-arrow-left me-2"></i>
                        Retour au tableau de bord
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