# D2S - PLAN DE DÉVELOPPEMENT ORDONNÉ
## Basé sur l'existant du projet

---

## ✅ ÉTAT ACTUEL - CE QUI EST DÉJÀ CRÉÉ

### Models (8)
```
✅ User.php
✅ Role.php
✅ Permission.php
✅ MediaCategory.php
✅ Media.php
✅ FichesCategory.php
✅ FichesSousCategory.php
✅ Fiche.php
```

### Controllers (20+)
```
✅ Auth/* (authentification complète Laravel Breeze)
✅ UserController.php
✅ RoleController.php
✅ PermissionController.php
✅ MediaController.php
✅ FicheController.php
✅ FichesCategoryController.php
✅ FichesSousCategoryController.php
✅ PublicFicheController.php
✅ HomeController.php
✅ DashboardController.php
✅ ProfileController.php
```

### Migrations (14)
```
✅ 0001_01_01_000000_create_users_table.php
✅ 0001_01_01_000001_create_cache_table.php
✅ 0001_01_01_000002_create_jobs_table.php
✅ 2026_01_03_124407_create_roles_table.php
✅ 2026_01_03_124950_create_permissions_table.php
✅ 2026_01_03_124951_add_fields_to_users_table.php
✅ 2026_01_03_124954_create_role_user_table.php
✅ 2026_01_03_124955_create_permission_user_table.php
✅ 2026_01_03_124956_create_permission_role_table.php
✅ 2026_01_08_202209_create_media_categories_table.php
✅ 2026_01_08_202211_create_media_table.php
✅ 2026_01_09_150854_create_fiches_categories_table.php
✅ 2026_01_09_151128_create_fiches_sous_categories_table.php
✅ 2026_01_09_151234_create_fiches_table.php
```

### Modules fonctionnels complétés
```
✅ Authentification (Laravel Breeze)
✅ RBAC (Roles & Permissions)
✅ Gestion Médias
✅ Système de Fiches (contenu)
```

---

## ❌ CE QUI RESTE À DÉVELOPPER

Selon la cartographie des 9 modules :

```
❌ M1 : Hiérarchie Spatiale (services, structures, espaces, zones)
❌ M2 : Agents complets (types, compétences, certifications, rattachements)
❌ M3 : Planification (activités, assignations agents)
❌ M4 : Gestion Matériel
❌ M5 : Fréquentation
❌ M6 : Carnet Sanitaire
❌ M7 : Congés & Remplacements
❌ M8 : Messagerie
❌ M9 : D2S Storage (extension médias existants)
```

---

## 📋 PLAN DE DÉVELOPPEMENT ORDONNÉ PAR ÉTAPES

### 🔹 **ÉTAPE 1 : M1 - HIÉRARCHIE SPATIALE** (Priorité P0 - 2 semaines)
**Pourquoi d'abord ?** Aucune dépendance. TOUT le reste dépend de M1.

#### 1.1 Migrations à créer (ORDRE STRICT)
```
1️⃣ create_services_table.php
   └─ Colonnes : id, nom, description, adresse, ville, code_postal, pays, 
                 actif, timestamps

2️⃣ create_structures_table.php
   └─ Colonnes : id, service_id (FK), nom, description, type, 
                 adresse, horaires_ouverture (JSON), actif, timestamps
   └─ Dépend de : services

3️⃣ create_espaces_table.php
   └─ Colonnes : id, structure_id (FK), nom, description, type, 
                 capacite_max, equipements_fixes (JSON), actif, timestamps
   └─ Dépend de : structures

4️⃣ create_zones_table.php
   └─ Colonnes : id, espace_id (FK), nom, description, 
                 capacite_max, encadrement_obligatoire, actif, timestamps
   └─ Dépend de : espaces
```

#### 1.2 Models à créer (ORDRE STRICT)
```
1️⃣ Service.php
   └─ Relations : hasMany(Structure)

2️⃣ Structure.php
   └─ Relations : belongsTo(Service), hasMany(Espace)

3️⃣ Espace.php
   └─ Relations : belongsTo(Structure), hasMany(Zone)

4️⃣ Zone.php
   └─ Relations : belongsTo(Espace)
```

