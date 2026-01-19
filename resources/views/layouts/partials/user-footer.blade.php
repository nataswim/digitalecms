{{-- Footer User - Digital’SOS (Digital Sport Organisation System) - Plateforme tout-en-un (Utilisateurs standards) --}}


<footer class="admin-footer mt-5" style="border-left: 20px solid #4fa79b;border-right: 20px solid #4fa79b;background-color: #303030 !important;border-bottom: 20px solid #f9f5f4;border-top: 20px solid #f9f5f4;padding-top: 20px;"> 



<!-- Contenu principal du footer -->
    <div class="py-5">
        <div class="container-lg">
            <div class="row g-4">
                
                <!-- Mon Espace -->
<div class="col-lg- col-md-6" style="background-color: #faf7f2;padding: 20px 10px;border-color: #faf7f2 #4dadc1 #38849a #4dadc1;border-width: 20px;border-style: solid;">
    
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3"
                            style="width: 50px; height: 50px;">
                            <i class="fas fa-user text-primary"></i>
                        </div>
                        <h5 class="mb-0 text-white">Mon Espace</h5>
                    </div>
                    <p class="text-light opacity-75 mb-4">
                        Bienvenue <strong>{{ auth()->user()->name }}</strong> !<br>
                        Gérez votre contenu et vos préférences en toute simplicité.
                    </p>
                    <div class="text-light opacity-75">
                        <i class="fas fa-shield-alt me-2"></i>
                        <small>Vos données sont en sécurité.</small>
                    </div>
                </div>

                <!-- Navigation -->
<div class="col-lg-2 col-md-6" style="background-color: #faf7f2;padding: 20px 10px;border-color: #faf7f2 #4dadc1 #38849a #4dadc1;border-width: 20px;border-style: solid;">
    
                    <h6 class="text-white fw-semibold mb-3">Navigation</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ route('dashboard') }}" class="footer-link">
                                <i class="fas fa-tachometer-alt me-2"></i>Mon espace
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('public.fiches.index') }}" class="footer-link">
                                <i class="fas fa-file-alt me-2"></i>Fiches
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('home') }}" class="footer-link">
                                <i class="fas fa-home me-2"></i>Accueil
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Mon Compte -->
<div class="col-lg-3 col-md-6" style="background-color: #faf7f2;padding: 20px 10px;border-color: #faf7f2 #4dadc1 #38849a #4dadc1;border-width: 20px;border-style: solid;">
    
                    <h6 class="text-white fw-semibold mb-3">Mon Compte</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ route('profile.edit') }}" class="footer-link">
                                <i class="fas fa-user me-2"></i>Mon profil
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('profile.edit') }}#security" class="footer-link">
                                <i class="fas fa-lock me-2"></i>Sécurité
                            </a>
                        </li>
                        @if(auth()->user()->hasRole('admin'))
                        <li class="mb-2">
                            <a href="{{ route('admin.dashboard') }}" class="footer-link text-warning">
                                <i class="fas fa-cog me-2"></i>Administration
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>

                <!-- Informations -->
<div class="col-lg-3 col-md-6" style="background-color: #faf7f2;padding: 20px 10px;border-color: #faf7f2 #4dadc1 #38849a #4dadc1;border-width: 20px;border-style: solid;">
    
                    <h6 class="text-white fw-semibold mb-3">Informations</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="#" class="footer-link">
                                <i class="fas fa-question-circle me-2"></i>Aide
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('contact') }}" class="footer-link">
                                <i class="fas fa-envelope me-2"></i>Contact
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="footer-link">
                                <i class="fas fa-shield-alt me-2"></i>Confidentialité
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Barre de copyright -->
<div style="background-color: #148992;border-top: 10px solid #45b2fb;border-bottom: 10px solid #3fa5eb;border-left: 10px solid #de9933;border-right: 10px solid #dd3b33;">
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
                        <span class="text-light opacity-75 small">
                            <i class="fas fa-user-circle me-1"></i>
                            Connecté en tant que {{ auth()->user()->name }}
                        </span>
                        <a href="{{ route('home') }}" class="text-light opacity-75 text-decoration-none hover-opacity-100 small">
                            <i class="fas fa-home me-1"></i>Retour au site
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

{{-- CSS personnalisé pour le footer user --}}
@push('styles')
<style>
    /* Footer User */
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

    .hover-opacity-100:hover {
        opacity: 1 !important;
        transition: opacity 0.3s ease;
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
    }
</style>
@endpush
