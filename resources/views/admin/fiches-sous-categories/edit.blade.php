@extends('layouts.app')

@section('title', 'Modifier une sous-catégorie')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
            <i class="fas fa-edit text-primary me-2"></i>
            Modifier une sous-catégorie
        </h2>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.fiches-sous-categories.show', $fichesSousCategory) }}" class="btn btn-outline-info">
                <i class="fas fa-eye me-2"></i>Voir
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
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="{{ route('admin.fiches-sous-categories.update', $fichesSousCategory) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Informations principales -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-bottom p-4">
                            <h5 class="mb-0">
                                <i class="fas fa-info-circle text-primary me-2"></i>
                                Informations principales
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <!-- Catégorie parente -->
                                <div class="col-12">
                                    <label for="fiches_category_id" class="form-label fw-semibold">
                                        Catégorie parente <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select @error('fiches_category_id') is-invalid @enderror" 
                                            id="fiches_category_id" 
                                            name="fiches_category_id" 
                                            required>
                                        <option value="">-- Sélectionner une catégorie --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                    {{ old('fiches_category_id', $fichesSousCategory->fiches_category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('fiches_category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Nom -->
                                <div class="col-12">
                                    <label for="name" class="form-label fw-semibold">
                                        Nom <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', $fichesSousCategory->name) }}" 
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Slug -->
                                <div class="col-12">
                                    <label for="slug" class="form-label fw-semibold">
                                        Slug <small class="text-muted">(généré automatiquement si vide)</small>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('slug') is-invalid @enderror" 
                                           id="slug" 
                                           name="slug" 
                                           value="{{ old('slug', $fichesSousCategory->slug) }}">
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="col-12">
                                    <label for="description" class="form-label fw-semibold">
                                        Description
                                    </label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" 
                                              name="description" 
                                              rows="4">{{ old('description', $fichesSousCategory->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Image -->
                                <div class="col-12">
                                    <label for="image" class="form-label fw-semibold">
                                        Image (URL)
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('image') is-invalid @enderror" 
                                           id="image" 
                                           name="image" 
                                           value="{{ old('image', $fichesSousCategory->image) }}" 
                                           placeholder="https://...">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if($fichesSousCategory->image)
                                        <div class="mt-2">
                                            <img src="{{ $fichesSousCategory->image }}" 
                                                 alt="{{ $fichesSousCategory->name }}" 
                                                 class="img-thumbnail" 
                                                 style="max-height: 150px;">
                                        </div>
                                    @endif
                                </div>

                                <!-- Ordre -->
                                <div class="col-md-6">
                                    <label for="sort_order" class="form-label fw-semibold">
                                        Ordre d'affichage
                                    </label>
                                    <input type="number" 
                                           class="form-control @error('sort_order') is-invalid @enderror" 
                                           id="sort_order" 
                                           name="sort_order" 
                                           value="{{ old('sort_order', $fichesSousCategory->sort_order) }}" 
                                           min="0">
                                    @error('sort_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Statut -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Statut</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               id="is_active" 
                                               name="is_active" 
                                               value="1"
                                               {{ old('is_active', $fichesSousCategory->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Sous-catégorie active
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SEO -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-bottom p-4">
                            <h5 class="mb-0">
                                <i class="fas fa-search text-success me-2"></i>
                                Référencement (SEO)
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <!-- Meta Title -->
                                <div class="col-12">
                                    <label for="meta_title" class="form-label fw-semibold">
                                        Titre SEO
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('meta_title') is-invalid @enderror" 
                                           id="meta_title" 
                                           name="meta_title" 
                                           value="{{ old('meta_title', $fichesSousCategory->meta_title) }}" 
                                           maxlength="255">
                                    @error('meta_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Meta Description -->
                                <div class="col-12">
                                    <label for="meta_description" class="form-label fw-semibold">
                                        Description SEO
                                    </label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                              id="meta_description" 
                                              name="meta_description" 
                                              rows="3">{{ old('meta_description', $fichesSousCategory->meta_description) }}</textarea>
                                    @error('meta_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Meta Keywords -->
                                <div class="col-12">
                                    <label for="meta_keywords" class="form-label fw-semibold">
                                        Mots-clés SEO
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('meta_keywords') is-invalid @enderror" 
                                           id="meta_keywords" 
                                           name="meta_keywords" 
                                           value="{{ old('meta_keywords', $fichesSousCategory->meta_keywords) }}" 
                                           placeholder="mot1, mot2, mot3">
                                    @error('meta_keywords')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="{{ route('admin.fiches-sous-categories.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times me-2"></i>Annuler
                                    </a>
                                    @if($fichesSousCategory->fiches_count === 0)
                                        <form action="{{ route('admin.fiches-sous-categories.destroy', $fichesSousCategory) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette sous-catégorie ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">
                                                <i class="fas fa-trash me-2"></i>Supprimer
                                            </button>
                                        </form>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Mettre à jour
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Générer automatiquement le slug à partir du nom
document.getElementById('name')?.addEventListener('input', function() {
    const slug = this.value
        .toLowerCase()
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '');
    
    document.getElementById('slug').value = slug;
});
</script>
@endpush