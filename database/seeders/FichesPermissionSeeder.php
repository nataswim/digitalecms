<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class FichesPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer les permissions fiches
        $fichesView = Permission::where('slug', 'fiches.view')->first();
        $fichesCreate = Permission::where('slug', 'fiches.create')->first();
        $fichesEdit = Permission::where('slug', 'fiches.edit')->first();
        $fichesDelete = Permission::where('slug', 'fiches.delete')->first();
        $fichesManage = Permission::where('slug', 'fiches.manage')->first();

        // Admin : toutes les permissions
        $admin = Role::where('slug', 'admin')->first();
        if ($admin) {
            $admin->permissions()->syncWithoutDetaching([
                $fichesView->id,
                $fichesCreate->id,
                $fichesEdit->id,
                $fichesDelete->id,
                $fichesManage->id,
            ]);
        }

        // Manager : toutes sauf supprimer
        $manager = Role::where('slug', 'manager')->first();
        if ($manager) {
            $manager->permissions()->syncWithoutDetaching([
                $fichesView->id,
                $fichesCreate->id,
                $fichesEdit->id,
                $fichesManage->id,
            ]);
        }

        // Editor : voir, créer, modifier
        $editor = Role::where('slug', 'editor')->first();
        if ($editor) {
            $editor->permissions()->syncWithoutDetaching([
                $fichesView->id,
                $fichesCreate->id,
                $fichesEdit->id,
            ]);
        }

        $this->command->info('Permissions fiches assignées avec succès !');
    }
}