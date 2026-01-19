{{-- Utilisateurs - Index avec Actions Rapides --}}
@extends('layouts.app')

@section('title', 'Gestion des utilisateurs')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
            <i class="fas fa-users text-primary me-2"></i>
            Gestion des utilisateurs
        </h2>
        @if(auth()->user()->hasPermission('users.create'))
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nouvel utilisateur
        </a>
        @endif
    </div>
@endsection

@section('content')
<div class="py-4">
    <div class="container-fluid">
        {{-- ACTIONS RAPIDES --}}
        <div class="row g-3 mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body p-4 text-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 60px; height: 60px;">
                            <i class="fas fa-users fa-lg text-primary"></i>
                        </div>
                        <h6 class="fw-bold mb-2">Tous les utilisateurs</h6>
                        <p class="text-muted small mb-3">Liste complète des utilisateurs</p>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-primary w-100">
                            <i class="fas fa-arrow-right me-1"></i>Voir tout
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body p-4 text-center">
                        <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 60px; height: 60px;">
                            <i class="fas fa-user-plus fa-lg text-success"></i>
                        </div>
                        <h6 class="fw-bold mb-2">Nouvel utilisateur</h6>
                        <p class="text-muted small mb-3">Créer un compte utilisateur</p>
                        @if(auth()->user()->hasPermission('users.create'))
                        <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-outline-success w-100">
                            <i class="fas fa-plus me-1"></i>Créer
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body p-4 text-center">
                        <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 60px; height: 60px;">
                            <i class="fas fa-user-shield fa-lg text-info"></i>
                        </div>
                        <h6 class="fw-bold mb-2">Rôles</h6>
                        <p class="text-muted small mb-3">Gérer les rôles</p>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-outline-info w-100">
                            <i class="fas fa-arrow-right me-1"></i>Gérer
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body p-4 text-center">
                        <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 60px; height: 60px;">
                            <i class="fas fa-key fa-lg text-warning"></i>
                        </div>
                        <h6 class="fw-bold mb-2">Permissions</h6>
                        <p class="text-muted small mb-3">Gérer les permissions</p>
                        <a href="{{ route('admin.permissions.index') }}" class="btn btn-sm btn-outline-warning w-100">
                            <i class="fas fa-arrow-right me-1"></i>Gérer
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- LISTE DES UTILISATEURS --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom p-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h5 class="mb-0">Liste des utilisateurs</h5>
                    </div>
                    <div class="col-md-6">
                        <form method="GET" action="{{ route('admin.users.index') }}" class="d-flex gap-2">
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
                                <th class="px-4 py-3">Utilisateur</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Rôle</th>
                                <th class="px-4 py-3">Dernière connexion</th>
                                <th class="px-4 py-3">Inscription</th>
                                <th class="px-4 py-3 text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" 
                                             style="width: 40px; height: 40px;">
                                            @if($user->avatar)
                                                <img src="{{ asset('storage/' . $user->avatar) }}" 
                                                     alt="{{ $user->first_name }}" 
                                                     class="rounded-circle"
                                                     style="width: 40px; height: 40px; object-fit: cover;">
                                            @else
                                                <span class="text-primary fw-bold">
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
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-envelope text-muted me-2"></i>
                                        {{ $user->email }}
                                        @if($user->email_verified_at)
                                            <i class="fas fa-check-circle text-success ms-2" 
                                               title="Email vérifié"></i>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    @if($user->role)
                                        <span class="badge bg-primary-subtle text-primary">
                                            {{ $user->role->name }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary">
                                            Sans rôle
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @if($user->last_login_at)
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ $user->last_login_at->diffForHumans() }}
                                        </small>
                                    @else
                                        <small class="text-muted">Jamais</small>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <small class="text-muted">
                                        {{ $user->created_at->format('d/m/Y') }}
                                    </small>
                                </td>
                                <td class="px-4 py-3 text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" 
                                                type="button" 
                                                data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            @if(auth()->user()->hasPermission('users.view'))
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.users.show', $user) }}">
                                                    <i class="fas fa-eye text-info me-2"></i>Voir
                                                </a>
                                            </li>
                                            @endif
                                            
                                            @if(auth()->user()->hasPermission('users.edit'))
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.users.edit', $user) }}">
                                                    <i class="fas fa-edit text-primary me-2"></i>Modifier
                                                </a>
                                            </li>
                                            @endif
                                            
                                            @if(auth()->user()->hasPermission('users.delete') && $user->id !== auth()->id())
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.users.destroy', $user) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="fas fa-trash me-2"></i>Supprimer
                                                    </button>
                                                </form>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <i class="fas fa-users fa-3x text-muted opacity-25 mb-3"></i>
                                    <p class="text-muted mb-0">Aucun utilisateur trouvé</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            @if($users->hasPages())
            <div class="card-footer bg-white border-top p-4">
                {{ $users->links() }}
            </div>
            @endif
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

.dropdown-item {
    transition: all 0.2s ease;
}

.dropdown-item:hover {
    background-color: rgba(13, 110, 253, 0.1);
    padding-left: 1.5rem;
}

.hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
}
</style>
@endpush