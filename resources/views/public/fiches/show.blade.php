@extends('layouts.public')

{{-- SEO Meta --}}
@section('title', $fiche->meta_title ?? $fiche->title)
@section('meta_description', $fiche->meta_description ?? strip_tags($fiche->short_description))

@if($fiche->meta_keywords)
    @section('meta_keywords', $fiche->meta_keywords)
@endif

{{-- Open Graph / Facebook --}}
@section('og_type', 'article')
@section('og_title', $fiche->meta_title ?? $fiche->title)
@section('og_description', $fiche->meta_description ?? strip_tags($fiche->short_description))
@section('og_url', $fiche->meta_og_url ?? route('public.fiches.show', [$category, $fiche]))

@if($fiche->meta_og_image ?? $fiche->image)
    @section('og_image', $fiche->meta_og_image ?? $fiche->image)
    @section('og_image_alt', $fiche->title)
@endif

{{-- Twitter Card --}}
@section('twitter_card', 'summary_large_image')
@section('twitter_title', $fiche->meta_title ?? $fiche->title)
@section('twitter_description', $fiche->meta_description ?? strip_tags($fiche->short_description))

@if($fiche->meta_og_image ?? $fiche->image)
    @section('twitter_image', $fiche->meta_og_image ?? $fiche->image)
@endif

@section('content')

{{-- Hero Section avec titre de la fiche --}}
<section class="py-5 text-white text-center nataswim-titre3">
    <div class="container-lg">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-10">
                {{-- Badges informatifs --}}
                <div class="d-flex flex-wrap justify-content-center gap-2 mb-3">
                    <a href="{{ route('public.fiches.category', $category) }}" 
                       class="badge bg-light bg-opacity-25 text-white text-decoration-none px-3 py-2">
                        <i class="fas fa-folder me-1"></i>{{ $category->name }}
                    </a>
                    
                    @if($fiche->sousCategory)
                        <a href="{{ route('public.fiches.sous-category', [$category, $fiche->sousCategory]) }}" 
                           class="badge bg-light bg-opacity-25 text-white text-decoration-none px-3 py-2">
                            <i class="fas fa-layer-group me-1"></i>{{ $fiche->sousCategory->name }}
                        </a>
                    @endif
                    
                    @if($fiche->is_featured)
                        <span class="badge bg-warning text-dark px-3 py-2">
                            <i class="fas fa-star me-1"></i>En vedette
                        </span>
                    @endif
                    
                    @if($fiche->visibility === 'authenticated')
                        <span class="badge bg-info px-3 py-2">
                            <i class="fas fa-lock me-1"></i>Membres
                        </span>
                    @endif
                </div>

                {{-- Titre de la fiche --}}
                <h1 class="display-5 fw-bold mb-4">{{ $fiche->title }}</h1>

                {{-- Métadonnées rapides --}}
                <div class="d-flex flex-wrap justify-content-center gap-4 text-white-50">
                    <span>
                        <i class="fas fa-calendar me-1"></i>
                        {{ $fiche->published_at?->format('d M Y') ?? $fiche->created_at->format('d M Y') }}
                    </span>
                    <span>
                        <i class="fas fa-eye me-1"></i>
                        {{ number_format($fiche->views_count) }} lecture{{ $fiche->views_count > 1 ? 's' : '' }}
                    </span>
                    @if($fiche->creator)
                        <span>
                            <i class="fas fa-user me-1"></i>
                            Par {{ $fiche->creator->name }}
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
                <li class="breadcrumb-item">
                    <a href="{{ route('public.fiches.category', $category) }}" class="text-white text-decoration-none">
                        {{ $category->name }}
                    </a>
                </li>
                @if($fiche->sousCategory)
                    <li class="breadcrumb-item">
                        <a href="{{ route('public.fiches.sous-category', [$category, $fiche->sousCategory]) }}" 
                           class="text-white text-decoration-none">
                            {{ $fiche->sousCategory->name }}
                        </a>
                    </li>
                @endif
                <li class="breadcrumb-item active text-white" aria-current="page">
                    {{ Str::limit($fiche->title, 50) }}
                </li>
            </ol>
        </nav>
    </div>
