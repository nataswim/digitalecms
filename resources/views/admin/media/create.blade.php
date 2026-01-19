@extends('layouts.app')

@section('title', 'Uploader des médias')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
            <i class="fas fa-cloud-upload-alt text-primary me-2"></i>
            Uploader des médias
        </h2>
        <a href="{{ route('admin.media.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Retour
        </a>
    </div>
@endsection

@section('content')
<div class="py-4">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5">
                        <form action="{{ route('admin.media.store') }}" 
                              method="POST" 
                              enctype="multipart/form-data" 
                              id="uploadForm">
                            @csrf
                            
                            <!-- Zone de drop -->
                            <div class="upload-zone border-2 border-dashed border-primary rounded-3 p-5 text-center mb-4 position-relative" 
                                 id="uploadZone">
                                <div class="upload-zone-content">
                                    <i class="fas fa-cloud-upload-alt fa-4x text-primary mb-3"></i>
                                    <h5 class="text-primary mb-2">Glissez-déposez vos fichiers ici</h5>
                                    <p class="text-muted mb-3">ou cliquez pour sélectionner</p>
                                    <button type="button" 
                                            class="btn btn-primary" 
                                            onclick="document.getElementById('fileInput').click()">
                                        <i class="fas fa-folder-open me-2"></i>Parcourir les fichiers
                                    </button>
                                    <input type="file" 
                                           id="fileInput" 
                                           name="files[]" 
                                           multiple 
                                           accept="image/*"
                                           style="display: none;"
                                           onchange="handleFileSelect(this.files)">
                                </div>
                                
                                <!-- Indicateur de survol -->
                                <div class="upload-overlay position-absolute top-0 start-0 w-100 h-100 bg-primary bg-opacity-10 rounded-3 d-none align-items-center justify-content-center">
                                    <div class="text-center">
                                        <i class="fas fa-download fa-3x text-primary mb-2"></i>
                                        <div class="fw-bold text-primary fs-5">Déposez vos fichiers ici</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informations format -->
                            <div class="alert alert-info mb-4">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Formats acceptés :</strong> JPEG, PNG, GIF, WebP, SVG •
                                <strong>Taille max :</strong> 5 MB par fichier
                            </div>

                            <!-- Catégorie globale -->
                            <div class="mb-4">
                                <label for="media_category_id" class="form-label fw-semibold">
                                    Catégorie (appliquée à tous les fichiers)
                                </label>
                                <select name="media_category_id" 
                                        id="media_category_id" 
                                        class="form-select">
                                    <option value="">Aucune catégorie</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Prévisualisation des fichiers -->
                            <div id="filePreview" class="d-none">
                                <h6 class="fw-semibold mb-3">
                                    <i class="fas fa-images me-2"></i>
                                    Fichiers sélectionnés
                                </h6>
                                <div id="previewContainer" class="row g-3 mb-4"></div>
                            </div>

                            <!-- Boutons -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.media.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Annuler
                                </a>
                                <button type="submit" 
                                        class="btn btn-primary" 
                                        id="uploadBtn" 
                                        disabled>
                                    <i class="fas fa-upload me-2"></i>
                                    Uploader <span id="fileCount">0</span> fichier(s)
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.upload-zone {
    cursor: pointer;
    transition: all 0.3s ease;
}

.upload-zone:hover {
    border-color: var(--bs-primary) !important;
    background-color: rgba(var(--bs-primary-rgb), 0.05);
}

.upload-zone.dragover {
    border-color: var(--bs-primary) !important;
    background-color: rgba(var(--bs-primary-rgb), 0.1);
    transform: scale(1.02);
}
</style>
@endpush

@push('scripts')
<script>
let selectedFiles = [];

// Drag & Drop
const uploadZone = document.getElementById('uploadZone');
const overlay = uploadZone.querySelector('.upload-overlay');

uploadZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadZone.classList.add('dragover');
    overlay.classList.remove('d-none');
});

uploadZone.addEventListener('dragleave', (e) => {
    e.preventDefault();
    uploadZone.classList.remove('dragover');
    overlay.classList.add('d-none');
});

uploadZone.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadZone.classList.remove('dragover');
    overlay.classList.add('d-none');
    handleFileSelect(e.dataTransfer.files);
});

// Click sur la zone
uploadZone.addEventListener('click', (e) => {
    if (e.target === uploadZone || e.target.closest('.upload-zone-content')) {
        document.getElementById('fileInput').click();
    }
});

// Gestion de la sélection de fichiers
function handleFileSelect(files) {
    selectedFiles = Array.from(files);
    
    if (selectedFiles.length === 0) {
        document.getElementById('filePreview').classList.add('d-none');
        document.getElementById('uploadBtn').disabled = true;
        return;
    }
    
    // Afficher la prévisualisation
    const previewContainer = document.getElementById('previewContainer');
    previewContainer.innerHTML = '';
    
    selectedFiles.forEach((file, index) => {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            const col = document.createElement('div');
            col.className = 'col-md-4';
            col.innerHTML = `
                <div class="card border-0 shadow-sm">
                    <img src="${e.target.result}" 
                         class="card-img-top" 
                         style="height: 150px; object-fit: cover;">
                    <div class="card-body p-3">
                        <div class="text-truncate mb-1" title="${file.name}">
                            <i class="fas fa-file-image me-1 text-primary"></i>
                            <small class="fw-semibold">${file.name}</small>
                        </div>
                        <small class="text-muted">${formatBytes(file.size)}</small>
                    </div>
                </div>
            `;
            previewContainer.appendChild(col);
        };
        
        reader.readAsDataURL(file);
    });
    
    document.getElementById('filePreview').classList.remove('d-none');
    document.getElementById('uploadBtn').disabled = false;
    document.getElementById('fileCount').textContent = selectedFiles.length;
}

function formatBytes(bytes) {
    if (bytes === 0) return '0 B';
    const k = 1024;
    const sizes = ['B', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
}
</script>
@endpush