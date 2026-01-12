<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Utilisateurs
            ['name' => 'Voir Utilisateurs', 'slug' => 'users.view', 'module' => 'users', 'description' => 'Voir liste des utilisateurs'],
            ['name' => 'Créer Utilisateurs', 'slug' => 'users.create', 'module' => 'users', 'description' => 'Créer un utilisateur'],
            ['name' => 'Modifier Utilisateurs', 'slug' => 'users.edit', 'module' => 'users', 'description' => 'Modifier un utilisateur'],
            ['name' => 'Supprimer Utilisateurs', 'slug' => 'users.delete', 'module' => 'users', 'description' => 'Supprimer un utilisateur'],
            
            // Rôles
            ['name' => 'Gérer Rôles', 'slug' => 'roles.manage', 'module' => 'roles', 'description' => 'Gérer les rôles'],
            
            // Permissions
            ['name' => 'Gérer Permissions', 'slug' => 'permissions.manage', 'module' => 'permissions', 'description' => 'Gérer les permissions'],
            
            // Menus
            ['name' => 'Gérer Menus', 'slug' => 'menus.manage', 'module' => 'menus', 'description' => 'Gérer les menus et éléments de menu'],
            
            // Programmes
            ['name' => 'Voir Programmes', 'slug' => 'programs.view', 'module' => 'programs', 'description' => 'Voir liste des programmes'],
            ['name' => 'Créer Programmes', 'slug' => 'programs.create', 'module' => 'programs', 'description' => 'Créer un programme'],
            ['name' => 'Modifier Programmes', 'slug' => 'programs.edit', 'module' => 'programs', 'description' => 'Modifier un programme'],
            ['name' => 'Supprimer Programmes', 'slug' => 'programs.delete', 'module' => 'programs', 'description' => 'Supprimer un programme'],
            
            // Exercices
            ['name' => 'Voir Exercices', 'slug' => 'exercises.view', 'module' => 'exercises', 'description' => 'Voir liste des exercices'],
            ['name' => 'Créer Exercices', 'slug' => 'exercises.create', 'module' => 'exercises', 'description' => 'Créer un exercice'],
            ['name' => 'Modifier Exercices', 'slug' => 'exercises.edit', 'module' => 'exercises', 'description' => 'Modifier un exercice'],
            ['name' => 'Supprimer Exercices', 'slug' => 'exercises.delete', 'module' => 'exercises', 'description' => 'Supprimer un exercice'],
            
            // Athlètes
            ['name' => 'Voir Athlètes', 'slug' => 'athletes.view', 'module' => 'athletes', 'description' => 'Voir liste des athlètes'],
            ['name' => 'Créer Athlètes', 'slug' => 'athletes.create', 'module' => 'athletes', 'description' => 'Créer un athlète'],
            ['name' => 'Modifier Athlètes', 'slug' => 'athletes.edit', 'module' => 'athletes', 'description' => 'Modifier un athlète'],
            ['name' => 'Supprimer Athlètes', 'slug' => 'athletes.delete', 'module' => 'athletes', 'description' => 'Supprimer un athlète'],
            
            // Compétitions
            ['name' => 'Voir Compétitions', 'slug' => 'competitions.view', 'module' => 'competitions', 'description' => 'Voir liste des compétitions'],
            ['name' => 'Créer Compétitions', 'slug' => 'competitions.create', 'module' => 'competitions', 'description' => 'Créer une compétition'],
            ['name' => 'Modifier Compétitions', 'slug' => 'competitions.edit', 'module' => 'competitions', 'description' => 'Modifier une compétition'],
            ['name' => 'Supprimer Compétitions', 'slug' => 'competitions.delete', 'module' => 'competitions', 'description' => 'Supprimer une compétition'],
            
            // Résultats
            ['name' => 'Voir Résultats', 'slug' => 'results.view', 'module' => 'results', 'description' => 'Voir les résultats'],
            ['name' => 'Créer Résultats', 'slug' => 'results.create', 'module' => 'results', 'description' => 'Créer un résultat'],
            ['name' => 'Modifier Résultats', 'slug' => 'results.edit', 'module' => 'results', 'description' => 'Modifier un résultat'],
            ['name' => 'Supprimer Résultats', 'slug' => 'results.delete', 'module' => 'results', 'description' => 'Supprimer un résultat'],
            
            // Statistiques
            ['name' => 'Voir Statistiques', 'slug' => 'stats.view', 'module' => 'stats', 'description' => 'Voir les statistiques'],
            ['name' => 'Exporter Statistiques', 'slug' => 'stats.export', 'module' => 'stats', 'description' => 'Exporter les statistiques'],

            // Permissions médias
            ['name' => 'Voir les médias', 'slug' => 'media.view', 'module' => 'media'],
            ['name' => 'Uploader des médias', 'slug' => 'media.upload', 'module' => 'media'],
            ['name' => 'Gérer les médias', 'slug' => 'media.manage', 'module' => 'media'],
            ['name' => 'Supprimer des médias', 'slug' => 'media.delete', 'module' => 'media'],

            // Permissions fiches
            ['name' => 'Voir les fiches', 'slug' => 'fiches.view', 'module' => 'fiches'],
            ['name' => 'Créer des fiches', 'slug' => 'fiches.create', 'module' => 'fiches'],
            ['name' => 'Modifier des fiches', 'slug' => 'fiches.edit', 'module' => 'fiches'],
            ['name' => 'Supprimer des fiches', 'slug' => 'fiches.delete', 'module' => 'fiches'],
            ['name' => 'Gérer les fiches', 'slug' => 'fiches.manage', 'module' => 'fiches'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['slug' => $permission['slug']], // Recherche par slug
                $permission // Données à créer ou mettre à jour
            );
        }

        $this->command->info('Permissions créées ou mises à jour avec succès!');
    }
}