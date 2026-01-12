{{-- resources/views/admin/permissions/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Gestion des permissions')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
            <i class="fas fa-key text-primary me-2"></i>
            Gestion des permissions
        </h2>
        @if(auth()->user()->hasPermission('permissions.manage'))
        <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nouvelle permission
        </a>
        @endif
    </div>
@endsection

@section('content')
<div class="py-4">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom p-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h5 class="mb-0">Liste des permissions</h5>
                    </div>
                    <div class="col-md-6">
                        <form method="GET" action="{{ route('admin.permissions.index') }}" class="d-flex gap-2">
                            <select name="module" class="form-select">
                                <option value="">Tous les modules</option>
                                @php
                                    $modules = \App\Models\Permission::distinct()->pluck('module')->filter();
                                @endphp
                                @foreach($modules as $module)
                                    <option value="{{ $module }}" {{ request('module') == $module ? 'selected' : '' }}>
                                        {{ ucfirst($module) }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="text" 
                                   name="search" 
                                   class="form-control" 
                                   placeholder="Rechercher..." 
                                   value="{{ request('search') }}">
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3">Permission</th>
                                <th class="px-4 py-3">Module</th>
                                <th class="px-4 py-3">Description</th>
                                <th class="px-4 py-3">Rôles</th>
                                <th class="px-4 py-3">Statut</th>
                                <th class="px-4 py-3 text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($permissions as $permission)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" 
                                             style="width: 40px; height: 40px;">
                                            <i class="fas fa-key text-success"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold">{{ $permission->name }}</div>
                                            <small class="text-muted">
                                                <code>{{ $permission->slug }}</code>
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    @if($permission->module)
                                        <span class="badge bg-primary-subtle text-primary">
                                            <i class="fas fa-folder me-1"></i>
                                            {{ ucfirst($permission->module) }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary">
                                            Général
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <p class="mb-0 text-muted small">
                                        {{ $permission->description ?? 'Aucune description' }}
                                    </p>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-user-shield text-muted me-2"></i>
                                        <span class="badge bg-info-subtle text-info">
                                            {{ $permission->roles_count }} rôle(s)
                                        </span>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    @if($permission->is_active)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check me-1"></i>Actif
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-times me-1"></i>Inactif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" 
                                                type="button" 
                                                data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            @if(auth()->user()->hasPermission('permissions.manage'))
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.permissions.show', $permission) }}">
                                                    <i class="fas fa-eye text-info me-2"></i>Voir
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.permissions.edit', $permission) }}">
                                                    <i class="fas fa-edit text-primary me-2"></i>Modifier
                                                </a>
                                            </li>
                                            
                                            @if($permission->roles->count() == 0)
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.permissions.destroy', $permission) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette permission ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="fas fa-trash me-2"></i>Supprimer
                                                    </button>
                                                </form>
                                            </li>
                                            @endif
                                            @endif
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <i class="fas fa-key fa-3x text-muted opacity-25 mb-3"></i>
                                    <p class="text-muted mb-0">Aucune permission trouvée</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            @if($permissions->hasPages())
            <div class="card-footer bg-white border-top p-4">
                {{ $permissions->links() }}
            </div>
            @endif
        </div>
        
        <!-- Statistiques par module -->
        @php
            $allPermissions = \App\Models\Permission::with('roles')->get();
            $permissionsByModule = $allPermissions->groupBy('module');
        @endphp
        
        @if($permissionsByModule->count() > 0)
        <div class="row g-4 mt-4">
            @foreach($permissionsByModule->take(4) as $module => $modulePermissions)
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm hover-lift">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 50px; height: 50px;">
                                <i class="fas fa-folder text-primary"></i>
                            </div>
                            <span class="badge bg-primary-subtle text-primary">
                                {{ $modulePermissions->count() }}
                            </span>
                        </div>
                        <h6 class="fw-bold mb-1">{{ ucfirst($module ?: 'Général') }}</h6>
                        <p class="text-muted small mb-3">Module de permissions</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                {{ $modulePermissions->where('is_active', true)->count() }} actives
                            </small>
                            <a href="{{ route('admin.permissions.index', ['module' => $module]) }}" 
                               class="btn btn-sm btn-outline-primary">
                                Voir
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
.table tbody tr {
    transition: background-color 0.2s ease;
}

.table tbody tr:hover {
    background-color: rgba(13, 110, 253, 0.05);
}

.hover-lift {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

.dropdown-item {
    transition: all 0.2s ease;
}

.dropdown-item:hover {
    background-color: rgba(13, 110, 253, 0.1);
    padding-left: 1.5rem;
}

code {
    background-color: #f8f9fa;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.875em;
}
</style>
@endpush