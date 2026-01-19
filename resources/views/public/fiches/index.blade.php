@extends('layouts.public')

@section('title', 'Fiches Pratiques - Digital\'SOS')
@section('meta_description', 'Découvrez nos fiches pratiques organisées par thématique pour optimiser votre gestion sportive avec la méthode M2PC.')

@section('content')

{{-- Hero Section avec vidéo background --}}
<section class="position-relative text-white py-5 nataswim-titre3 overflow-hidden" style="min-height: 500px;">
    {{-- Overlay pour meilleure lisibilité --}}
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-25" style="z-index: 1;"></div>

    {{-- Contenu Hero --}}
    <div class="container-lg py-5 position-relative" style="z-index: 2;">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                {{-- Icône principale --}}
                <div class="mb-4">
                    <i class="fas fa-file-alt fa-4x text-white opacity-75"></i>
                </div>

                {{-- Titre principal --}}
                <h1 class="display-3 fw-bold mb-4" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                    Fiches Pratiques
                </h1>

                {{-- Sous-titre --}}
                <p class="lead mb-4 fs-4">
                    Optimisez votre gestion sportive avec nos fiches organisées selon la méthode M2PC : 
                    Matériel, Planning, Personnel, Contenu.
                </p>

                {{-- Stats rapides --}}
                <div class="d-flex flex-wrap justify-content-center gap-4 mt-4">
                    <div class="badge bg-light bg-opacity-25 text-white px-4 py-3 fs-6">
                        <i class="fas fa-folder me-2"></i>
                        {{ $categories->count() }} catégorie{{ $categories->count() > 1 ? 's' : '' }}
                    </div>
                    <div class="badge bg-light bg-opacity-25 text-white px-4 py-3 fs-6">
                        <i class="fas fa-star me-2"></i>
                        {{ $featuredFiches->count() }} en vedette
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Fiches en vedette --}}
@if($featuredFiches->count() > 0)
<section class="py-5 bg-light">
    <div class="container-lg">
        {{-- En-tête de section --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h2 class="h3 mb-2">
                            <i class="fas fa-star text-warning me-2"></i>Fiches en Vedette
                        </h2>
                        <p class="text-muted mb-0">Les ressources essentielles pour votre organisation</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Grille de fiches --}}
        <div class="row g-4">
            @foreach($featuredFiches as $fiche)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-lg hover-lift">
                        {{-- Image --}}
                        @if($fiche->image)
                            <img src="{{ $fiche->image }}" 
                                 class="card-img-top" 
                                 style="height: 220px; object-fit: cover;"
                                 alt="{{ $fiche->title }}">
                        @else
                            <div class="card-img-top bg-gradient-primary d-flex align-items-center justify-content-center" 
                                 style="height: 220px;">
                                <i class="fas fa-file-alt fa-4x text-white opacity-50"></i>
                            </div>
                        @endif
                        
                        {{-- Corps de la carte --}}
                        <div class="card-body d-flex flex-column">
                            {{-- Badges --}}
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                @if($fiche->category)
                                    <span class="badge bg-primary">
                                        <i class="fas fa-folder me-1"></i>{{ $fiche->category->name }}
                                    </span>
                                @endif
                                @if($fiche->sousCategory)
                                    <span class="badge bg-info">
                                        <i class="fas fa-layer-group me-1"></i>{{ $fiche->sousCategory->name }}
                                    </span>
                                @endif
                                @if($fiche->visibility === 'authenticated')
                                    <span class="badge bg-warning">
                                        <i class="fas fa-lock me-1"></i>Membres
                                    </span>
                                @endif
                                <span class="badge bg-success">
                                    <i class="fas fa-star me-1"></i>Vedette
                                </span>
                            </div>
                            
                            {{-- Titre --}}
                            <h5 class="card-title mb-3">{{ $fiche->title }}</h5>
                            
                            {{-- Description --}}
                            <p class="card-text text-muted flex-grow-1">
                                {!! Str::limit(strip_tags($fiche->short_description), 120) !!}
                            </p>
                            
                            {{-- Footer --}}
                            <div class="d-flex align-items-center justify-content-between mt-3 pt-3 border-top">
                                <small class="text-muted">
                                    <i class="fas fa-eye me-1"></i>{{ number_format($fiche->views_count) }} lecture{{ $fiche->views_count > 1 ? 's' : '' }}
                                </small>
                                @if($fiche->category)
                                    <a href="{{ route('public.fiches.show', [$fiche->category, $fiche]) }}" 
                                       class="btn btn-sm btn-primary">
                                        Découvrir <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Navigation par Catégories --}}
