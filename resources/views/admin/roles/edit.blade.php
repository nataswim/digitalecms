{{-- resources/views/admin/roles/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Modifier le rôle')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
            <i class="fas fa-user-shield text-primary me-2"></i>
            Modifier le rôle
        </h2>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Retour
        </a>
    </div>
@endsection

@section('content')
<div class="py-4">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-4">
                        <!-- Informations du rôle -->
                        <div class="col-lg-5">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-white border-bottom p-4">
                                    <h5 class="mb-0">
                                        <i class="fas fa-info-circle text-primary me-2"></i>
                                        Informations du rôle
                                    </h5>
                                </div>
                                
                                <div class="card-body p-4">
                                    <div class="mb-4">
                                        <label for="name" class="form-label fw-semibold">
                                            Nom du rôle <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-tag"></i>
                                            </span>
                                            <input type="text" 
                                                   class="form-control @error('name') is-invalid @enderror" 
                                                   id="name" 
                                                   name="name" 
                                                   value="{{ old('name', $role->name) }}" 
                                                   placeholder="Ex: Entraîneur Principal"
                                                   required>
                                        </div>
                                        @error('name')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-4">
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
                                                   value="{{ old('slug', $role->slug) }}" 
                                                   placeholder="Ex: manager"
                                                   required>
                                        </div>
                                        <small class="text-muted">Identifiant unique (sans espaces)</small>
                                        @error('slug')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="description" class="form-label fw-semibold">
                                            Description
                                        </label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                                  id="description" 
                                                  name="description" 
                                                  rows="3" 
                                                  placeholder="Description du rôle...">{{ old('description', $role->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               id="is_active" 
                                               name="is_active" 
                                               value="1" 
                                               {{ old('is_active', $role->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="is_active">
                                            Rôle actif
                                        </label>
                                    </div>
                                    
                                    <!-- Statistiques -->
                                    <div class="mt-4 p-3 bg-light rounded">
                                        <h6 class="mb-3">
                                            <i class="fas fa-chart-bar text-primary me-2"></i>
                                            Statistiques
                                        </h6>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Utilisateurs</span>
                                            <strong>{{ $role->users->count() }}</strong>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Permissions actuelles</span>
                                            <strong>{{ $role->permissions->count() }}</strong>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted">Créé le</span>
                                            <strong>{{ $role->created_at->format('d/m/Y') }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Permissions -->
                        <div class="col-lg-7">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-white border-bottom p-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">
                                            <i class="fas fa-key text-primary me-2"></i>
                                            Permissions
                                        </h5>
                                        <div>
                                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="selectAll()">
                                                <i class="fas fa-check-double me-1"></i>Tout sélectionner
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="deselectAll()">
                                                <i class="fas fa-times me-1"></i>Tout désélectionner
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-body p-4">
                                    @php
                                        $permissionsByModule = $permissions->groupBy('module');
                                        $selectedPermissions = old('permissions', $role->permissions->pluck('id')->toArray());
                                    @endphp
                                    
                                    @if($permissionsByModule->count() > 0)
                                        @foreach($permissionsByModule as $module => $modulePermissions)
                                        <div class="mb-4">
                                            <div class="bg-primary bg-opacity-10 rounded p-3 mb-3">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <h6 class="mb-0 text-primary">
                                                        <i class="fas fa-folder me-2"></i>
                                                        {{ ucfirst($module ?: 'Général') }}
                                                    </h6>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="badge bg-primary-subtle text-primary">
                                                            {{ $modulePermissions->whereIn('id', $selectedPermissions)->count() }}/{{ $modulePermissions->count() }}
                                                        </span>
                                                        <button type="button" 
                                                                class="btn btn-sm btn-primary" 
                                                                onclick="toggleModule('{{ $module }}')">
                                                            <i class="fas fa-check me-1"></i>Tout
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row g-2">
                                                @foreach($modulePermissions as $permission)
                                                <div class="col-md-6">
                                                    <div class="form-check p-3 border rounded hover-bg">
                                                        <input class="form-check-input permission-checkbox module-{{ $module }}" 
                                                               type="checkbox" 
                                                               id="permission_{{ $permission->id }}" 
                                                               name="permissions[]" 
                                                               value="{{ $permission->id }}"
                                                               {{ in_array($permission->id, $selectedPermissions) ? 'checked' : '' }}>
                                                        <label class="form-check-label w-100" for="permission_{{ $permission->id }}">
                                                            <div class="fw-semibold">{{ $permission->name }}</div>
                                                            @if($permission->description)
                                                            <small class="text-muted d-block">{{ $permission->description }}</small>
                                                            @endif
                                                        </label>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endforeach
                                    @else
                                        <div class="text-center py-5">
                                            <i class="fas fa-key fa-3x text-muted opacity-25 mb-3"></i>
                                            <p class="text-muted mb-0">Aucune permission disponible</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Boutons d'action -->
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-footer bg-white border-top-0 p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Annuler
                                </a>
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

.hover-bg {
    transition: background-color 0.2s ease;
}

.hover-bg:hover {
    background-color: rgba(13, 110, 253, 0.05);
}

.form-check-input:checked ~ .form-check-label {
    color: #11767e;
}
</style>
@endpush

@push('scripts')
<script>
// Auto-génération du slug
document.getElementById('name').addEventListener('input', function(e) {
    const slug = e.target.value
        .toLowerCase()
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '');
    document.getElementById('slug').value = slug;
});

// Sélectionner toutes les permissions
function selectAll() {
    document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
        checkbox.checked = true;
    });
}

// Désélectionner toutes les permissions
function deselectAll() {
    document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
        checkbox.checked = false;
    });
}

// Toggle module
function toggleModule(module) {
    const checkboxes = document.querySelectorAll('.module-' + module);
    const allChecked = Array.from(checkboxes).every(cb => cb.checked);
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = !allChecked;
    });
}
</script>
@endpush