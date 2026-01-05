<header class="sticky-top">
    <!-- Navigation Globale (Niveau 1) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <i class="fas fa-swimmer text-primary me-2" style="font-size: 1.5rem;"></i>
                <span class="fw-bold">MyCreaNet Digital Solutions</span>
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <!-- Navigation Globale -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i>Accueil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                            <i class="fas fa-info-circle me-1"></i>À propos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                            <i class="fas fa-envelope me-1"></i>Contact
                        </a>
                    </li>
                </ul>

                <!-- User Menu -->
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i>Connexion
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary btn-sm ms-2" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-1"></i>S'inscrire
                            </a>
                        </li>
                    @else
                        <!-- Notifications -->
                        <li class="nav-item dropdown me-2">
                            <a class="nav-link position-relative" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-bell"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                    0
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                <li><h6 class="dropdown-header">Notifications</h6></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-muted text-center py-3" href="#">
                                        <i class="fas fa-info-circle me-2"></i>Aucune notification
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- User Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                @if(auth()->user()->avatar)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" 
                                         alt="{{ auth()->user()->name }}" 
                                         class="rounded-circle me-2"
                                         style="width: 32px; height: 32px; object-fit: cover;">
                                @else
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center me-2" 
                                         style="width: 32px; height: 32px;">
                                        <span class="text-primary fw-bold" style="font-size: 0.9rem;">
                                            {{ substr(auth()->user()->name, 0, 1) }}
                                        </span>
                                    </div>
                                @endif
                                <span class="d-none d-lg-inline">{{ auth()->user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                <!-- User Info -->
                                <li class="px-3 py-2 border-bottom">
                                    <div class="small text-muted">Connecté en tant que</div>
                                    <div class="fw-semibold">{{ auth()->user()->name }}</div>
                                    @if(auth()->user()->role)
                                        <span class="badge bg-primary-subtle text-primary mt-1" style="font-size: 0.7rem;">
                                            {{ auth()->user()->role->name }}
                                        </span>
                                    @endif
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                
                                <!-- Dashboard -->
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-2 text-primary"></i>Tableau de bord
                                    </a>
                                </li>
                                
                                <!-- Profile -->
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="fas fa-user me-2 text-success"></i>Mon profil
                                    </a>
                                </li>
                                
                                @if(auth()->user()->hasPermission('users.view'))
                                    <!-- Admin Dashboard -->
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            <i class="fas fa-cog me-2 text-warning"></i>Administration
                                        </a>
                                    </li>
                                @endif
                                
                                <li><hr class="dropdown-divider"></li>
                                
                                <!-- Logout -->
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Navigation Contextuelle par Rôle (Niveau 2) -->
    @auth
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="roleNav">
                    <ul class="navbar-nav">
                        @if(auth()->user()->hasPermission('users.view'))
                            {{-- Navigation Admin --}}
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                                   href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-chart-line me-1"></i>Dashboard Admin
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" 
                                   href="{{ route('admin.users.index') }}">
                                    <i class="fas fa-users me-1"></i>Utilisateurs
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}" 
                                   href="{{ route('admin.roles.index') }}">
                                    <i class="fas fa-user-shield me-1"></i>Rôles
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}" 
                                   href="{{ route('admin.permissions.index') }}">
                                    <i class="fas fa-key me-1"></i>Permissions
                                </a>
                            </li>
                        @else
                            {{-- Navigation User Standard --}}
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
                                   href="{{ route('dashboard') }}">
                                    <i class="fas fa-home me-1"></i>Mon Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" 
                                   href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user me-1"></i>Mon Profil
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-cog me-1"></i>Paramètres
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    @endauth
</header>

<style>
.navbar .nav-link {
    transition: all 0.3s ease;
    border-radius: 0.25rem;
    padding: 0.5rem 1rem !important;
    margin: 0 0.25rem;
}

.navbar .nav-link:hover {
    background-color: rgba(13, 110, 253, 0.1);
}

.navbar .nav-link.active {
    color: #0d6efd !important;
    background-color: rgba(13, 110, 253, 0.1);
    font-weight: 600;
}

.dropdown-menu {
    min-width: 280px;
}

.dropdown-item {
    padding: 0.5rem 1rem;
    transition: all 0.3s ease;
}

.dropdown-item:hover {
    background-color: rgba(13, 110, 253, 0.1);
    padding-left: 1.25rem;
}

.sticky-top {
    z-index: 1020;
}
</style>