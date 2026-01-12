<!-- Modal Upload Multiple -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-cloud-upload-alt text-primary me-2"></i>
                    Uploader des fichiers
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                @csrf
                <div class="modal-body">
                    <!-- Zone de drop -->
                    <div class="upload-zone border-2 border-dashed border-primary rounded-3 p-5 text-center mb-4 position-relative" 
                         id="uploadZone">
                        <div class="upload-zone-content">
                            <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                            <h5 class="text-primary">Glissez-déposez vos fichiers ici</h5>
                            <p class="text-muted mb-3">ou cliquez pour sélectionner</p>
                            <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('fileInput').click()">
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
                                <i class="fas fa-download fa-2x text-primary mb-2"></i>
                                <div class="fw-bold text-primary">Déposez vos fichiers ici</div>
                            </div>
                        </div>
                    </div>

                    <!-- Informations format -->
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Formats acceptés :</strong> JPEG, PNG, GIF, WebP • 
                        <strong>Taille max :</strong> 5 MB par fichier
                    </div>

                    <!-- Options générales -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="media_category_id" class="form-label">Catégorie</label>
                            <select name="media_category_id" id="media_category_id" class="form-select">
                                <option value="">Aucune catégorie</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Prévisualisation des fichiers -->
                    <div id="filePreview" class="d-none">
                        <h6 class="fw-semibold mb-3">Fichiers sélectionnés</h6>
                        <div id="previewContainer" class="row g-3"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Annuler
                    </button>
                    <button type="submit" class="btn btn-primary" id="uploadBtn" disabled>
                        <i class="fas fa-upload me-2"></i>Uploader <span id="fileCount">0</span> fichier(s)
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
let selectedFiles = [];

// Drag & Drop
const uploadZone = document.getElementById('uploadZone');
const overlay = uploadZone?.querySelector('.upload-overlay');

uploadZone?.addEventListener('dragover', (e) => {
    e.preventDefault();
    overlay.classList.remove('d-none');
});

uploadZone?.addEventListener('dragleave', (e) => {
    e.preventDefault();
    overlay.classList.add('d-none');
});

uploadZone?.addEventListener('drop', (e) => {
    e.preventDefault();
    overlay.classList.add('d-none');
    handleFileSelect(e.dataTransfer.files);
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
                <div class="card">
                    <img src="${e.target.result}" class="card-img-top" style="height: 120px; object-fit: cover;">
                    <div class="card-body p-2">
                        <small class="text-truncate d-block">${file.name}</small>
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

// Réinitialiser le modal à la fermeture
document.getElementById('uploadModal')?.addEventListener('hidden.bs.modal', function() {
    document.getElementById('uploadForm').reset();
    document.getElementById('filePreview').classList.add('d-none');
    document.getElementById('uploadBtn').disabled = true;
    selectedFiles = [];
});
</script>
@endpush