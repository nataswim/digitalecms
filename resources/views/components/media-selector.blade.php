{{-- 
    Composant de sélection de média depuis la bibliothèque
    Utilise les routes existantes de MediaController
    
    Usage:
    @include('components.media-selector', [
        'inputName' => 'media_id',
        'inputId' => 'media_id',
        'selectedMediaId' => old('media_id', $fiche->media_id ?? null),
        'selectedMediaUrl' => old('media_id') ? null : ($fiche->media->url ?? null),
        'label' => 'Image de la fiche',
        'required' => false
    ])
--}}

@php
    $inputName = $inputName ?? 'media_id';
    $inputId = $inputId ?? 'media_id';
    $selectedMediaId = $selectedMediaId ?? null;
    $selectedMediaUrl = $selectedMediaUrl ?? null;
    $label = $label ?? 'Sélectionner une image';
    $required = $required ?? false;
    $buttonClass = $buttonClass ?? 'btn btn-outline-primary';
    $modalId = $modalId ?? 'mediaSelector' . Str::random(8);
@endphp

<div class="media-selector-container">
    <!-- Champ caché pour stocker l'ID du média sélectionné -->
    <input type="hidden" 
           name="{{ $inputName }}" 
           id="{{ $inputId }}" 
           value="{{ $selectedMediaId }}">
    
    <label for="{{ $inputId }}" class="form-label fw-semibold">
        {{ $label }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    
    <!-- Bouton pour ouvrir la bibliothèque -->
    <div class="d-grid mb-3">
        <button type="button" 
                class="{{ $buttonClass }} w-100" 
                data-bs-toggle="modal" 
                data-bs-target="#{{ $modalId }}">
            <i class="fas fa-images me-2"></i>
            Choisir depuis la bibliothèque
        </button>
    </div>
    
    <!-- Prévisualisation de l'image sélectionnée -->
    <div id="{{ $inputId }}_preview" 
         class="media-preview {{ $selectedMediaId || $selectedMediaUrl ? '' : 'd-none' }}">
        <div class="position-relative">
            <img id="{{ $inputId }}_preview_img" 
                 src="{{ $selectedMediaUrl ?? '' }}" 
                 alt="Aperçu" 
                 class="img-fluid rounded border">
            <button type="button" 
                    class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2"
                    onclick="clearMediaSelection('{{ $inputId }}')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="mt-2 small text-muted" id="{{ $inputId }}_preview_name"></div>
    </div>
</div>

<!-- Modal de sélection de média -->
<div class="modal fade" 
     id="{{ $modalId }}" 
     tabindex="-1" 
     aria-labelledby="{{ $modalId }}Label" 
     aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="{{ $modalId }}Label">
                    <i class="fas fa-images me-2"></i>
                    Bibliothèque de médias
                </h5>
                <button type="button" 
                        class="btn-close btn-close-white" 
                        data-bs-dismiss="modal" 
                        aria-label="Fermer"></button>
            </div>
            
            <div class="modal-body p-0">
                <!-- Filtres -->
                <div class="p-4 bg-light border-bottom">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" 
                                   class="form-control" 
                                   id="{{ $modalId }}_search" 
                                   placeholder="Rechercher par nom...">
                        </div>
                        <div class="col-md-4">
                            <select class="form-select" id="{{ $modalId }}_category">
                                <option value="">Toutes les catégories</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" 
                                    class="btn btn-primary w-100"
                                    onclick="loadMediaLibrary{{ $modalId }}()">
                                <i class="fas fa-search me-2"></i>Filtrer
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Zone de chargement -->
                <div id="{{ $modalId }}_loading" class="text-center p-5 d-none">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Chargement...</span>
                    </div>
                    <p class="mt-3 text-muted">Chargement de la bibliothèque...</p>
                </div>
                
                <!-- Grille de médias -->
                <div id="{{ $modalId }}_grid" class="p-4">
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
                        <!-- Les médias seront chargés ici dynamiquement -->
                    </div>
                </div>
                
                <!-- Message si aucun média -->
                <div id="{{ $modalId }}_empty" class="text-center p-5 text-muted d-none">
                    <i class="fas fa-images fa-3x mb-3 opacity-50"></i>
                    <p>Aucun média disponible</p>
                    <a href="{{ route('admin.media.create') }}" class="btn btn-primary">
                        <i class="fas fa-upload me-2"></i>Uploader des médias
                    </a>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Annuler
                </button>
            </div>
        </div>
    </div>
</div>

@once
@push('scripts')
<script>
// Fonction pour charger la bibliothèque de médias
function loadMediaLibrary{{ $modalId }}() {
    const searchInput = document.getElementById('{{ $modalId }}_search');
    const categorySelect = document.getElementById('{{ $modalId }}_category');
    const gridContainer = document.getElementById('{{ $modalId }}_grid').querySelector('.row');
    const loadingDiv = document.getElementById('{{ $modalId }}_loading');
    const emptyDiv = document.getElementById('{{ $modalId }}_empty');
    
    // Afficher le loader
    loadingDiv.classList.remove('d-none');
    gridContainer.innerHTML = '';
    emptyDiv.classList.add('d-none');
    
    // Paramètres de recherche
    const params = new URLSearchParams({
        search: searchInput.value || '',
        category: categorySelect.value || '',
        per_page: 100
    });
    
    // Utiliser la route existante /admin/media
    fetch('{{ route('admin.media.index') }}?' + params, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        loadingDiv.classList.add('d-none');
        
        // Support pour réponse paginée Laravel
        const mediaData = data.data || data;
        
        if (mediaData && mediaData.length > 0) {
            renderMediaGrid{{ $modalId }}(mediaData, gridContainer);
        } else {
            emptyDiv.classList.remove('d-none');
        }
    })
    .catch(error => {
        loadingDiv.classList.add('d-none');
        console.error('Erreur lors du chargement des médias:', error);
        alert('Erreur lors du chargement de la bibliothèque');
    });
}

