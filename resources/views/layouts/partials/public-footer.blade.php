{{-- Footer Public - Digital’SOS (Digital Sport Organisation System) - Plateforme tout-en-un --}}

<footer class="admin-footer mt-5" style="border-left: 20px solid #4dadc1;border-right: 20px solid #4dadc1;background-color: #4dadc1 !important;border-bottom: 20px solid #378399;border-top: 20px solid #378399;padding-top: 20px;">    


    <!-- Contenu principal du footer -->
    <div class="py-5">
        <div class="container-lg">
            <div class="row g-4">
                
                <!-- À propos -->
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3"
                            style="width: 50px; height: 50px;">
                            <i class="fas fa-water text-primary"></i>
                        </div>
                        <h5 class="mb-0 text-white">{{ config('app.name') }}</h5>
                    </div>
                    <p class="text-light opacity-75 mb-4">
                        Digital Sport Organisation System - Plateforme tout-en-un -
Plateforme de gestion digitale.
                    </p>
                    <div class="text-light opacity-75">
                        <i class="fas fa-shield-alt me-2"></i>
                        <small>Vos données sont en sécurité avec nous.</small>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="col-lg-2 col-md-6" style=" background-color: #fff; padding: 20px 10px; border: 20px solid #38849a; ">
                    <h6 class="text-white fw-semibold mb-3">Navigation</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ route('home') }}" class="footer-link">
                                <i class="fas fa-home me-2"></i>Accueil
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('about') }}" class="footer-link">
                                <i class="fas fa-info-circle me-2"></i>À propos
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('contact') }}" class="footer-link">
                                <i class="fas fa-envelope me-2"></i>Contact
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Compte -->
<div class="col-lg-3 col-md-6" style="background-color: #faf7f2;padding: 20px 10px;border-color: #faf7f2 #4dadc1 #38849a #4dadc1;border-width: 20px;border-style: solid;">
    
                    <h6 class="text-white fw-semibold mb-3">Mon compte</h6>
                    <ul class="list-unstyled">
                        @auth
                        <li class="mb-2">
                            <a href="{{ route('dashboard') }}" class="footer-link">
                                <i class="fas fa-tachometer-alt me-2"></i>Mon espace
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('profile.edit') }}" class="footer-link">
                                <i class="fas fa-user me-2"></i>Mon profil
                            </a>
                        </li>
                        @else
                        <li class="mb-2">
                            <a href="{{ route('login') }}" class="footer-link">
                                <i class="fas fa-sign-in-alt me-2"></i>Connexion
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('register') }}" class="footer-link">
                                <i class="fas fa-user-plus me-2"></i>Inscription
                            </a>
                        </li>
                        @endauth
                    </ul>
                </div>

                <!-- Informations légales -->
<div class="col-lg-3 col-md-6" style="background-color: #faf7f2;padding: 20px 10px;border-color: #faf7f2 #4dadc1 #38849a #4dadc1;border-width: 20px;border-style: solid;">
    
                    <h6 class="text-white fw-semibold mb-3">Informations</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="#" class="footer-link">
                                <i class="fas fa-gavel me-2"></i>Mentions légales
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="footer-link">
                                <i class="fas fa-shield-alt me-2"></i>Confidentialité
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="footer-link">
                                <i class="fas fa-cookie-bite me-2"></i>Cookies
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="footer-link">
                                <i class="fas fa-file-contract me-2"></i>CGU
                            </a>
                        </li>
                    </ul>

                    <!-- Réseaux sociaux (optionnel) -->
                    <div class="mt-4">
                        <h6 class="text-white fw-semibold mb-3">Suivez-nous</h6>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-light btn-sm rounded-circle" style="width: 36px; height: 36px; padding: 0;" aria-label="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="btn btn-light btn-sm rounded-circle" style="width: 36px; height: 36px; padding: 0;" aria-label="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="btn btn-light btn-sm rounded-circle" style="width: 36px; height: 36px; padding: 0;" aria-label="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="btn btn-light btn-sm rounded-circle" style="width: 36px; height: 36px; padding: 0;" aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Barre de copyright -->
    <div style="background-color: #093b4d;">
        <div class="container-lg py-4">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0 text-light opacity-75">
                        <i class="fas fa-copyright me-1"></i>
                        {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.
                    </p>
                </div>

                <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                    <div class="d-flex flex-wrap justify-content-center justify-content-md-end gap-3">
                        <span class="badge bg-success">
                            <i class="fab fa-laravel me-1"></i>MyCreaNet {{ app()->version() }}
                        </span>
                        <span class="badge bg-info">
                            <i class="fab fa-php me-1"></i>H.Elhaouat
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

{{-- CSS personnalisé pour le footer public --}}
@push('styles')
<style>
    /* Footer */
    footer {
        margin-top: auto;
    }

    .footer-link {
        color: rgba(255, 255, 255, 0.75);
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .footer-link:hover {
        color: #fff;
        transform: translateX(5px);
    }

    .footer-link i {
        transition: transform 0.3s ease;
    }

    .footer-link:hover i {
        transform: scale(1.2);
    }

    /* Boutons réseaux sociaux */
    .btn-light.rounded-circle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .btn-light.rounded-circle:hover {
        background-color: #00acc0 !important;
        border-color: #00acc0 !important;
        color: white !important;
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0, 172, 192, 0.3);
    }

    /* Call to Action */
    .hover-lift {
        transition: all 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    /* Badge */
    .badge {
        font-size: 0.75rem;
        padding: 0.5rem 0.75rem;
    }

    /* Responsive */
    @media (max-width: 767.98px) {
        footer h5,
        footer h6 {
            font-size: 1rem;
        }

        footer p,
        footer .footer-link {
            font-size: 0.9rem;
        }

        .btn-light.rounded-circle {
            width: 32px !important;
            height: 32px !important;
            font-size: 0.85rem;
        }
    }
</style>
@endpush
