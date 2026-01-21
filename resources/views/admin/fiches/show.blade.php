@extends('layouts.app')

@section('title', $fiche->title)

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
            <i class="fas fa-eye text-primary me-2"></i>
            Détails de la fiche
        </h2>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.fiches.edit', $fiche) }}" class="btn btn-primary">
                <i class="fas fa-edit me-2"></i>Modifier
            </a>
            <a href="{{ route('admin.fiches.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Retour
            </a>
        </div>
    </div>
@endsection

@section('content')
<div class="py-4">
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-lg-8">
                
                {{-- =============================================
                     NOUVEAU : AFFICHAGE DE L'IMAGE
                     ============================================= --}}
                <div class="card border-0 shadow-sm mb-4 overflow-hidden">
                    @if($fiche->media)
                        <div class="position-relative">
                            <img src="{{ $fiche->media->url }}" alt="{{ $fiche->title }}" 
                                 class="w-100 object-fit-cover" style="max-height: 400px;">
                            @if($fiche->is_featured)
                                <span class="position-absolute top-0 end-0 m-3 badge bg-warning text-dark p-2">
                                    <i class="fas fa-star me-1"></i> Mise en avant
                                </span>
                            @endif
                        </div>
                    @elseif($fiche->image)
                        <img src="{{ asset('storage/' . $fiche->image) }}" alt="{{ $fiche->title }}" 
                             class="w-100 object-fit-cover" style="max-height: 400px;">
                    @else
                        <div class="bg-light d-flex flex-column align-items-center justify-content-center p-5 text-muted">
                            <i class="fas fa-image fa-4x mb-3 opacity-25"></i>
                            <p class="mb-0">Aucune image associée à cette fiche</p>
                        </div>
                    @endif
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start justify-content-between mb-3">
                            <div class="flex-grow-1">
                                <h3 class="mb-3">{{ $fiche->title }}</h3>
                                <div class="d-flex flex-wrap gap-2">
                                    @if($fiche->is_published)
                                        <span class="badge bg-success-subtle text-success px-3 py-2">
                                            <i class="fas fa-check-circle me-1"></i> Publié
                                        </span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary px-3 py-2">
                                            <i class="fas fa-clock me-1"></i> Brouillon
                                        </span>
                                    @endif

                                    <span class="badge bg-info-subtle text-info px-3 py-2">
                                        <i class="fas fa-eye me-1"></i> {{ ucfirst($fiche->visibility) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <hr class="my-4 opacity-10">

                        <div class="mb-4">
                            <h6 class="fw-bold text-uppercase small text-muted mb-3">Description courte</h6>
                            <div class="p-3 bg-light rounded italic">
                                {{ $fiche->short_description ?: 'Pas de description courte.' }}
                            </div>
                        </div>

                        <div>
                            <h6 class="fw-bold text-uppercase small text-muted mb-3">Description longue</h6>
                            <div class="prose max-w-none">
                                {!! $fiche->long_description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom p-3">
                        <h6 class="mb-0 fw-bold">Classification</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="mb-3">
                            <label class="small text-muted d-block">Catégorie</label>
                            <span class="fw-medium">{{ $fiche->category->name ?? 'Non classé' }}</span>
                        </div>
                        <div class="mb-0">
                            <label class="small text-muted d-block">Sous-catégorie</label>
                            <span class="fw-medium">{{ $fiche->sousCategory->name ?? 'Aucune' }}</span>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom p-3">
                        <h6 class="mb-0 fw-bold">Informations système</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Vues :</span>
                            <span class="badge bg-light text-dark">{{ $fiche->views_count }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Créé par :</span>
                            <span class="small">{{ $fiche->creator->name ?? 'Système' }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Créé le :</span>
                            <span class="small">{{ $fiche->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted small">Mis à jour :</span>
                            <span class="small">{{ $fiche->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.fiches.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                    </a>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.fiches.edit', $fiche) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i>Modifier cette fiche
                        </a>
                        <form action="{{ route('admin.fiches.destroy', $fiche) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash me-2"></i>Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection