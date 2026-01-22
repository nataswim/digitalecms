@extends('layouts.app')

@section('title', 'Créer une fiche')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
            <i class="fas fa-plus text-primary me-2"></i>
            Créer une fiche
        </h2>
        <a href="{{ route('admin.fiches.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Retour
        </a>
    </div>
@endsection

@section('content')
<div class="py-4">
    <div class="container-fluid">
        <form action="{{ route('admin.fiches.store') }}" method="POST" id="ficheForm">
            @csrf
            
            <div class="row g-4">
                <!-- Colonne principale -->
                <div class="col-lg-8">
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
                                <!-- Titre -->
                                <div class="col-12">
                                    <label for="title" class="form-label fw-semibold">
                                        Titre <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('title') is-invalid @enderror" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title') }}" 
                                           required>
                                    @error('title')
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
                                           value="{{ old('slug') }}">
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Description courte -->
                                <div class="col-12">
                                    <label for="short_description" class="form-label fw-semibold">
                                        Description courte <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control @error('short_description') is-invalid @enderror" 
                                              id="short_description" 
                                              name="short_description" 
                                              rows="3" 
                                              required>{{ old('short_description') }}</textarea>
                                    @error('short_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Description longue -->
                                <div class="col-12">
    <label class="form-label fw-semibold">Description détaillée</label>
    
    <div id="quill-editor" style="height: 300px; background: white;">
        {!! old('long_description', $fiche->long_description ?? '') !!}
    </div>

    <input type="hidden" name="long_description" id="long_description_input">
    
    @error('long_description')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>
                            </div>
                        </div>
                    </div>

                    <!-- SEO -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-bottom p-4">
                            <h5 class="mb-0">
                                <i class="fas fa-search text-success me-2"></i>
                                Référencement (SEO)
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="meta_title" class="form-label fw-semibold">
                                        Titre SEO
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('meta_title') is-invalid @enderror" 
                                           id="meta_title" 
                                           name="meta_title" 
                                           value="{{ old('meta_title') }}" 
                                           maxlength="255">
                                    @error('meta_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="meta_description" class="form-label fw-semibold">
                                        Description SEO
                                    </label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                              id="meta_description" 
                                              name="meta_description" 
                                              rows="3" 
                                              maxlength="500">{{ old('meta_description') }}</textarea>
                                    @error('meta_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="meta_keywords" class="form-label fw-semibold">
                                        Mots-clés SEO
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('meta_keywords') is-invalid @enderror" 
                                           id="meta_keywords" 
                                           name="meta_keywords" 
                                           value="{{ old('meta_keywords') }}" 
                                           placeholder="mot1, mot2, mot3">
                                    @error('meta_keywords')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Publication -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-bottom p-4">
                            <h5 class="mb-0">
                                <i class="fas fa-paper-plane text-info me-2"></i>
                                Publication
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <!-- Publié -->
                                <div class="col-12">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               id="is_published" 
                                               name="is_published" 
                                               value="1"
                                               {{ old('is_published') ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="is_published">
                                            Publier cette fiche
                                        </label>
                                    </div>
                                </div>

                                <!-- Date de publication -->
                                <div class="col-12">
                                    <label for="published_at" class="form-label fw-semibold">
                                        Date de publication
                                    </label>
                                    <input type="datetime-local" 
                                           class="form-control @error('published_at') is-invalid @enderror" 
                                           id="published_at" 
                                           name="published_at" 
                                           value="{{ old('published_at') }}">
                                    @error('published_at')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Visibilité -->
                                <div class="col-12">
                                    <label for="visibility" class="form-label fw-semibold">
                                        Visibilité <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select @error('visibility') is-invalid @enderror" 
                                            id="visibility" 
                                            name="visibility" 
                                            required>
                                        <option value="public" {{ old('visibility', 'public') == 'public' ? 'selected' : '' }}>
                                            Public
                                        </option>
                                        <option value="authenticated" {{ old('visibility') == 'authenticated' ? 'selected' : '' }}>
                                            Authentifié uniquement
                                        </option>
                                    </select>
                                    @error('visibility')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- En vedette -->
                                <div class="col-12">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               id="is_featured" 
                                               name="is_featured" 
                                               value="1"
                                               {{ old('is_featured') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">
                                            Mettre en vedette
                                        </label>
                                    </div>
                                </div>

                                <!-- Ordre d'affichage -->
                                <div class="col-12">
                                    <label for="sort_order" class="form-label fw-semibold">
                                        Ordre d'affichage
                                    </label>
                                    <input type="number" 
                                           class="form-control @error('sort_order') is-invalid @enderror" 
                                           id="sort_order" 
                                           name="sort_order" 
                                           value="{{ old('sort_order', 0) }}" 
                                           min="0">
                                    @error('sort_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Catégories -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-bottom p-4">
                            <h5 class="mb-0">
                                <i class="fas fa-folder text-warning me-2"></i>
                                Catégories
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <!-- Catégorie principale -->
                                <div class="col-12">
                                    <label for="fiches_category_id" class="form-label fw-semibold">
                                        Catégorie
                                    </label>
                                    <select class="form-select @error('fiches_category_id') is-invalid @enderror" 
                                            id="fiches_category_id" 
                                            name="fiches_category_id">
                                        <option value="">-- Sélectionner une catégorie --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                    {{ old('fiches_category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('fiches_category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Sous-catégorie -->
                                <div class="col-12">
                                    <label for="fiches_sous_category_id" class="form-label fw-semibold">
                                        Sous-catégorie
                                    </label>
                                    <select class="form-select @error('fiches_sous_category_id') is-invalid @enderror" 
                                            id="fiches_sous_category_id" 
                                            name="fiches_sous_category_id">
                                        <option value="">-- Sélectionner une sous-catégorie --</option>
                                    </select>
                                    @error('fiches_sous_category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Image - Nouveau sélecteur de médias -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-bottom p-4">
                            <h5 class="mb-0">
                                <i class="fas fa-image text-danger me-2"></i>
                                Image
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            @include('components.media-selector', [
                                'inputName' => 'media_id',
                                'inputId' => 'media_id',
                                'selectedMediaId' => old('media_id'),
                                'selectedMediaUrl' => null,
                                'label' => 'Image de la fiche',
                                'required' => false
                            ])
                        </div>
                    </div>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.fiches.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i>Annuler
                        </a>
                        <div class="d-flex gap-2">
                            <button type="submit" name="action" value="save" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Créer la fiche
                            </button>
                            <button type="submit" name="action" value="save_and_continue" class="btn btn-success">
                                <i class="fas fa-edit me-2"></i>Créer et continuer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Générer automatiquement le slug à partir du titre
document.getElementById('title')?.addEventListener('input', function() {
    const slug = this.value
        .toLowerCase()
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '');
    
    document.getElementById('slug').value = slug;
});

// Charger les sous-catégories en fonction de la catégorie
document.getElementById('fiches_category_id')?.addEventListener('change', function() {
    const categoryId = this.value;
    const sousCategorySelect = document.getElementById('fiches_sous_category_id');
    
    sousCategorySelect.innerHTML = '<option value="">-- Sélectionner une sous-catégorie --</option>';
    
    if (!categoryId) {
        return;
    }
    
    fetch(`/admin/api/fiches-sous-categories/by-category?category_id=${categoryId}`)
        .then(response => response.json())
        .then(data => {
            data.forEach(sousCategory => {
                const option = document.createElement('option');
                option.value = sousCategory.id;
                option.textContent = sousCategory.name;
                sousCategorySelect.appendChild(option);
            });
        });
});
</script>



<script>
document.addEventListener('DOMContentLoaded', function() {
    // Configuration de la barre d'outils (Toutes ces options sont gratuites)
    const toolbarOptions = [
        [{ 'header': [1, 2, 3, false] }],
        ['bold', 'italic', 'underline', 'strike'],        // Styles
        [{ 'color': [] }, { 'background': [] }],          // Couleurs
        [{ 'align': [] }],                                // Alignement
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],     // Listes
        ['link', 'blockquote', 'code-block'],
        ['clean']                                         // Bouton pour effacer le formatage
    ];

    // Initialisation de l'éditeur
    const quill = new Quill('#quill-editor', {
        modules: { toolbar: toolbarOptions },
        theme: 'snow'
    });

    // Synchronisation avec le formulaire
    const form = document.querySelector('#ficheForm'); // Vérifiez que l'ID de votre form est bien ficheForm
    const input = document.querySelector('#long_description_input');

    form.addEventListener('submit', function() {
        // On récupère le contenu HTML de Quill pour le mettre dans l'input hidden
        input.value = quill.root.innerHTML;
    });
});
</script>

@endpush