#### 1.3 Controllers à créer
```
□ ServiceController.php (CRUD complet)
□ StructureController.php (CRUD complet)
□ EspaceController.php (CRUD complet)
□ ZoneController.php (CRUD complet)
```

#### 1.4 Seeders à créer (optionnel mais recommandé)
```
□ ServiceSeeder.php (créer 1-2 services exemple)
□ StructureSeeder.php (créer structures exemple par service)
□ EspaceSeeder.php (créer espaces exemple)
□ ZoneSeeder.php (créer zones exemple)
```

#### 1.5 Vues à créer
```
resources/views/admin/services/ (index, create, edit, show)
resources/views/admin/structures/ (index, create, edit, show)
resources/views/admin/espaces/ (index, create, edit, show)
resources/views/admin/zones/ (index, create, edit, show)
```

---

### 🔹 **ÉTAPE 2 : M2 - AGENTS COMPLETS** (Priorité P0 - 2 semaines)
**Pourquoi maintenant ?** Dépend de M1 (rattachements structures). Requis pour M3.

#### 2.1 Migrations à créer (ORDRE STRICT)
```
1️⃣ create_agent_types_table.php
   └─ Colonnes : id, code (T1-T7), libelle, description, actif, timestamps
   └─ Note : 7 types prédéfinis (MNS, Coach, BNSSA, Accueil, Entretien, Maintenance, Animateur)

2️⃣ create_agents_table.php
   └─ Colonnes : id, user_id (FK), agent_type_id (FK), 
                 nom, prenom, date_naissance, photo, 
                 email, telephone, telephone_secondaire, adresse,
                 statut (temps_plein/partiel/cdd/cdi/stagiaire),
                 date_entree, actif, timestamps
   └─ Dépend de : users, agent_types

3️⃣ create_agent_service_table.php (pivot)
   └─ Colonnes : id, agent_id (FK), service_id (FK), 
                 date_assignation, actif, timestamps
   └─ Dépend de : agents, services
   └─ Note : Relation N:N (un agent peut être dans plusieurs services)

4️⃣ create_competences_table.php
   └─ Colonnes : id, nom, categorie, description, actif, timestamps

5️⃣ create_agent_competences_table.php (pivot)
   └─ Colonnes : id, agent_id (FK), competence_id (FK), 
                 niveau, date_obtention, notes, timestamps
   └─ Dépend de : agents, competences

6️⃣ create_certifications_table.php
   └─ Colonnes : id, nom, organisme, description, duree_validite_mois, actif, timestamps

7️⃣ create_agent_certifications_table.php (pivot)
   └─ Colonnes : id, agent_id (FK), certification_id (FK),
                 date_obtention, date_expiration, numero_certificat, 
                 document_path, actif, timestamps
   └─ Dépend de : agents, certifications

8️⃣ create_taches_table.php
   └─ Colonnes : id, agent_id (FK), createur_id (FK users),
                 titre, description, priorite (basse/moyenne/haute/urgente),
                 statut (a_faire/en_cours/terminee/non_realisee),
                 date_echeance, commentaires (JSON), timestamps
   └─ Dépend de : agents, users
```

#### 2.2 Models à créer
```
□ AgentType.php
□ Agent.php (relations : belongsTo(User), belongsTo(AgentType), belongsToMany(Service), ...)
□ Competence.php
□ Certification.php
□ Tache.php
```

#### 2.3 Controllers à créer
```
□ AgentController.php (CRUD complet + stats)
□ CompetenceController.php (CRUD)
□ CertificationController.php (CRUD)
□ TacheController.php (CRUD + workflows)
```

#### 2.4 Seeders à créer
```
□ AgentTypeSeeder.php (OBLIGATOIRE - 7 types prédéfinis)
□ CompetenceSeeder.php (exemples BNSSA, PSE1, PSE2, etc.)
□ CertificationSeeder.php (exemples)
```

