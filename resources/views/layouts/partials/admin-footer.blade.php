{{-- Footer Admin - Digital’SOS (Digital Sport Organisation System) est la plateforme tout-en-un --}}

<footer class="admin-footer mt-5" style="border-left: 20px solid #4fa79b;border-right: 20px solid #4fa79b;background-color: #303030 !important;border-bottom: 20px solid #f9f5f4;border-top: 20px solid #f9f5f4;padding-top: 20px;"> 
    
        <div class="row g-4">
            
            <!-- Colonne 1 : Navigation -->
<div class="col-lg-3 col-md-6" style="background-color: #faf7f2;padding: 20px 10px;border-color: #faf7f2 #4dadc1 #38849a #4dadc1;border-width: 20px;border-style: solid;">
    
<h6 class="footer-heading text-primary mb-3">
                    <i class="fas fa-sitemap me-2"></i>Navigation
                </h6>
                <ul class="footer-links list-unstyled">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="footer-link">
                            <i class="fas fa-angle-right me-2"></i>Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.media.index') }}" class="footer-link">
                            <i class="fas fa-angle-right me-2"></i>Médiathèque
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.fiches.index') }}" class="footer-link">
                            <i class="fas fa-angle-right me-2"></i>Fiches
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Colonne 2 : Utilisateurs -->
            @if(auth()->user()->hasRole('admin'))
<div class="col-lg-3 col-md-6" style="background-color: #faf7f2;padding: 20px 10px;border-color: #faf7f2 #4dadc1 #38849a #4dadc1;border-width: 20px;border-style: solid;">
    
                <h6 class="footer-heading text-primary mb-3">
                    <i class="fas fa-users me-2"></i>Utilisateurs
                </h6>
                <ul class="footer-links list-unstyled">
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="footer-link">
                            <i class="fas fa-angle-right me-2"></i>Gestion utilisateurs
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.roles.index') }}" class="footer-link">
                            <i class="fas fa-angle-right me-2"></i>Rôles
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.permissions.index') }}" class="footer-link">
                            <i class="fas fa-angle-right me-2"></i>Permissions
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.profile.show') }}" class="footer-link">
                            <i class="fas fa-angle-right me-2"></i>Mon profil
                        </a>
                    </li>
                </ul>
            </div>
            @else
<div class="col-lg-3 col-md-6" style="background-color: #faf7f2;padding: 20px 10px;border-color: #faf7f2 #4dadc1 #38849a #4dadc1;border-width: 20px;border-style: solid;">
    
                <h6 class="footer-heading text-primary mb-3">
                    <i class="fas fa-user me-2"></i>Mon compte
                </h6>
                <ul class="footer-links list-unstyled">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="footer-link">
                            <i class="fas fa-angle-right me-2"></i>Mon espace
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.profile.show') }}" class="footer-link">
                            <i class="fas fa-angle-right me-2"></i>Mon profil
                        </a>
                    </li>
                </ul>
            </div>
            @endif

            <!-- Colonne 3 : Ressources -->
<div class="col-lg-3 col-md-6" style="background-color: #faf7f2;padding: 20px 10px;border-color: #faf7f2 #4dadc1 #38849a #4dadc1;border-width: 20px;border-style: solid;">
    
                <h6 class="footer-heading text-primary mb-3">
                    <i class="fas fa-book me-2"></i>Ressources
                </h6>
                <ul class="footer-links list-unstyled">
                    <li>
                        <a href="https://laravel.com/docs" target="_blank" rel="noopener noreferrer" class="footer-link">
                            <i class="fab fa-laravel fa-fw me-2"></i>Documentation Laravel
                            <i class="fas fa-external-link-alt ms-1 small"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://getbootstrap.com/" target="_blank" rel="noopener noreferrer" class="footer-link">
                            <i class="fab fa-bootstrap fa-fw me-2"></i>Bootstrap 5
                            <i class="fas fa-external-link-alt ms-1 small"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://fontawesome.com/icons" target="_blank" rel="noopener noreferrer" class="footer-link">
                            <i class="fab fa-font-awesome fa-fw me-2"></i>Font Awesome Icons
                            <i class="fas fa-external-link-alt ms-1 small"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Colonne 4 : Outils -->
