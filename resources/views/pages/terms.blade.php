@extends('layouts.app')

@section('title', 'Conditions d\'utilisation')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <section class="bg-primary text-white py-5">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3">Conditions d'utilisation</h1>
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
                                <div class="alert alert-warning bg-warning bg-opacity-10 border-0">
                                    <div class="d-flex align-items-start">
                                        <i class="fas fa-exclamation-triangle text-warning me-3 mt-1"></i>
                                        <p class="mb-0">
                                            En accédant et en utilisant MyCreaNet Digital Solutions, vous acceptez d'être lié par ces 
                                            conditions d'utilisation. Si vous n'acceptez pas ces conditions, veuillez 
                                            ne pas utiliser notre plateforme.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- 1. Acceptation des conditions -->
                            <div class="mb-5">
                                <h3 class="fw-bold mb-3">
                                    <i class="fas fa-handshake text-primary me-2"></i>
                                    1. Acceptation des conditions
                                </h3>
                                <p class="text-muted mb-0">
                                    En créant un compte sur MyCreaNet Digital Solutions, vous confirmez que vous avez lu, compris et 
                                    accepté ces conditions d'utilisation ainsi que notre politique de confidentialité. 
                                    Ces conditions constituent un accord légal entre vous et MyCreaNet Digital Solutions.
                                </p>
                            </div>

                            <!-- 2. Utilisation du service -->
                            <div class="mb-5">
                                <h3 class="fw-bold mb-3">
                                    <i class="fas fa-user-check text-success me-2"></i>
                                    2. Utilisation du service
                                </h3>
                                <p class="text-muted mb-3">
                                    Vous vous engagez à :
                                </p>
                                <ul class="text-muted">
                                    <li class="mb-2">Fournir des informations exactes et à jour lors de votre inscription</li>
                                    <li class="mb-2">Maintenir la confidentialité de votre mot de passe</li>
                                    <li class="mb-2">Utiliser le service de manière légale et appropriée</li>
                                    <li class="mb-2">Ne pas partager votre compte avec d'autres personnes</li>
                                    <li class="mb-2">Respecter les droits de propriété intellectuelle</li>
                                </ul>
                            </div>

                            <!-- 3. Compte utilisateur -->
                            <div class="mb-5">
                                <h3 class="fw-bold mb-3">
                                    <i class="fas fa-user-circle text-info me-2"></i>
                                    3. Compte utilisateur
                                </h3>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="card border-0 bg-light h-100">
                                            <div class="card-body p-4">
                                                <h6 class="fw-bold mb-3">
                                                    <i class="fas fa-user-plus text-primary me-2"></i>
                                                    Création de compte
                                                </h6>
                                                <ul class="small text-muted mb-0">
                                                    <li>Vous devez avoir au moins 18 ans</li>
                                                    <li>Un compte par personne</li>
                                                    <li>Informations véridiques requises</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card border-0 bg-light h-100">
                                            <div class="card-body p-4">
                                                <h6 class="fw-bold mb-3">
                                                    <i class="fas fa-shield-alt text-success me-2"></i>
                                                    Sécurité
                                                </h6>
                                                <ul class="small text-muted mb-0">
                                                    <li>Mot de passe sécurisé obligatoire</li>
                                                    <li>Responsabilité de votre compte</li>
                                                    <li>Signaler toute activité suspecte</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 4. Rôles et permissions -->
                            <div class="mb-5">
                                <h3 class="fw-bold mb-3">
                                    <i class="fas fa-users-cog text-warning me-2"></i>
                                    4. Rôles et permissions
                                </h3>
                                <p class="text-muted mb-3">
                                    Notre plateforme utilise un système de rôles et permissions :
                                </p>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Rôle</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><span class="badge bg-danger">Admin</span></td>
                                                <td class="text-muted">Accès complet au système</td>
                                            </tr>
                                            <tr>
                                                <td><span class="badge bg-primary">Manager</span></td>
                                                <td class="text-muted">Gestion des programmes et athlètes</td>
                                            </tr>
                                            <tr>
                                                <td><span class="badge bg-info">Editor</span></td>
                                                <td class="text-muted">Création et modification de contenu</td>
                                            </tr>
                                            <tr>
                                                <td><span class="badge bg-success">User</span></td>
                                                <td class="text-muted">Accès utilisateur standard</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- 5. Contenu utilisateur -->
                            <div class="mb-5">
                                <h3 class="fw-bold mb-3">
                                    <i class="fas fa-file-alt text-primary me-2"></i>
                                    5. Contenu utilisateur
                                </h3>
                                <p class="text-muted mb-3">
                                    En publiant du contenu sur MyCreaNet Digital Solutions :
                                </p>
                                <ul class="text-muted">
                                    <li class="mb-2">Vous conservez la propriété de votre contenu</li>
                                    <li class="mb-2">Vous accordez une licence d'utilisation à MyCreaNet Digital Solutions</li>
                                    <li class="mb-2">Vous garantissez que le contenu ne viole aucun droit</li>
                                    <li class="mb-2">Vous êtes responsable de votre contenu</li>
                                </ul>
                            </div>

                            <!-- 6. Comportements interdits -->
                            <div class="mb-5">
                                <h3 class="fw-bold mb-3">
                                    <i class="fas fa-ban text-danger me-2"></i>
                                    6. Comportements interdits
                                </h3>
                                <div class="alert alert-danger bg-danger bg-opacity-10 border-0">
                                    <p class="mb-2"><strong>Il est strictement interdit de :</strong></p>
                                    <ul class="mb-0">
                                        <li>Utiliser le service à des fins illégales</li>
                                        <li>Harceler, menacer ou intimider d'autres utilisateurs</li>
                                        <li>Publier du contenu offensant, diffamatoire ou pornographique</li>
                                        <li>Tenter de pirater ou compromettre la sécurité</li>
                                        <li>Utiliser des bots ou scripts automatisés</li>
                                        <li>Usurper l'identité d'une autre personne</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- 7. Propriété intellectuelle -->
                            <div class="mb-5">
                                <h3 class="fw-bold mb-3">
                                    <i class="fas fa-copyright text-warning me-2"></i>
                                    7. Propriété intellectuelle
                                </h3>
                                <p class="text-muted mb-0">
                                    Tous les éléments de MyCreaNet Digital Solutions (logo, design, code, contenu) sont protégés par 
                                    les droits d'auteur et autres droits de propriété intellectuelle. Toute reproduction 
                                    non autorisée est interdite.
                                </p>
                            </div>

                            <!-- 8. Limitation de responsabilité -->
                            <div class="mb-5">
                                <h3 class="fw-bold mb-3">
                                    <i class="fas fa-exclamation-circle text-info me-2"></i>
                                    8. Limitation de responsabilité
                                </h3>
                                <p class="text-muted mb-3">
                                    MyCreaNet Digital Solutions est fourni "tel quel". Nous ne garantissons pas :
                                </p>
                                <ul class="text-muted">
                                    <li class="mb-2">L'absence d'interruptions ou d'erreurs</li>
                                    <li class="mb-2">L'exactitude complète des informations</li>
                                    <li class="mb-2">La compatibilité avec tous les appareils</li>
                                </ul>
                            </div>

                            <!-- 9. Résiliation -->
                            <div class="mb-5">
                                <h3 class="fw-bold mb-3">
                                    <i class="fas fa-user-times text-danger me-2"></i>
                                    9. Résiliation
                                </h3>
                                <p class="text-muted mb-3">
                                    Nous nous réservons le droit de suspendre ou supprimer votre compte si :
                                </p>
                                <ul class="text-muted">
                                    <li class="mb-2">Vous violez ces conditions d'utilisation</li>
                                    <li class="mb-2">Votre comportement nuit à la communauté</li>
                                    <li class="mb-2">Nous le jugeons nécessaire pour protéger le service</li>
                                </ul>
                            </div>

                            <!-- 10. Modifications -->
                            <div class="mb-5">
                                <h3 class="fw-bold mb-3">
                                    <i class="fas fa-edit text-success me-2"></i>
                                    10. Modifications des conditions
                                </h3>
                                <p class="text-muted mb-0">
                                    Nous pouvons modifier ces conditions à tout moment. Les modifications importantes 
                                    seront notifiées par email. Continuer à utiliser le service après modification 
                                    constitue une acceptation des nouvelles conditions.
                                </p>
                            </div>

                            <!-- Contact -->
                            <div class="mb-0">
                                <h3 class="fw-bold mb-3">
                                    <i class="fas fa-envelope text-primary me-2"></i>
                                    Contact
                                </h3>
                                <p class="text-muted mb-3">
                                    Pour toute question concernant ces conditions :
                                </p>
                                <div class="alert alert-primary bg-primary bg-opacity-10 border-0">
                                    <div class="row">
                                        <div class="col-md-6 mb-2 mb-md-0">
                                            <strong>Email :</strong>
                                            <a href="mailto:legal@cmssport.fr">legal@cmssport.fr</a>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Page contact :</strong>
                                            <a href="{{ route('contact') }}">{{ route('contact') }}</a>
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