@extends('layouts.app')

@section('title', 'Détails du média')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
            <i class="fas fa-image text-primary me-2"></i>
            {{ $media->name }}
        </h2>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.media.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Retour
            </a>
            <button type="button" 
                    class="btn btn-outline-danger"
                    onclick="deleteMediaConfirm()">
                <i class="fas fa-trash me-2"></i>Supprimer
            </button>
        </div>
    </div>
@endsection

@section('content')
<div class="py-4">
    <div class="container-fluid">
        <div class="row g-4">
            <!-- Aperçu de l'image -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom p-4">
                        <h5 class="mb-0">
                            <i class="fas fa-eye text-primary me-2"></i>Aperçu
                        </h5>
                    </div>
                    <div class="card-body text-center p-4">
                        <img src="{{ $media->url }}" 
                             alt="{{ $media->alt_text ?: $media->name }}"
                             class="img-fluid rounded shadow-sm mb-3"
                             style="max-height: 400px;">
                        
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ $media->url }}" 
                               target="_blank" 
                               class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-external-link-alt me-1"></i>Voir en taille réelle
                            </a>
                            <button type="button" 
                                    class="btn btn-outline-success btn-sm"
                                    onclick="copyToClipboard('{{ $media->url }}')">
                                <i class="fas fa-copy me-1"></i>Copier l'URL
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Informations techniques -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-white border-bottom p-4">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle text-info me-2"></i>Informations techniques
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <strong class="d-block mb-1">Nom du fichier :</strong>
                                <code class="small">{{ $media->file_name }}</code>
                            </div>
                            <div class="col-md-6">
                                <strong class="d-block mb-1">Nom original :</strong>
                                <span class="text-muted small">{{ $media->original_name }}</span>
                            </div>
                            <div class="col-md-6">
                                <strong class="d-block mb-1">Taille :</strong>
                                <span class="badge bg-info">{{ $media->formatted_size }}</span>
                            </div>
                            <div class="col-md-6">
                                <strong class="d-block mb-1">Type MIME :</strong>
                                <span class="text-muted small">{{ $media->mime_type }}</span>
                            </div>
                            @if($media->dimensions)
                                <div class="col-md-6">
                                    <strong class="d-block mb-1">Dimensions :</strong>
                                    <span class="text-muted">{{ $media->dimensions }}</span>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <strong class="d-block mb-1">Uploadé le :</strong>
                                <span class="text-muted small">{{ $media->created_at->format('d/m/Y à H:i') }}</span>
                            </div>
                            <div class="col-md-6">
                                <strong class="d-block mb-1">Par :</strong>
                                <span class="text-muted">{{ $media->uploader->name ?? 'Inconnu' }}</span>
                            </div>
                            @if($media->used_at)
                                <div class="col-md-6">
                                    <strong class="d-block mb-1">Dernière utilisation :</strong>
                                    <span class="text-muted small">{{ $media->used_at->format('d/m/Y à H:i') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulaire d'édition -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom p-4">
                        <h5 class="mb-0">
                            <i class="fas fa-edit text-success me-2"></i>Édition
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('admin.media.update', $media) }}">
                            @csrf
                            @method('PUT')
                            
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="name" class="form-label fw-semibold">
                                        Nom d'affichage
                                    </label>
                                    <input type="text" 
                                           name="name" 
                                           id="name" 
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name', $media->name) }}"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="alt_text" class="form-label fw-semibold">
                                        Texte alternatif (Alt)
                                    </label>
                                    <input type="text" 
                                           name="alt_text" 
                                           id="alt_text" 
                                           class="form-control @error('alt_text') is-invalid @enderror"
                                           value="{{ old('alt_text', $media->alt_text) }}"
                                           placeholder="Description pour l'accessibilité">
                                    @error('alt_text')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="media_category_id" class="form-label fw-semibold">
                                        Catégorie
                                    </label>
                                    <select name="media_category_id" 
                                            id="media_category_id" 
                                            class="form-select @error('media_category_id') is-invalid @enderror">
                                        <option value="">Aucune catégorie</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                    {{ old('media_category_id', $media->media_category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('media_category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="description" class="form-label fw-semibold">
                                        Description
                                    </label>
                                    <textarea name="description" 
                                              id="description" 
                                              class="form-control @error('description') is-invalid @enderror" 
                                              rows="4"
                                              placeholder="Description détaillée du média">{{ old('description', $media->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="url_copy" class="form-label fw-semibold">
                                        URL du fichier
                                    </label>
                                    <div class="input-group">
                                        <input type="text" 
                                               id="url_copy" 
                                               class="form-control font-monospace small" 
                                               value="{{ $media->url }}"
                                               readonly>
                                        <button type="button" 
                                                class="btn btn-outline-secondary"
                                                onclick="copyToClipboard('{{ $media->url }}')">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Enregistrer les modifications
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirmer la suppression
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer ce média ?</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Cette action est irréversible.</strong> Le fichier sera définitivement supprimé du serveur.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form method="POST" action="{{ route('admin.media.destroy', $media) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Supprimer définitivement
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        const alert = document.createElement('div');
        alert.className = 'alert alert-success position-fixed';
        alert.style.cssText = 'top: 20px; right: 20px; z-index: 9999;';
        alert.innerHTML = '<i class="fas fa-check me-2"></i>URL copiée !';
        document.body.appendChild(alert);
        
        setTimeout(() => {
            alert.remove();
        }, 2000);
    });
}

function deleteMediaConfirm() {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endpush