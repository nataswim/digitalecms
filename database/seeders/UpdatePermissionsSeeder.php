<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

/**
 * Seeder pour mettre à jour les permissions selon les routes existantes
 * Supprime les anciennes permissions et crée les nouvelles
 */
class UpdatePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();

        try {
            // =========================================
            // ÉTAPE 1 : SUPPRIMER LES ANCIENNES PERMISSIONS
            // =========================================
            $this->info('🗑️  Suppression des permissions obsolètes...');
            
            $obsoleteModules = ['Exercises', 'Programs', 'Results', 'Stats'];
            
            Permission::whereIn('module', $obsoleteModules)->each(function ($permission) {
                $this->warn("   ❌ Suppression : {$permission->name} ({$permission->slug})");
                
                // Détacher des rôles et utilisateurs
                $permission->roles()->detach();
                $permission->users()->detach();
                
                // Supprimer
                $permission->delete();
            });

            // =========================================
            // ÉTAPE 2 : CRÉER/METTRE À JOUR LES PERMISSIONS
            // =========================================
            $this->info("\n✅ Création/Mise à jour des permissions...\n");

            $permissions = $this->getPermissionsStructure();

            foreach ($permissions as $permissionData) {
                $permission = Permission::updateOrCreate(
                    ['slug' => $permissionData['slug']],
                    [
                        'name' => $permissionData['name'],
                        'module' => $permissionData['module'],
                        'description' => $permissionData['description'],
                        'is_active' => true,
                    ]
                );

                $this->info("   ✅ {$permission->name} ({$permission->slug})");
            }

            // =========================================
            // ÉTAPE 3 : ATTRIBUER AU RÔLE ADMIN
            // =========================================
            $this->info("\n🔐 Attribution des permissions au rôle Admin...");
            
            $adminRole = Role::where('slug', 'admin')->first();
            
            if ($adminRole) {
                $allPermissions = Permission::where('is_active', true)->pluck('id');
                $adminRole->permissions()->sync($allPermissions);
                
                $this->info("   ✅ {$allPermissions->count()} permissions attribuées au rôle Admin");
            } else {
                $this->warn("   ⚠️  Rôle Admin introuvable");
            }

            DB::commit();

            $this->info("\n🎉 Mise à jour des permissions terminée !");
            $this->showSummary();

        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("❌ Erreur : " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Structure complète des permissions basée sur les routes
     */
    private function getPermissionsStructure(): array
    {
        return [
            // ===================
            // USERS
            // ===================
            [
                'name' => 'Voir Utilisateurs',
                'slug' => 'users.view',
                'module' => 'Users',
                'description' => 'Consulter la liste des utilisateurs',
            ],
            [
                'name' => 'Créer Utilisateurs',
                'slug' => 'users.create',
                'module' => 'Users',
                'description' => 'Créer un nouvel utilisateur',
            ],
            [
                'name' => 'Modifier Utilisateurs',
                'slug' => 'users.edit',
                'module' => 'Users',
                'description' => 'Modifier un utilisateur existant',
            ],
            [
                'name' => 'Supprimer Utilisateurs',
                'slug' => 'users.delete',
                'module' => 'Users',
                'description' => 'Supprimer un utilisateur',
            ],

            // ===================
            // ROLES
            // ===================
            [
                'name' => 'Gérer Rôles',
                'slug' => 'roles.manage',
                'module' => 'Roles',
                'description' => 'Gérer les rôles (CRUD complet)',
            ],

            // ===================
            // PERMISSIONS
            // ===================
            [
                'name' => 'Gérer Permissions',
                'slug' => 'permissions.manage',
                'module' => 'Permissions',
                'description' => 'Gérer les permissions (CRUD complet)',
            ],

            // ===================
            // MEDIA
            // ===================
            [
                'name' => 'Voir Médias',
                'slug' => 'media.view',
                'module' => 'Media',
                'description' => 'Consulter la bibliothèque de médias',
            ],
            [
                'name' => 'Uploader Médias',
                'slug' => 'media.create',
                'module' => 'Media',
                'description' => 'Uploader de nouveaux médias',
            ],
            [
                'name' => 'Modifier Médias',
                'slug' => 'media.edit',
                'module' => 'Media',
                'description' => 'Modifier les métadonnées des médias',
            ],
            [
                'name' => 'Supprimer Médias',
                'slug' => 'media.delete',
                'module' => 'Media',
                'description' => 'Supprimer des médias',
            ],
            [
                'name' => 'Gérer Médias',
                'slug' => 'media.manage',
                'module' => 'Media',
                'description' => 'Accès complet à la gestion des médias (catégories, actions en masse)',
            ],

            // ===================
            // FICHES
            // ===================
            [
                'name' => 'Voir Fiches',
                'slug' => 'fiches.view',
                'module' => 'Fiches',
                'description' => 'Consulter la liste des fiches',
            ],
            [
                'name' => 'Créer Fiches',
                'slug' => 'fiches.create',
                'module' => 'Fiches',
                'description' => 'Créer une nouvelle fiche',
            ],
            [
                'name' => 'Modifier Fiches',
                'slug' => 'fiches.edit',
                'module' => 'Fiches',
                'description' => 'Modifier une fiche existante',
            ],
            [
                'name' => 'Supprimer Fiches',
                'slug' => 'fiches.delete',
                'module' => 'Fiches',
                'description' => 'Supprimer une fiche',
            ],
            [
                'name' => 'Gérer Fiches',
                'slug' => 'fiches.manage',
                'module' => 'Fiches',
                'description' => 'Accès complet à la gestion des fiches (catégories, sous-catégories, actions en masse)',
            ],

            // ===================
            // FICHES CATEGORIES
            // ===================
            [
                'name' => 'Gérer Catégories de Fiches',
                'slug' => 'fiches-categories.manage',
                'module' => 'Fiches',
                'description' => 'Gérer les catégories de fiches (CRUD complet)',
            ],

            // ===================
            // FICHES SOUS-CATEGORIES
            // ===================
            [
                'name' => 'Gérer Sous-Catégories de Fiches',
                'slug' => 'fiches-sous-categories.manage',
                'module' => 'Fiches',
                'description' => 'Gérer les sous-catégories de fiches (CRUD complet)',
            ],
        ];
    }

    /**
     * Affiche un résumé des modifications
     */
    private function showSummary(): void
    {
        $this->info("\n📊 RÉSUMÉ");
        $this->info("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");

        $modules = Permission::select('module', DB::raw('count(*) as count'))
            ->groupBy('module')
            ->orderBy('module')
            ->get();

        foreach ($modules as $module) {
            $this->info("   📁 {$module->module}: {$module->count} permission(s)");
        }

        $total = Permission::count();
        $active = Permission::where('is_active', true)->count();

        $this->info("\n   📊 TOTAL: {$total} permissions ({$active} actives)");
        $this->info("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n");
    }

    /**
     * Helper pour afficher des messages colorés
     */
    private function info(string $message): void
    {
        echo "\033[32m{$message}\033[0m\n";
    }

    private function warn(string $message): void
    {
        echo "\033[33m{$message}\033[0m\n";
    }

    private function error(string $message): void
    {
        echo "\033[31m{$message}\033[0m\n";
    }
}