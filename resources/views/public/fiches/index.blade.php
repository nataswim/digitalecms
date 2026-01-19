@extends('layouts.app')

@section('title', 'Toutes les Fiches')

@section('content')
{{-- Hero Section --}}
<section class="bg-gradient text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-3">
                    <i class="fas fa-file-alt me-3"></i>
                    Bibliothèque de Fiches
                </h1>
                <p class="lead mb-0">
                    Découvrez nos ressources documentaires pour votre organisation sportive
                </p>
            </div>
        </div>
    </div>
</section>

{{-- Filtres et Recherche --}}
<section class="py-4 bg-light border-bottom">
    <div class="container">
        <form method="GET" action="{{ route('public.fiches.index') }}" class="row g-3">
            {{-- Barre de recherche --}}
            <div class="col-lg-5">
                <div class="input-group input-group-lg">
                    <span class="input-group-text bg-white">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" 
                           name="search" 
                           class="form-control" 
                           placeholder="Rechercher une fiche..."
                           value="{{ $search }}">
                </div>
            </div>

            {{-- Filtre Catégorie --}}
            <div class="col-lg-3">
                <select name="category" class="form-select form-select-lg">
                    <option value="">Toutes les catégories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->slug }}" {{ $categorySlug == $cat->slug ? 'selected' : '' }}>
                            {{ $cat->name }} ({{ $cat->fiches_count }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Filtre Sous-Catégorie --}}
            <div class="col-lg-3">
                <select name="sous_category" class="form-select form-select-lg">
                    <option value="">Toutes les sous-catégories</option>
                    @foreach($sousCategories as $sousCat)
                        <option value="{{ $sousCat->slug }}" {{ $sousCategorySlug == $sousCat->slug ? 'selected' : '' }}>
                            {{ $sousCat->name }} ({{ $sousCat->fiches_count }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Bouton Rechercher --}}
            <div class="col-lg-1">
                <button type="submit" class="btn btn-primary btn-lg w-100">
                    <i class="fas fa-filter"></i>
                </button>
            </div>
        </form>

        {{-- Affichage des filtres actifs --}}
        @if($search || $categorySlug || $sousCategorySlug)
            <div class="mt-3">
                <span class="text-muted me-2">Filtres actifs :</span>
                @if($search)
                    <span class="badge bg-primary me-2">
                        Recherche : {{ $search }}
                        <a href="{{ route('public.fiches.index', array_filter(['category' => $categorySlug, 'sous_category' => $sousCategorySlug])) }}" 
                           class="text-white ms-1">
                            <i class="fas fa-times"></i>
                        </a>
                    </span>
                @endif
                @if($categorySlug)
                    <span class="badge bg-info me-2">
                        Catégorie : {{ $categories->firstWhere('slug', $categorySlug)->name ?? $categorySlug }}
                        <a href="{{ route('public.fiches.index', array_filter(['search' => $search, 'sous_category' => $sousCategorySlug])) }}" 
                           class="text-white ms-1">
                            <i class="fas fa-times"></i>
                        </a>
                    </span>
                @endif
                @if($sousCategorySlug)
                    <span class="badge bg-success me-2">
                        Sous-catégorie : {{ $sousCategories->firstWhere('slug', $sousCategorySlug)->name ?? $sousCategorySlug }}
                        <a href="{{ route('public.fiches.index', array_filter(['search' => $search, 'category' => $categorySlug])) }}" 
                           class="text-white ms-1">
                            <i class="fas fa-times"></i>
                        </a>
                    </span>
                @endif
                <a href="{{ route('public.fiches.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-redo me-1"></i>Réinitialiser
                </a>
            </div>
        @endif
    </div>
</section>

