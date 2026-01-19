{{-- Header Public - Digital’SOS (Digital Sport Organisation System) - Plateforme tout-en-un --}}
<nav class="navbar navbar-expand-lg" style="border-left: 20px solid #f9f5f4;border-right: 20px solid #f9f5f4;border-bottom: 5px solid #4fa79b;border-top: 5px solid #4fa79b;">   
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
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Navigation principale -->
            <ul class="navbar-nav me-auto ms-lg-4">
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 {{ request()->routeIs('home') ? 'active text-primary fw-bold' : '' }}" 
                       href="{{ route('home') }}">
                        <i class="fas fa-home me-2"></i>Accueil
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link px-3 py-2 {{ request()->routeIs('about') ? 'active text-primary fw-bold' : '' }}" 
                       href="{{ route('about') }}">
                        <i class="fas fa-info-circle me-2"></i>À propos
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link px-3 py-2 {{ request()->routeIs('contact') ? 'active text-primary fw-bold' : '' }}" 
                       href="{{ route('contact') }}">
                        <i class="fas fa-envelope me-2"></i>Contact
                    </a>
                </li>
            </ul>

            <!-- Section utilisateur -->
            <div class="d-flex align-items-center">
                @auth
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

                        @if(auth()->user()->hasRole('admin'))
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-cog text-danger me-2"></i>Administration
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        @endif

                        <li>
                            <a class="dropdown-item py-2" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt text-dark me-2"></i>Mon espace
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user text-info me-2"></i>Mon profil
                            </a>
                        </li>
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
                @else
                <div class="d-flex gap-2">
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-sign-in-alt me-1"></i>Connexion
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-user-plus me-1"></i>Inscription
                    </a>
                </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

{{-- CSS personnalisé pour le header public --}}
@push('styles')
<style>
    /* Navigation publique */
    .navbar {
        background-color: #fff !important;
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
        position: relative;
    }

    .nav-link:hover:not(.active) {
        background-color: rgba(0, 172, 192, 0.1);
        color: #00acc0 !important;
    }

    .nav-link.active {
        background-color: rgba(0, 172, 192, 0.15);
    }

    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60%;
        height: 2px;
        background-color: #00acc0;
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
    .btn-primary {
        background: linear-gradient(135deg, #00acc0, #0173b4);
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #0173b4, #00acc0);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 172, 192, 0.3);
    }

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

        .d-flex.gap-2 {
            width: 100%;
        }

        .d-flex.gap-2 a {
            flex: 1;
        }
    }
</style>
@endpush
