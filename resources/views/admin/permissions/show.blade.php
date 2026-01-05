{{-- resources/views/admin/permissions/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Détails de la permission')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
            <i class="fas fa-key text-primary me-2"></i>
            Détails de la permission
        </h2>
        <div class="d-flex gap-2">
            @if(auth()->user()->hasPermission('permissions.manage'))
            <a href="{{ route('admin.permissions.edit', $permission) }}" class="btn btn-primary">
                <i class="fas fa-edit me-2"></i>Modifier
            </a>
            @endif
            <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Retour
            </a>
        </div>
    </div>
@endsection

@section('content')
<div class="py-4">
    <div class="container-fluid">
        <div class="row g-4">
            <!-- Informations de la permission -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="mb-4">
                            <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center shadow"
                                 style="width: 100px; height: 100px;">
                                <i class="fas fa-key text-success" style="font-size: 2.5rem;"></i>
                            </div>
                        </div>
                        
                        <h4 class="fw-bold mb-2">{{ $permission->name }}</h4>
                        <p class="text-muted mb-1">
                            <code>{{ $permission->slug }}</code>
                        </p>
                        
                        @if($permission->is_active)
                        <div class="mb-3">
                            <span class="badge bg-success px-3 py-2">
                                <i class="fas fa-check me-1"></i>Active
                            </span>
                        </div>
                        @else
                        <div class="mb-3">
                            <span class="badge bg-secondary px-3 py-2">
                                <i class="fas fa-times me-1"></i>Inactive
                            </span>
                        </div>
                        @endif
                        
                        @if($permission->module)
                        <div class="mb-3">
                            <span class="badge bg-primary-subtle text-primary px-3 py-2">
                                <i class="fas fa-folder me-1"></i>
                                {{ ucfirst($permission->module) }}
                            </span>
                        </div>
                        @endif
                        
                        @if($permission->description)
                        <div class="alert alert-info bg-info bg-opacity-10 border-0 text-start">
                            <small class="text-muted d-block mb-1">
                                <i class="fas fa-info-circle me-1"></i>Description
                            </small>
                            <p class="mb-0">{{ $permission->description }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Statistiques -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-white border-bottom p-3">
                        <h6 class="mb-0">
                            <i class="fas fa-chart-bar text-primary me-2"></i>
                            Statistiques
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="text-muted">
                                    <i class="fas fa-user-shield me-2"></i>Rôles
                                </span>
                                <strong class="badge bg-primary-subtle text-primary">
                                    {{ $permission->roles->count() }}
                                </strong>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="text-muted">
                                    <i class="fas fa-calendar-alt me-2"></i>Créée le
                                </span>
                                <strong>{{ $permission->created_at->format('d/m/Y') }}</strong>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="text-muted">
                                    <i class="fas fa-clock me-2"></i>Modifiée le
                                </span>
                                <strong>{{ $permission->updated_at->format('d/m/Y') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Rôles utilisant cette permission -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="fas fa-user-shield text-primary me-2"></i>
                                Rôles ({{ $permission->roles->count() }})
                            </h5>
                            @if(auth()->user()->hasPermission('roles.manage') && $permission->roles->count() > 0)
                            <a href="{{ route('admin.roles.index', ['permission' => $permission->id]) }}" 
                               class="btn btn-sm btn-outline-primary">
                                Voir tous
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body p-4">
                        @if($permission->roles->count() > 0)
                            <div class="row g-3">
                                @foreach($permission->roles as $role)
                                <div class="col-md-6">
                                    <div class="card border hover-bg">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-start justify-content-between">
                                                <div class="d-flex align-items-center flex-grow-1">
                                                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" 
                                                         style="width: 40px; height: 40px;">
                                                        <i class="fas fa-user-shield text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1 fw-semibold">{{ $role->name }}</h6>
                                                        <small class="text-muted d-block">{{ $role->slug }}</small>
                                                        @if($role->description)
                                                        <small class="text-muted d-block mt-1">
                                                            {{ Str::limit($role->description, 50) }}
                                                        </small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column align-items-end gap-2">
                                                    @if($role->is_active)
                                                        <span class="badge bg-success-subtle text-success">Actif</span>
                                                    @endif
                                                    <span class="badge bg-info-subtle text-info">
                                                        {{ $role->users->count() }} user(s)
                                                    </span>
                                                    @if(auth()->user()->hasPermission('roles.manage'))
                                                    <a href="{{ route('admin.roles.show', $role) }}" 
                                                       class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-user-shield fa-3x text-muted opacity-25 mb-3"></i>
                                <p class="text-muted mb-0">Aucun rôle n'utilise cette permission</p>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Autres permissions du même module -->
                @if($permission->module)
                @php
                    $relatedPermissions = \App\Models\Permission::where('module', $permission->module)
                        ->where('id', '!=', $permission->id)
                        ->where('is_active', true)
                        ->get();
                @endphp
                
                @if($relatedPermissions->count() > 0)
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-white border-bottom p-4">
                        <h5 class="mb-0">
                            <i class="fas fa-folder text-primary me-2"></i>
                            Autres permissions du module "{{ ucfirst($permission->module) }}"
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="px-4 py-3">Permission</th>
                                        <th class="px-4 py-3">Description</th>
                                        <th class="px-4 py-3">Rôles</th>
                                        <th class="px-4 py-3 text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($relatedPermissions as $relatedPermission)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="fw-semibold">{{ $relatedPermission->name }}</div>
                                            <small class="text-muted">
                                                <code>{{ $relatedPermission->slug }}</code>
                                            </small>
                                        </td>
                                        <td class="px-4 py-3">
                                            <small class="text-muted">
                                                {{ $relatedPermission->description ?? 'Aucune description' }}
                                            </small>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="badge bg-primary-subtle text-primary">
                                                {{ $relatedPermission->roles->count() }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-end">
                                            @if(auth()->user()->hasPermission('permissions.manage'))
                                            <a href="{{ route('admin.permissions.show', $relatedPermission) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.hover-bg {
    transition: background-color 0.2s ease, transform 0.2s ease;
}

.hover-bg:hover {
    background-color: rgba(13, 110, 253, 0.05);
    transform: translateY(-2px);
}

.list-group-item {
    transition: background-color 0.2s ease;
}

.list-group-item:hover {
    background-color: rgba(13, 110, 253, 0.05);
}

.table tbody tr {
    transition: background-color 0.2s ease;
}

.table tbody tr:hover {
    background-color: rgba(13, 110, 253, 0.05);
}

code {
    background-color: #f8f9fa;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.875em;
}
</style>
@endpush