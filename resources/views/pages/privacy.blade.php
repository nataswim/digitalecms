@extends('layouts.app')

@section('title', 'Politique de confidentialité')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <section class="bg-primary text-white py-5">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3">Politique de confidentialité</h1>
            <p class="lead">Dernière mise à jour : {{ date('d/m/Y') }}</p>
        </div>
    </section>

    <!-- Contenu -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-5">
                            <!-- Introduction -->
                            <div class="mb-5">
                                <div class="alert alert-info bg-info bg-opacity-10 border-0">
                                    <div class="d-flex align-items-start">
                                        <i class="fas fa-info-circle text-info me-3 mt-1"></i>
                                        <p class="mb-0">
                                            Cette politique de confidentialité décrit comment Digital’SOS (Digital Sport Organisation System) collecte, 
                                            utilise et protège vos informations personnelles. En utilisant notre plateforme, 
                                            vous acceptez les pratiques décrites dans cette politique.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- 1. Collecte des données -->
                            <div class="mb-5">
                                <h3 class="fw-bold mb-3">
                                    <i class="fas fa-database text-primary me-2"></i>
                                    1. Collecte des données
                                </h3>
                                <p class="text-muted mb-3">
                                    Nous collectons les types d'informations suivants :
                                </p>
                                <ul class="text-muted">
                                    <li class="mb-2">
                                        <strong>Informations d'identification :</strong> nom, prénom, email, nom d'utilisateur
                                    </li>
                                    <li class="mb-2">
                                        <strong>Informations de profil :</strong> photo, téléphone, biographie, date de naissance
                                    </li>
                                    <li class="mb-2">
                                        <strong>Données d'utilisation :</strong> adresse IP, connexions, activités sur la plateforme
                                    </li>
                                    <li class="mb-2">
                                        <strong>Données sportives :</strong> performances, programmes d'entraînement, statistiques
                                    </li>
                                </ul>
                            </div>

                            <!-- 2. Utilisation des données -->
                            <div class="mb-5">
                                <h3 class="fw-bold mb-3">
                                    <i class="fas fa-cogs text-success me-2"></i>
                                    2. Utilisation des données
                                </h3>
                                <p class="text-muted mb-3">
                                    Nous utilisons vos données pour :
                                </p>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="border-start border-primary border-3 ps-3">
                                            <strong class="d-block mb-1">Fourniture du service</strong>
                                            <small class="text-muted">
                                                Créer et gérer votre compte, personnaliser votre expérience
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="border-start border-success border-3 ps-3">
                                            <strong class="d-block mb-1">Communication</strong>
                                            <small class="text-muted">
                                                Vous envoyer des notifications et mises à jour importantes
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="border-start border-warning border-3 ps-3">
                                            <strong class="d-block mb-1">Amélioration</strong>
                                            <small class="text-muted">
                                                Analyser l'utilisation pour améliorer nos services
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="border-start border-info border-3 ps-3">
                                            <strong class="d-block mb-1">Sécurité</strong>
                                            <small class="text-muted">
                                                Protéger contre les fraudes et abus
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 3. Partage des données -->
                            <div class="mb-5">
                                <h3 class="fw-bold mb-3">
                                    <i class="fas fa-share-alt text-warning me-2"></i>
                                    3. Partage des données
                                </h3>
                                <p class="text-muted mb-3">
                                    Nous ne vendons jamais vos données personnelles. Nous pouvons partager vos informations uniquement :
                                </p>
                                <ul class="text-muted">
                                    <li class="mb-2">Avec votre consentement explicite</li>
                                    <li class="mb-2">Avec les entraîneurs et membres de votre équipe (selon vos paramètres)</li>
                                    <li class="mb-2">Pour se conformer aux obligations légales</li>
                                    <li class="mb-2">Avec des prestataires de services qui nous aident à opérer la plateforme</li>
                                </ul>
                            </div>

                            <!-- 4. Sécurité -->
                            <div class="mb-5">
                                <h3 class="fw-bold mb-3">
                                    <i class="fas fa-shield-alt text-danger me-2"></i>
                                    4. Sécurité des données
                                </h3>
                                <div class="alert alert-success bg-success bg-opacity-10 border-0">
                                    <div class="d-flex align-items-start">
                                        <i class="fas fa-lock text-success me-3 mt-1"></i>
                                        <div>
                                            <p class="mb-2">
                                                <strong>Nous prenons la sécurité au sérieux :</strong>
                                            </p>
                                            <ul class="mb-0">
                                                <li>Chiffrement des données sensibles</li>
                                                <li>Authentification sécurisée avec hashage des mots de passe</li>
                                                <li>Système de permissions granulaire</li>
                                                <li>Surveillance continue des accès</li>
                                                <li>Sauvegardes régulières</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 5. Vos droits -->
                            <div class="mb-5">
                                <h3 class="fw-bold mb-3">
                                    <i class="fas fa-user-shield text-info me-2"></i>
                                    5. Vos droits
                                </h3>
                                <p class="text-muted mb-3">
                                    Conformément au RGPD, vous disposez des droits suivants :
                                </p>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="card border-0 bg-light">
                                            <div class="card-body p-3">
                                                <h6 class="fw-bold mb-2">
                                                    <i class="fas fa-eye text-primary me-2"></i>
                                                    Droit d'accès
                                                </h6>
                                                <small class="text-muted">
                                                    Consulter vos données personnelles
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card border-0 bg-light">
                                            <div class="card-body p-3">
                                                <h6 class="fw-bold mb-2">
                                                    <i class="fas fa-edit text-success me-2"></i>
                                                    Droit de rectification
                                                </h6>
                                                <small class="text-muted">
                                                    Corriger vos informations
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card border-0 bg-light">
                                            <div class="card-body p-3">
                                                <h6 class="fw-bold mb-2">
                                                    <i class="fas fa-trash text-danger me-2"></i>
                                                    Droit à l'effacement
                                                </h6>
                                                <small class="text-muted">
                                                    Supprimer vos données
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card border-0 bg-light">
                                            <div class="card-body p-3">
                                                <h6 class="fw-bold mb-2">
                                                    <i class="fas fa-download text-warning me-2"></i>
                                                    Droit à la portabilité
                                                </h6>
                                                <small class="text-muted">
                                                    Récupérer vos données
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-muted mt-3 mb-0">
                                    Pour exercer ces droits, contactez-nous à 
                                    <a href="mailto:privacy@cmssport.fr">privacy@cmssport.fr</a>
                                </p>
                            </div>

                            <!-- 6. Cookies -->
                            <div class="mb-5">
                                <h3 class="fw-bold mb-3">
                                    <i class="fas fa-cookie-bite text-warning me-2"></i>
                                    6. Cookies et technologies similaires
                                </h3>
                                <p class="text-muted mb-3">
                                    Nous utilisons des cookies pour améliorer votre expérience. Vous pouvez les gérer 
                                    dans les paramètres de votre navigateur.
                                </p>
                            </div>

                            <!-- 7. Contact -->
                            <div class="mb-0">
                                <h3 class="fw-bold mb-3">
                                    <i class="fas fa-envelope text-primary me-2"></i>
                                    7. Nous contacter
                                </h3>
                                <p class="text-muted mb-3">
                                    Pour toute question concernant cette politique de confidentialité :
                                </p>
                                <div class="alert alert-primary bg-primary bg-opacity-10 border-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Email :</strong>
                                            <a href="mailto:privacy@cmssport.fr">privacy@cmssport.fr</a>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Adresse :</strong>
                                            123 Avenue du Sport, 75001 Paris
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection