@extends('layouts.app')

@section('title', 'Sous-catégories de fiches')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
            <i class="fas fa-folder-open text-primary me-2"></i>
            Sous-catégories de fiches
        </h2>
        <a href="{{ route('admin.fiches-sous-categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nouvelle sous-catégorie
        </a>
    </div>
@endsection

@section('content')
<div class="py-4">
    <div class="container-fluid">
        <!-- Statistiques -->
        <div class="row g-3 mb-4">
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded p-2 me-3">
                                <i class="fas fa-folder-open text-primary fa-lg"></i>
                            </div>
                            <div>
                                <div class="fw-bold fs-4">{{ $stats['total'] }}</div>
                                <small class="text-muted">Total sous-catégories</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 rounded p-2 me-3">
                                <i class="fas fa-check-circle text-success fa-lg"></i>
                            </div>
                            <div>
                                <div class="fw-bold fs-4">{{ $stats['active'] }}</div>
                                <small class="text-muted">Actives</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-secondary bg-opacity-10 rounded p-2 me-3">
                                <i class="fas fa-times-circle text-secondary fa-lg"></i>
                            </div>
                            <div>
                                <div class="fw-bold fs-4">{{ $stats['inactive'] }}</div>
                                <small class="text-muted">Inactives</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtres et recherche -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.fiches-sous-categories.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" 
                                   name="search" 
                                   value="{{ $search }}"
                                   class="form-control border-start-0" 
                                   placeholder="Rechercher...">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select name="category" class="form-select">
                            <option value="">Toutes les catégories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fas fa-filter me-1"></i>Filtrer
                            </button>
                            <a href="{{ route('admin.fiches-sous-categories.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i>Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Liste des sous-catégories -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                @if($sousCategories->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3">Nom</th>
                                    <th class="px-4 py-3">Catégorie parente</th>
                                    <th class="px-4 py-3">Slug</th>
                                    <th class="px-4 py-3">Fiches</th>
                                    <th class="px-4 py-3">Ordre</th>
                                    <th class="px-4 py-3">Statut</th>
                                    <th class="px-4 py-3">Date création</th>
                                    <th class="px-4 py-3 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sousCategories as $sousCategory)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div>
                                                <a href="{{ route('admin.fiches-sous-categories.show', $sousCategory) }}" 
                                                   class="fw-semibold text-decoration-none">
                                                    {{ $sousCategory->name }}
                                                </a>
                                                @if($sousCategory->description)
                                                    <div class="small text-muted">{{ Str::limit($sousCategory->description, 60) }}</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            @if($sousCategory->category)
                                                <span class="badge bg-primary">
                                                    {{ $sousCategory->category->name }}
                                                </span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            <code class="small">{{ $sousCategory->slug }}</code>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="badge bg-info-subtle text-info">
                                                {{ $sousCategory->fiches_count }} fiche(s)
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="badge bg-secondary-subtle text-secondary">
                                                {{ $sousCategory->sort_order }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            @if($sousCategory->is_active)
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check-circle me-1"></i>Active
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">
                                                    <i class="fas fa-times-circle me-1"></i>Inactive
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            <small class="text-muted">{{ $sousCategory->created_at->format('d/m/Y') }}</small>
                                        </td>
                                        <td class="px-4 py-3 text-end">
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.fiches-sous-categories.show', $sousCategory) }}" 
                                                   class="btn btn-outline-primary"
                                                   title="Voir">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.fiches-sous-categories.edit', $sousCategory) }}" 
                                                   class="btn btn-outline-secondary"
                                                   title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if($sousCategory->fiches_count === 0)
                                                    <form method="POST" 
                                                          action="{{ route('admin.fiches-sous-categories.destroy', $sousCategory) }}"
                                                          onsubmit="return confirm('Êtes-vous sûr ?')"
                                                          class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-outline-danger"
                                                                title="Supprimer">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($sousCategories->hasPages())
                        <div class="border-top p-4">
                            {{ $sousCategories->appends(request()->query())->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-folder-open fa-4x text-muted opacity-50"></i>
                        </div>
                        <h5 class="text-muted">Aucune sous-catégorie trouvée</h5>
                        <p class="text-muted mb-4">
                            @if($search || $categoryId)
                                Aucun résultat pour les critères sélectionnés.
                            @else
                                Commencez par créer votre première sous-catégorie.
                            @endif
                        </p>
                        <a href="{{ route('admin.fiches-sous-categories.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Créer une sous-catégorie
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection