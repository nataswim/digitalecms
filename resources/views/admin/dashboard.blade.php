@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
        <i class="fas fa-chart-line text-primary me-2"></i>
        Tableau de bord Administration
    </h2>
@endsection

@section('content')
<div class="py-4">
    <div class="container-fluid">
        
        {{-- Message de bienvenue --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-primary border-0 shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle fa-2x me-3"></i>
                        <div>
                            <h5 class="mb-1">Bienvenue sur Digital'SOS</h5>
                            <p class="mb-0">Digital Sport Organisation System - Gestion centralisée M2PC (Matériel, Planning, Personnel, Contenu)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Cards par fonctionnalité --}}
        <div class="row g-4">

            {{-- UTILISATEURS --}}
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body p-4">
                        {{-- En-tête --}}
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h5 class="card-title mb-1">
                                    <i class="fas fa-users text-primary me-2"></i>
                                    Utilisateurs
                                </h5>
                                <p class="text-muted small mb-0">Gestion des comptes</p>
                            </div>
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-users text-primary fa-2x"></i>
                            </div>
                        </div>

                        {{-- Nombre total --}}
                        <div class="mb-4">
                            <div class="d-flex align-items-baseline">
                                <h2 class="fw-bold mb-0 me-2">{{ $stats['total_users'] }}</h2>
                                <span class="text-muted">utilisateur(s)</span>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary">
                                <i class="fas fa-list me-2"></i>Voir tous les utilisateurs
                            </a>
                            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Ajouter un utilisateur
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RÔLES --}}
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body p-4">
                        {{-- En-tête --}}
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h5 class="card-title mb-1">
                                    <i class="fas fa-user-shield text-success me-2"></i>
                                    Rôles
                                </h5>
                                <p class="text-muted small mb-0">Groupes de permissions</p>
                            </div>
                            <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-user-shield text-success fa-2x"></i>
                            </div>
                        </div>

                        {{-- Nombre total --}}
                        <div class="mb-4">
                            <div class="d-flex align-items-baseline">
                                <h2 class="fw-bold mb-0 me-2">{{ $stats['total_roles'] }}</h2>
                                <span class="text-muted">rôle(s)</span>
                            </div>
                            <small class="text-success">
                                <i class="fas fa-check-circle me-1"></i>
                                {{ $stats['active_roles'] }} actif(s)
                            </small>
                        </div>

                        {{-- Actions --}}
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-success">
                                <i class="fas fa-list me-2"></i>Voir tous les rôles
                            </a>
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-success">
                                <i class="fas fa-plus me-2"></i>Ajouter un rôle
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PERMISSIONS --}}
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body p-4">
                        {{-- En-tête --}}
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h5 class="card-title mb-1">
                                    <i class="fas fa-key text-warning me-2"></i>
                                    Permissions
                                </h5>
                                <p class="text-muted small mb-0">Contrôle d'accès</p>
                            </div>
                            <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-key text-warning fa-2x"></i>
                            </div>
                        </div>

                        {{-- Nombre total --}}
                        <div class="mb-4">
                            <div class="d-flex align-items-baseline">
                                <h2 class="fw-bold mb-0 me-2">{{ $stats['total_permissions'] }}</h2>
                                <span class="text-muted">permission(s)</span>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-warning">
                                <i class="fas fa-list me-2"></i>Voir toutes les permissions
                            </a>
                            <a href="{{ route('admin.permissions.create') }}" class="btn btn-warning text-white">
                                <i class="fas fa-plus me-2"></i>Ajouter une permission
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MÉDIAS --}}
<div class="col-lg-4 col-md-6">
    <div class="card border-0 shadow-sm h-100 hover-card">
        <div class="card-body p-4">
            {{-- En-tête --}}
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h5 class="card-title mb-1">
                        <i class="fas fa-images text-info me-2"></i>
                        Médias
                    </h5>
                    <p class="text-muted small mb-0">Images, documents, fichiers</p>
                </div>
                <div class="bg-info bg-opacity-10 rounded-circle p-3">
                    <i class="fas fa-images text-info fa-2x"></i>
                </div>
            </div>

            {{-- Nombre total --}}
            <div class="mb-4">
                <div class="d-flex align-items-baseline">
                    @php
                        $mediaCount = \App\Models\Media::count();
                    @endphp
                    <h2 class="fw-bold mb-0 me-2">{{ $mediaCount }}</h2>
                    <span class="text-muted">média(s)</span>
                </div>
            </div>

            {{-- Actions --}}
            <div class="d-grid gap-2">
                <a href="{{ route('admin.media.index') }}" class="btn btn-outline-info">
                    <i class="fas fa-list me-2"></i>Voir tous les médias
                </a>
                <a href="{{ route('admin.media.create') }}" class="btn btn-info text-white">
                    <i class="fas fa-upload me-2"></i>Uploader un média
                </a>
            </div>
        </div>
    </div>
</div>

