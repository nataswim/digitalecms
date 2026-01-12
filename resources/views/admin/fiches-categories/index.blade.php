@extends('layouts.app')

@section('title', 'Catégories de fiches')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
            <i class="fas fa-folder text-primary me-2"></i>
            Catégories de fiches
        </h2>
        <a href="{{ route('admin.fiches-categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nouvelle catégorie
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
                                <i class="fas fa-folder text-primary fa-lg"></i>
                            </div>
                            <div>
                                <div class="fw-bold fs-4">{{ $stats['total'] }}</div>
                                <small class="text-muted">Total catégories</small>
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
                <form method="GET" action="{{ route('admin.fiches-categories.index') }}" class="row g-3">
                    <div class="col-md-6">
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
                    <div class="col-md-6">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fas fa-filter me-1"></i>Filtrer
                            </button>
                            <a href="{{ route('admin.fiches-categories.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i>Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Liste des catégories -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                @if($categories->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3">Nom</th>
                                    <th class="px-4 py-3">Slug</th>
                                    <th class="px-4 py-3">Fiches</th>
                                    <th class="px-4 py-3">Ordre</th>
                                    <th class="px-4 py-3">Statut</th>
                                    <th class="px-4 py-3">Date création</th>
                                    <th class="px-4 py-3 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div>
                                                <a href="{{ route('admin.fiches-categories.show', $category) }}" 
                                                   class="fw-semibold text-decoration-none">
                                                    {{ $category->name }}
                                                </a>
                                                @if($category->description)
                                                    <div class="small text-muted">{{ Str::limit($category->description, 60) }}</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <code class="small">{{ $category->slug }}</code>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="badge bg-primary-subtle text-primary">
                                                {{ $category->fiches_count }} fiche(s)
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="badge bg-secondary-subtle text-secondary">
                                                {{ $category->sort_order }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            @if($category->is_active)
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
                                            <small class="text-muted">{{ $category->created_at->format('d/m/Y') }}</small>
                                        </td>
                                        <td class="px-4 py-3 text-end">
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.fiches-categories.show', $category) }}" 
                                                   class="btn btn-outline-primary"
                                                   title="Voir">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.fiches-categories.edit', $category) }}" 
                                                   class="btn btn-outline-secondary"
                                                   title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if($category->fiches_count === 0)
                                                    <form method="POST" 
                                                          action="{{ route('admin.fiches-categories.destroy', $category) }}"
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
                    @if($categories->hasPages())
                        <div class="border-top p-4">
                            {{ $categories->appends(request()->query())->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-folder fa-4x text-muted opacity-50"></i>
                        </div>
                        <h5 class="text-muted">Aucune catégorie trouvée</h5>
                        <p class="text-muted mb-4">
                            @if($search)
                                Aucun résultat pour votre recherche.
                            @else
                                Commencez par créer votre première catégorie.
                            @endif
                        </p>
                        <a href="{{ route('admin.fiches-categories.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Créer une catégorie
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection