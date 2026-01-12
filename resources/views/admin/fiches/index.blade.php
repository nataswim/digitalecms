@extends('layouts.app')

@section('title', 'Gestion des fiches')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
            <i class="fas fa-file-alt text-primary me-2"></i>
            Gestion des fiches
        </h2>
        <a href="{{ route('admin.fiches.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nouvelle fiche
        </a>
    </div>
@endsection

@section('content')
<div class="py-4">
    <div class="container-fluid">
        <!-- Statistiques -->
        <div class="row g-3 mb-4">
            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded p-2 me-3">
                                <i class="fas fa-file-alt text-primary"></i>
                            </div>
                            <div>
                                <div class="fw-bold fs-5">{{ $stats['total'] }}</div>
                                <small class="text-muted">Total</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 rounded p-2 me-3">
                                <i class="fas fa-check-circle text-success"></i>
                            </div>
                            <div>
                                <div class="fw-bold fs-5">{{ $stats['published'] }}</div>
                                <small class="text-muted">Publiées</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-warning bg-opacity-10 rounded p-2 me-3">
                                <i class="fas fa-edit text-warning"></i>
                            </div>
                            <div>
                                <div class="fw-bold fs-5">{{ $stats['draft'] }}</div>
                                <small class="text-muted">Brouillons</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-info bg-opacity-10 rounded p-2 me-3">
                                <i class="fas fa-globe text-info"></i>
                            </div>
                            <div>
                                <div class="fw-bold fs-5">{{ $stats['public'] }}</div>
                                <small class="text-muted">Public</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-secondary bg-opacity-10 rounded p-2 me-3">
                                <i class="fas fa-lock text-secondary"></i>
                            </div>
                            <div>
                                <div class="fw-bold fs-5">{{ $stats['authenticated'] }}</div>
                                <small class="text-muted">Authentifié</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-danger bg-opacity-10 rounded p-2 me-3">
                                <i class="fas fa-star text-danger"></i>
                            </div>
                            <div>
                                <div class="fw-bold fs-5">{{ $stats['featured'] }}</div>
                                <small class="text-muted">En vedette</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Barre d'actions en masse -->
        <div id="bulkActionsBar" class="card border-0 shadow-sm mb-3 d-none">
            <div class="card-body py-2">
                <form id="bulkActionForm" method="POST" action="{{ route('admin.fiches.bulk-assign-categories') }}">
                    @csrf
                    <div class="row align-items-center g-2">
                        <div class="col-auto">
                            <span class="fw-semibold">
                                <span id="selectedCount">0</span> fiche(s) sélectionnée(s)
                            </span>
                        </div>
                        <div class="col-auto">
                            <select name="fiches_category_id" id="bulkCategorySelect" class="form-select form-select-sm">
                                <option value="">-- Changer la catégorie --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto" id="sousCategorySelectContainer" style="display: none;">
                            <select name="fiches_sous_category_id" id="bulkSousCategorySelect" class="form-select form-select-sm">
                                <option value="">-- Sous-catégorie (optionnel) --</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-check me-1"></i>Appliquer
                            </button>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="clearSelection()">
                                <i class="fas fa-times me-1"></i>Annuler
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="fiche_ids" id="selectedFicheIds">
                </form>
            </div>
        </div>

        <!-- Filtres et recherche -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.fiches.index') }}" class="row g-3">
                    <div class="col-md-3">
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
                    <div class="col-md-2">
                        <select name="visibility" class="form-select">
                            <option value="">Toutes visibilités</option>
                            <option value="public" {{ $visibility == 'public' ? 'selected' : '' }}>Public</option>
                            <option value="authenticated" {{ $visibility == 'authenticated' ? 'selected' : '' }}>Authentifié</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="category" id="filterCategory" class="form-select">
                            <option value="">Toutes catégories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="sous_category" id="filterSousCategory" class="form-select">
                            <option value="">Toutes sous-catégories</option>
                            @foreach($sousCategories as $sousCategory)
                                <option value="{{ $sousCategory->id }}" {{ $sousCategoryId == $sousCategory->id ? 'selected' : '' }}>
                                    {{ $sousCategory->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1">
                        <select name="featured" class="form-select">
                            <option value="">Tous</option>
                            <option value="1" {{ $featured ? 'selected' : '' }}>Vedette</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fas fa-filter me-1"></i>Filtrer
                            </button>
                            <a href="{{ route('admin.fiches.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i>Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Liste des fiches -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                @if($fiches->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3" style="width: 30px;">
                                        <input type="checkbox" class="form-check-input" id="selectAll">
                                    </th>
                                    <th class="px-4 py-3">Titre</th>
                                    <th class="px-4 py-3">Catégorie</th>
                                    <th class="px-4 py-3">Sous-catégorie</th>
                                    <th class="px-4 py-3">Visibilité</th>
                                    <th class="px-4 py-3">Statut</th>
                                    <th class="px-4 py-3">Auteur</th>
                                    <th class="px-4 py-3">Date</th>
                                    <th class="px-4 py-3 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fiches as $fiche)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <input type="checkbox" 
                                                   class="form-check-input fiche-checkbox" 
                                                   value="{{ $fiche->id }}">
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center">
                                                @if($fiche->is_featured)
                                                    <i class="fas fa-star text-warning me-2" title="En vedette"></i>
                                                @endif
                                                <div>
                                                    <a href="{{ route('admin.fiches.show', $fiche) }}" 
                                                       class="fw-semibold text-decoration-none">
                                                        {{ $fiche->title }}
                                                    </a>
                                                    <div class="small text-muted">{{ Str::limit($fiche->short_description, 50) }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            @if($fiche->category)
                                                <span class="badge bg-primary-subtle text-primary">
                                                    {{ $fiche->category->name }}
                                                </span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            @if($fiche->sousCategory)
                                                <span class="badge bg-info-subtle text-info">
                                                    {{ $fiche->sousCategory->name }}
                                                </span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            @if($fiche->visibility === 'public')
                                                <span class="badge bg-success-subtle text-success">
                                                    <i class="fas fa-globe me-1"></i>Public
                                                </span>
                                            @else
                                                <span class="badge bg-secondary-subtle text-secondary">
                                                    <i class="fas fa-lock me-1"></i>Authentifié
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            @if($fiche->is_published)
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check-circle me-1"></i>Publié
                                                </span>
                                            @else
                                                <span class="badge bg-warning">
                                                    <i class="fas fa-edit me-1"></i>Brouillon
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            <small class="text-muted">{{ $fiche->created_by_name }}</small>
                                        </td>
                                        <td class="px-4 py-3">
                                            <small class="text-muted">{{ $fiche->created_at->format('d/m/Y') }}</small>
                                        </td>
                                        <td class="px-4 py-3 text-end">
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.fiches.show', $fiche) }}" 
                                                   class="btn btn-outline-primary"
                                                   title="Voir">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.fiches.edit', $fiche) }}" 
                                                   class="btn btn-outline-secondary"
                                                   title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form method="POST" 
                                                      action="{{ route('admin.fiches.destroy', $fiche) }}"
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
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($fiches->hasPages())
                        <div class="border-top p-4">
                            {{ $fiches->appends(request()->query())->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-file-alt fa-4x text-muted opacity-50"></i>
                        </div>
                        <h5 class="text-muted">Aucune fiche trouvée</h5>
                        <p class="text-muted mb-4">
                            @if($search || $visibility || $categoryId || $sousCategoryId || $featured)
                                Aucun résultat pour les critères sélectionnés.
                            @else
                                Commencez par créer votre première fiche.
                            @endif
                        </p>
                        <a href="{{ route('admin.fiches.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Créer une fiche
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Gestion de la sélection multiple
let selectedFiches = new Set();

document.getElementById('selectAll')?.addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.fiche-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
        updateFicheSelection(checkbox);
    });
});

document.querySelectorAll('.fiche-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        updateFicheSelection(this);
    });
});

