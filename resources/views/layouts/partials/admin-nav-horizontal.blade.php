{{-- Navigation Admin Horizontale - Digital’SOS (Digital Sport Organisation System) - Plateforme tout-en-un --}}
<nav class="navbar navbar-expand-lg" style="border-left: 20px solid #f9f5f4;border-right: 20px solid #f9f5f4;border-bottom: 5px solid #4fa79b;border-top: 5px solid #4fa79b;">    



<div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('assets/images/Digital-sOs-logo13.png') }}"
                alt="{{ config('app.name') }}"
                style="height: 80px; width: auto;"
                onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
            <span class="fw-bold text-primary ms-2" style="display: none;">{{ config('app.name') }}</span>
        </a>

        <!-- Bouton burger pour mobile -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu principal -->
        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active fw-bold text-primary' : '' }}" 
                       href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                </li>

                <!-- Médias -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.media.*') ? 'active fw-bold text-primary' : '' }}" 
                       href="{{ route('admin.media.index') }}">
                        <i class="fas fa-images me-2"></i>Médias
                        @php 
                            $mediaCount = \App\Models\Media::count(); 
                        @endphp
                        @if($mediaCount > 0)
                        <span class="badge bg-success ms-1">{{ $mediaCount }}</span>
                        @endif
                    </a>
                </li>

                <!-- Fiches (dropdown) -->
                <li class="nav-item dropdown">
                    @php 
                        $fichesActive = request()->routeIs('admin.fiches.*'); 
                    @endphp
                    <a class="nav-link dropdown-toggle {{ $fichesActive ? 'active fw-bold text-primary' : '' }}" 
                       href="#" 
                       role="button" 
                       data-bs-toggle="dropdown" 
                       aria-expanded="false">
                        <i class="fas fa-file-alt me-2"></i>Fiches
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('admin.fiches.index', 'admin.fiches.create', 'admin.fiches.edit', 'admin.fiches.show') ? 'active' : '' }}" 
                               href="{{ route('admin.fiches.index') }}">
                                <i class="fas fa-list-alt fa-fw me-2"></i>Toutes les fiches
                                @php 
                                    $fichesCount = \App\Models\Fiche::count(); 
                                @endphp
                                @if($fichesCount > 0)
                                <span class="badge bg-success ms-2">{{ $fichesCount }}</span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.fiches.create') }}">
                                <i class="fas fa-plus-circle fa-fw me-2"></i>Créer une fiche
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Utilisateurs (dropdown) - Réservé admin -->
                @if(auth()->user()->hasRole('admin'))
                <li class="nav-item dropdown">
                    @php 
                        $usersActive = request()->routeIs('admin.users.*', 'admin.roles.*', 'admin.permissions.*'); 
                    @endphp
                    <a class="nav-link dropdown-toggle {{ $usersActive ? 'active fw-bold text-primary' : '' }}" 
                       href="#" 
                       role="button" 
                       data-bs-toggle="dropdown" 
                       aria-expanded="false">
                        <i class="fas fa-users me-2"></i>Utilisateurs
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" 
                               href="{{ route('admin.users.index') }}">
                                <i class="fas fa-users fa-fw me-2"></i>Tous les utilisateurs
                                @php 
                                    $usersCount = \App\Models\User::count(); 
                                @endphp
                                @if($usersCount > 0)
                                <span class="badge bg-info ms-2">{{ $usersCount }}</span>
                                @endif
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><h6 class="dropdown-header">Accès & Permissions</h6></li>
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}" 
                               href="{{ route('admin.roles.index') }}">
                                <i class="fas fa-user-shield fa-fw me-2"></i>Rôles
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}" 
                               href="{{ route('admin.permissions.index') }}">
                                <i class="fas fa-key fa-fw me-2"></i>Permissions
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

            </ul>

            <!-- Actions utilisateur (droite) -->
            <div class="d-flex align-items-center gap-2">
                
                <!-- Notifications -->
                <div class="dropdown">
                    <button class="btn btn-outline-secondary btn-sm position-relative rounded-circle" 
                            style="width: 36px; height: 36px;" 
                            data-bs-toggle="dropdown"
                            aria-label="Notifications">
                        <i class="fas fa-bell"></i>
                        @php
                            $notificationsCount = 0; // À adapter selon votre système de notifications
                        @endphp
                        @if($notificationsCount > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                            {{ $notificationsCount }}
                        </span>
                        @endif
                    </button>
                    <div class="dropdown-menu dropdown-menu-end p-0" style="width: 320px;">
                        <div class="p-3 border-bottom bg-light">
                            <h6 class="mb-0">Notifications</h6>
                        </div>
                        <div class="p-3">
                            <p class="text-muted text-center mb-0">Aucune notification</p>
                        </div>
                    </div>
                </div>
                
                <!-- Menu utilisateur -->
                <div class="dropdown">
                    <button class="btn btn-outline-primary btn-sm dropdown-toggle d-flex align-items-center" 
                            data-bs-toggle="dropdown"
                            aria-label="Menu utilisateur">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" 
                             style="width: 28px; height: 28px; font-size: 12px;">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <span class="d-none d-xl-inline">{{ auth()->user()->name }}</span>
                    </button>
                    
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="dropdown-header">
                            <strong>{{ auth()->user()->name }}</strong><br>
                            <small class="text-muted">{{ auth()->user()->email }}</small>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.profile.show') }}">
                                <i class="fas fa-user me-2"></i>Mon profil
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('home') }}">
                                <i class="fas fa-home me-2"></i>Voir le site
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i>Se déconnecter
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

{{-- CSS personnalisé pour la navigation --}}
@push('styles')
<style>
    /* Navigation */
    .navbar-nav .nav-link {
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        border-radius: 0.375rem;
    }

    .navbar-nav .nav-link:hover:not(.active) {
        background-color: rgba(0, 172, 192, 0.1);
        color: #00acc0 !important;
    }

    .navbar-nav .nav-link.active {
        background-color: rgba(0, 172, 192, 0.15);
    }

    /* Dropdown menu */
    .dropdown-menu {
        border: none;
        border-radius: 0.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        padding: 0.5rem;
        animation: slideDown 0.2s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-item {
        border-radius: 0.375rem;
        padding: 0.6rem 1rem;
        transition: all 0.3s ease;
    }

    .dropdown-item:hover {
        background-color: rgba(0, 172, 192, 0.1);
        color: #00acc0;
        transform: translateX(5px);
    }

    .dropdown-item.active {
        background-color: rgba(0, 172, 192, 0.2);
        color: #00acc0;
    }

    .dropdown-header {
        font-size: 0.75rem;
        text-transform: uppercase;
        font-weight: 600;
        color: #6c757d;
        letter-spacing: 0.5px;
    }

    /* Badge */
    .badge {
        font-size: 0.65rem;
        padding: 0.25rem 0.5rem;
    }

    /* Avatar circle */
    .rounded-circle {
        font-weight: 600;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .navbar-nav .nav-link {
            margin: 0.25rem 0;
        }

        .dropdown-menu {
            border: none;
            box-shadow: none;
            padding-left: 1rem;
        }
    }
</style>
@endpush