---

### 🔹 **ÉTAPE 3 : M3 - PLANIFICATION CORE** (Priorité P0 - 3 semaines)
**Pourquoi maintenant ?** Dépend de M1 (zones) et M2 (agents).

#### 3.1 Migrations à créer (ORDRE STRICT)
```
1️⃣ create_activite_types_table.php
   └─ Colonnes : id, nom, description, couleur_hex, actif, timestamps

2️⃣ create_activites_table.php
   └─ Colonnes : id, zone_id (FK), activite_type_id (FK),
                 nom, description, date_debut, date_fin, 
                 recurrence_type (none/daily/weekly/monthly),
                 recurrence_config (JSON),
                 capacite_min, capacite_max,
                 notes, actif, timestamps
   └─ Dépend de : zones, activite_types

3️⃣ create_activite_agent_table.php (pivot)
   └─ Colonnes : id, activite_id (FK), agent_id (FK),
                 role_activite, notes, timestamps
   └─ Dépend de : activites, agents

4️⃣ create_shifts_table.php (créneaux horaires)
   └─ Colonnes : id, agent_id (FK), activite_id (FK nullable),
                 date, heure_debut, heure_fin,
                 type (travail/pause/formation), statut, timestamps
   └─ Dépend de : agents, activites

5️⃣ create_planning_notes_table.php
   └─ Colonnes : id, structure_id (FK), date, contenu,
                 auteur_id (FK users), timestamps
   └─ Dépend de : structures, users
```

#### 3.2 Models à créer
```
□ ActiviteType.php
□ Activite.php (relations complexes)
□ Shift.php
□ PlanningNote.php
```

#### 3.3 Controllers à créer
```
□ ActiviteController.php (CRUD + duplication hebdo)
□ PlanningController.php (vues globale/structure/zone/agent)
□ ShiftController.php
```

#### 3.4 Vues à créer (IMPORTANTES)
```
resources/views/admin/planning/
  ├─ globale.blade.php (vue calendrier tous services)
  ├─ structure.blade.php (vue par structure)
  ├─ zone.blade.php (vue par zone)
  └─ agent.blade.php (planning individuel)
```

---

### 🔹 **ÉTAPE 4 : M6 - CARNET SANITAIRE** (Priorité P0 - 2 semaines)
**Pourquoi maintenant ?** Module critique aquatique. Dépend uniquement de M1 (zones).

#### 4.1 Migrations à créer
```
1️⃣ create_produits_chimiques_table.php
   └─ Colonnes : id, nom, type, fds_document_path, 
                 stock_initial, unite, fournisseur, actif, timestamps

2️⃣ create_registres_chimiques_table.php
   └─ Colonnes : id, zone_id (FK), agent_id (FK),
                 date_releve, heure_releve,
                 ph, chlore_libre_dpd1, chlore_total_dpd2, chlore_combine (calculé),
                 temperature_eau, temperature_air, transparence,
                 tac, th, stabilisant, pression_filtres, debit_filtration,
                 nb_entrees, volume_eau_neuf,
                 notes, statut_conformite, timestamps
   └─ Dépend de : zones, agents

3️⃣ create_mouvements_produits_table.php
   └─ Colonnes : id, produit_chimique_id (FK), registre_chimique_id (FK nullable),
                 type (entree/sortie), quantite, unite,
                 agent_id (FK), date_mouvement, notes, timestamps
```

#### 4.2 Models à créer
```
□ ProduitChimique.php
□ RegistreChimique.php (avec mutator pour chlore_combine)
□ MouvementProduit.php
```

#### 4.3 Controllers à créer
```
□ CarnetSanitaireController.php (CRUD + graphiques + alertes)
□ ProduitChimiqueController.php (gestion stocks)
```

---