// Fonction pour afficher la grille de médias
function renderMediaGrid{{ $modalId }}(media, container) {
    container.innerHTML = '';
    
    media.forEach(item => {
        const col = document.createElement('div');
        col.className = 'col';
        
        col.innerHTML = `
            <div class="media-item card h-100 cursor-pointer" 
                 onclick="selectMedia{{ $modalId }}(${item.id}, '${item.url}', '${item.name.replace(/'/g, "\\'")}')"
                 style="cursor: pointer;">
                <div class="ratio ratio-1x1">
                    <img src="${item.url}" 
                         alt="${item.name}" 
                         class="card-img-top object-fit-cover">
                </div>
                <div class="card-body p-2">
                    <p class="card-text small text-truncate mb-0" title="${item.name}">
                        ${item.name}
                    </p>
                    ${item.formatted_size ? `<small class="text-muted">${item.formatted_size}</small>` : ''}
                </div>
            </div>
        `;
        
        container.appendChild(col);
    });
}

// Fonction pour sélectionner un média
function selectMedia{{ $modalId }}(mediaId, mediaUrl, mediaName) {
    const inputId = '{{ $inputId }}';
    
    // Remplir le champ caché
    document.getElementById(inputId).value = mediaId;
    
    // Afficher la prévisualisation
    const preview = document.getElementById(inputId + '_preview');
    const previewImg = document.getElementById(inputId + '_preview_img');
    const previewName = document.getElementById(inputId + '_preview_name');
    
    previewImg.src = mediaUrl;
    previewName.textContent = mediaName;
    preview.classList.remove('d-none');
    
    // Fermer le modal
    const modalElement = document.getElementById('{{ $modalId }}');
    const modal = bootstrap.Modal.getInstance(modalElement);
    if (modal) {
        modal.hide();
    }
}

// Fonction pour vider la sélection
function clearMediaSelection(inputId) {
    document.getElementById(inputId).value = '';
    document.getElementById(inputId + '_preview').classList.add('d-none');
    document.getElementById(inputId + '_preview_img').src = '';
    document.getElementById(inputId + '_preview_name').textContent = '';
}

// Charger les catégories de médias au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('{{ $modalId }}_category');
    
    if (categorySelect) {
        // Utiliser la route existante /admin/media/categories
        fetch('{{ route('admin.media.categories') }}', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Support pour réponse directe ou paginée
            const categories = data.data || data;
            
            categories.forEach(category => {
                const option = document.createElement('option');
                option.value = category.id;
                option.textContent = category.name;
                categorySelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Erreur lors du chargement des catégories:', error);
        });
    }
    
    // Charger la bibliothèque lors de l'ouverture du modal
    const modal = document.getElementById('{{ $modalId }}');
    if (modal) {
        modal.addEventListener('shown.bs.modal', function() {
            loadMediaLibrary{{ $modalId }}();
        });
    }
});
</script>
@endpush
@endonce