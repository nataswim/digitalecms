<!-- Navigation Globale - Niveau 1 -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <i class="fas fa-swimmer text-primary me-2" style="font-size: 1.5rem;"></i>
            <span class="fw-bold">MDigital’SOS</span>
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <!-- Menu Principal (gauche) -->
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

            <!-- Menu Utilisateur (droite) -->
            <ul class="navbar-nav">
                @guest
                    <!-- Si non connecté -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i>Connexion
                        </a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-1"></i>Inscription
                            </a>
                        </li>
                    @endif
                @else
                    <!-- Si connecté -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" 
                           href="#" 
                           id="navbarDropdown" 
                           role="button" 
                           data-bs-toggle="dropdown" 
                           aria-expanded="false">
                            <div class="avatar-circle bg-primary text-white me-2">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user-circle me-2"></i>Mon Profil
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
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

<!-- Navigation par Rôle - Niveau 2 (Si authentifié) -->
@auth
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#roleNav" aria-controls="roleNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="roleNav">
                <ul class="navbar-nav">
                    @if(auth()->user()->hasPermission('users.view'))
                        {{-- ===== NAVIGATION ADMIN ===== --}}
                        
                        <!-- Dashboard Admin -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                               href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-chart-line me-1"></i>Dashboard Admin
                            </a>
                        </li>

                        <!-- Utilisateurs -->
                        @if(auth()->user()->hasPermission('users.view'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" 
                                   href="{{ route('admin.users.index') }}">
                                    <i class="fas fa-users me-1"></i>Utilisateurs
                                </a>
                            </li>
                        @endif

                        <!-- Rôles -->
                        @if(auth()->user()->hasPermission('roles.manage'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}" 
                                   href="{{ route('admin.roles.index') }}">
                                    <i class="fas fa-user-shield me-1"></i>Rôles
                                </a>
                            </li>
                        @endif

                        <!-- Permissions -->
                        @if(auth()->user()->hasPermission('permissions.manage'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}" 
                                   href="{{ route('admin.permissions.index') }}">
                                    <i class="fas fa-key me-1"></i>Permissions
                                </a>
                            </li>
                        @endif

                        <!-- Médias -->
                        @if(auth()->user()->hasPermission('media.view') || auth()->user()->hasPermission('media.manage'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.media.*') ? 'active' : '' }}" 
                                   href="{{ route('admin.media.index') }}">
                                    <i class="fas fa-images me-1"></i>Médias
                                </a>
                            </li>
                        @endif

                        <!-- Fiches (Dropdown) -->
                        @if(auth()->user()->hasPermission('fiches.view') || auth()->user()->hasPermission('fiches.manage'))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.fiches*') ? 'active' : '' }}" 
                                   href="#" 
                                   role="button" 
                                   data-bs-toggle="dropdown" 
                                   aria-expanded="false">
                                    <i class="fas fa-file-alt me-1"></i>Fiches
                                </a>
                                <ul class="dropdown-menu">
                                    @if(auth()->user()->hasPermission('fiches.view'))
                                        <li>
                                            <a class="dropdown-item {{ request()->routeIs('admin.fiches.index') ? 'active' : '' }}" 
                                               href="{{ route('admin.fiches.index') }}">
                                                <i class="fas fa-list me-2"></i>Toutes les fiches
                                            </a>
                                        </li>
                                    @endif
                                    
                                    @if(auth()->user()->hasPermission('fiches.create'))
                                        <li>
                                            <a class="dropdown-item {{ request()->routeIs('admin.fiches.create') ? 'active' : '' }}" 
                                               href="{{ route('admin.fiches.create') }}">
                                                <i class="fas fa-plus me-2"></i>Nouvelle fiche
                                            </a>
                                        </li>
                                    @endif
                                    
                                    @if(auth()->user()->hasPermission('fiches.manage'))
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item {{ request()->routeIs('admin.fiches-categories.*') ? 'active' : '' }}" 
                                               href="{{ route('admin.fiches-categories.index') }}">
                                                <i class="fas fa-folder me-2"></i>Catégories
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item {{ request()->routeIs('admin.fiches-sous-categories.*') ? 'active' : '' }}" 
                                               href="{{ route('admin.fiches-sous-categories.index') }}">
                                                <i class="fas fa-folder-open me-2"></i>Sous-catégories
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif

                    @else
                        {{-- ===== NAVIGATION UTILISATEUR STANDARD ===== --}}
                        
                        <!-- Mon Dashboard -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
                               href="{{ route('dashboard') }}">
                                <i class="fas fa-home me-1"></i>Mon Dashboard
                            </a>
                        </li>

                        <!-- Mon Profil -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" 
                               href="{{ route('profile.edit') }}">
                                <i class="fas fa-user me-1"></i>Mon Profil
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endauth

<!-- Styles pour l'avatar -->
<style>
.avatar-circle {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: bold;
}

.navbar-nav .nav-link.active {
    color: #0d6efd !important;
    font-weight: 500;
}

.dropdown-item.active {
    background-color: #e7f1ff;
    color: #0d6efd;
}

.navbar-light .navbar-nav .nav-link:hover {
    color: #0d6efd;
}
</style>