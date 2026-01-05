@extends('layouts.app')

@section('title', 'Mon profil')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <i class="fas fa-user-circle text-primary me-2"></i>
        Mon profil
    </h2>
@endsection

@section('content')
<div class="py-4">
    <div class="container-fluid">
        <div class="row g-4">
            <!-- Sidebar Profil -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <!-- Avatar -->
                        <div class="mb-4">
                            @if(auth()->user()->avatar)
                                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" 
                                     alt="{{ auth()->user()->first_name }}" 
                                     class="rounded-circle shadow"
                                     style="width: 120px; height: 120px; object-fit: cover;">
                            @else
                                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center shadow"
                                     style="width: 120px; height: 120px;">
                                    <span class="text-primary fw-bold" style="font-size: 3rem;">
                                        {{ substr(auth()->user()->first_name ?: auth()->user()->name, 0, 1) }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        
                        <h4 class="fw-bold mb-2">
                            {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                        </h4>
                        <p class="text-muted mb-1">{{ '@' . auth()->user()->username }}</p>
                        <p class="text-muted mb-3">{{ auth()->user()->email }}</p>
                        
                        @if(auth()->user()->role)
                        <div class="mb-3">
                            <span class="badge bg-primary-subtle text-primary px-3 py-2">
                                <i class="fas fa-user-shield me-1"></i>
                                {{ auth()->user()->role->name }}
                            </span>
                        </div>
                        @endif
                        
                        @if(auth()->user()->bio)
                        <div class="alert alert-info bg-info bg-opacity-10 border-0 text-start">
                            <small class="text-muted d-block mb-1">
                                <i class="fas fa-quote-left me-1"></i>Biographie
                            </small>
                            <p class="mb-0">{{ auth()->user()->bio }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Informations -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-white border-bottom p-3">
                        <h6 class="mb-0">
                            <i class="fas fa-info-circle text-primary me-2"></i>
                            Informations
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between">
                                <span class="text-muted">
                                    <i class="fas fa-calendar-alt me-2"></i>Membre depuis
                                </span>
                                <strong>{{ auth()->user()->created_at->format('d/m/Y') }}</strong>
                            </div>
                            @if(auth()->user()->last_login_at)
                            <div class="list-group-item d-flex justify-content-between">
                                <span class="text-muted">
                                    <i class="fas fa-clock me-2"></i>Dernière connexion
                                </span>
                                <strong>{{ auth()->user()->last_login_at->diffForHumans() }}</strong>
                            </div>
                            @endif
                            @if(auth()->user()->email_verified_at)
                            <div class="list-group-item">
                                <span class="badge bg-success w-100">
                                    <i class="fas fa-check-circle me-1"></i>Email vérifié
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Formulaires -->
            <div class="col-lg-8">
                <!-- Informations personnelles -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom p-4">
                        <h5 class="mb-0">
                            <i class="fas fa-user-edit text-primary me-2"></i>
                            Informations personnelles
                        </h5>
                    </div>
                    
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        
                        <div class="card-body p-4">
                            <div class="row g-4">
                                <!-- Username -->
                                <div class="col-md-6">
                                    <label for="username" class="form-label fw-semibold">
                                        Nom d'utilisateur
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-at"></i>
                                        </span>
                                        <input type="text" 
                                               class="form-control @error('username') is-invalid @enderror" 
                                               id="username" 
                                               name="username" 
                                               value="{{ old('username', auth()->user()->username) }}">
                                    </div>
                                    @error('username')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Email -->
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-semibold">
                                        Email
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input type="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email', auth()->user()->email) }}">
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Prénom -->
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label fw-semibold">
                                        Prénom
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('first_name') is-invalid @enderror" 
                                           id="first_name" 
                                           name="first_name" 
                                           value="{{ old('first_name', auth()->user()->first_name) }}">
                                    @error('first_name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Nom -->
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label fw-semibold">
                                        Nom
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('last_name') is-invalid @enderror" 
                                           id="last_name" 
                                           name="last_name" 
                                           value="{{ old('last_name', auth()->user()->last_name) }}">
                                    @error('last_name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Téléphone -->
                                <div class="col-md-6">
                                    <label for="phone" class="form-label fw-semibold">
                                        Téléphone
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" 
                                           name="phone" 
                                           value="{{ old('phone', auth()->user()->phone) }}">
                                    @error('phone')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Avatar -->
                                <div class="col-md-6">
                                    <label for="avatar" class="form-label fw-semibold">
                                        Photo de profil
                                    </label>
                                    <input type="file" 
                                           class="form-control @error('avatar') is-invalid @enderror" 
                                           id="avatar" 
                                           name="avatar" 
                                           accept="image/*">
                                    <small class="text-muted">JPG, PNG - Max 2 Mo</small>
                                    @error('avatar')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Bio -->
                                <div class="col-12">
                                    <label for="bio" class="form-label fw-semibold">
                                        Biographie
                                    </label>
                                    <textarea class="form-control @error('bio') is-invalid @enderror" 
                                              id="bio" 
                                              name="bio" 
                                              rows="3">{{ old('bio', auth()->user()->bio) }}</textarea>
                                    @error('bio')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer bg-white border-top p-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Mot de passe -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom p-4">
                        <h5 class="mb-0">
                            <i class="fas fa-lock text-warning me-2"></i>
                            Changer le mot de passe
                        </h5>
                    </div>
                    
                    <form action="{{ route('profile.password.update') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="card-body p-4">
                            <div class="row g-4">
                                <!-- Mot de passe actuel -->
                                <div class="col-12">
                                    <label for="current_password" class="form-label fw-semibold">
                                        Mot de passe actuel
                                    </label>
                                    <input type="password" 
                                           class="form-control @error('current_password') is-invalid @enderror" 
                                           id="current_password" 
                                           name="current_password">
                                    @error('current_password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Nouveau mot de passe -->
                                <div class="col-md-6">
                                    <label for="password" class="form-label fw-semibold">
                                        Nouveau mot de passe
                                    </label>
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password">
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Confirmation -->
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label fw-semibold">
                                        Confirmer le mot de passe
                                    </label>
                                    <input type="password" 
                                           class="form-control" 
                                           id="password_confirmation" 
                                           name="password_confirmation">
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer bg-white border-top p-4">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-key me-2"></i>Changer le mot de passe
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Supprimer le compte -->
                <div class="card border-0 shadow-sm border-danger">
                    <div class="card-header bg-danger bg-opacity-10 border-bottom border-danger p-4">
                        <h5 class="mb-0 text-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Zone de danger
                        </h5>
                    </div>
                    
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-2">Supprimer mon compte</h6>
                                <p class="text-muted mb-0">
                                    Une fois votre compte supprimé, toutes vos données seront définitivement effacées. 
                                    Cette action est irréversible.
                                </p>
                            </div>
                            <button type="button" 
                                    class="btn btn-danger ms-3" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteAccountModal">
                                <i class="fas fa-trash me-2"></i>Supprimer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Confirmer la suppression
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            
            <form action="{{ route('profile.destroy') }}" method="POST">
                @csrf
                @method('DELETE')
                
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <strong>Attention !</strong> Cette action est irréversible.
                    </div>
                    
                    <p class="mb-3">
                        Pour confirmer la suppression de votre compte, veuillez entrer votre mot de passe :
                    </p>
                    
                    <label for="delete_password" class="form-label fw-semibold">
                        Mot de passe
                    </label>
                    <input type="password" 
                           class="form-control" 
                           id="delete_password" 
                           name="password" 
                           required>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Annuler
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Supprimer définitivement
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.input-group-text {
    background-color: #f8f9fa;
    border-right: none;
}

.input-group .form-control {
    border-left: none;
}

.input-group .form-control:focus {
    border-left: none;
    box-shadow: none;
}

.input-group:focus-within .input-group-text {
    border-color: #86b7fe;
}

.list-group-item {
    transition: background-color 0.2s ease;
}

.list-group-item:hover {
    background-color: rgba(13, 110, 253, 0.05);
}
</style>
@endpush