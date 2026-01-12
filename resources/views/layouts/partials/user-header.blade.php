{{-- Header User - Digital’SOS (Digital Sport Organisation System) - Plateforme tout-en-un (Utilisateurs standards) --}}
<nav class="navbar navbar-expand-lg shadow-sm sticky-top" style="border-left: 20px solid #f9f5f4;border-right: 20px solid #f9f5f4;background-color: #fff !important;border-bottom: 20px solid #00acc0;border-top: 20px solid #00acc0;">
    <div class="container-lg">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('assets/images/Digital-sOs-logo13.png') }}"
                alt="{{ config('app.name') }}"
                class="img-fluid"
                style="height: 80px; width: auto;"
                onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
            <span class="fw-bold text-primary ms-2 fs-4" style="display: none;">{{ config('app.name') }}</span>
        </a>

        <!-- Toggle mobile -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#userNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="userNav">
            <!-- Navigation principale -->
            <ul class="navbar-nav me-auto ms-lg-4">
                
                <!-- Mon Espace -->
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 {{ request()->routeIs('dashboard') ? 'active bg-primary text-white' : 'text-dark' }}"
                        href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i>Mon Espace
                    </a>
                </li>

                <!-- Fiches -->
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 {{ request()->routeIs('fiches.*') ? 'active bg-primary text-white' : 'text-dark' }}"
                        href="{{ route('fiches.index') }}">
                        <i class="fas fa-file-alt me-2"></i>Fiches
                    </a>
                </li>

                <!-- Retour au site -->
                <li class="nav-item">
                    <a class="nav-link px-3 py-2"
                        href="{{ route('home') }}">
                        <i class="fas fa-home me-2"></i>Accueil
                    </a>
                </li>

            </ul>

            <!-- Section utilisateur (droite) -->
            <div class="d-flex align-items-center">
                
                @if(auth()->user()->hasRole('admin'))
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-danger me-3 px-4">
                    <i class="fas fa-cog me-1"></i>Administration
                </a>
                @endif

                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle d-flex align-items-center"
                        type="button"
                        id="userDropdown"
                        data-bs-toggle="dropdown">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                            style="width: 32px; height: 32px; font-size: 14px;">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2">
                        <li class="dropdown-header">
                            <strong>{{ auth()->user()->name }}</strong><br>
                            <small class="text-muted">{{ auth()->user()->email }}</small>
                        </li>
                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item py-2" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt text-primary me-2"></i>Mon tableau de bord
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user text-info me-2"></i>Mon profil
                            </a>
                        </li>

                        @if(auth()->user()->hasRole('admin'))
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-cog text-danger me-2"></i>Administration
                            </a>
                        </li>
                        @endif

                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 text-danger">
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

{{-- CSS personnalisé pour le header user --}}
@push('styles')
<style>
    /* Navigation user */
    .navbar {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
        font-weight: 700;
        transition: transform 0.3s ease;
    }

    .navbar-brand:hover {
        transform: scale(1.05);
    }

    .nav-link {
        font-weight: 500;
        transition: all 0.3s ease;
        border-radius: 0.375rem;
        font-size: 1rem;
    }

    .nav-link:hover:not(.active) {
        background-color: rgba(0, 172, 192, 0.1) !important;
        color: #00acc0 !important;
    }

    .nav-link.active {
        font-weight: 600;
        border-radius: 0.375rem;
    }

    /* Dropdown menu */
    .dropdown-menu {
        border: none;
        border-radius: 0.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        padding: 0.5rem;
        min-width: 260px;
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
        font-size: 0.95rem;
    }

    .dropdown-item:hover {
        background-color: rgba(0, 172, 192, 0.1);
        color: #00acc0;
        transform: translateX(5px);
    }

    .dropdown-header {
        padding: 0.75rem 1rem;
    }

    .dropdown-divider {
        margin: 0.5rem 0;
        border-color: rgba(0, 0, 0, 0.08);
    }

    /* Boutons */
    .btn-outline-primary {
        border-color: #00acc0;
        color: #00acc0;
        transition: all 0.3s ease;
    }

    .btn-outline-primary:hover {
        background-color: #00acc0;
        border-color: #00acc0;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 172, 192, 0.3);
    }

    .btn-outline-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);
    }

    /* Avatar */
    .rounded-circle {
        font-weight: 600;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .navbar-collapse {
            margin-top: 1rem;
        }

        .nav-link {
            margin: 0.25rem 0;
        }

        .navbar-nav {
            margin-bottom: 1rem;
        }
    }
</style>
@endpush