### 🔹 **ÉTAPE 5 : M4 - MATÉRIEL** (Priorité P1 - 1 semaine)
**Pourquoi maintenant ?** Dépend de M1 (espaces). Module indépendant.

#### 5.1 Migrations à créer
```
1️⃣ create_materiel_categories_table.php
   └─ Colonnes : id, nom, description, actif, timestamps

2️⃣ create_materiels_table.php
   └─ Colonnes : id, espace_id (FK), materiel_categorie_id (FK),
                 nom, type (mobile/fixe), quantite,
                 couleur, marque, modele, reference,
                 date_achat, prix_achat, fournisseur,
                 statut (disponible/maintenance/panne/obsolete),
                 notes, timestamps
   └─ Dépend de : espaces, materiel_categories

3️⃣ create_materiel_mouvements_table.php
   └─ Colonnes : id, materiel_id (FK), 
                 type (deplacement/maintenance/reparation),
                 espace_origine_id (FK), espace_destination_id (FK),
                 agent_id (FK), date_mouvement, description, timestamps
```

#### 5.2 Models à créer
```
□ MaterielCategorie.php
□ Materiel.php
□ MaterielMouvement.php
```

#### 5.3 Controllers à créer
```
□ MaterielController.php (CRUD + rapports inventaire)
```

---

### 🔹 **ÉTAPE 6 : M8 - MESSAGERIE** (Priorité P1 - 1 semaine)
**Pourquoi maintenant ?** Dépend de M2 (agents). Utile pour M7.

#### 6.1 Migrations à créer
```
1️⃣ create_messages_table.php
   └─ Colonnes : id, expediteur_id (FK users), 
                 objet, contenu, lu, 
                 date_lecture, timestamps

2️⃣ create_message_destinataire_table.php (pivot)
   └─ Colonnes : id, message_id (FK), destinataire_id (FK users),
                 lu, date_lecture, timestamps

3️⃣ create_message_templates_table.php
   └─ Colonnes : id, nom, objet, contenu, variables (JSON), actif, timestamps

4️⃣ create_notifications_table.php
   └─ Colonnes : id, user_id (FK), type, titre, contenu,
                 lu, lien_action, date_lecture, timestamps
```

#### 6.2 Models à créer
```
□ Message.php
□ MessageTemplate.php
□ Notification.php
```

#### 6.3 Controllers à créer
```
□ MessageController.php (CRUD + envoi groupes)
□ NotificationController.php
```

---

### 🔹 **ÉTAPE 7 : M7 - CONGÉS & REMPLACEMENTS** (Priorité P1 - 2 semaines)
**Pourquoi maintenant ?** Dépend de M2, M3, M8.

#### 7.1 Migrations à créer
```
1️⃣ create_conge_types_table.php
   └─ Colonnes : id, code, libelle, description, couleur_hex, actif, timestamps
   └─ Note : 6 types prédéfinis

2️⃣ create_conges_table.php
   └─ Colonnes : id, agent_id (FK), conge_type_id (FK),
                 date_debut, date_fin, motif,
                 statut (en_attente/approuve/refuse/annule),
                 manager_id (FK users), commentaire_manager,
                 date_validation, timestamps

3️⃣ create_demandes_remplacement_table.php
   └─ Colonnes : id, demandeur_id (FK agents), 
                 shift_id (FK) ou (activite_id + date),
                 statut (ouvert/accepte/valide/refuse/annule),
                 remplacant_id (FK agents), 
                 manager_id (FK users), commentaire_manager,
                 date_validation, timestamps
```

#### 7.2 Models à créer
```
□ CongeType.php
□ Conge.php
□ DemandeRemplacement.php
```

#### 7.3 Controllers à créer
```
□ CongeController.php (workflows complets)
□ RemplacementController.php (workflows complets)
```

#### 7.4 Seeders à créer
```
□ CongeTypeSeeder.php (OBLIGATOIRE - 6 types)
```

---

### 🔹 **ÉTAPE 8 : M5 - FRÉQUENTATION** (Post-MVP v1.1 - 1 semaine)
**Pourquoi plus tard ?** Dépend de M3 mais non critique pour MVP.

