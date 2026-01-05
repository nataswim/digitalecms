@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
        <i class="fas fa-chart-line text-primary me-2"></i>
        Tableau de bord Administration
    </h2>
@endsection

@section('content')
<div class="py-4">
    <div class="container-fluid">
        <!-- Statistiques principales -->
        <div class="row g-4 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1 small">Total Utilisateurs</p>
                                <h3 class="fw-bold mb-0">{{ $stats['total_users'] }}</h3>
                                <small class="text-success">
                                    <i class="fas fa-users me-1"></i>
                                    Tous les utilisateurs
                                </small>
                            </div>
                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 60px; height: 60px;">
                                <i class="fas fa-users text-primary fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1 small">Total Rôles</p>
                                <h3 class="fw-bold mb-0">{{ $stats['total_roles'] }}</h3>
                                <small class="text-info">
                                    <i class="fas fa-shield-alt me-1"></i>
                                    Système de permissions
                                </small>
                            </div>
                            <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 60px; height: 60px;">
                                <i class="fas fa-user-shield text-success fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1 small">Total Permissions</p>
                                <h3 class="fw-bold mb-0">{{ $stats['total_permissions'] }}</h3>
                                <small class="text-warning">
                                    <i class="fas fa-key me-1"></i>
                                    Accès contrôlés
                                </small>
                            </div>
                            <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 60px; height: 60px;">
                                <i class="fas fa-key text-warning fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1 small">Rôles Actifs</p>
                                <h3 class="fw-bold mb-0">{{ $stats['active_roles'] }}</h3>
                                <small class="text-success">
                                    <i class="fas fa-check-circle me-1"></i>
                                    Sur {{ $stats['total_roles'] }} rôles
                                </small>
                            </div>
                            <div class="bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 60px; height: 60px;">
                                <i class="fas fa-shield-alt text-info fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Utilisateurs récents -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="fas fa-user-clock text-primary me-2"></i>
                                Utilisateurs récents
                            </h5>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-primary">
                                Voir tout
                            </a>
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
                                        <th class="px-4 py-3">Inscription</th>
                                        <th class="px-4 py-3">Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($stats['recent_users'] as $user)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center">
                                                @if($user->avatar)
                                                    <img src="{{ asset('storage/' . $user->avatar) }}" 
                                                         alt="{{ $user->name }}" 
                                                         class="rounded-circle me-2"
                                                         style="width: 32px; height: 32px; object-fit: cover;">
                                                @else
                                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center me-2" 
                                                         style="width: 32px; height: 32px;">
                                                        <span class="text-primary fw-bold small">
                                                            {{ substr($user->name, 0, 1) }}
                                                        </span>
                                                    </div>
                                                @endif
                                                <span class="fw-semibold">{{ $user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">{{ $user->email }}</td>
                                        <td class="px-4 py-3">
                                            @if($user->role)
                                                <span class="badge bg-primary-subtle text-primary">
                                                    {{ $user->role->name }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            <small class="text-muted">
                                                {{ $user->created_at->diffForHumans() }}
                                            </small>
                                        </td>
                                        <td class="px-4 py-3">
                                            @if($user->is_active)
                                                <span class="badge bg-success-subtle text-success">Actif</span>
                                            @else
                                                <span class="badge bg-secondary-subtle text-secondary">Inactif</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            Aucun utilisateur récent
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Distribution des rôles -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom p-4">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-pie text-primary me-2"></i>
                            Distribution des rôles
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        @foreach($stats['users_by_role'] as $role)
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-semibold">{{ $role->name }}</span>
                                <span class="badge bg-primary-subtle text-primary">
                                    {{ $role->users_count }}
                                </span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar" 
                                     role="progressbar" 
                                     style="width: {{ $stats['total_users'] > 0 ? ($role->users_count / $stats['total_users']) * 100 : 0 }}%"
                                     aria-valuenow="{{ $role->users_count }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="{{ $stats['total_users'] }}">
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="mt-4">
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-cog me-2"></i>Gérer les rôles
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Actions rapides -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-white border-bottom p-4">
                        <h5 class="mb-0">
                            <i class="fas fa-bolt text-warning me-2"></i>
                            Actions rapides
                        </h5>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.users.create') }}" class="btn btn-outline-primary text-start">
                                <i class="fas fa-user-plus me-2"></i>Nouvel utilisateur
                            </a>
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-outline-success text-start">
                                <i class="fas fa-shield-alt me-2"></i>Nouveau rôle
                            </a>
                            <a href="{{ route('admin.permissions.create') }}" class="btn btn-outline-warning text-start">
                                <i class="fas fa-key me-2"></i>Nouvelle permission
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.table tbody tr {
    transition: background-color 0.2s ease;
}

.table tbody tr:hover {
    background-color: rgba(13, 110, 253, 0.05);
}

.progress-bar {
    transition: width 0.6s ease;
}
</style>
@endpush