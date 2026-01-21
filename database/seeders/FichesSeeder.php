<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FichesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Désactiver les contraintes de clés étrangères
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Vider les tables
        DB::table('fiches')->truncate();
        DB::table('fiches_sous_categories')->truncate();
        DB::table('fiches_categories')->truncate();
        
        // Réactiver les contraintes
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $now = Carbon::now();
        $userId = 1; // ID de l'admin par défaut

        // ============================================================================
        // CATÉGORIES PRINCIPALES
        // ============================================================================
        
        $categories = [
            [
                'id' => 1,
                'name' => 'Sécurité',
                'slug' => 'securite',
                'description' => 'Procédures et protocoles de sécurité',
                'image' => null,
                'meta_title' => 'Fiches Sécurité - D2S',
                'meta_description' => 'Documentation sur les procédures de sécurité',
                'meta_keywords' => 'sécurité, surveillance, piscine',
                'is_active' => true,
                'sort_order' => 1,
                'created_by' => $userId,
                'updated_by' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'name' => 'Hygiène',
                'slug' => 'hygiene',
                'description' => 'Protocoles d\'hygiène et contrôles sanitaires',
                'image' => null,
                'meta_title' => 'Fiches Hygiène - D2S',
                'meta_description' => 'Procédures d\'hygiène et de contrôle',
                'meta_keywords' => 'hygiène, qualité eau, nettoyage',
                'is_active' => true,
                'sort_order' => 2,
                'created_by' => $userId,
                'updated_by' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'name' => 'Maintenance',
                'slug' => 'maintenance',
                'description' => 'Guides de maintenance des installations',
                'image' => null,
                'meta_title' => 'Fiches Maintenance - D2S',
                'meta_description' => 'Documentation maintenance équipements',
                'meta_keywords' => 'maintenance, filtration, équipements',
                'is_active' => true,
                'sort_order' => 3,
                'created_by' => $userId,
                'updated_by' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'name' => 'Activités',
                'slug' => 'activites',
                'description' => 'Fiches techniques des activités proposées',
                'image' => null,
                'meta_title' => 'Activités - D2S',
                'meta_description' => 'Guides des activités sportives',
                'meta_keywords' => 'activités, natation, aquagym',
                'is_active' => true,
                'sort_order' => 4,
                'created_by' => $userId,
                'updated_by' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('fiches_categories')->insert($categories);

        // ============================================================================
        // SOUS-CATÉGORIES
        // ============================================================================

        $sousCategories = [
            // Sécurité
            [
                'id' => 1,
                'name' => 'POSS',
                'slug' => 'poss',
                'description' => 'Plan d\'Organisation de la Surveillance',
                'image' => null,
                'fiches_category_id' => 1,
                'meta_title' => 'POSS - D2S',
                'meta_description' => 'Plan d\'Organisation de la Surveillance et des Secours',
                'meta_keywords' => 'poss, surveillance, organisation',
                'is_active' => true,
                'sort_order' => 1,
                'created_by' => $userId,
                'updated_by' => null,
                'deleted_by' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'name' => 'Premiers Secours',
                'slug' => 'premiers-secours',
                'description' => 'Protocoles de premiers secours',
                'image' => null,
                'fiches_category_id' => 1,
                'meta_title' => 'Premiers Secours - D2S',
                'meta_description' => 'Procédures de sauvetage et premiers secours',
                'meta_keywords' => 'secours, sauvetage, réanimation',
                'is_active' => true,
                'sort_order' => 2,
                'created_by' => $userId,
                'updated_by' => null,
                'deleted_by' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Hygiène
            [
                'id' => 3,
                'name' => 'Qualité de l\'Eau',
                'slug' => 'qualite-eau',
                'description' => 'Contrôles qualité de l\'eau',
                'image' => null,
                'fiches_category_id' => 2,
                'meta_title' => 'Qualité de l\'Eau - D2S',
                'meta_description' => 'Contrôles et analyses de la qualité de l\'eau',
                'meta_keywords' => 'qualité eau, pH, chlore, analyses',
                'is_active' => true,
                'sort_order' => 1,
                'created_by' => $userId,
                'updated_by' => null,
                'deleted_by' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'name' => 'Nettoyage',
                'slug' => 'nettoyage',
                'description' => 'Protocoles de nettoyage',
                'image' => null,
                'fiches_category_id' => 2,
                'meta_title' => 'Nettoyage - D2S',
                'meta_description' => 'Procédures de nettoyage et désinfection',
                'meta_keywords' => 'nettoyage, désinfection, entretien',
                'is_active' => true,
                'sort_order' => 2,
                'created_by' => $userId,
                'updated_by' => null,
                'deleted_by' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Maintenance
            [
                'id' => 5,
                'name' => 'Filtration',
                'slug' => 'filtration',
                'description' => 'Maintenance des systèmes de filtration',
                'image' => null,
                'fiches_category_id' => 3,
                'meta_title' => 'Filtration - D2S',
                'meta_description' => 'Entretien et maintenance de la filtration',
                'meta_keywords' => 'filtration, pompes, filtres',
                'is_active' => true,
                'sort_order' => 1,
                'created_by' => $userId,
                'updated_by' => null,
                'deleted_by' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 6,
                'name' => 'Équipements',
                'slug' => 'equipements',
                'description' => 'Entretien du matériel sportif',
                'image' => null,
                'fiches_category_id' => 3,
                'meta_title' => 'Équipements - D2S',
                'meta_description' => 'Entretien du matériel et équipements',
                'meta_keywords' => 'équipements, matériel, entretien',
                'is_active' => true,
                'sort_order' => 2,
                'created_by' => $userId,
                'updated_by' => null,
                'deleted_by' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Activités
            [
                'id' => 7,
                'name' => 'Natation',
                'slug' => 'natation',
                'description' => 'Cours de natation',
                'image' => null,
                'fiches_category_id' => 4,
                'meta_title' => 'Natation - D2S',
                'meta_description' => 'Cours et apprentissage de la natation',
                'meta_keywords' => 'natation, cours, apprentissage',
                'is_active' => true,
                'sort_order' => 1,
                'created_by' => $userId,
                'updated_by' => null,
                'deleted_by' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 8,
                'name' => 'Aquagym',
                'slug' => 'aquagym',
                'description' => 'Cours d\'aquagym',
                'image' => null,
                'fiches_category_id' => 4,
                'meta_title' => 'Aquagym - D2S',
                'meta_description' => 'Cours d\'aquagym et fitness aquatique',
                'meta_keywords' => 'aquagym, fitness, activité aquatique',
                'is_active' => true,
                'sort_order' => 2,
                'created_by' => $userId,
                'updated_by' => null,
                'deleted_by' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('fiches_sous_categories')->insert($sousCategories);

        // ============================================================================
        // FICHES
        // ============================================================================

        $fiches = [
            // POSS - Fiche 1
            [
                'title' => 'Plan d\'Organisation de la Surveillance (POSS)',
                'slug' => 'plan-organisation-surveillance',
                'short_description' => 'Document réglementaire définissant l\'organisation de la surveillance des bassins.',
                'long_description' => '<h2>Introduction</h2><p>Le POSS est obligatoire pour toute piscine ouverte au public.</p><h3>Contenu</h3><ul><li>Organisation de la surveillance</li><li>Nombre de surveillants</li><li>Matériel de sauvetage</li><li>Procédures d\'urgence</li></ul>',
                'image' => null,
                'visibility' => 'authenticated',
                'is_published' => true,
                'is_featured' => true,
                'views_count' => 0,
                'sort_order' => 1,
                'fiches_category_id' => 1,
                'fiches_sous_category_id' => 1,
                'meta_title' => 'POSS - Plan d\'Organisation de la Surveillance',
                'meta_keywords' => 'poss, surveillance, sécurité, piscine, réglementation',
                'meta_description' => 'Document réglementaire définissant l\'organisation de la surveillance des bassins et les procédures de sécurité.',
                'meta_og_image' => null,
                'meta_og_url' => null,
                'created_by' => $userId,
                'created_by_name' => 'Admin D2S',
                'updated_by' => null,
                'deleted_by' => null,
                'published_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // POSS - Fiche 2
            [
                'title' => 'Postes de Surveillance',
                'slug' => 'postes-surveillance',
                'short_description' => 'Définition des postes de surveillance et zones à couvrir.',
                'long_description' => '<h2>Postes de Surveillance</h2><p><strong>Bassin 25m :</strong></p><ul><li>Poste 1 : Surveillance générale</li><li>Poste 2 : Zone profonde</li></ul><p><strong>Rotation :</strong> Toutes les 45 minutes</p>',
                'image' => null,
                'visibility' => 'authenticated',
                'is_published' => true,
                'is_featured' => false,
                'views_count' => 0,
                'sort_order' => 2,
                'fiches_category_id' => 1,
                'fiches_sous_category_id' => 1,
                'meta_title' => 'Postes de Surveillance - Organisation',
                'meta_keywords' => 'surveillance, postes, rotation, piscine, zones',
                'meta_description' => 'Organisation des postes de surveillance dans les piscines et définition des zones à couvrir.',
                'meta_og_image' => null,
                'meta_og_url' => null,
                'created_by' => $userId,
                'created_by_name' => 'Admin D2S',
                'updated_by' => null,
                'deleted_by' => null,
                'published_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Premiers Secours - Fiche 3
            [
                'title' => 'Protocole de Sauvetage',
                'slug' => 'protocole-sauvetage',
                'short_description' => 'Procédure de sauvetage d\'une personne en difficulté dans l\'eau.',
                'long_description' => '<h2>Étapes</h2><ol><li>Détection de la victime</li><li>Alerte (coup de sifflet)</li><li>Entrée dans l\'eau</li><li>Approche et prise</li><li>Remorquage</li><li>Sortie et bilan</li></ol><p><strong>Matériel :</strong> Perche, bouée tube, DAE</p>',
                'image' => null,
                'visibility' => 'authenticated',
                'is_published' => true,
                'is_featured' => true,
                'views_count' => 0,
                'sort_order' => 1,
                'fiches_category_id' => 1,
                'fiches_sous_category_id' => 2,
                'meta_title' => 'Protocole de Sauvetage Aquatique',
                'meta_keywords' => 'sauvetage, secours, réanimation, urgence, MNS',
                'meta_description' => 'Procédure complète de sauvetage d\'une personne en difficulté dans l\'eau.',
                'meta_og_image' => null,
                'meta_og_url' => null,
                'created_by' => $userId,
                'created_by_name' => 'Admin D2S',
                'updated_by' => null,
                'deleted_by' => null,
                'published_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Qualité Eau - Fiche 4
            [
                'title' => 'Relevé Quotidien des Paramètres',
                'slug' => 'releve-quotidien',
                'short_description' => 'Mesure quotidienne du pH, chlore et température de l\'eau.',
                'long_description' => '<h2>Paramètres à mesurer</h2><ul><li><strong>pH :</strong> 6,9 à 7,7</li><li><strong>Chlore libre :</strong> 0,4 à 1,4 mg/L</li><li><strong>Température :</strong> 26 à 30°C</li><li><strong>Transparence :</strong> Visible jusqu\'au fond</li></ul><p><strong>Horaire :</strong> Avant ouverture (7h-8h)</p>',
                'image' => null,
                'visibility' => 'authenticated',
                'is_published' => true,
                'is_featured' => true,
                'views_count' => 0,
                'sort_order' => 1,
                'fiches_category_id' => 2,
                'fiches_sous_category_id' => 3,
                'meta_title' => 'Relevé Quotidien Qualité Eau',
                'meta_keywords' => 'qualité eau, pH, chlore, température, analyses',
                'meta_description' => 'Procédure de mesure quotidienne des paramètres de qualité de l\'eau de piscine.',
                'meta_og_image' => null,
                'meta_og_url' => null,
                'created_by' => $userId,
                'created_by_name' => 'Admin D2S',
                'updated_by' => null,
                'deleted_by' => null,
                'published_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Qualité Eau - Fiche 5
            [
                'title' => 'Normes ARS',
                'slug' => 'normes-ars',
                'short_description' => 'Normes ARS pour la qualité de l\'eau des piscines.',
                'long_description' => '<h2>Valeurs de référence</h2><table border="1"><tr><th>Paramètre</th><th>Min</th><th>Max</th></tr><tr><td>pH</td><td>6,9</td><td>7,7</td></tr><tr><td>Chlore libre</td><td>0,4</td><td>1,4</td></tr><tr><td>Chlore combiné</td><td>-</td><td>0,6</td></tr></table>',
                'image' => null,
                'visibility' => 'public',
                'is_published' => true,
                'is_featured' => false,
                'views_count' => 0,
                'sort_order' => 2,
                'fiches_category_id' => 2,
                'fiches_sous_category_id' => 3,
                'meta_title' => 'Normes ARS Qualité Eau',
                'meta_keywords' => 'normes, ARS, qualité eau, réglementation, piscine',
                'meta_description' => 'Normes ARS pour la qualité de l\'eau des piscines publiques et valeurs de référence.',
                'meta_og_image' => null,
                'meta_og_url' => null,
                'created_by' => $userId,
                'created_by_name' => 'Admin D2S',
                'updated_by' => null,
                'deleted_by' => null,
                'published_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Nettoyage - Fiche 6
            [
                'title' => 'Protocole Nettoyage Bassins',
                'slug' => 'nettoyage-bassins',
                'short_description' => 'Protocole quotidien de nettoyage des bassins.',
                'long_description' => '<h2>Nettoyage quotidien</h2><ul><li>Aspiration du fond (robot ou manuel)</li><li>Nettoyage ligne d\'eau</li><li>Vidage des skimmers</li><li>Nettoyage plages</li></ul><p><strong>Produits :</strong> Détergent neutre, désinfectant</p>',
                'image' => null,
                'visibility' => 'authenticated',
                'is_published' => true,
                'is_featured' => false,
                'views_count' => 0,
                'sort_order' => 1,
                'fiches_category_id' => 2,
                'fiches_sous_category_id' => 4,
                'meta_title' => 'Protocole Nettoyage Bassins',
                'meta_keywords' => 'nettoyage, bassins, désinfection, entretien, hygiène',
                'meta_description' => 'Protocole quotidien de nettoyage et désinfection des bassins de piscine.',
                'meta_og_image' => null,
                'meta_og_url' => null,
                'created_by' => $userId,
                'created_by_name' => 'Admin D2S',
                'updated_by' => null,
                'deleted_by' => null,
                'published_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Filtration - Fiche 7
            [
                'title' => 'Maintenance Filtration',
                'slug' => 'maintenance-filtration',
                'short_description' => 'Check-list hebdomadaire de maintenance des filtres.',
                'long_description' => '<h2>Actions hebdomadaires</h2><ol><li>Contre-lavage des filtres (3-5 min)</li><li>Rinçage (1 min)</li><li>Nettoyage skimmers</li><li>Contrôle pression manomètres</li><li>Vérification débits</li></ol><p><strong>Fréquence :</strong> Chaque lundi matin</p>',
                'image' => null,
                'visibility' => 'authenticated',
                'is_published' => true,
                'is_featured' => false,
                'views_count' => 0,
                'sort_order' => 1,
                'fiches_category_id' => 3,
                'fiches_sous_category_id' => 5,
                'meta_title' => 'Maintenance Filtration Piscine',
                'meta_keywords' => 'filtration, maintenance, contre-lavage, pompes, filtres',
                'meta_description' => 'Check-list hebdomadaire de maintenance préventive des systèmes de filtration.',
                'meta_og_image' => null,
                'meta_og_url' => null,
                'created_by' => $userId,
                'created_by_name' => 'Admin D2S',
                'updated_by' => null,
                'deleted_by' => null,
                'published_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Équipements - Fiche 8
            [
                'title' => 'Entretien Matériel Pédagogique',
                'slug' => 'entretien-materiel',
                'short_description' => 'Entretien des planches, frites et matériel aquatique.',
                'long_description' => '<h2>Contrôles réguliers</h2><ul><li>Vérifier état (fissures, usure)</li><li>Nettoyer à l\'eau savonneuse</li><li>Désinfecter</li><li>Sécher avant rangement</li></ul><p><strong>Éliminer :</strong> Matériel abîmé ou dangereux</p>',
                'image' => null,
                'visibility' => 'authenticated',
                'is_published' => true,
                'is_featured' => false,
                'views_count' => 0,
                'sort_order' => 1,
                'fiches_category_id' => 3,
                'fiches_sous_category_id' => 6,
                'meta_title' => 'Entretien Matériel Pédagogique',
                'meta_keywords' => 'matériel, entretien, équipements, planches, frites',
                'meta_description' => 'Guide d\'entretien du matériel pédagogique aquatique (planches, frites, bouées).',
                'meta_og_image' => null,
                'meta_og_url' => null,
                'created_by' => $userId,
                'created_by_name' => 'Admin D2S',
                'updated_by' => null,
                'deleted_by' => null,
                'published_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Natation - Fiche 9
            [
                'title' => 'Cours Natation Débutant',
                'slug' => 'natation-debutant',
                'short_description' => 'Programme pédagogique pour l\'apprentissage natation niveau débutant.',
                'long_description' => '<h2>Objectifs</h2><ul><li>Familiarisation avec l\'eau</li><li>Immersion complète</li><li>Flottaison ventrale</li><li>Déplacements simples</li></ul><h3>Séance type (45 min)</h3><ol><li>Échauffement (5 min)</li><li>Exercices (30 min)</li><li>Jeux ludiques (10 min)</li></ol>',
                'image' => null,
                'visibility' => 'authenticated',
                'is_published' => true,
                'is_featured' => false,
                'views_count' => 0,
                'sort_order' => 1,
                'fiches_category_id' => 4,
                'fiches_sous_category_id' => 7,
                'meta_title' => 'Cours Natation Débutant - Programme',
                'meta_keywords' => 'natation, débutant, cours, apprentissage, pédagogie',
                'meta_description' => 'Programme pédagogique pour l\'apprentissage de la natation niveau débutant.',
                'meta_og_image' => null,
                'meta_og_url' => null,
                'created_by' => $userId,
                'created_by_name' => 'Admin D2S',
                'updated_by' => null,
                'deleted_by' => null,
                'published_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Aquagym - Fiche 10
            [
                'title' => 'Séance Aquagym Douce',
                'slug' => 'aquagym-douce',
                'short_description' => 'Déroulé d\'une séance d\'aquagym douce pour seniors.',
                'long_description' => '<h2>Déroulé (45 min)</h2><ol><li><strong>Échauffement (10 min) :</strong> Marche dans l\'eau, mouvements doux</li><li><strong>Cardio léger (15 min) :</strong> Exercices dynamiques adaptés</li><li><strong>Renforcement (15 min) :</strong> Frites, haltères aquatiques</li><li><strong>Étirements (5 min) :</strong> Retour au calme</li></ol><p><strong>Musique :</strong> Rythme modéré, 120-130 BPM</p>',
                'image' => null,
                'visibility' => 'authenticated',
                'is_published' => true,
                'is_featured' => false,
                'views_count' => 0,
                'sort_order' => 1,
                'fiches_category_id' => 4,
                'fiches_sous_category_id' => 8,
                'meta_title' => 'Séance Aquagym Douce - Programme',
                'meta_keywords' => 'aquagym, seniors, fitness, activité douce, piscine',
                'meta_description' => 'Déroulé complet d\'une séance d\'aquagym douce adaptée aux seniors et publics fragiles.',
                'meta_og_image' => null,
                'meta_og_url' => null,
                'created_by' => $userId,
                'created_by_name' => 'Admin D2S',
                'updated_by' => null,
                'deleted_by' => null,
                'published_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Fiche brouillon (non publiée) - Fiche 11
            [
                'title' => 'Règlement Intérieur (Brouillon)',
                'slug' => 'reglement-interieur-brouillon',
                'short_description' => 'Cette fiche est en cours de rédaction.',
                'long_description' => '<p>Contenu en cours de rédaction...</p>',
                'image' => null,
                'visibility' => 'public',
                'is_published' => false,
                'is_featured' => false,
                'views_count' => 0,
                'sort_order' => 999,
                'fiches_category_id' => 1,
                'fiches_sous_category_id' => 1,
                'meta_title' => 'Règlement Intérieur - Brouillon',
                'meta_keywords' => 'règlement, intérieur, piscine, règles',
                'meta_description' => 'Règlement intérieur en cours de rédaction',
                'meta_og_image' => null,
                'meta_og_url' => null,
                'created_by' => $userId,
                'created_by_name' => 'Admin D2S',
                'updated_by' => null,
                'deleted_by' => null,
                'published_at' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('fiches')->insert($fiches);

        $this->command->info('✅ Seeder FichesSeeder exécuté avec succès !');
        $this->command->info('📊 ' . count($categories) . ' catégories créées');
        $this->command->info('📂 ' . count($sousCategories) . ' sous-catégories créées');
        $this->command->info('📄 ' . count($fiches) . ' fiches créées');
        $this->command->newLine();
        $this->command->info('💡 Détails :');
        $this->command->info('   - 10 fiches publiées');
        $this->command->info('   - 1 fiche brouillon (non publiée)');
        $this->command->info('   - 3 fiches mises en avant (featured)');
        $this->command->info('   - Visibilité : 9 authentifiées + 2 publiques');
    }
}