#### 8.1 Migrations à créer
```
1️⃣ create_frequentations_table.php
   └─ Colonnes : id, activite_id (FK), zone_id (FK),
                 date, nb_participants, capacite_max,
                 taux_remplissage (calculé),
                 agent_saisie_id (FK), notes, timestamps
```

#### 8.2 Models à créer
```
□ Frequentation.php
```

#### 8.3 Controllers à créer
```
□ FrequentationController.php (CRUD + statistiques + graphiques)
```

---

### 🔹 **ÉTAPE 9 : M9 - D2S STORAGE** (Post-MVP v1.1 - 1 semaine)
**Pourquoi plus tard ?** Extension des médias existants.

#### 9.1 Migrations à créer
```
1️⃣ add_dossier_permissions_to_media_categories.php
   └─ Ajouter : permissions_json (qui peut voir/éditer)

2️⃣ create_document_versions_table.php
   └─ Colonnes : id, media_id (FK), version, 
                 fichier_path, user_id (FK), commentaire, timestamps
```

#### 9.2 Modifications Models existants
```
□ MediaCategory.php (ajouter gestion permissions)
□ Media.php (ajouter versioning)
```

#### 9.3 Controllers à créer
```
□ StorageController.php (étendre MediaController)
```

---

## 📊 RÉCAPITULATIF - ORDRE DE DÉVELOPPEMENT

```
ÉTAPE 1 : M1 Hiérarchie Spatiale      [2 sem] ⚠️ BLOQUANT
    ↓
ÉTAPE 2 : M2 Agents Complets          [2 sem] ⚠️ BLOQUANT
    ↓
ÉTAPE 3 : M3 Planification Core       [3 sem] ⚠️ BLOQUANT
    ↓
ÉTAPE 4 : M6 Carnet Sanitaire         [2 sem] ⚠️ CRITICAL
    ↓
ÉTAPE 5 : M4 Matériel                 [1 sem] ✅ Indépendant
    ↓
ÉTAPE 6 : M8 Messagerie               [1 sem] ✅ Utile pour M7
    ↓
ÉTAPE 7 : M7 Congés/Remplacements     [2 sem] ✅ Workflows
    ↓
═══════════════════════════════════════════════
TOTAL MVP : 13 semaines (~3 mois)
═══════════════════════════════════════════════
    ↓
ÉTAPE 8 : M5 Fréquentation            [1 sem] 📅 v1.1
    ↓
ÉTAPE 9 : M9 D2S Storage              [1 sem] 📅 v1.1
```

---

## ⚠️ POINTS D'ATTENTION CRITIQUES

### 1. **Ordre des migrations** = CRUCIAL
- Toujours créer la table parente AVANT la table enfant
- Services → Structures → Espaces → Zones
- Agents → Activités → Assignations

### 2. **Foreign Keys** = OBLIGATOIRES
- Toutes les relations doivent avoir des FK avec `onDelete('cascade')` ou `onDelete('restrict')`

### 3. **Seeders recommandés** (gain de temps énorme)
- AgentTypeSeeder (7 types)
- CongeTypeSeeder (6 types)
- ServiceSeeder (1-2 services exemple)

### 4. **Tests après chaque étape**
- Ne JAMAIS passer à l'étape suivante sans valider l'étape actuelle
- Tester tous les CRUD avant d'ajouter les relations

---

## 🎯 PROCHAINE ACTION IMMÉDIATE

**JE RECOMMANDE DE COMMENCER PAR :**

### ÉTAPE 1.1 : Migration `create_services_table.php`

Voulez-vous que je génère :
- ✅ La migration complète ?
- ✅ Le Model Service.php ?
- ✅ Le ServiceController.php ?
- ✅ Les vues admin (index, create, edit, show) ?
- ✅ Le ServiceSeeder.php ?

**Répondez simplement "oui" et je génère tout fichier par fichier ! 🚀**