{{-- Résultats --}}
<section class="py-5">
    <div class="container">
        {{-- Compteur de résultats --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">
                <span class="text-muted">{{ $fiches->total() }}</span> fiche(s) trouvée(s)
            </h5>
            <div class="text-muted small">
                Page {{ $fiches->currentPage() }} sur {{ $fiches->lastPage() }}
            </div>
        </div>

        @if($fiches->count() > 0)
            {{-- Grille de fiches --}}
            <div class="row g-4 mb-4">
                @foreach($fiches as $fiche)
                    <div class="col-lg-4 col-md-6">
                        <div class="card border-0 shadow-sm h-100 hover-card">
                            {{-- Image à la une --}}
                            @if($fiche->featured_image)
                                <div class="card-img-top overflow-hidden" style="height: 200px;">
                                    <img src="{{ $fiche->featured_image }}" 
                                         alt="{{ $fiche->title }}"
                                         class="w-100 h-100 object-fit-cover">
                                </div>
                            @else
                                <div class="card-img-top bg-gradient d-flex align-items-center justify-content-center" 
                                     style="height: 200px;">
                                    <i class="fas fa-file-alt fa-3x text-white opacity-50"></i>
                                </div>
                            @endif

                            <div class="card-body p-4">
                                {{-- Catégories --}}
                                <div class="mb-2">
                                    @if($fiche->category)
                                        <span class="badge bg-primary-subtle text-primary">
                                            <i class="fas fa-folder me-1"></i>
                                            {{ $fiche->category->name }}
                                        </span>
                                    @endif
                                    @if($fiche->sousCategory)
                                        <span class="badge bg-success-subtle text-success">
                                            {{ $fiche->sousCategory->name }}
                                        </span>
                                    @endif
                                </div>

                                {{-- Titre --}}
                                <h5 class="card-title mb-3">
                                    <a href="{{ route('public.fiches.show', [$fiche->category->slug ?? 'general', $fiche->slug]) }}" 
                                       class="text-decoration-none text-dark hover-primary stretched-link">
                                        {{ $fiche->title }}
                                    </a>
                                </h5>

                                {{-- Extrait --}}
                                @if($fiche->excerpt)
                                    <p class="card-text text-muted small mb-3">
                                        {{ Str::limit($fiche->excerpt, 120) }}
                                    </p>
                                @endif

                                {{-- Meta --}}
                                <div class="d-flex justify-content-between align-items-center text-muted small">
                                    <span>
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        {{ $fiche->created_at->format('d/m/Y') }}
                                    </span>
                                    <span>
                                        <i class="fas fa-eye me-1"></i>
                                        Lire
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {{ $fiches->appends(request()->query())->links() }}
            </div>
        @else
            {{-- Aucun résultat --}}
            <div class="text-center py-5">
                <i class="fas fa-search fa-4x text-muted mb-4"></i>
                <h5 class="text-muted mb-3">Aucune fiche trouvée</h5>
                <p class="text-muted">Essayez de modifier vos critères de recherche</p>
                <a href="{{ route('public.fiches.index') }}" class="btn btn-primary">
                    <i class="fas fa-redo me-2"></i>Voir toutes les fiches
                </a>
            </div>
        @endif
    </div>
</section>

{{-- Catégories en bas de page --}}
@if($categories->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <h4 class="mb-4 text-center">
            <i class="fas fa-folder-open text-primary me-2"></i>
            Explorer par Catégorie
        </h4>
        <div class="row g-3">
            @foreach($categories as $category)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="{{ route('public.fiches.category', $category->slug) }}" 
                       class="d-block p-3 bg-white border rounded hover-shadow text-decoration-none h-100">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-folder fa-2x text-primary"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0 text-dark">{{ $category->name }}</h6>
                                <small class="text-muted">
                                    {{ $category->fiches_count }} fiche(s)
                                </small>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection

@push('styles')
<style>
.bg-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.hover-card {
    transition: all 0.3s ease;
}

.hover-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
}

.hover-primary:hover {
    color: var(--bs-primary) !important;
}

.hover-shadow:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    border-color: var(--bs-primary) !important;
}

.object-fit-cover {
    object-fit: cover;
}

.stretched-link::after {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1;
    content: "";
}
</style>
@endpush