<div class="col-lg-3 col-md-6" style="background-color: #faf7f2;padding: 20px 10px;border-color: #faf7f2 #4dadc1 #38849a #4dadc1;border-width: 20px;border-style: solid;">
    
                <h6 class="footer-heading text-primary mb-3">
                    <i class="fas fa-tools me-2"></i>Outils
                </h6>
                <ul class="footer-links list-unstyled">
                    <li>
                        <a href="https://github.com/nataswim/digitalecms" target="_blank" rel="noopener noreferrer" class="footer-link">
                            <i class="fab fa-github fa-fw me-2"></i>GitHub
                            <i class="fas fa-external-link-alt ms-1 small"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://search.google.com/search-console" target="_blank" rel="noopener noreferrer" class="footer-link">
                            <i class="fab fa-google fa-fw me-2"></i>Search Console
                            <i class="fas fa-external-link-alt ms-1 small"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://analytics.google.com/" target="_blank" rel="noopener noreferrer" class="footer-link">
                            <i class="fas fa-chart-bar fa-fw me-2"></i>Google Analytics
                            <i class="fas fa-external-link-alt ms-1 small"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright et informations -->
        <div class="row mt-4 pt-4 border-top" style="background-color: #faf7f2;">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <p class="mb-1 text-muted">
                    <i class="fas fa-copyright me-1"></i>
                    {{ date('Y') }} <strong>Digital’SOS</strong> - Administration
                </p>
                <p class="mb-0 small text-muted">
                    Digital’SOS (Digital Sport Organisation System) - Plateforme tout-en-un
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <div class="footer-meta d-flex justify-content-center justify-content-md-end align-items-center gap-3 flex-wrap">
                    <span class="badge bg-success">
                        <i class="fas fa-check-circle me-1"></i>MyCreaNet {{ app()->version() }}
                    </span>
                    <span class="badge bg-info">
                        <i class="fas fa-server me-1"></i>H.EL HAOUAT {{ PHP_VERSION }}
                    </span>
                    <span class="text-muted small">
                        <i class="fas fa-user me-1"></i>{{ auth()->user()->name }}
                    </span>
                    <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary" target="_blank">
                        <i class="fas fa-eye me-1"></i>Voir le site
                    </a>
                </div>
            </div>
        </div>

        <!-- Liens légaux -->
        <div class="row mt-3 pt-3 border-top" style="background-color: #378399;">
            <div class="col-12 text-center">
                <div class="footer-legal d-flex justify-content-center gap-3 flex-wrap small">
                    <a href="#" class="text-muted footer-link-legal">Mentions légales</a>
                    <span class="text-muted">•</span>
                    <a href="#" class="text-muted footer-link-legal">Politique de confidentialité</a>
                    <span class="text-muted">•</span>
                    <a href="#" class="text-muted footer-link-legal">CGU</a>
                    <span class="text-muted">•</span>
                    <a href="#" class="text-muted footer-link-legal">Contact</a>
                    <span class="text-muted">•</span>
                    <a href="https://github.com/nataswim/digitalecms" target="_blank" rel="noopener noreferrer" class="text-muted footer-link-legal">
                        <i class="fab fa-github me-1"></i>Code source
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

{{-- CSS personnalisé pour le footer --}}
@push('styles')
<style>
    /* Footer */
    .admin-footer {
        margin-top: auto;
    }

    .footer-heading {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .footer-links {
        margin: 0;
        padding: 0;
    }

   .footer-link {
    color: #6c757d;
    text-decoration: none;
    font-size: 0.9rem;
    display: inline-flex;
    align-items: center;
    transition: all 0.2s ease;
    position: relative;
    padding-left: 0;
}

    .footer-link:hover {
        color: #00acc0;
        transform: translateX(5px);
    }

    .footer-link i.fa-angle-right {
        transition: transform 0.3s ease;
    }

    .footer-link:hover i.fa-angle-right {
        transform: translateX(3px);
    }

    .footer-link-legal {
        transition: all 0.3s ease;
    }

    .footer-link-legal:hover {
        color: #000000ff !important;
        text-decoration: none;
    }

    .footer-meta .badge {
        font-size: 0.75rem;
    }

    /* Responsive */
    @media (max-width: 767.98px) {
        .footer-heading {
            font-size: 0.9rem;
        }

        .footer-link {
            font-size: 0.85rem;
        }

        .footer-legal {
            font-size: 0.75rem !important;
        }
    }
</style>
@endpush