</section>

{{-- Contenu principal --}}
<article class="py-5 bg-light">
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                
                {{-- Image principale --}}
                @if($fiche->image)
                    <div class="card border-0 shadow-sm mb-4">
                        <img src="{{ $fiche->image }}" 
                             alt="{{ $fiche->title }}" 
                             class="card-img-top rounded"
                             style="max-height: 500px; object-fit: cover;">
                    </div>
                @endif

                {{-- Description courte (toujours visible) --}}
                @if($fiche->short_description)
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <div class="alert alert-info border-0 mb-0" 
                                 style="background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);">
                                <div class="content-display">
                                    {!! $fiche->short_description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Description longue (selon visibilité) --}}
                @if($fiche->long_description)
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            @if($fiche->canViewContent(auth()->user()))
                                {{-- Utilisateur autorisé : affichage complet --}}
                                <div class="content-display-full fs-6 lh-lg">
                                    {!! $fiche->long_description !!}
                                </div>
                            @else
                                {{-- Utilisateur non autorisé : Message d'accès restreint --}}
                                <div class="content-restricted">
                                    <div class="alert alert-warning border-0">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <i class="fas fa-lock text-warning fa-3x"></i>
                                            </div>
                                            <div class="col">
                                                <h5 class="alert-heading mb-2">
                                                    <i class="fas fa-crown me-1"></i>
                                                    Contenu Réservé aux Membres
                                                </h5>
                                                <p class="mb-3">
                                                    {{ $fiche->getAccessMessage(auth()->user()) }}
                                                </p>
                                                @if(!auth()->check())
                                                    {{-- Utilisateur non connecté --}}
                                                    <div class="d-flex flex-wrap gap-2">
                                                        <a href="{{ route('register') }}" class="btn btn-warning">
                                                            <i class="fas fa-user-plus me-2"></i>Créer un compte
                                                        </a>
                                                        <a href="{{ route('login') }}" class="btn btn-outline-warning">
                                                            <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                                                        </a>
                                                    </div>
                                                @else
                                                    {{-- Utilisateur connecté mais pas premium --}}
                                                    <a href="{{ route('dashboard') }}" class="btn btn-warning">
                                                        <i class="fas fa-crown me-2"></i>Passer Premium
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- Informations de la fiche --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i>Informations
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded">
                                    <span class="text-muted">
                                        <i class="fas fa-folder me-2"></i>Catégorie
                                    </span>
                                    <strong>{{ $category->name }}</strong>
                                </div>
                            </div>

                            @if($fiche->sousCategory)
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded">
                                        <span class="text-muted">
                                            <i class="fas fa-layer-group me-2"></i>Sous-catégorie
                                        </span>
                                        <strong>{{ $fiche->sousCategory->name }}</strong>
                                    </div>
                                </div>
                            @endif

                            <div class="col-md-6">
                                <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded">
                                    <span class="text-muted">
                                        <i class="fas fa-calendar me-2"></i>Date de publication
                                    </span>
                                    <strong>{{ $fiche->published_at?->format('d/m/Y') ?? $fiche->created_at->format('d/m/Y') }}</strong>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded">
                                    <span class="text-muted">
                                        <i class="fas fa-eye me-2"></i>Nombre de lectures
                                    </span>
                                    <strong>{{ number_format($fiche->views_count) }}</strong>
                                </div>
                            </div>

                            @if($fiche->creator)
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded">
                                        <span class="text-muted">
                                            <i class="fas fa-user me-2"></i>Auteur
                                        </span>
                                        <strong>{{ $fiche->creator->name }}</strong>
                                    </div>
                                </div>
                            @endif

                            <div class="col-md-6">
                                <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded">
                                    <span class="text-muted">
                                        <i class="fas fa-sync-alt me-2"></i>Dernière mise à jour
                                    </span>
                                    <strong>{{ $fiche->updated_at->format('d/m/Y') }}</strong>
                                </div>
                            </div>

                            @if($fiche->visibility === 'authenticated')
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between align-items-center p-2 bg-info bg-opacity-10 rounded">
                                        <span class="text-info">
                                            <i class="fas fa-lock me-2"></i>Visibilité
                                        </span>
                                        <strong class="text-info">Membres uniquement</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Fiches associées --}}
                @if($relatedFiches->count() > 0)
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-th-list me-2"></i>Fiches Associées
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-4">
                                @foreach($relatedFiches as $related)
                                    <div class="col-md-4">
                                        <div class="card h-100 border hover-lift-sm">
                                            {{-- Image --}}
                                            @if($related->image)
                                                <img src="{{ $related->image }}" 
                                                     class="card-img-top" 
                                                     style="height: 180px; object-fit: cover;"
                                                     alt="{{ $related->title }}">
                                            @else
                                                <div class="card-img-top bg-gradient-secondary d-flex align-items-center justify-content-center" 
                                                     style="height: 180px;">
                                                    <i class="fas fa-file-alt fa-2x text-white opacity-50"></i>
                                                </div>
                                            @endif
                                            
                                            {{-- Contenu --}}
                                            <div class="card-body p-3">
                                                <h6 class="card-title mb-2">{{ Str::limit($related->title, 60) }}</h6>
                                                <small class="text-muted">
                                                    <i class="fas fa-eye me-1"></i>{{ number_format($related->views_count) }}
                                                </small>
                                                <a href="{{ route('public.fiches.show', [$category, $related]) }}" 
                                                   class="stretched-link"></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Navigation --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                            {{-- Bouton retour catégorie --}}
                            <a href="{{ route('public.fiches.category', $category) }}" 
                               class="btn btn-primary">
                                <i class="fas fa-arrow-left me-2"></i>Retour à {{ Str::limit($category->name, 30) }}
                            </a>

                            {{-- Boutons secondaires --}}
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('public.fiches.index') }}" 
                                   class="btn btn-outline-secondary">
                                    <i class="fas fa-th me-2"></i>Toutes les catégories
                                </a>
                                @auth
                                    <a href="{{ route('dashboard') }}" 
                                       class="btn btn-outline-secondary">
                                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</article>

