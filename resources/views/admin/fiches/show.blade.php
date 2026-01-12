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
            <!-- Colonne principale -->
            <div class="col-lg-8">
                <!-- Titre et badges -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start justify-content-between mb-3">
                            <div class="flex-grow-1">
                                <h3 class="mb-3">
                                    @if($fiche->is_featured)
                                        <i class="fas fa-star text-warning me-2"></i>
                                    @endif
                                    {{ $fiche->title }}
                                </h3>
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    @if($fiche->is_published)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i>Publié
                                        </span>
                                    @else
                                        <span class="badge bg-warning">
                                            <i class="fas fa-edit me-1"></i>Brouillon
                                        </span>
                                    @endif

                                    @if($fiche->visibility === 'public')
                                        <span class="badge bg-info">
                                            <i class="fas fa-globe me-1"></i>Public
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-lock me-1"></i>Authentifié
                                        </span>
                                    @endif

                                    @if($fiche->is_featured)
                                        <span class="badge bg-danger">
                                            <i class="fas fa-star me-1"></i>En vedette
                                        </span>
                                    @endif

                                    @if($fiche->category)
                                        <span class="badge bg-primary">
                                            {{ $fiche->category->name }}
                                        </span>
                                    @endif

                                    @if($fiche->sousCategory)
                                        <span class="badge bg-primary-subtle text-primary">
                                            {{ $fiche->sousCategory->name }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Image -->
                        @if($fiche->image)
                            <div class="mb-4">
                                <img src="{{ $fiche->image }}" 
                                     alt="{{ $fiche->title }}" 
                                     class="img-fluid rounded shadow-sm"
                                     style="max-height: 400px; width: 100%; object-fit: cover;">
                            </div>
                        @endif

                        <!-- Description courte -->
                        <div class="mb-4">
                            <h5 class="fw-semibold mb-2">
                                <i class="fas fa-align-left text-primary me-2"></i>
                                Description courte
                            </h5>
                            <div class="text-muted">
                                {{ $fiche->short_description }}
                            </div>
                        </div>

                        <!-- Description longue -->
                        @if($fiche->long_description)
                            <div class="mb-4">
                                <h5 class="fw-semibold mb-2">
                                    <i class="fas fa-file-alt text-primary me-2"></i>
                                    Description détaillée
                                </h5>
                                <div class="border-start border-3 border-primary ps-3">
                                    {!! nl2br(e($fiche->long_description)) !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- SEO -->
                @if($fiche->meta_title || $fiche->meta_description || $fiche->meta_keywords)
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-bottom p-4">
                            <h5 class="mb-0">
                                <i class="fas fa-search text-success me-2"></i>
                                Informations SEO
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            @if($fiche->meta_title)
                                <div class="mb-3">
                                    <strong>Titre SEO :</strong>
                                    <div class="text-muted">{{ $fiche->meta_title }}</div>
                                </div>
                            @endif

                            @if($fiche->meta_description)
                                <div class="mb-3">
                                    <strong>Description SEO :</strong>
                                    <div class="text-muted">{{ $fiche->meta_description }}</div>
                                </div>
                            @endif

                            @if($fiche->meta_keywords)
                                <div class="mb-3">
                                    <strong>Mots-clés :</strong>
                                    <div>
                                        @foreach(explode(',', $fiche->meta_keywords) as $keyword)
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
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="text-center">
                                    <div class="bg-primary bg-opacity-10 rounded p-3 mb-2">
                                        <i class="fas fa-eye text-primary fa-2x"></i>
                                    </div>
                                    <div class="fw-bold fs-4">{{ $fiche->views_count }}</div>
                                    <small class="text-muted">Vues</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <div class="bg-success bg-opacity-10 rounded p-3 mb-2">
                                        <i class="fas fa-sort text-success fa-2x"></i>
                                    </div>
                                    <div class="fw-bold fs-4">{{ $fiche->sort_order }}</div>
                                    <small class="text-muted">Ordre</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Publication -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom p-4">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle text-warning me-2"></i>
                            Publication
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="small">
                            <div class="d-flex justify-content-between mb-2">
                                <strong>Statut :</strong>
                                @if($fiche->is_published)
                                    <span class="badge bg-success">Publié</span>
                                @else
                                    <span class="badge bg-warning">Brouillon</span>
                                @endif
                            </div>

                            @if($fiche->published_at)
                                <div class="d-flex justify-content-between mb-2">
                                    <strong>Publié le :</strong>
                                    <span class="text-muted">{{ $fiche->published_at->format('d/m/Y à H:i') }}</span>
                                </div>
                            @endif

                            <div class="d-flex justify-content-between mb-2">
                                <strong>Visibilité :</strong>
                                @if($fiche->visibility === 'public')
                                    <span class="badge bg-info">Public</span>
                                @else
                                    <span class="badge bg-secondary">Authentifié</span>
                                @endif
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <strong>En vedette :</strong>
                                @if($fiche->is_featured)
                                    <i class="fas fa-check-circle text-success"></i>
                                @else
                                    <i class="fas fa-times-circle text-muted"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Catégorisation -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom p-4">
                        <h5 class="mb-0">
                            <i class="fas fa-folder text-primary me-2"></i>
                            Catégorisation
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="small">
                            <div class="mb-3">
                                <strong>Catégorie :</strong>
                                @if($fiche->category)
                                    <div class="mt-1">
                                        <span class="badge bg-primary">{{ $fiche->category->name }}</span>
                                    </div>
                                @else
                                    <div class="text-muted mt-1">Aucune catégorie</div>
                                @endif
                            </div>

                            <div class="mb-0">
                                <strong>Sous-catégorie :</strong>
                                @if($fiche->sousCategory)
                                    <div class="mt-1">
                                        <span class="badge bg-primary-subtle text-primary">
                                            {{ $fiche->sousCategory->name }}
                                        </span>
                                    </div>
                                @else
                                    <div class="text-muted mt-1">Aucune sous-catégorie</div>
                                @endif
                            </div>
                        </div>
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
                            <div class="mb-2">
                                <strong>Créé par :</strong>
                                <div class="text-muted">{{ $fiche->created_by_name }}</div>
                            </div>

                            <div class="mb-2">
                                <strong>Créé le :</strong>
                                <div class="text-muted">{{ $fiche->created_at->format('d/m/Y à H:i') }}</div>
                            </div>

                            @if($fiche->updated_at != $fiche->created_at)
                                <div class="mb-2">
                                    <strong>Modifié le :</strong>
                                    <div class="text-muted">{{ $fiche->updated_at->format('d/m/Y à H:i') }}</div>
                                </div>

                                @if($fiche->updater)
                                    <div class="mb-2">
                                        <strong>Modifié par :</strong>
                                        <div class="text-muted">{{ $fiche->updater->name }}</div>
                                    </div>
                                @endif
                            @endif

                            <div class="mb-0">
                                <strong>Slug :</strong>
                                <div class="text-muted">
                                    <code>{{ $fiche->slug }}</code>
                                </div>
                            </div>
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
                        <a href="{{ route('admin.fiches.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                        </a>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.fiches.edit', $fiche) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i>Modifier
                        </a>
                        <form action="{{ route('admin.fiches.destroy', $fiche) }}" 
                              method="POST" 
                              class="d-inline"
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette fiche ?')">
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