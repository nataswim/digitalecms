@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <section class="bg-primary text-white py-5">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3">Contactez-nous</h1>
            <p class="lead">Nous sommes là pour vous aider</p>
        </div>
    </section>

    <!-- Contact Form & Info -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Formulaire de contact -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-bottom p-4">
                            <h4 class="mb-0">
                                <i class="fas fa-envelope text-primary me-2"></i>
                                Envoyez-nous un message
                            </h4>
                        </div>
                        <div class="card-body p-4">
                            <form>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label fw-semibold">
                                            Nom complet <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="name" required>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="email" class="form-label fw-semibold">
                                            Email <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" class="form-control" id="email" required>
                                    </div>
                                    
                                    <div class="col-12">
                                        <label for="subject" class="form-label fw-semibold">
                                            Sujet <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select" id="subject" required>
                                            <option value="">Sélectionner un sujet</option>
                                            <option value="support">Support technique</option>
                                            <option value="billing">Facturation</option>
                                            <option value="feature">Suggestion de fonctionnalité</option>
                                            <option value="bug">Signaler un bug</option>
                                            <option value="other">Autre</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-12">
                                        <label for="message" class="form-label fw-semibold">
                                            Message <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control" id="message" rows="6" required></textarea>
                                    </div>
                                    
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary px-4">
                                            <i class="fas fa-paper-plane me-2"></i>
                                            Envoyer le message
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Informations de contact -->
                <div class="col-lg-4">
                    <!-- Coordonnées -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">
                                <i class="fas fa-info-circle text-primary me-2"></i>
                                Coordonnées
                            </h5>
                            
                            <div class="mb-4">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" 
                                         style="width: 40px; height: 40px; min-width: 40px;">
                                        <i class="fas fa-envelope text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold mb-1">Email</div>
                                        <a href="mailto:contact@cmssport.fr" class="text-decoration-none text-muted">
                                            contact@cmssport.fr
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-start mb-3">
                                    <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" 
                                         style="width: 40px; height: 40px; min-width: 40px;">
                                        <i class="fas fa-phone text-success"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold mb-1">Téléphone</div>
                                        <a href="tel:+33123456789" class="text-decoration-none text-muted">
                                            +33 1 23 45 67 89
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-start">
                                    <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" 
                                         style="width: 40px; height: 40px; min-width: 40px;">
                                        <i class="fas fa-map-marker-alt text-warning"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold mb-1">Adresse</div>
                                        <p class="text-muted mb-0">
                                            123 Avenue du Sport<br>
                                            75001 Paris, France
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Horaires -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">
                                <i class="fas fa-clock text-primary me-2"></i>
                                Horaires d'ouverture
                            </h5>
                            
                            <div class="small">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Lundi - Vendredi</span>
                                    <strong>9h00 - 18h00</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Samedi</span>
                                    <strong>10h00 - 16h00</strong>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">Dimanche</span>
                                    <strong class="text-danger">Fermé</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Réseaux sociaux -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">
                                <i class="fas fa-share-alt text-primary me-2"></i>
                                Suivez-nous
                            </h5>
                            
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-outline-primary">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="btn btn-outline-info">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-outline-danger">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="btn btn-outline-primary">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ rapide -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Questions fréquentes</h2>
                <p class="text-muted">Trouvez rapidement des réponses</p>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Comment créer un compte ?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Cliquez sur "S'inscrire" en haut de la page, remplissez le formulaire et validez votre email.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Quels sont les rôles disponibles ?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Nous proposons 7 rôles : Admin, Entraîneur Principal, Assistant, Nageur MNS, Agent Sportif, Technicien et Sportif Amateur.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item border-0 shadow-sm">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Comment obtenir de l'aide ?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Utilisez le formulaire ci-dessus ou contactez-nous par email à contact@cmssport.fr
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