@extends('layouts.public')

@section('title', $category->meta_title ?? $category->name . ' - Fiches Pratiques')
@section('meta_description', $category->meta_description ?? $category->description ?? 'Découvrez toutes les fiches pratiques de la catégorie ' . $category->name)

@if($category->meta_keywords)
    @section('meta_keywords', $category->meta_keywords)
@endif

@section('content')

{{-- Hero Section avec informations catégorie --}}
<section class="py-5 text-white text-center nataswim-titre3">
    <div class="container-lg">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-8">
                {{-- Icône catégorie --}}
                <div class="mb-3">
                    <i class="fas fa-folder fa-3x opacity-75"></i>
                </div>

                {{-- Nom de la catégorie --}}
                <h1 class="display-4 fw-bold mb-3">
                    {{ $category->name }}
                </h1>
                
                {{-- Description --}}
                @if($category->description)
                    <p class="lead mb-4">{{ $category->description }}</p>
                @endif
                
                {{-- Stats --}}
                <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
                    <span class="badge bg-light bg-opacity-25 text-white fs-6 px-4 py-2">
                        <i class="fas fa-file-alt me-2"></i>{{ $fiches->total() }} fiche{{ $fiches->total() > 1 ? 's' : '' }}
                    </span>
                    @if($sousCategories->count() > 0)
                        <span class="badge bg-light bg-opacity-25 text-white fs-6 px-4 py-2">
                            <i class="fas fa-layer-group me-2"></i>{{ $sousCategories->count() }} sous-catégorie{{ $sousCategories->count() > 1 ? 's' : '' }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Breadcrumb --}}
<section class="py-3 bg-light border-bottom">
    <div class="container-lg">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-primary px-3 py-2 mb-0 rounded">
                <li class="breadcrumb-item">
                    <a href="{{ route('public.fiches.index') }}" class="text-white text-decoration-none">
                        <i class="fas fa-home me-1"></i>Fiches
                    </a>
                </li>
                <li class="breadcrumb-item active text-white" aria-current="page">
                    {{ $category->name }}
                </li>
            </ol>
        </nav>
    </div>
</section>

{{-- Sous-catégories disponibles --}}
@if($sousCategories->count() > 0)
<section class="py-4 bg-white border-bottom">
    <div class="container-lg">
        {{-- En-tête --}}
        <div class="mb-3">
            <h2 class="h5 mb-0">
                <i class="fas fa-layer-group text-primary me-2"></i>Sous-catégories
            </h2>
        </div>

        {{-- Grille de sous-catégories --}}
        <div class="row g-3">
            @foreach($sousCategories as $sousCategory)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('public.fiches.sous-category', [$category, $sousCategory]) }}" 
                       class="text-decoration-none">
                        <div class="card h-100 border shadow-sm hover-lift-sm">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center">
                                    {{-- Image ou icône --}}
                                    @if($sousCategory->image)
                                        <img src="{{ $sousCategory->image }}" 
                                             class="rounded me-3" 
                                             style="width: 50px; height: 50px; object-fit: cover;"
                                             alt="{{ $sousCategory->name }}">
                                    @else
                                        <div class="bg-info bg-opacity-10 rounded d-flex align-items-center justify-content-center me-3" 
                                             style="width: 50px; height: 50px;">
                                            <i class="fas fa-layer-group text-info fs-4"></i>
                                        </div>
                                    @endif

                                    {{-- Contenu --}}
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 text-dark">{{ $sousCategory->name }}</h6>
                                        <small class="text-muted">
                                            <i class="fas fa-file-alt me-1"></i>
                                            {{ $sousCategory->published_fiches_count }} fiche{{ $sousCategory->published_fiches_count > 1 ? 's' : '' }}
                                        </small>
                                    </div>

                                    {{-- Flèche --}}
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Liste des fiches --}}
<section class="py-5 bg-light">
    <div class="container-lg">
        {{-- En-tête de section --}}
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="h4 mb-0">
                    <i class="fas fa-list text-primary me-2"></i>
                    Toutes les fiches
                    @if($sousCategories->count() > 0)
                        <span class="text-muted fs-6">(toutes sous-catégories confondues)</span>
                    @endif
                </h2>
            </div>
        </div>

        @if($fiches->count() > 0)
            {{-- Grille de fiches --}}
            <div class="row g-4">
                @foreach($fiches as $fiche)
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
                                    @if($fiche->sousCategory)
                                        <span class="badge bg-info">
                                            <i class="fas fa-layer-group me-1"></i>{{ $fiche->sousCategory->name }}
                                        </span>
                                    @endif
                                    @if($fiche->is_featured)
                                        <span class="badge bg-warning">
                                            <i class="fas fa-star me-1"></i>Vedette
                                        </span>
                                    @endif
                                    @if($fiche->visibility === 'authenticated')
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-lock me-1"></i>Membres
                                        </span>
                                    @endif
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
                                    <a href="{{ route('public.fiches.show', [$category, $fiche]) }}" 
                                       class="btn btn-sm btn-primary">
                                        Lire <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($fiches->hasPages())
                <div class="row mt-5">
                    <div class="col-12">
                        <nav aria-label="Navigation des fiches">
                            {{ $fiches->links() }}
                        </nav>
                    </div>
                </div>
            @endif
        @else
            {{-- Aucune fiche --}}
            <div class="card border-0 shadow-sm text-center py-5">
                <div class="card-body">
                    <i class="fas fa-file-alt fa-3x text-muted mb-3 opacity-25"></i>
                    <h5 class="text-muted mb-3">Aucune fiche disponible dans cette catégorie</h5>
                    <p class="text-muted mb-4">Les fiches seront bientôt disponibles.</p>
                    <a href="{{ route('public.fiches.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-2"></i>Retour aux catégories
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

{{-- Navigation rapide et image catégorie --}}
<section class="py-4 bg-white border-top">
    <div class="container-lg">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                {{-- Boutons de navigation --}}
                <div class="d-flex flex-wrap justify-content-center justify-content-lg-start gap-3">
                    <a href="{{ route('public.fiches.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-th me-2"></i>Toutes les catégories
                    </a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-tachometer-alt me-2"></i>Tableau de bord
                        </a>
                    @endauth
                </div>
            </div>

            {{-- Image de la catégorie --}}
            @if($category->image)
                <div class="col-lg-6 text-center">
                    <img src="{{ $category->image }}" 
                         alt="{{ $category->name }}" 
                         class="img-fluid rounded shadow"
                         style="max-height: 300px; object-fit: contain;">
                </div>
            @endif
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
/* ========================================
   FICHES CATÉGORIE - STYLES
   ======================================== */

/* Effet hover sur les cards */
.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important;
}

.hover-lift-sm {
    transition: all 0.2s ease;
}

.hover-lift-sm:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.1) !important;
}

/* Gradient pour images placeholder */
.bg-gradient-primary {
    background: linear-gradient(135deg, #0ea5e9 0%, #0f172a 100%);
}

/* Breadcrumb personnalisé */
.breadcrumb-item + .breadcrumb-item::before {
    content: "›";
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.7);
}

/* Animation pour les badges */
.badge {
    transition: transform 0.2s ease;
}

.card:hover .badge {
    transform: scale(1.05);
}

/* Responsive images */
@media (max-width: 767px) {
    .card-img-top {
        height: 180px !important;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation d'apparition des cards au scroll
    const cards = document.querySelectorAll('.hover-lift, .hover-lift-sm');
    
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 50); // Décalage pour effet cascade
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