function updateFicheSelection(checkbox) {
    const ficheId = checkbox.value;
    
    if (checkbox.checked) {
        selectedFiches.add(ficheId);
    } else {
        selectedFiches.delete(ficheId);
        document.getElementById('selectAll').checked = false;
    }
    
    updateBulkActionsBar();
}

function updateBulkActionsBar() {
    const bar = document.getElementById('bulkActionsBar');
    const count = document.getElementById('selectedCount');
    const ficheIds = document.getElementById('selectedFicheIds');
    
    count.textContent = selectedFiches.size;
    ficheIds.value = JSON.stringify([...selectedFiches]);
    
    if (selectedFiches.size > 0) {
        bar.classList.remove('d-none');
    } else {
        bar.classList.add('d-none');
    }
}

function clearSelection() {
    selectedFiches.clear();
    document.querySelectorAll('.fiche-checkbox').forEach(checkbox => {
        checkbox.checked = false;
    });
    document.getElementById('selectAll').checked = false;
    updateBulkActionsBar();
}

// Charger les sous-catégories en fonction de la catégorie (pour le filtre)
document.getElementById('filterCategory')?.addEventListener('change', function() {
    const categoryId = this.value;
    const sousCategorySelect = document.getElementById('filterSousCategory');
    
    if (!categoryId) {
        sousCategorySelect.innerHTML = '<option value="">Toutes sous-catégories</option>';
        return;
    }
    
    fetch(`/admin/api/fiches-sous-categories/by-category?category_id=${categoryId}`)
        .then(response => response.json())
        .then(data => {
            sousCategorySelect.innerHTML = '<option value="">Toutes sous-catégories</option>';
            data.forEach(sousCategory => {
                const option = document.createElement('option');
                option.value = sousCategory.id;
                option.textContent = sousCategory.name;
                sousCategorySelect.appendChild(option);
            });
        });
});

// Charger les sous-catégories pour les actions en masse
document.getElementById('bulkCategorySelect')?.addEventListener('change', function() {
    const categoryId = this.value;
    const sousCategoryContainer = document.getElementById('sousCategorySelectContainer');
    const sousCategorySelect = document.getElementById('bulkSousCategorySelect');
    
    if (!categoryId) {
        sousCategoryContainer.style.display = 'none';
        return;
    }
    
    fetch(`/admin/api/fiches-sous-categories/by-category?category_id=${categoryId}`)
        .then(response => response.json())
        .then(data => {
            sousCategorySelect.innerHTML = '<option value="">-- Sous-catégorie (optionnel) --</option>';
            data.forEach(sousCategory => {
                const option = document.createElement('option');
                option.value = sousCategory.id;
                option.textContent = sousCategory.name;
                sousCategorySelect.appendChild(option);
            });
            sousCategoryContainer.style.display = 'block';
        });
});
</script>
@endpush