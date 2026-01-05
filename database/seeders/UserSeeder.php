<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $roles = Role::all()->keyBy('slug');

        $users = [
            [
                'username' => 'admin',
                'name' => 'Admin Système',
                'email' => 'admin@sport.fr',
                'first_name' => 'Admin',
                'last_name' => 'Système',
                'password' => Hash::make('password'),
                'phone' => '0612345678',
                'bio' => 'Administrateur système',
                'role_id' => $roles['admin']->id,
                'email_verified_at' => now(),
            ],
            [
                'username' => 'coach.hassan',
                'name' => 'Hassan El Haouat',
                'email' => 'hassan@nataswim.fr',
                'first_name' => 'Hassan',
                'last_name' => 'El Haouat',
                'password' => Hash::make('password'),
                'phone' => '0623456789',
                'bio' => 'Entraîneur principal natation',
                'role_id' => $roles['manager']->id,
                'email_verified_at' => now(),
            ],
            [
                'username' => 'assistant.marie',
                'name' => 'Marie Dupont',
                'email' => 'marie@nataswim.fr',
                'first_name' => 'Marie',
                'last_name' => 'Dupont',
                'password' => Hash::make('password'),
                'phone' => '0634567890',
                'bio' => 'Entraîneur assistant triathlon',
                'role_id' => $roles['editor']->id,
                'email_verified_at' => now(),
            ],
            [
                'username' => 'nageur.thomas',
                'name' => 'Thomas Martin',
                'email' => 'thomas@athlete.fr',
                'first_name' => 'Thomas',
                'last_name' => 'Martin',
                'password' => Hash::make('password'),
                'phone' => '0645678901',
                'bio' => 'MNS - Spécialiste crawl et dos',
                'role_id' => $roles['usermns']->id,
                'email_verified_at' => now(),
            ],
            [
                'username' => 'agent.sophie',
                'name' => 'Sophie Bernard',
                'email' => 'sophie@agent.fr',
                'first_name' => 'Sophie',
                'last_name' => 'Bernard',
                'password' => Hash::make('password'),
                'phone' => '0656789012',
                'bio' => 'Agent sportif - Suivi performances',
                'role_id' => $roles['useragent']->id,
                'email_verified_at' => now(),
            ],
            [
                'username' => 'tech.julien',
                'name' => 'Julien Petit',
                'email' => 'julien@tech.fr',
                'first_name' => 'Julien',
                'last_name' => 'Petit',
                'password' => Hash::make('password'),
                'phone' => '0667890123',
                'bio' => 'Technicien vidéo et analyse',
                'role_id' => $roles['usertech']->id,
                'email_verified_at' => now(),
            ],
            [
                'username' => 'amateur.lucas',
                'name' => 'Lucas Robert',
                'email' => 'lucas@nageur.fr',
                'first_name' => 'Lucas',
                'last_name' => 'Robert',
                'password' => Hash::make('password'),
                'phone' => '0678901234',
                'bio' => 'Nageur amateur passionné',
                'role_id' => $roles['userdiv']->id,
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}