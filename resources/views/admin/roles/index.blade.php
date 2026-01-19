{{-- Rôles - Index avec Actions Rapides --}}
@extends('layouts.app')

@section('title', 'Gestion des rôles')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
            <i class="fas fa-user-shield text-primary me-2"></i>
            Gestion des rôles
        </h2>
        @if(auth()->user()->hasPermission('roles.manage'))
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nouveau rôle
        </a>
        @endif
    </div>
@endsection

@section('content')
<div class="py-4">
    <div class="container-fluid">
        {{-- ACTIONS RAPIDES --}}
        <div class="row g-3 mb-4">
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body p-4 text-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 60px; height: 60px;">
                            <i class="fas fa-user-shield fa-lg text-primary"></i>
                        </div>
                        <h6 class="fw-bold mb-2">Tous les rôles</h6>
                        <p class="text-muted small mb-3">Liste complète des rôles</p>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-outline-primary w-100">
                            <i class="fas fa-arrow-right me-1"></i>Voir tout
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body p-4 text-center">
                        <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 60px; height: 60px;">
                            <i class="fas fa-plus-circle fa-lg text-success"></i>
                        </div>
                        <h6 class="fw-bold mb-2">Nouveau rôle</h6>
                        <p class="text-muted small mb-3">Créer un nouveau rôle</p>
                        @if(auth()->user()->hasPermission('roles.manage'))
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-outline-success w-100">
                            <i class="fas fa-plus me-1"></i>Créer
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body p-4 text-center">
                        <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 60px; height: 60px;">
                            <i class="fas fa-key fa-lg text-info"></i>
                        </div>
                        <h6 class="fw-bold mb-2">Permissions</h6>
                        <p class="text-muted small mb-3">Gérer les permissions</p>
                        <a href="{{ route('admin.permissions.index') }}" class="btn btn-sm btn-outline-info w-100">
                            <i class="fas fa-arrow-right me-1"></i>Gérer
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Reste du contenu identique à l'original --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom p-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h5 class="mb-0">Liste des rôles</h5>
                    </div>
                    <div class="col-md-6">
                        <form method="GET" action="{{ route('admin.roles.index') }}" class="d-flex gap-2">
                            <input type="text" 
                                   name="search" 
                                   class="form-control" 
                                   placeholder="Rechercher un rôle..." 
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
                                <th class="px-4 py-3">Rôle</th>
                                <th class="px-4 py-3">Description</th>
                                <th class="px-4 py-3">Utilisateurs</th>
                                <th class="px-4 py-3">Permissions</th>
                                <th class="px-4 py-3">Statut</th>
                                <th class="px-4 py-3 text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $role)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" 
                                             style="width: 40px; height: 40px;">
                                            <i class="fas fa-user-shield text-primary"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold">{{ $role->name }}</div>
                                            <small class="text-muted">{{ $role->slug }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <p class="mb-0 text-muted">
                                        {{ $role->description ?? 'Aucune description' }}
                                    </p>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-users text-muted me-2"></i>
                                        <span class="badge bg-primary-subtle text-primary">
                                            {{ $role->users_count }} utilisateur(s)
                                        </span>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-key text-muted me-2"></i>
                                        <span class="badge bg-success-subtle text-success">
                                            {{ $role->permissions->count() }} permission(s)
                                        </span>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    @if($role->is_active)
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
                                            @if(auth()->user()->hasPermission('roles.manage'))
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.roles.show', $role) }}">
                                                    <i class="fas fa-eye text-info me-2"></i>Voir
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.roles.edit', $role) }}">
                                                    <i class="fas fa-edit text-primary me-2"></i>Modifier
                                                </a>
                                            </li>
                                            
                                            @if($role->users_count == 0)
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.roles.destroy', $role) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rôle ?');">
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
                                    <i class="fas fa-user-shield fa-3x text-muted opacity-25 mb-3"></i>
                                    <p class="text-muted mb-0">Aucun rôle trouvé</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            @if($roles->hasPages())
            <div class="card-footer bg-white border-top p-4">
                {{ $roles->links() }}
            </div>
            @endif
        </div>
        
        {{-- Statistiques des rôles --}}
        <div class="row g-4 mt-4">
            @foreach($roles->take(4) as $role)
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm hover-lift">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 50px; height: 50px;">
                                <i class="fas fa-user-shield text-primary"></i>
                            </div>
                            @if($role->is_active)
                                <span class="badge bg-success-subtle text-success">Actif</span>
                            @endif
                        </div>
                        <h6 class="fw-bold mb-1">{{ $role->name }}</h6>
                        <p class="text-muted small mb-3">{{ $role->users_count }} utilisateur(s)</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                {{ $role->permissions->count() }} permissions
                            </small>
                            <a href="{{ route('admin.roles.show', $role) }}" class="btn btn-sm btn-outline-primary">
                                Voir
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
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
</style>
@endpush