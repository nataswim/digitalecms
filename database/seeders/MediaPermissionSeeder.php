<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class MediaPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer les permissions média
        $mediaView = Permission::where('slug', 'media.view')->first();
        $mediaUpload = Permission::where('slug', 'media.upload')->first();
        $mediaManage = Permission::where('slug', 'media.manage')->first();
        $mediaDelete = Permission::where('slug', 'media.delete')->first();

        // Admin : toutes les permissions
        $admin = Role::where('slug', 'admin')->first();
        if ($admin) {
            $admin->permissions()->syncWithoutDetaching([
                $mediaView->id,
                $mediaUpload->id,
                $mediaManage->id,
                $mediaDelete->id,
            ]);
        }

        // Manager : toutes sauf supprimer
        $manager = Role::where('slug', 'manager')->first();
        if ($manager) {
            $manager->permissions()->syncWithoutDetaching([
                $mediaView->id,
                $mediaUpload->id,
                $mediaManage->id,
            ]);
        }

        // Editor : voir et uploader
        $editor = Role::where('slug', 'editor')->first();
        if ($editor) {
            $editor->permissions()->syncWithoutDetaching([
                $mediaView->id,
                $mediaUpload->id,
            ]);
        }

        $this->command->info('Permissions média assignées avec succès !');
    }
}