@extends('layouts.public')

@section('title', $sousCategory->meta_title ?? $sousCategory->name . ' - ' . $category->name)
@section('meta_description', $sousCategory->meta_description ?? $sousCategory->description ?? 'Découvrez toutes les fiches pratiques de la sous-catégorie ' . $sousCategory->name)

@if($sousCategory->meta_keywords)
    @section('meta_keywords', $sousCategory->meta_keywords)
@endif

@section('content')

{{-- Hero Section avec informations sous-catégorie --}}
<section class="py-5 text-white text-center nataswim-titre3">
    <div class="container-lg">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-8">
                {{-- Icône sous-catégorie --}}
                <div class="mb-3">
                    <i class="fas fa-layer-group fa-3x opacity-75"></i>
                </div>

                {{-- Badge catégorie parente --}}
                <div class="mb-3">
                    <a href="{{ route('public.fiches.category', $category) }}" 
                       class="badge bg-light bg-opacity-25 text-white text-decoration-none fs-6 px-4 py-2">
                        <i class="fas fa-folder me-2"></i>{{ $category->name }}
                    </a>
                </div>

                {{-- Nom de la sous-catégorie --}}
                <h1 class="display-4 fw-bold mb-3">
                    {{ $sousCategory->name }}
                </h1>
                
                {{-- Description --}}
                @if($sousCategory->description)
                    <p class="lead mb-4">{{ $sousCategory->description }}</p>
                @endif
                
                {{-- Stats --}}
                <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
                    <span class="badge bg-light bg-opacity-25 text-white fs-6 px-4 py-2">
                        <i class="fas fa-file-alt me-2"></i>{{ $fiches->total() }} fiche{{ $fiches->total() > 1 ? 's' : '' }}
                    </span>
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
                <li class="breadcrumb-item">
                    <a href="{{ route('public.fiches.category', $category) }}" class="text-white text-decoration-none">
                        {{ $category->name }}
                    </a>
                </li>
                <li class="breadcrumb-item active text-white" aria-current="page">
                    {{ $sousCategory->name }}
                </li>
            </ol>
        </nav>
    </div>
</section>

{{-- Informations catégorie parente --}}
<section class="py-3 bg-white border-bottom">
    <div class="container-lg">
        <div class="alert alert-info border-0 mb-0 d-flex align-items-center" 
             style="background: linear-gradient(to right, rgba(14, 165, 233, 0.1), transparent);">
            <i class="fas fa-info-circle fs-4 me-3"></i>
            <div>
                <strong>Catégorie parente :</strong> 
                <a href="{{ route('public.fiches.category', $category) }}" class="text-decoration-none">
                    {{ $category->name }}
                </a>
                @if($category->description)
                    <span class="d-none d-md-inline text-muted ms-2">- {{ Str::limit($category->description, 80) }}</span>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- Liste des fiches --}}
<section class="py-5 bg-light">
    <div class="container-lg">
        {{-- En-tête de section --}}
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="h4 mb-0">
                    <i class="fas fa-list text-primary me-2"></i>
                    Fiches de cette sous-catégorie
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
                                <div class="card-img-top bg-gradient-info d-flex align-items-center justify-content-center" 
                                     style="height: 220px;">
                                    <i class="fas fa-file-alt fa-4x text-white opacity-50"></i>
                                </div>
                            @endif
                            
                            {{-- Corps de la carte --}}
                            <div class="card-body d-flex flex-column">
                                {{-- Badges --}}
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge bg-info">
                                        <i class="fas fa-layer-group me-1"></i>{{ $sousCategory->name }}
                                    </span>
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
                    <h5 class="text-muted mb-3">Aucune fiche disponible dans cette sous-catégorie</h5>
                    <p class="text-muted mb-4">Les fiches seront bientôt disponibles.</p>
                    <a href="{{ route('public.fiches.category', $category) }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-2"></i>Retour à {{ $category->name }}
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

{{-- Navigation rapide et images --}}
<section class="py-4 bg-white border-top">
    <div class="container-lg">
        <div class="row align-items-center">
            {{-- Boutons de navigation --}}
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="d-flex flex-wrap justify-content-center justify-content-lg-start gap-3">
                    <a href="{{ route('public.fiches.category', $category) }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-2"></i>{{ Str::limit($category->name, 20) }}
                    </a>
                    <a href="{{ route('public.fiches.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-th me-2"></i>Toutes les catégories
                    </a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                    @endauth
                </div>
            </div>

            {{-- Image de la sous-catégorie ou catégorie --}}
            <div class="col-lg-6 text-center">
                @if($sousCategory->image)
                    <img src="{{ $sousCategory->image }}" 
                         alt="{{ $sousCategory->name }}" 
                         class="img-fluid rounded shadow"
                         style="max-height: 300px; object-fit: contain;">
                @elseif($category->image)
                    <img src="{{ $category->image }}" 
                         alt="{{ $category->name }}" 
                         class="img-fluid rounded shadow"
                         style="max-height: 300px; object-fit: contain; opacity: 0.7;">
                @endif
            </div>
        </div>
    </div>
</section>

{{-- Section aide contextuelle --}}
<section class="py-4 nataswim-titre5">
    <div class="container-lg">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <div class="d-flex align-items-center justify-content-center gap-3 mb-3">
                    <i class="fas fa-lightbulb fs-3 text-white"></i>
                    <h3 class="h5 mb-0 text-white">Besoin de plus d'informations ?</h3>
                </div>
                <p class="text-white mb-4">
                    Explorez d'autres fiches de la catégorie <strong>{{ $category->name }}</strong> 
                    pour approfondir vos connaissances.
                </p>
                <a href="{{ route('public.fiches.category', $category) }}" 
                   class="btn btn-light">
                    <i class="fas fa-search me-2"></i>Explorer {{ $category->name }}
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
/* ========================================
   FICHES SOUS-CATÉGORIE - STYLES
   ======================================== */

/* Effet hover sur les cards */
.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important;
}

/* Gradient info pour images placeholder */
.bg-gradient-info {
    background: linear-gradient(135deg, #06b6d4 0%, #0ea5e9 100%);
}

/* Breadcrumb personnalisé */
.breadcrumb-item + .breadcrumb-item::before {
    content: "›";
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.7);
}

/* Alert info avec dégradé */
.alert-info {
    border-left: 4px solid #06b6d4;
}

/* Badge catégorie parente hover */
.badge.text-decoration-none:hover {
    background-color: rgba(255, 255, 255, 0.4) !important;
    transform: scale(1.05);
    transition: all 0.2s ease;
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
    
    .display-4 {
        font-size: 2rem !important;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation d'apparition des cards au scroll
    const cards = document.querySelectorAll('.hover-lift');
    
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

    // Effet smooth scroll pour les ancres
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>
@endpush
