{{-- resources/views/admin/permissions/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Créer une permission')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
            <i class="fas fa-key text-primary me-2"></i>
            Créer une permission
        </h2>
        <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-secondary">
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
                    <div class="card-header bg-white border-bottom p-4">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle text-primary me-2"></i>
                            Informations de la permission
                        </h5>
                    </div>
                    
                    <form action="{{ route('admin.permissions.store') }}" method="POST">
                        @csrf
                        
                        <div class="card-body p-4">
                            <div class="row g-4">
                                <!-- Nom -->
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-semibold">
                                        Nom de la permission <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-tag"></i>
                                        </span>
                                        <input type="text" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name') }}" 
                                               placeholder="Ex: Voir Programmes"
                                               required>
                                    </div>
                                    @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Slug -->
                                <div class="col-md-6">
                                    <label for="slug" class="form-label fw-semibold">
                                        Slug <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-link"></i>
                                        </span>
                                        <input type="text" 
                                               class="form-control @error('slug') is-invalid @enderror" 
                                               id="slug" 
                                               name="slug" 
                                               value="{{ old('slug') }}" 
                                               placeholder="Ex: programs.view"
                                               required>
                                    </div>
                                    <small class="text-muted">Format: module.action (ex: users.create)</small>
                                    @error('slug')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Module -->
                                <div class="col-md-6">
                                    <label for="module" class="form-label fw-semibold">
                                        Module
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-folder"></i>
                                        </span>
                                        <input type="text" 
                                               list="modules" 
                                               class="form-control @error('module') is-invalid @enderror" 
                                               id="module" 
                                               name="module" 
                                               value="{{ old('module') }}" 
                                               placeholder="Ex: programs">
                                    </div>
                                    <datalist id="modules">
                                        @foreach($modules as $existingModule)
                                            <option value="{{ $existingModule }}">
                                        @endforeach
                                    </datalist>
                                    <small class="text-muted">Regroupement logique (users, programs, exercises...)</small>
                                    @error('module')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Statut -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold d-block">
                                        Statut
                                    </label>
                                    <div class="form-check form-switch mt-2">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               id="is_active" 
                                               name="is_active" 
                                               value="1" 
                                               {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Permission active
                                        </label>
                                    </div>
                                </div>
                                
                                <!-- Description -->
                                <div class="col-12">
                                    <label for="description" class="form-label fw-semibold">
                                        Description
                                    </label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" 
                                              name="description" 
                                              rows="3" 
                                              placeholder="Description de la permission...">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Exemples de permissions -->
                            <div class="alert alert-info bg-info bg-opacity-10 border-0 mt-4">
                                <h6 class="alert-heading">
                                    <i class="fas fa-lightbulb me-2"></i>
                                    Exemples de permissions
                                </h6>
                                <hr>
                                <div class="row small">
                                    <div class="col-md-6">
                                        <strong>Utilisateurs :</strong>
                                        <ul class="mb-0">
                                            <li><code>users.view</code> - Voir utilisateurs</li>
                                            <li><code>users.create</code> - Créer utilisateurs</li>
                                            <li><code>users.edit</code> - Modifier utilisateurs</li>
                                            <li><code>users.delete</code> - Supprimer utilisateurs</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Programmes :</strong>
                                        <ul class="mb-0">
                                            <li><code>programs.view</code> - Voir programmes</li>
                                            <li><code>programs.create</code> - Créer programmes</li>
                                            <li><code>programs.publish</code> - Publier programmes</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer bg-white border-top p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Annuler
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Créer la permission
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.input-group-text {
    background-color: #f8f9fa;
    border-right: none;
}

.input-group .form-control {
    border-left: none;
}

.input-group .form-control:focus {
    border-left: none;
    box-shadow: none;
}

.input-group:focus-within .input-group-text {
    border-color: #86b7fe;
}

code {
    background-color: #f8f9fa;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.875em;
    color: #d63384;
}
</style>
@endpush

@push('scripts')
<script>
// Auto-génération du slug
document.getElementById('name').addEventListener('input', function(e) {
    const name = e.target.value;
    const module = document.getElementById('module').value || 'general';
    
    // Extraire l'action du nom (dernier mot)
    const words = name.trim().split(' ');
    const action = words[words.length - 1]
        .toLowerCase()
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .replace(/[^a-z0-9]+/g, '');
    
    // Générer le slug: module.action
    const slug = `${module}.${action}`;
    document.getElementById('slug').value = slug;
});

// Mise à jour du slug quand le module change
document.getElementById('module').addEventListener('input', function(e) {
    const module = e.target.value
        .toLowerCase()
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .replace(/[^a-z0-9]+/g, '');
    
    const currentSlug = document.getElementById('slug').value;
    const action = currentSlug.split('.').pop();
    
    if (module && action) {
        document.getElementById('slug').value = `${module}.${action}`;
    }
});
</script>
@endpush