{{-- Section partage social (optionnel) --}}
<section class="py-4 bg-white border-top">
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h5 class="mb-3">
                    <i class="fas fa-share-alt me-2 text-primary"></i>Partager cette fiche
                </h5>
                <div class="d-flex flex-wrap justify-content-center gap-2">
                    {{-- Facebook --}}
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('public.fiches.show', [$category, $fiche])) }}" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="btn btn-outline-primary btn-sm">
                        <i class="fab fa-facebook-f me-1"></i>Facebook
                    </a>
                    
                    {{-- Twitter --}}
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('public.fiches.show', [$category, $fiche])) }}&text={{ urlencode($fiche->title) }}" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="btn btn-outline-info btn-sm">
                        <i class="fab fa-twitter me-1"></i>Twitter
                    </a>
                    
                    {{-- LinkedIn --}}
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('public.fiches.show', [$category, $fiche])) }}" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="btn btn-outline-primary btn-sm">
                        <i class="fab fa-linkedin-in me-1"></i>LinkedIn
                    </a>
                    
                    {{-- Email --}}
                    <a href="mailto:?subject={{ urlencode($fiche->title) }}&body={{ urlencode('Découvrez cette fiche : ' . route('public.fiches.show', [$category, $fiche])) }}" 
                       class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-envelope me-1"></i>Email
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
/* ========================================
   CONTENU FICHE - STYLES
   ======================================== */

/* Styles pour le contenu HTML (description courte et longue) */
.content-display,
.content-display-full {
    line-height: 1.8;
}

.content-display h1,
.content-display h2,
.content-display h3,
.content-display-full h1,
.content-display-full h2,
.content-display-full h3 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    font-weight: 600;
    line-height: 1.3;
}

.content-display h1, .content-display-full h1 { 
    font-size: 1.8rem;
    color: #0d7f8a; 
}

.content-display h2, .content-display-full h2 { 
    font-size: 1.5rem;
    color: #0a7db1; 
}

.content-display h3, .content-display-full h3 { 
    font-size: 1.3rem;
    color: #0173b4; 
}