{{-- CATÉGORIES MÉDIA - NOUVELLE CARD --}}
<div class="col-lg-4 col-md-6">
    <div class="card border-0 shadow-sm h-100 hover-card">
        <div class="card-body p-4">
            {{-- En-tête --}}
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h5 class="card-title mb-1">
                        <i class="fas fa-folder-open text-purple me-2"></i>
                        Catégories Média
                    </h5>
                    <p class="text-muted small mb-0">Organisation des médias</p>
                </div>
                <div class="bg-purple bg-opacity-10 rounded-circle p-3">
                    <i class="fas fa-folder-open text-purple fa-2x"></i>
                </div>
            </div>

            {{-- Nombre total --}}
            <div class="mb-4">
                <div class="d-flex align-items-baseline">
                    @php
                        $mediaCategoriesCount = \App\Models\MediaCategory::count();
                    @endphp
                    <h2 class="fw-bold mb-0 me-2">{{ $mediaCategoriesCount }}</h2>
                    <span class="text-muted">catégorie(s)</span>
                </div>
                <small class="text-muted">
                    <i class="fas fa-images me-1"></i>
                    Pour organiser {{ $mediaCount }} médias
                </small>
            </div>

            {{-- Actions --}}
            <div class="d-grid gap-2">
                <a href="{{ route('admin.media.categories') }}" class="btn btn-outline-purple">
                    <i class="fas fa-list me-2"></i>Voir toutes les catégories
                </a>
                <button type="button" 
                        class="btn btn-purple text-white"
                        data-bs-toggle="modal" 
                        data-bs-target="#categoryModal">
                    <i class="fas fa-plus me-2"></i>Créer une catégorie
                </button>
            </div>
        </div>
    </div>
</div>

            {{-- FICHES --}}
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body p-4">
                        {{-- En-tête --}}
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h5 class="card-title mb-1">
                                    <i class="fas fa-file-alt text-danger me-2"></i>
                                    Fiches
                                </h5>
                                <p class="text-muted small mb-0">Contenu documentaire</p>
                            </div>
                            <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-file-alt text-danger fa-2x"></i>
                            </div>
                        </div>

                        {{-- Nombre total --}}
                        <div class="mb-4">
                            <div class="d-flex align-items-baseline">
                                @php
                                    $fichesCount = \App\Models\Fiche::count();
                                @endphp
                                <h2 class="fw-bold mb-0 me-2">{{ $fichesCount }}</h2>
                                <span class="text-muted">fiche(s)</span>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.fiches.index') }}" class="btn btn-outline-danger">
                                <i class="fas fa-list me-2"></i>Voir toutes les fiches
                            </a>
                            <a href="{{ route('admin.fiches.create') }}" class="btn btn-danger">
                                <i class="fas fa-plus me-2"></i>Créer une fiche
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CATÉGORIES DE FICHES --}}
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body p-4">
                        {{-- En-tête --}}
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h5 class="card-title mb-1">
                                    <i class="fas fa-folder text-secondary me-2"></i>
                                    Catégories
                                </h5>
                                <p class="text-muted small mb-0">Organisation des fiches</p>
                            </div>
                            <div class="bg-secondary bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-folder text-secondary fa-2x"></i>
                            </div>
                        </div>

                        {{-- Nombre total --}}
                        <div class="mb-4">
                            <div class="d-flex align-items-baseline">
                                @php
                                    $categoriesCount = \App\Models\FichesCategory::count();
                                @endphp
                                <h2 class="fw-bold mb-0 me-2">{{ $categoriesCount }}</h2>
                                <span class="text-muted">catégorie(s)</span>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.fiches-categories.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-list me-2"></i>Voir toutes les catégories
                            </a>
                            <a href="{{ route('admin.fiches-categories.create') }}" class="btn btn-secondary">
                                <i class="fas fa-plus me-2"></i>Ajouter une catégorie
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Informations système (optionnel) --}}
        <div class="row mt-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-3">
                            <i class="fas fa-info-circle text-primary me-2"></i>
                            Méthode M2PC
                        </h5>
                        <div class="row text-center">
                            <div class="col-md-3 col-6 mb-3 mb-md-0">
                                <div class="p-3 bg-light rounded">
                                    <i class="fas fa-boxes fa-2x text-primary mb-2"></i>
                                    <h6 class="mb-0">Matériel</h6>
                                    <small class="text-muted">Inventaire</small>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-3 mb-md-0">
                                <div class="p-3 bg-light rounded">
                                    <i class="fas fa-calendar-alt fa-2x text-success mb-2"></i>
                                    <h6 class="mb-0">Planning</h6>
                                    <small class="text-muted">Organisation</small>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="p-3 bg-light rounded">
                                    <i class="fas fa-users fa-2x text-warning mb-2"></i>
                                    <h6 class="mb-0">Personnel</h6>
                                    <small class="text-muted">Équipe</small>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="p-3 bg-light rounded">
                                    <i class="fas fa-file-alt fa-2x text-danger mb-2"></i>
                                    <h6 class="mb-0">Contenu</h6>
                                    <small class="text-muted">Documents</small>
                                </div>
                            </div>
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
/* Animation hover sur les cards */
.hover-card {
    transition: all 0.3s ease;
}

.hover-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
}

/* Style des boutons dans les cards */
.card-body .btn {
    font-weight: 500;
    transition: all 0.2s ease;
}

.card-body .btn:hover {
    transform: translateX(5px);
}

/* Amélioration des icônes circulaires */
.bg-opacity-10 {
    --bs-bg-opacity: 0.1;
}

/* NOUVELLE COULEUR PURPLE pour Catégories Média */
.text-purple {
    color: #9333ea !important;
}

.bg-purple {
    background-color: #9333ea !important;
}

.btn-purple {
    background-color: #9333ea;
    border-color: #9333ea;
    color: white;
}

.btn-purple:hover {
    background-color: #7c3aed;
    border-color: #7c3aed;
    color: white;
}

.btn-outline-purple {
    color: #9333ea;
    border-color: #9333ea;
}

.btn-outline-purple:hover {
    background-color: #9333ea;
    border-color: #9333ea;
    color: white;
}

/* Animation des chiffres */
.card-body h2 {
    animation: countUp 0.8s ease-out;
}

@keyframes countUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 768px) {
    .hover-card:hover {
        transform: translateY(-4px);
    }
}
</style>
@endpush