{{-- Catégories de Médias - Index avec Actions Rapides --}}
@extends('layouts.app')

@section('title', 'Catégories de médias')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
            <i class="fas fa-folder text-primary me-2"></i>
            Catégories de médias
        </h2>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.media.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Retour aux médias
            </a>
            <button type="button" 
                    class="btn btn-primary" 
                    data-bs-toggle="modal" 
                    data-bs-target="#categoryModal">
                <i class="fas fa-plus me-2"></i>Nouvelle catégorie
            </button>
        </div>
    </div>
@endsection

@section('content')
<div class="py-4">
    <div class="container-fluid">
        {{-- ACTIONS RAPIDES --}}
        <div class="row g-3 mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body p-4 text-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 60px; height: 60px;">
                            <i class="fas fa-images fa-lg text-primary"></i>
                        </div>
                        <h6 class="fw-bold mb-2">Tous les médias</h6>
                        <p class="text-muted small mb-3">Voir tous les médias</p>
                        <a href="{{ route('admin.media.index') }}" class="btn btn-sm btn-outline-primary w-100">
                            <i class="fas fa-arrow-right me-1"></i>Accéder
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body p-4 text-center">
                        <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 60px; height: 60px;">
                            <i class="fas fa-cloud-upload-alt fa-lg text-success"></i>
                        </div>
                        <h6 class="fw-bold mb-2">Uploader un média</h6>
                        <p class="text-muted small mb-3">Ajouter de nouveaux médias</p>
                        <a href="{{ route('admin.media.create') }}" class="btn btn-sm btn-outline-success w-100">
                            <i class="fas fa-upload me-1"></i>Upload
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body p-4 text-center">
                        <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 60px; height: 60px;">
                            <i class="fas fa-folder fa-lg text-info"></i>
                        </div>
                        <h6 class="fw-bold mb-2">Catégories</h6>
                        <p class="text-muted small mb-3">Gérer les catégories</p>
                        <a href="{{ route('admin.media.categories') }}" class="btn btn-sm btn-outline-info w-100">
                            <i class="fas fa-arrow-right me-1"></i>Gérer
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body p-4 text-center">
                        <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 60px; height: 60px;">
                            <i class="fas fa-plus fa-lg text-warning"></i>
                        </div>
                        <h6 class="fw-bold mb-2">Nouvelle catégorie</h6>
                        <p class="text-muted small mb-3">Créer une catégorie</p>
                        <button type="button" 
                                class="btn btn-sm btn-outline-warning w-100" 
                                data-bs-toggle="modal" 
                                data-bs-target="#categoryModal">
                            <i class="fas fa-plus me-1"></i>Créer
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- LISTE DES CATÉGORIES --}}
        @if($categories->count() > 0)
            <div class="row g-4">
                @foreach($categories as $category)
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header d-flex justify-content-between align-items-center p-4" 
                                 style="background-color: {{ $category->color }}15; border-left: 4px solid {{ $category->color }}">
                                <div class="d-flex align-items-center">
                                    <div class="rounded me-3" 
                                         style="width: 32px; height: 32px; background-color: {{ $category->color }}"></div>
                                    <div>
                                        <h5 class="mb-0">{{ $category->name }}</h5>
                                        <small class="text-muted">{{ $category->media_count }} média(s)</small>
                                    </div>
                                </div>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.media.index', ['category' => $category->id]) }}" 
                                       class="btn btn-sm btn-outline-primary"
                                       title="Voir tous les médias">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($category->media_count === 0)
                                        <form method="POST" 
                                              action="{{ route('admin.media.categories.destroy', $category) }}"
                                              onsubmit="return confirm('Êtes-vous sûr ?')"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>

                            @if($category->description)
                                <div class="card-body py-2 border-bottom">
                                    <small class="text-muted">{{ $category->description }}</small>
                                </div>
                            @endif

                            <div class="card-body p-4">
                                @if($category->media_count > 0)
                                    <div class="row g-2">
                                        @foreach($category->media()->latest()->limit(6)->get() as $media)
                                            <div class="col-4">
                                                <a href="{{ route('admin.media.show', $media) }}" 
                                                   class="d-block position-relative media-thumb">
                                                    <img src="{{ $media->url }}" 
                                                         alt="{{ $media->name }}"
                                                         class="img-fluid rounded shadow-sm"
                                                         style="width: 100%; height: 100px; object-fit: cover;">
                                                    <div class="media-thumb-overlay position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-0 rounded d-flex align-items-center justify-content-center">
                                                        <i class="fas fa-search-plus text-white d-none"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if($category->media_count > 6)
                                        <div class="text-center mt-3">
                                            <a href="{{ route('admin.media.index', ['category' => $category->id]) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                Voir les {{ $category->media_count }} médias
                                                <i class="fas fa-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                    @endif
                                @else
                                    <div class="text-center py-4 text-muted">
                                        <i class="fas fa-images fa-2x mb-2 opacity-50"></i>
                                        <p class="mb-0">Aucun média dans cette catégorie</p>
                                    </div>
                                @endif
                            </div>

                            <div class="card-footer bg-light p-3">
                                <div class="row text-center small text-muted">
                                    <div class="col-4">
                                        <i class="fas fa-sort-amount-down me-1"></i>
                                        Ordre: {{ $category->order }}
                                    </div>
                                    <div class="col-4">
                                        <span class="badge bg-{{ $category->is_active ? 'success' : 'secondary' }}">
                                            {{ $category->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                    <div class="col-4">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $category->created_at->format('d/m/Y') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-folder fa-4x text-muted opacity-50"></i>
                </div>
                <h5 class="text-muted">Aucune catégorie créée</h5>
                <p class="text-muted mb-4">Créez votre première catégorie pour organiser vos médias.</p>
                <button type="button" 
                        class="btn btn-primary" 
                        data-bs-toggle="modal" 
                        data-bs-target="#categoryModal">
                    <i class="fas fa-plus me-2"></i>Créer une catégorie
                </button>
            </div>
        @endif
    </div>
</div>

{{-- Modal Catégorie --}}
@include('admin.media.modals.category')
@endsection

@push('styles')
<style>
.media-thumb:hover .media-thumb-overlay {
    background-color: rgba(0, 0, 0, 0.3) !important;
}

.media-thumb:hover .media-thumb-overlay i {
    display: block !important;
}

.hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
}
</style>
@endpush