@extends('layouts.app')

@section('title', $fichesSousCategory->name)

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
            <i class="fas fa-folder-open text-primary me-2"></i>
            {{ $fichesSousCategory->name }}
        </h2>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.fiches-sous-categories.edit', $fichesSousCategory) }}" class="btn btn-primary">
                <i class="fas fa-edit me-2"></i>Modifier
            </a>
            <a href="{{ route('admin.fiches-sous-categories.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Retour
            </a>
        </div>
    </div>
@endsection

@section('content')
<div class="py-4">
    <div class="container-fluid">
        <div class="row g-4">
            <!-- Colonne principale -->
            <div class="col-lg-8">
                <!-- Informations principales -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom p-4">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle text-primary me-2"></i>
                            Informations
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <!-- Image -->
                        @if($fichesSousCategory->image)
                            <div class="mb-4">
                                <img src="{{ $fichesSousCategory->image }}" 
                                     alt="{{ $fichesSousCategory->name }}" 
                                     class="img-fluid rounded shadow-sm"
                                     style="max-height: 300px;">
                            </div>
                        @endif

                        <div class="row g-3">
                            <div class="col-12">
                                <strong>Nom :</strong>
                                <div class="mt-1">{{ $fichesSousCategory->name }}</div>
                            </div>

                            <div class="col-12">
                                <strong>Catégorie parente :</strong>
                                <div class="mt-1">
                                    @if($fichesSousCategory->category)
                                        <a href="{{ route('admin.fiches-categories.show', $fichesSousCategory->category) }}" 
                                           class="badge bg-primary text-decoration-none">
                                            {{ $fichesSousCategory->category->name }}
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12">
                                <strong>Slug :</strong>
                                <div class="mt-1"><code>{{ $fichesSousCategory->slug }}</code></div>
                            </div>

                            @if($fichesSousCategory->description)
                                <div class="col-12">
                                    <strong>Description :</strong>
                                    <div class="mt-1 text-muted">{{ $fichesSousCategory->description }}</div>
                                </div>
                            @endif

                            <div class="col-md-6">
                                <strong>Ordre d'affichage :</strong>
                                <div class="mt-1">
                                    <span class="badge bg-secondary-subtle text-secondary">
                                        {{ $fichesSousCategory->sort_order }}
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <strong>Statut :</strong>
                                <div class="mt-1">
                                    @if($fichesSousCategory->is_active)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i>Active
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-times-circle me-1"></i>Inactive
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEO -->
                @if($fichesSousCategory->meta_title || $fichesSousCategory->meta_description || $fichesSousCategory->meta_keywords)
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-bottom p-4">
                            <h5 class="mb-0">
                                <i class="fas fa-search text-success me-2"></i>
                                Informations SEO
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            @if($fichesSousCategory->meta_title)
                                <div class="mb-3">
                                    <strong>Titre SEO :</strong>
                                    <div class="text-muted">{{ $fichesSousCategory->meta_title }}</div>
                                </div>
                            @endif

                            @if($fichesSousCategory->meta_description)
                                <div class="mb-3">
                                    <strong>Description SEO :</strong>
                                    <div class="text-muted">{{ $fichesSousCategory->meta_description }}</div>
                                </div>
                            @endif

                            @if($fichesSousCategory->meta_keywords)
                                <div class="mb-0">
                                    <strong>Mots-clés :</strong>
                                    <div>
                                        @foreach(explode(',', $fichesSousCategory->meta_keywords) as $keyword)
                                            <span class="badge bg-secondary-subtle text-secondary me-1">
                                                {{ trim($keyword) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Statistiques -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom p-4">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-bar text-info me-2"></i>
                            Statistiques
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center">
                            <div class="bg-info bg-opacity-10 rounded p-4 mb-3">
                                <i class="fas fa-file-alt text-info fa-3x"></i>
                            </div>
                            <div class="fw-bold fs-3">{{ $fichesSousCategory->fiches_count }}</div>
                            <small class="text-muted">Fiche(s) dans cette sous-catégorie</small>
                        </div>

                        @if($fichesSousCategory->fiches_count > 0)
                            <div class="mt-4">
                                <a href="{{ route('admin.fiches.index', ['sous_category' => $fichesSousCategory->id]) }}" 
                                   class="btn btn-outline-primary w-100">
                                    <i class="fas fa-eye me-2"></i>Voir les fiches
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Métadonnées -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom p-4">
                        <h5 class="mb-0">
                            <i class="fas fa-database text-secondary me-2"></i>
                            Métadonnées
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="small">
                            @if($fichesSousCategory->creator)
                                <div class="mb-2">
                                    <strong>Créé par :</strong>
                                    <div class="text-muted">{{ $fichesSousCategory->creator->name }}</div>
                                </div>
                            @endif

                            <div class="mb-2">
                                <strong>Créé le :</strong>
                                <div class="text-muted">{{ $fichesSousCategory->created_at->format('d/m/Y à H:i') }}</div>
                            </div>

                            @if($fichesSousCategory->updated_at != $fichesSousCategory->created_at)
                                <div class="mb-0">
                                    <strong>Modifié le :</strong>
                                    <div class="text-muted">{{ $fichesSousCategory->updated_at->format('d/m/Y à H:i') }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('admin.fiches-sous-categories.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                        </a>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.fiches-sous-categories.edit', $fichesSousCategory) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i>Modifier
                        </a>
                        @if($fichesSousCategory->fiches_count === 0)
                            <form action="{{ route('admin.fiches-sous-categories.destroy', $fichesSousCategory) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette sous-catégorie ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash me-2"></i>Supprimer
                                </button>
                            </form>
                        @else
                            <button type="button" class="btn btn-danger" disabled title="Impossible de supprimer une sous-catégorie contenant des fiches">
                                <i class="fas fa-trash me-2"></i>Supprimer
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection