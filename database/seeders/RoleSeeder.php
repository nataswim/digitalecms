<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Accès complet au système',
                'is_active' => true,
            ],
            [
                'name' => 'Manager',
                'slug' => 'manager',
                'description' => 'Gestion',
                'is_active' => true,
            ],
            [
                'name' => 'Editeur',
                'slug' => 'editor',
                'description' => 'Création et modification de contenu',
                'is_active' => true,
            ],
            [
                'name' => 'Utilisateur MNS',
                'slug' => 'usermns',
                'description' => 'Accès specifique',
                'is_active' => true,
            ],
            [
                'name' => 'Utilisateur Agent',
                'slug' => 'useragent',
                'description' => 'Suivi administratif',
                'is_active' => true,
            ],
            [
                'name' => 'Utilisateur Technicien',
                'slug' => 'usertech',
                'description' => 'Analyse technique',
                'is_active' => true,
            ],
            [
                'name' => 'Utilisateur Divers',
                'slug' => 'userdiv',
                'description' => 'Accès basique',
                'is_active' => true,
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}