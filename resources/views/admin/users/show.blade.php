@extends('layouts.app')

@section('title', 'Détails de l\'utilisateur')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
            <i class="fas fa-user text-primary me-2"></i>
            Détails de l'utilisateur
        </h2>
        <div class="d-flex gap-2">
            @if(auth()->user()->hasPermission('users.edit'))
            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">
                <i class="fas fa-edit me-2"></i>Modifier
            </a>
            @endif
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Retour
            </a>
        </div>
    </div>
@endsection

@section('content')
<div class="py-4">
    <div class="container-fluid">
        <div class="row g-4">
            <!-- Profil utilisateur -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="mb-4">
                            @if($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" 
                                     alt="{{ $user->first_name }}" 
                                     class="rounded-circle shadow"
                                     style="width: 120px; height: 120px; object-fit: cover;">
                            @else
                                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center shadow"
                                     style="width: 120px; height: 120px;">
                                    <span class="text-primary fw-bold" style="font-size: 3rem;">
                                        {{ substr($user->first_name ?: $user->name, 0, 1) }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        
                        <h4 class="fw-bold mb-2">{{ $user->first_name }} {{ $user->last_name }}</h4>
                        <p class="text-muted mb-1">{{ '@' . $user->username }}</p>
                        <p class="text-muted mb-3">{{ $user->email }}</p>
                        
                        @if($user->role)
                        <div class="mb-3">
                            <span class="badge bg-primary-subtle text-primary px-3 py-2">
                                <i class="fas fa-user-shield me-1"></i>
                                {{ $user->role->name }}
                            </span>
                        </div>
                        @endif
                        
                        @if($user->bio)
                        <div class="alert alert-info bg-info bg-opacity-10 border-0 text-start">
                            <small class="text-muted d-block mb-1">
                                <i class="fas fa-quote-left me-1"></i>Biographie
                            </small>
                            <p class="mb-0">{{ $user->bio }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Statistiques -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-white border-bottom p-3">
                        <h6 class="mb-0">
                            <i class="fas fa-chart-bar text-primary me-2"></i>
                            Statistiques
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="text-muted">
                                    <i class="fas fa-calendar-alt me-2"></i>Membre depuis
                                </span>
                                <strong>{{ $user->created_at->diffForHumans() }}</strong>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="text-muted">
                                    <i class="fas fa-clock me-2"></i>Dernière connexion
                                </span>
                                <strong>
                                    @if($user->last_login_at)
                                        {{ $user->last_login_at->diffForHumans() }}
                                    @else
                                        Jamais
                                    @endif
                                </strong>
                            </div>
                            @if($user->email_verified_at)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="text-muted">
                                    <i class="fas fa-check-circle me-2"></i>Email vérifié
                                </span>
                                <span class="badge bg-success-subtle text-success">
                                    Oui
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Informations détaillées -->
            <div class="col-lg-8">
                <!-- Informations générales -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom p-4">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle text-primary me-2"></i>
                            Informations générales
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="border-start border-primary border-3 ps-3">
                                    <small class="text-muted d-block mb-1">Nom d'utilisateur</small>
                                    <strong>{{ $user->username }}</strong>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="border-start border-primary border-3 ps-3">
                                    <small class="text-muted d-block mb-1">Email</small>
                                    <strong>{{ $user->email }}</strong>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="border-start border-primary border-3 ps-3">
                                    <small class="text-muted d-block mb-1">Prénom</small>
                                    <strong>{{ $user->first_name }}</strong>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="border-start border-primary border-3 ps-3">
                                    <small class="text-muted d-block mb-1">Nom</small>
                                    <strong>{{ $user->last_name }}</strong>
                                </div>
                            </div>
                            @if($user->phone)
                            <div class="col-md-6">
                                <div class="border-start border-primary border-3 ps-3">
                                    <small class="text-muted d-block mb-1">Téléphone</small>
                                    <strong>{{ $user->phone }}</strong>
                                </div>
                            </div>
                            @endif
                            <div class="col-md-6">
                                <div class="border-start border-primary border-3 ps-3">
                                    <small class="text-muted d-block mb-1">Inscription</small>
                                    <strong>{{ $user->created_at->format('d/m/Y à H:i') }}</strong>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="border-start border-primary border-3 ps-3">
                                    <small class="text-muted d-block mb-1">Dernière modification</small>
                                    <strong>{{ $user->updated_at->format('d/m/Y à H:i') }}</strong>
                                </div>
                            </div>
                            @if($user->last_ip)
                            <div class="col-md-6">
                                <div class="border-start border-primary border-3 ps-3">
                                    <small class="text-muted d-block mb-1">Dernière IP</small>
                                    <strong>{{ $user->last_ip }}</strong>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Permissions -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom p-4">
                        <h5 class="mb-0">
                            <i class="fas fa-key text-primary me-2"></i>
                            Permissions
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        @if($user->role)
                        <div class="alert alert-info bg-info bg-opacity-10 border-0 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle me-2"></i>
                                <div>
                                    Cet utilisateur hérite des permissions du rôle 
                                    <strong>{{ $user->role->name }}</strong>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        @if($user->permissions->count() > 0)
                        <h6 class="mb-3">Permissions directes :</h6>
                        <div class="row g-2">
                            @foreach($user->permissions as $permission)
                            <div class="col-md-6">
                                <div class="badge bg-success-subtle text-success w-100 text-start py-2">
                                    <i class="fas fa-check me-1"></i>
                                    {{ $permission->name }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="text-muted text-center mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            Aucune permission directe attribuée
                        </p>
                        @endif
                    </div>
                </div>
                
                <!-- Actions -->
                @if(auth()->user()->hasPermission('users.delete') && $user->id !== auth()->id())
                <div class="card border-0 shadow-sm border-danger">
                    <div class="card-header bg-danger bg-opacity-10 border-bottom border-danger p-4">
                        <h5 class="mb-0 text-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Zone de danger
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Supprimer cet utilisateur</h6>
                                <p class="text-muted mb-0 small">
                                    Cette action est irréversible. Toutes les données de l'utilisateur seront supprimées.
                                </p>
                            </div>
                            <form action="{{ route('admin.users.destroy', $user) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Êtes-vous absolument sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash me-2"></i>Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.border-start {
    border-left-width: 3px !important;
}

.list-group-item {
    transition: background-color 0.2s ease;
}

.list-group-item:hover {
    background-color: rgba(13, 110, 253, 0.05);
}
</style>
@endpush