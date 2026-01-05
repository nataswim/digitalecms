{{-- resources/views/admin/roles/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Détails du rôle')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
            <i class="fas fa-user-shield text-primary me-2"></i>
            Détails du rôle
        </h2>
        <div class="d-flex gap-2">
            @if(auth()->user()->hasPermission('roles.manage'))
            <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-primary">
                <i class="fas fa-edit me-2"></i>Modifier
            </a>
            @endif
            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Retour
            </a>
        </div>
    </div>
@endsection

@section('content')
<div class="py-4">
    <div class="container-fluid">
        <div class="row g-4">
            <!-- Informations du rôle -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="mb-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center shadow"
                                 style="width: 100px; height: 100px;">
                                <i class="fas fa-user-shield text-primary" style="font-size: 2.5rem;"></i>
                            </div>
                        </div>
                        
                        <h4 class="fw-bold mb-2">{{ $role->name }}</h4>
                        <p class="text-muted mb-1">{{ $role->slug }}</p>
                        
                        @if($role->is_active)
                        <div class="mb-3">
                            <span class="badge bg-success px-3 py-2">
                                <i class="fas fa-check me-1"></i>Actif
                            </span>
                        </div>
                        @else
                        <div class="mb-3">
                            <span class="badge bg-secondary px-3 py-2">
                                <i class="fas fa-times me-1"></i>Inactif
                            </span>
                        </div>
                        @endif
                        
                        @if($role->description)
                        <div class="alert alert-info bg-info bg-opacity-10 border-0 text-start">
                            <small class="text-muted d-block mb-1">
                                <i class="fas fa-info-circle me-1"></i>Description
                            </small>
                            <p class="mb-0">{{ $role->description }}</p>
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
                                    <i class="fas fa-users me-2"></i>Utilisateurs
                                </span>
                                <strong class="badge bg-primary-subtle text-primary">
                                    {{ $role->users->count() }}
                                </strong>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="text-muted">
                                    <i class="fas fa-key me-2"></i>Permissions
                                </span>
                                <strong class="badge bg-success-subtle text-success">
                                    {{ $role->permissions->count() }}
                                </strong>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="text-muted">
                                    <i class="fas fa-calendar-alt me-2"></i>Créé le
                                </span>
                                <strong>{{ $role->created_at->format('d/m/Y') }}</strong>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="text-muted">
                                    <i class="fas fa-clock me-2"></i>Modifié le
                                </span>
                                <strong>{{ $role->updated_at->format('d/m/Y') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Permissions et Utilisateurs -->
            <div class="col-lg-8">
                <!-- Permissions -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom p-4">
                        <h5 class="mb-0">
                            <i class="fas fa-key text-primary me-2"></i>
                            Permissions ({{ $role->permissions->count() }})
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        @if($role->permissions->count() > 0)
                            @php
                                $permissionsByModule = $role->permissions->groupBy('module');
                            @endphp
                            
                            @foreach($permissionsByModule as $module => $modulePermissions)
                            <div class="mb-4">
                                <div class="bg-primary bg-opacity-10 rounded p-3 mb-3">
                                    <h6 class="mb-0 text-primary">
                                        <i class="fas fa-folder me-2"></i>
                                        {{ ucfirst($module ?: 'Général') }}
                                        <span class="badge bg-primary-subtle text-primary ms-2">
                                            {{ $modulePermissions->count() }}
                                        </span>
                                    </h6>
                                </div>
                                
                                <div class="row g-2">
                                    @foreach($modulePermissions as $permission)
                                    <div class="col-md-6">
                                        <div class="border rounded p-3">
                                            <div class="d-flex align-items-start">
                                                <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                                <div>
                                                    <div class="fw-semibold">{{ $permission->name }}</div>
                                                    @if($permission->description)
                                                    <small class="text-muted d-block">{{ $permission->description }}</small>
                                                    @endif
                                                    <small class="text-muted">
                                                        <code>{{ $permission->slug }}</code>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-key fa-3x text-muted opacity-25 mb-3"></i>
                                <p class="text-muted mb-0">Aucune permission attribuée à ce rôle</p>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Utilisateurs -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="fas fa-users text-primary me-2"></i>
                                Utilisateurs ({{ $role->users->count() }})
                            </h5>
                            @if(auth()->user()->hasPermission('users.view') && $role->users->count() > 0)
                            <a href="{{ route('admin.users.index', ['role' => $role->id]) }}" class="btn btn-sm btn-outline-primary">
                                Voir tous
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @if($role->users->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="px-4 py-3">Utilisateur</th>
                                            <th class="px-4 py-3">Email</th>
                                            <th class="px-4 py-3">Inscription</th>
                                            <th class="px-4 py-3 text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($role->users->take(10) as $user)
                                        <tr>
                                            <td class="px-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" 
                                                         style="width: 35px; height: 35px;">
                                                        @if($user->avatar)
                                                            <img src="{{ asset('storage/' . $user->avatar) }}" 
                                                                 alt="{{ $user->first_name }}" 
                                                                 class="rounded-circle"
                                                                 style="width: 35px; height: 35px; object-fit: cover;">
                                                        @else
                                                            <span class="text-primary fw-bold small">
                                                                {{ substr($user->first_name ?: $user->name, 0, 1) }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold">{{ $user->first_name }} {{ $user->last_name }}</div>
                                                        <small class="text-muted">{{ '@' . $user->username }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3">{{ $user->email }}</td>
                                            <td class="px-4 py-3">
                                                <small class="text-muted">{{ $user->created_at->format('d/m/Y') }}</small>
                                            </td>
                                            <td class="px-4 py-3 text-end">
                                                @if(auth()->user()->hasPermission('users.view'))
                                                <a href="{{ route('admin.users.show', $user) }}" 
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
                            
                            @if($role->users->count() > 10)
                            <div class="card-footer bg-light text-center p-3">
                                <small class="text-muted">
                                    Et {{ $role->users->count() - 10 }} autre(s) utilisateur(s)
                                </small>
                            </div>
                            @endif
                        @else
                            <div class="p-4 text-center">
                                <i class="fas fa-users fa-3x text-muted opacity-25 mb-3"></i>
                                <p class="text-muted mb-0">Aucun utilisateur avec ce rôle</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
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