<section class="py-5 {{ $featuredFiches->count() > 0 ? 'bg-white' : 'bg-light' }}">
    <div class="container-lg">
        {{-- En-tête de section --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="text-center">
                    <h2 class="h3 mb-2">
                        <i class="fas fa-th-large me-2 text-primary"></i>Explorer par Catégorie
                    </h2>
                    <p class="text-muted mb-0">Organisé selon la méthode M2PC pour une gestion optimale</p>
                </div>
            </div>
        </div>

        {{-- Catégories --}}
        @if($categories->count() > 0)
            <div class="row g-4">
                @foreach($categories as $category)
                    <div class="col-12">
                        <div class="card border-0 shadow-sm hover-category-fiche">
                            <div class="row g-0">
                                {{-- Image de la catégorie --}}
                                <div class="col-12 col-md-3">
                                    <div class="category-image-wrapper-fiche position-relative">
                                        @if($category->image)
                                            <img src="{{ $category->image }}" 
                                                 alt="{{ $category->name }}"
                                                 class="category-image-fiche">
                                        @else
                                            <div class="category-image-placeholder-fiche d-flex align-items-center justify-content-center text-white"
                                                 style="background: linear-gradient(135deg, {{ $loop->index % 4 == 0 ? '#11767e' : ($loop->index % 4 == 1 ? '#198754' : ($loop->index % 4 == 2 ? '#0dcaf0' : '#ffc107')) }} 0%, {{ $loop->index % 4 == 0 ? '#084298' : ($loop->index % 4 == 1 ? '#0f5132' : ($loop->index % 4 == 2 ? '#087990' : '#cc9a06')) }} 100%);">
                                                <i class="fas fa-folder fa-4x"></i>
                                            </div>
                                        @endif
                                        
                                        {{-- Badge nombre de fiches --}}
                                        <div class="position-absolute top-0 end-0 m-3">
                                            <span class="badge bg-success shadow-sm fs-6">
                                                <i class="fas fa-file-alt me-1"></i>
                                                {{ $category->published_fiches_count }} fiche{{ $category->published_fiches_count > 1 ? 's' : '' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Contenu central --}}
                                <div class="col-12 col-md-7">
                                    <div class="card-body p-4">
                                        {{-- Nom de la catégorie --}}
                                        <h3 class="card-title h4 mb-3">
                                            <a href="{{ route('public.fiches.category', $category) }}" 
                                               class="text-decoration-none text-dark category-link-fiche">
                                                {{ $category->name }}
                                            </a>
                                        </h3>

                                        {{-- Description --}}
                                        @if($category->description)
                                            <p class="card-text text-muted mb-3">
                                                {!! Str::limit(strip_tags($category->description), 180) !!}
                                            </p>
                                        @else
                                            <p class="card-text text-muted mb-3">
                                                Découvrez nos fiches pratiques dans la catégorie {{ $category->name }}.
                                            </p>
                                        @endif

                                        {{-- Métadonnées --}}
                                        <div class="d-flex flex-wrap gap-3 text-muted small">
                                            <span>
                                                <i class="fas fa-folder me-1"></i>
                                                Catégorie principale
                                            </span>
                                            @if($category->activeSousCategories()->count() > 0)
                                                <span>
                                                    <i class="fas fa-layer-group me-1"></i>
                                                    {{ $category->activeSousCategories()->count() }} sous-catégorie{{ $category->activeSousCategories()->count() > 1 ? 's' : '' }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- Bouton à droite --}}
                                <div class="col-12 col-md-2 d-flex align-items-center justify-content-center">
                                    <div class="p-3 w-100">
                                        <a href="{{ route('public.fiches.category', $category) }}" 
                                           class="btn btn-outline-primary w-100 btn-category-fiche">
                                            <i class="fas fa-arrow-right me-2"></i>
                                            <span class="d-none d-lg-inline">Découvrir</span>
                                            <span class="d-inline d-lg-none">Voir les fiches</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Aucune catégorie --}}
            <div class="text-center py-5">
                <i class="fas fa-folder-open fa-3x text-muted mb-3 opacity-25"></i>
                <h5 class="text-muted">Aucune catégorie disponible pour le moment</h5>
                <p class="text-muted">Les fiches seront bientôt disponibles.</p>
            </div>
        @endif
    </div>