.content-display p,
.content-display-full p {
    margin-bottom: 1.5rem;
    text-align: justify;
    color: #4a5568;
}

.content-display ul,
.content-display ol,
.content-display-full ul,
.content-display-full ol {
    margin-bottom: 1.5rem;
    padding-left: 2rem;
}

.content-display li,
.content-display-full li {
    margin-bottom: 0.5rem;
}

.content-display blockquote,
.content-display-full blockquote {
    border-left: 4px solid #00acc0;
    padding: 1.5rem;
    margin: 2rem 0;
    font-style: italic;
    background: #f7fafc;
    border-radius: 0.375rem;
}

.content-display img,
.content-display-full img {
    max-width: 100%;
    height: auto;
    margin: 2rem auto;
    display: block;
    border-radius: 0.5rem;
}

.content-display pre,
.content-display-full pre {
    background: #1a202c;
    color: #e2e8f0;
    padding: 1.5rem;
    border-radius: 0.5rem;
    overflow-x: auto;
    margin: 2rem 0;
}

.content-display code,
.content-display-full code {
    background-color: #edf2f7;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.875em;
    color: #d63384;
}

.content-display table,
.content-display-full table {
    width: 100%;
    border-collapse: collapse;
    margin: 2rem 0;
    border: 1px solid #e2e8f0;
}

.content-display th,
.content-display td,
.content-display-full th,
.content-display-full td {
    padding: 0.75rem;
    border: 1px solid #e2e8f0;
}

.content-display th,
.content-display-full th {
    background-color: #f7fafc;
    font-weight: 600;
}

/* Effet hover sur fiches associées */
.hover-lift-sm {
    transition: all 0.2s ease;
}

.hover-lift-sm:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.1) !important;
}

/* Gradient secondaire */
.bg-gradient-secondary {
    background: linear-gradient(135deg, #6c8fa0 0%, #0f5c78 100%);
}

/* Badges interactifs */
.badge.text-decoration-none:hover {
    background-color: rgba(255, 255, 255, 0.4) !important;
    transform: scale(1.05);
    transition: all 0.2s ease;
}

/* Breadcrumb */
.breadcrumb-item + .breadcrumb-item::before {
    content: "›";
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.7);
}

/* Boutons partage social */
.btn-sm {
    font-size: 0.875rem;
}

/* Responsive */
@media (max-width: 767px) {
    .display-5 {
        font-size: 1.75rem !important;
    }
    
    .content-display,
    .content-display-full {
        font-size: 0.95rem;
    }
}

/* Support pour vidéos embedded (YouTube, Vimeo) */
.content-display iframe,
.content-display-full iframe {
    max-width: 100%;
    margin: 2rem auto;
    display: block;
}

.content-display .ql-video,
.content-display-full .ql-video {
    width: 100%;
    max-width: 100%;
    height: 480px;
    display: block;
    margin: 2rem auto;
}

@media (max-width: 767px) {
    .content-display .ql-video,
    .content-display-full .ql-video {
        height: 300px;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation d'apparition des sections
    const sections = document.querySelectorAll('.card');
    
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
                }, index * 100);
            }
        });
    }, observerOptions);
    
    sections.forEach(section => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(20px)';
        section.style.transition = 'all 0.6s ease';
        observer.observe(section);
    });

    // Copier le lien de la page
    const copyLinkBtn = document.getElementById('copy-link-btn');
    if (copyLinkBtn) {
        copyLinkBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const url = window.location.href;
            
            if (navigator.clipboard) {
                navigator.clipboard.writeText(url).then(function() {
                    // Feedback visuel
                    const originalText = copyLinkBtn.innerHTML;
                    copyLinkBtn.innerHTML = '<i class="fas fa-check me-1"></i>Copié !';
                    copyLinkBtn.classList.remove('btn-outline-secondary');
                    copyLinkBtn.classList.add('btn-success');
                    
                    setTimeout(function() {
                        copyLinkBtn.innerHTML = originalText;
                        copyLinkBtn.classList.remove('btn-success');
                        copyLinkBtn.classList.add('btn-outline-secondary');
                    }, 2000);
                });
            }
        });
    }

    // Smooth scroll pour les liens d'ancre
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