{{-- 
    ============================================================================
    Navigation Admin Horizontale - Digital'SOS CMS
    ============================================================================
    Digital Sport Organisation System (Digital'SOS)
    La performance commence par une gestion maîtrisée
    
    Structure du menu :
    - Dashboard (direct)
    - Gestion (Admin : Médias, Fiches, M2PC, Utilisateurs)
    - Visualisation (Site public : Accueil, Fiches, À propos, Contact)
    ============================================================================
--}}

<nav class="navbar navbar-expand-lg" style="border-left: 20px solid #f9f5f4;border-right: 20px solid #f9f5f4;border-bottom: 5px solid #4fa79b;border-top: 5px solid #4fa79b;">
    <div class="container-fluid">
        
        {{-- ============================================
            LOGO
            ============================================ --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('assets/images/Digital-sOs-logo13.png') }}"
                alt="{{ config('app.name') }}"
                style="height: 80px; width: auto;"
                onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
            <span class="fw-bold text-primary ms-2" style="display: none;">{{ config('app.name') }}</span>
        </a>

        {{-- ============================================
            BOUTON BURGER MOBILE
            ============================================ --}}
        <button class="navbar-toggler border-0" 
                type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#adminNavbar" 
                aria-controls="adminNavbar" 
                aria-expanded="false" 
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- ============================================
            MENU PRINCIPAL
            ============================================ --}}
        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                {{-- ========================================
                    1. DASHBOARD (Lien direct)
                    ======================================== --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active fw-bold text-primary' : '' }}" 
                       href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                </li>

                {{-- ========================================
                    2. GESTION (Admin)
                    ======================================== --}}
                <li class="nav-item dropdown">
                    @php 
                        $gestionActive = request()->routeIs('admin.media.*', 'admin.fiches.*', 'admin.fiches-categories.*', 'admin.fiches-sous-categories.*', 'admin.users.*', 'admin.roles.*', 'admin.permissions.*'); 
                    @endphp
                    <a class="nav-link dropdown-toggle {{ $gestionActive ? 'active fw-bold text-primary' : '' }}" 
                       href="#" 
                       role="button" 
                       data-bs-toggle="dropdown" 
                       aria-expanded="false">
                        <i class="fas fa-cog me-2"></i>Gestion
                    </a>
                    <ul class="dropdown-menu">
                        
                        {{-- Médias --}}
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('admin.media.*') ? 'active' : '' }}" 
                               href="{{ route('admin.media.index') }}">
                                <i class="fas fa-images fa-fw me-2"></i>Médias
                                @php 
                                    $mediaCount = \App\Models\Media::count(); 
                                @endphp
                                @if($mediaCount > 0)
                                <span class="badge bg-success ms-2">{{ $mediaCount }}</span>
                                @endif
                            </a>
                        </li>

                        {{-- Fiches --}}
                        <li><h6 class="dropdown-header"><i class="fas fa-file-alt me-2 text-primary"></i>Fiches</h6></li>
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('admin.fiches.index', 'admin.fiches.show') ? 'active' : '' }}" 
                               href="{{ route('admin.fiches.index') }}">
                                <i class="fas fa-list fa-fw me-2"></i>Toutes les fiches
                                @php 
                                    $fichesCount = \App\Models\Fiche::count(); 
                                @endphp
                                @if($fichesCount > 0)
                                <span class="badge bg-info ms-2">{{ $fichesCount }}</span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('admin.fiches.create') ? 'active' : '' }}" 
                               href="{{ route('admin.fiches.create') }}">
                                <i class="fas fa-plus-circle fa-fw me-2"></i>Créer une fiche
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('admin.fiches-categories.*') ? 'active' : '' }}" 
                               href="{{ route('admin.fiches-categories.index') }}">
                                <i class="fas fa-folder fa-fw me-2"></i>Gérer les catégories
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('admin.fiches-sous-categories.*') ? 'active' : '' }}" 
                               href="{{ route('admin.fiches-sous-categories.index') }}">
                                <i class="fas fa-folder-open fa-fw me-2"></i>Gérer les sous-catégories
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>
                        <li><h6 class="dropdown-header"><i class="fas fa-water me-2 text-primary"></i>Méthode M2PC</h6></li>

                        {{-- 
                        ============================================
                        MÉTHODE M2PC - À IMPLÉMENTER
                        ============================================
                        Décommentez ces sections au fur et à mesure
                        de l'implémentation des modules M2PC
                        ============================================
                        
                        -- Matériel --
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.materiel.index') }}">
                                <i class="fas fa-boxes fa-fw me-2 text-primary"></i>Matériel
                                <span class="badge bg-primary ms-2">0</span>
                            </a>
                        </li>

                        -- Planning --
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.planning.index') }}">
                                <i class="fas fa-calendar-alt fa-fw me-2 text-secondary"></i>Planning
                                <span class="badge bg-secondary ms-2">0</span>
                            </a>
                        </li>

                        -- Personnel --
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.personnel.index') }}">
                                <i class="fas fa-user-friends fa-fw me-2 text-success"></i>Personnel
                                <span class="badge bg-success ms-2">0</span>
                            </a>
                        </li>

                        -- Contenu --
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.contenu.index') }}">
                                <i class="fas fa-file-invoice fa-fw me-2 text-info"></i>Contenu
                                <span class="badge bg-info ms-2">0</span>
                            </a>
                        </li>
                        --}}

                        {{-- Sections M2PC temporaires (liens désactivés) --}}
                        <li>
                            <span class="dropdown-item text-muted disabled">
                                <i class="fas fa-boxes fa-fw me-2"></i>Matériel
                                <small class="ms-2 text-warning">(À venir)</small>
                            </span>
                        </li>
                        <li>
                            <span class="dropdown-item text-muted disabled">
                                <i class="fas fa-calendar-alt fa-fw me-2"></i>Planning
                                <small class="ms-2 text-warning">(À venir)</small>
                            </span>
                        </li>
                        <li>
                            <span class="dropdown-item text-muted disabled">
                                <i class="fas fa-user-friends fa-fw me-2"></i>Personnel
                                <small class="ms-2 text-warning">(À venir)</small>
                            </span>
                        </li>
                        <li>
                            <span class="dropdown-item text-muted disabled">
                                <i class="fas fa-file-invoice fa-fw me-2"></i>Contenu
                                <small class="ms-2 text-warning">(À venir)</small>
                            </span>
                        </li>

                        {{-- Utilisateurs (Admin uniquement) --}}
                        @if(auth()->user()->hasRole('admin'))
                        <li><hr class="dropdown-divider"></li>
                        <li><h6 class="dropdown-header">Administration</h6></li>
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" 
                               href="{{ route('admin.users.index') }}">
                                <i class="fas fa-users fa-fw me-2"></i>Utilisateurs
                                @php 
                                    $usersCount = \App\Models\User::count(); 
                                @endphp
                                @if($usersCount > 0)
                                <span class="badge bg-info ms-2">{{ $usersCount }}</span>
                                @endif
                            </a>
                        </li>
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
                        @endif

                    </ul>
                </li>

                {{-- ========================================
                    3. VISUALISATION (Site Public)
                    ======================================== --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" 
                       href="#" 
                       role="button" 
                       data-bs-toggle="dropdown" 
                       aria-expanded="false">
                        <i class="fas fa-eye me-2"></i>Visualisation
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" 
                               href="{{ route('home') }}" 
                               target="_blank">
                                <i class="fas fa-home fa-fw me-2"></i>Accueil
                                <i class="fas fa-external-link-alt fa-fw ms-2 text-muted" style="font-size: 0.7rem;"></i>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" 
                               href="{{ route('public.fiches.index') }}" 
                               target="_blank">
                                <i class="fas fa-file-alt fa-fw me-2"></i>Fiches
                                <i class="fas fa-external-link-alt fa-fw ms-2 text-muted" style="font-size: 0.7rem;"></i>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" 
                               href="{{ route('about') }}" 
                               target="_blank">
                                <i class="fas fa-info-circle fa-fw me-2"></i>À propos
                                <i class="fas fa-external-link-alt fa-fw ms-2 text-muted" style="font-size: 0.7rem;"></i>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" 
                               href="{{ route('contact') }}" 
                               target="_blank">
                                <i class="fas fa-envelope fa-fw me-2"></i>Contact
                                <i class="fas fa-external-link-alt fa-fw ms-2 text-muted" style="font-size: 0.7rem;"></i>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" 
                               href="{{ route('privacy') }}" 
                               target="_blank">
                                <i class="fas fa-shield-alt fa-fw me-2"></i>Confidentialité
                                <i class="fas fa-external-link-alt fa-fw ms-2 text-muted" style="font-size: 0.7rem;"></i>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" 
                               href="{{ route('terms') }}" 
                               target="_blank">
                                <i class="fas fa-file-contract fa-fw me-2"></i>Conditions
                                <i class="fas fa-external-link-alt fa-fw ms-2 text-muted" style="font-size: 0.7rem;"></i>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>

            {{-- ============================================
                ACTIONS UTILISATEUR (DROITE)
                ============================================ --}}
            <div class="d-flex align-items-center gap-2">
                
                {{-- Notifications --}}
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
                
                {{-- Menu utilisateur --}}
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
                            <a class="dropdown-item" href="{{ route('home') }}" target="_blank">
                                <i class="fas fa-home me-2"></i>Voir le site
                                <i class="fas fa-external-link-alt fa-fw ms-2 text-muted" style="font-size: 0.7rem;"></i>
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

{{-- ============================================================================
    STYLES PERSONNALISÉS
    ============================================================================ --}}
@push('styles')
<style>
    /* ========================================
       Navigation
       ======================================== */
    .navbar-nav .nav-link {
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        border-radius: 0.375rem;
        position: relative;
    }

    .navbar-nav .nav-link:hover:not(.active) {
        background-color: rgba(56, 133, 155, 0.1);
        color: #38859b !important;
    }

    .navbar-nav .nav-link.active {
        background-color: rgba(56, 133, 155, 0.15);
    }

    .navbar-nav .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 50%;
        transform: translateX(-50%);
        width: 40%;
        height: 3px;
        background: linear-gradient(90deg, #38859b 0%, #49aaca 100%);
        border-radius: 2px;
    }

    /* ========================================
       Dropdown Menu
       ======================================== */
    .dropdown-menu {
        border: none;
        border-radius: 0.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        padding: 0.5rem;
        animation: slideDown 0.2s ease;
        min-width: 220px;
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
        display: flex;
        align-items: center;
    }

    .dropdown-item:hover:not(.disabled) {
        background-color: rgba(56, 133, 155, 0.1);
        color: #38859b;
        transform: translateX(5px);
    }

    .dropdown-item.active {
        background-color: rgba(56, 133, 155, 0.2);
        color: #38859b;
        font-weight: 600;
    }

    .dropdown-item.disabled {
        cursor: not-allowed;
        opacity: 0.6;
    }

    .dropdown-header {
        font-size: 0.75rem;
        text-transform: uppercase;
        font-weight: 600;
        color: #6c757d;
        letter-spacing: 0.5px;
        padding: 0.5rem 1rem;
        margin-top: 0.5rem;
        background-color: #f8f9fa;
        border-radius: 0.25rem;
    }

    .dropdown-header:first-child {
        margin-top: 0;
    }

    /* ========================================
       Badges
       ======================================== */
    .badge {
        font-size: 0.65rem;
        padding: 0.25rem 0.5rem;
        font-weight: 600;
    }

    /* ========================================
       Avatar Circle
       ======================================== */
    .rounded-circle {
        font-weight: 600;
    }

    /* ========================================
       Icons
       ======================================== */
    .fa-external-link-alt {
        opacity: 0.5;
        transition: opacity 0.3s ease;
    }

    .dropdown-item:hover .fa-external-link-alt {
        opacity: 1;
    }

    /* ========================================
       Responsive
       ======================================== */
    @media (max-width: 991px) {
        .navbar-nav .nav-link {
            margin: 0.25rem 0;
        }

        .dropdown-menu {
            border: none;
            box-shadow: none;
            padding-left: 1rem;
        }

        .navbar-nav .nav-link.active::after {
            display: none;
        }
    }

    /* ========================================
       Amélioration visuelle
       ======================================== */
    .navbar {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        background: linear-gradient(to bottom, #ffffff 0%, #f9f9f9 100%);
    }

    /* Hover sur le logo */
    .navbar-brand img {
        transition: transform 0.3s ease;
    }

    .navbar-brand:hover img {
        transform: scale(1.05);
    }
</style>
@endpush

{{-- ============================================================================
    SCRIPTS PERSONNALISÉS (Optionnel)
    ============================================================================ --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fermer automatiquement les dropdowns au clic
        document.querySelectorAll('.dropdown-item').forEach(item => {
            item.addEventListener('click', function() {
                const dropdown = this.closest('.dropdown');
                if (dropdown) {
                    const toggle = dropdown.querySelector('[data-bs-toggle="dropdown"]');
                    if (toggle) {
                        bootstrap.Dropdown.getInstance(toggle)?.hide();
                    }
                }
            });
        });

        // Gestion du menu mobile
        const navbarToggler = document.querySelector('.navbar-toggler');
        const navbarCollapse = document.querySelector('#adminNavbar');
        
        if (navbarToggler && navbarCollapse) {
            navbarToggler.addEventListener('click', function() {
                navbarCollapse.classList.toggle('show');
            });
        }
    });
</script>
@endpush