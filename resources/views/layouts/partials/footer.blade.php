<footer class="bg-dark text-white mt-auto">
    <!-- Main Footer -->
    <div class="container py-5">
        <div class="row g-4">
            <!-- About Section -->
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-swimmer text-primary me-2" style="font-size: 2rem;"></i>
                    <h5 class="mb-0 fw-bold">MyCreaNet Digital Solutions</h5>
                </div>
                <p class="text-white-50 mb-3">
                    Plateforme de gestion complète et intuitive pour optimiser vos performances 
                    et atteindre vos objectifs.
                </p>
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle" style="width: 40px; height: 40px;" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle" style="width: 40px; height: 40px;" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle" style="width: 40px; height: 40px;" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle" style="width: 40px; height: 40px;" title="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6">
                <h6 class="fw-bold mb-3 text-uppercase">Navigation</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('home') }}" class="text-white-50 text-decoration-none footer-link">
                            <i class="fas fa-chevron-right me-2 small"></i>Accueil
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('about') }}" class="text-white-50 text-decoration-none footer-link">
                            <i class="fas fa-chevron-right me-2 small"></i>À propos
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('contact') }}" class="text-white-50 text-decoration-none footer-link">
                            <i class="fas fa-chevron-right me-2 small"></i>Contact
                        </a>
                    </li>
                    @auth
                    <li class="mb-2">
                        <a href="{{ route('dashboard') }}" class="text-white-50 text-decoration-none footer-link">
                            <i class="fas fa-chevron-right me-2 small"></i>Dashboard
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>

            <!-- Resources -->
            <div class="col-lg-3 col-md-6">
                <h6 class="fw-bold mb-3 text-uppercase">Ressources</h6>
                <ul class="list-unstyled">
                    @guest
                    <li class="mb-2">
                        <a href="{{ route('login') }}" class="text-white-50 text-decoration-none footer-link">
                            <i class="fas fa-chevron-right me-2 small"></i>Connexion
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('register') }}" class="text-white-50 text-decoration-none footer-link">
                            <i class="fas fa-chevron-right me-2 small"></i>Inscription
                        </a>
                    </li>
                    @else
                    <li class="mb-2">
                        <a href="{{ route('profile.edit') }}" class="text-white-50 text-decoration-none footer-link">
                            <i class="fas fa-chevron-right me-2 small"></i>Mon Profil
                        </a>
                    </li>
                    @if(auth()->user()->hasPermission('users.view'))
                    <li class="mb-2">
                        <a href="{{ route('admin.dashboard') }}" class="text-white-50 text-decoration-none footer-link">
                            <i class="fas fa-chevron-right me-2 small"></i>Administration
                        </a>
                    </li>
                    @endif
                    @endguest
                    <li class="mb-2">
                        <a href="#" class="text-white-50 text-decoration-none footer-link">
                            <i class="fas fa-chevron-right me-2 small"></i>Documentation
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white-50 text-decoration-none footer-link">
                            <i class="fas fa-chevron-right me-2 small"></i>Support
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-3 col-md-6">
                <h6 class="fw-bold mb-3 text-uppercase">Contact</h6>
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-map-marker-alt text-primary me-2 mt-1"></i>
                            <div class="text-white-50 small">
                                123 Avenue du Sport<br>
                                75001 Paris, France
                            </div>
                        </div>
                    </li>
                    <li class="mb-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-phone text-primary me-2"></i>
                            <a href="tel:+33123456789" class="text-white-50 text-decoration-none footer-link small">
                                +33 1 23 45 67 89
                            </a>
                        </div>
                    </li>
                    <li class="mb-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            <a href="mailto:contact@cmssport.fr" class="text-white-50 text-decoration-none footer-link small">
                                contact@cmssport.fr
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bottom Footer -->
    <div class="border-top border-secondary">
        <div class="container py-4">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="text-white-50 small mb-0">
                        &copy; {{ date('Y') }} MyCreaNet Digital Solutions. Tous droits réservés.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="{{ route('privacy') }}" class="text-white-50 text-decoration-none footer-link small">
                                Confidentialité
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <span class="text-white-50">|</span>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ route('terms') }}" class="text-white-50 text-decoration-none footer-link small">
                                Conditions d'utilisation
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <span class="text-white-50">|</span>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-white-50 text-decoration-none footer-link small">
                                Cookies
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
footer {
    margin-top: auto;
}

.footer-link {
    transition: all 0.3s ease;
}

.footer-link:hover {
    color: #fff !important;
    padding-left: 5px;
}

.btn-outline-light:hover {
    background-color: #0d6efd;
    border-color: #0d6efd;
}
</style>