{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Tableau de bord
    </h2>
@endsection

@section('content')
<div class="py-4">
    <div class="container-fluid">
        <!-- Cartes statistiques -->
        <div class="row g-4 mb-4">
            @php
                $statsCards = [
                    [
                        'title' => 'Utilisateurs',
                        'value' => $stats['total_users'] ?? 0,
                        'subtitle' => 'Membres inscrits',
                        'icon' => 'fas fa-users',
                        'color' => 'primary',
                        'change' => '+' . ($stats['active_users'] ?? 0) . ' actifs'
                    ],
                    [
                        'title' => 'Rôles',
                        'value' => $stats['total_roles'] ?? 0,
                        'subtitle' => 'Rôles configurés',
                        'icon' => 'fas fa-user-shield',
                        'color' => 'info',
                        'change' => 'Système'
                    ],
                    [
                        'title' => 'Permissions',
                        'value' => $stats['total_permissions'] ?? 0,
                        'subtitle' => 'Permissions actives',
                        'icon' => 'fas fa-key',
                        'color' => 'success',
                        'change' => 'Configurées'
                    ],
                    [
                        'title' => 'Actifs 30j',
                        'value' => $stats['active_users'] ?? 0,
                        'subtitle' => 'Utilisateurs actifs',
                        'icon' => 'fas fa-chart-line',
                        'color' => 'warning',
                        'change' => 'Ce mois'
                    ]
                ];
            @endphp
            
            @foreach($statsCards as $stat)
                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-{{ $stat['color'] }} bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" 
                                     style="width: 50px; height: 50px;">
                                    <i class="{{ $stat['icon'] }} text-{{ $stat['color'] }}"></i>
                                </div>
                                <div class="flex-fill">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h3 class="fw-bold mb-0">{{ number_format($stat['value']) }}</h3>
                                        <span class="badge bg-success-subtle text-success">{{ $stat['change'] }}</span>
                                    </div>
                                    <p class="text-muted mb-0 small">{{ $stat['subtitle'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="row g-4">
            <!-- Utilisateurs récents -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom-0 p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">
                                <i class="fas fa-users text-primary me-2"></i>
                                Utilisateurs récents
                            </h5>
                            @if(auth()->user()->hasPermission('users.view'))
                            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-primary">
                                Voir tout
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @forelse($stats['recent_users'] ?? [] as $user)
                            <div class="d-flex align-items-center p-4 {{ !$loop->last ? 'border-bottom' : '' }}">
                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" 
                                     style="width: 40px; height: 40px;">
                                    <span class="text-primary fw-bold">
                                        {{ substr($user->first_name ?: $user->name, 0, 1) }}
                                    </span>
                                </div>
                                <div class="flex-fill">
                                    <h6 class="mb-1">{{ $user->first_name }} {{ $user->last_name }}</h6>
                                    <div class="d-flex align-items-center text-muted small">
                                        <span>{{ $user->email }}</span>
                                        <span class="mx-2">•</span>
                                        <span>{{ $user->created_at->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-primary-subtle text-primary">
                                        {{ $user->role->name ?? 'Sans rôle' }}
                                    </span>
                                    @if(auth()->user()->hasPermission('users.view'))
                                    <a href="{{ route('admin.users.show', $user) }}" 
                                       class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="p-4 text-center text-muted">
                                <i class="fas fa-users fa-3x mb-3 opacity-25"></i>
                                <p>Aucun utilisateur pour le moment</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            
            <!-- Actions rapides -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom-0 p-4">
                        <h5 class="mb-0">
                            <i class="fas fa-bolt text-warning me-2"></i>
                            Actions rapides
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-grid gap-3">
                            @if(auth()->user()->hasPermission('users.create'))
                            <a href="{{ route('admin.users.create') }}" class="btn btn-primary d-flex align-items-center">
                                <i class="fas fa-user-plus me-2"></i>
                                <div class="text-start">
                                    <div class="fw-semibold">Nouvel utilisateur</div>
                                    <small class="opacity-75">Ajouter un membre</small>
                                </div>
                            </a>
                            @endif
                            
                            @if(auth()->user()->hasPermission('roles.manage'))
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-outline-info d-flex align-items-center">
                                <i class="fas fa-user-shield me-2"></i>
                                <div class="text-start">
                                    <div class="fw-semibold">Nouveau rôle</div>
                                    <small class="opacity-75">Créer un rôle</small>
                                </div>
                            </a>
                            @endif
                            
                            @if(auth()->user()->hasPermission('permissions.manage'))
                            <a href="{{ route('admin.permissions.create') }}" class="btn btn-outline-success d-flex align-items-center">
                                <i class="fas fa-key me-2"></i>
                                <div class="text-start">
                                    <div class="fw-semibold">Nouvelle permission</div>
                                    <small class="opacity-75">Ajouter une permission</small>
                                </div>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Distribution des rôles -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-white border-bottom-0 p-4">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-pie text-info me-2"></i>
                            Distribution des rôles
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        @forelse($stats['roles_distribution'] ?? [] as $role)
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div>
                                    <div class="fw-semibold">{{ $role['name'] }}</div>
                                    <small class="text-muted">{{ $role['count'] }} utilisateur(s)</small>
                                </div>
                                <span class="badge bg-primary">{{ $role['count'] }}</span>
                            </div>
                        @empty
                            <p class="text-muted text-center mb-0">Aucune donnée disponible</p>
                        @endforelse
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
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

.bg-primary-subtle {
    background-color: rgba(13, 110, 253, 0.1);
}

.bg-success-subtle {
    background-color: rgba(25, 135, 84, 0.1);
}

.bg-info-subtle {
    background-color: rgba(13, 202, 240, 0.1);
}

.bg-warning-subtle {
    background-color: rgba(255, 193, 7, 0.1);
}
</style>
@endpush