</section>

{{-- Section Call to Action --}}
<section class="py-5 nataswim-titre5">
    <div class="container-lg">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="h3 mb-3 text-white">
                    <i class="fas fa-lightbulb me-2"></i>Besoin d'aide ?
                </h2>
                <p class="lead text-white mb-4">
                    Nos fiches pratiques vous accompagnent dans l'optimisation de votre organisation sportive selon la méthode M2PC.
                </p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg">
                            <i class="fas fa-tachometer-alt me-2"></i>Mon Tableau de Bord
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                            <i class="fas fa-user-plus me-2"></i>Créer un Compte
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-sign-in-alt me-2"></i>Se Connecter
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
/* ========================================
   CATÉGORIES FICHES - STYLES PERSONNALISÉS
   ======================================== */

/* Espacement entre les catégories */
.category-row {
    margin-bottom: 2rem;
}

/* Card catégorie avec effet hover */
.hover-category-fiche {
    transition: all 0.3s ease;
    border-radius: 12px;
    overflow: hidden;
}

.hover-category-fiche:hover {
    box-shadow: 0 0.5rem 2rem rgba(4, 173, 185, 0.25) !important;
    background-color: #f0fbfc;
}

/* Image de la catégorie */
.category-image-wrapper-fiche {
    position: relative;
    height: 100%;
    min-height: 250px;
}

.category-image-fiche {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.category-image-placeholder-fiche {
    width: 100%;
    height: 100%;
    min-height: 250px;
}

/* Liens avec effet hover */
.category-link-fiche {
    transition: color 0.3s ease;
}

.hover-category-fiche:hover .category-link-fiche {
    color: #04adb9 !important;
}

/* Bouton avec effet hover */
.btn-category-fiche {
    transition: all 0.3s ease;
}

.hover-category-fiche:hover .btn-category-fiche {
    background-color: #04adb9;
    border-color: #04adb9;
    color: white;
}

/* ========================================
   FICHES EN VEDETTE
   ======================================== */

.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #0ea5e9 0%, #0f172a 100%);
}

/* ========================================
   RESPONSIVE
   ======================================== */

@media (max-width: 767px) {
    /* Image centrée en haut sur mobile */
    .category-image-wrapper-fiche {
        min-height: 200px;
    }
    
    .category-image-fiche,
    .category-image-placeholder-fiche {
        border-radius: 12px 12px 0 0;
        min-height: 200px;
    }
}

@media (min-width: 768px) {
    /* Image à gauche sur desktop */
    .category-image-wrapper-fiche,
    .category-image-fiche,
    .category-image-placeholder-fiche {
        border-radius: 12px 0 0 12px;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation d'entrée pour les cards
    const cards = document.querySelectorAll('.hover-category-fiche, .hover-lift');
    
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.6s ease';
        observer.observe(card);
    });
});
</script>
@endpush