<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Admin - Toutes les permissions
        $admin = Role::where('slug', 'admin')->first();
        $admin->permissions()->attach(Permission::all());

        // Entraîneur Principal (Manager)
        $manager = Role::where('slug', 'manager')->first();
        $managerPermissions = Permission::whereIn('slug', [
            'users.view', 'users.create', 'users.edit',
            'programs.view', 'programs.create', 'programs.edit', 'programs.delete', 'programs.publish',
            'exercises.view', 'exercises.create', 'exercises.edit', 'exercises.delete',
            'sessions.view', 'sessions.create', 'sessions.edit', 'sessions.delete',
            'performances.view', 'performances.create', 'performances.edit',
            'videos.view', 'videos.upload', 'videos.edit',
            'analytics.view', 'analytics.export',
        ])->pluck('id');
        $manager->permissions()->attach($managerPermissions);

        // Entraîneur Assistant (Editor)
        $editor = Role::where('slug', 'editor')->first();
        $editorPermissions = Permission::whereIn('slug', [
            'programs.view', 'programs.create', 'programs.edit',
            'exercises.view', 'exercises.create', 'exercises.edit',
            'sessions.view', 'sessions.create', 'sessions.edit',
            'performances.view', 'performances.create',
            'videos.view', 'videos.upload',
            'analytics.view',
        ])->pluck('id');
        $editor->permissions()->attach($editorPermissions);

        // Nageur MNS
        $usermns = Role::where('slug', 'usermns')->first();
        $usermnsPermissions = Permission::whereIn('slug', [
            'programs.view',
            'exercises.view',
            'sessions.view', 'sessions.create',
            'performances.view', 'performances.create', 'performances.edit',
            'videos.view',
            'analytics.view',
        ])->pluck('id');
        $usermns->permissions()->attach($usermnsPermissions);

        // Agent Sportif
        $useragent = Role::where('slug', 'useragent')->first();
        $useragentPermissions = Permission::whereIn('slug', [
            'programs.view',
            'performances.view', 'performances.create',
            'analytics.view', 'analytics.export',
        ])->pluck('id');
        $useragent->permissions()->attach($useragentPermissions);

        // Technicien
        $usertech = Role::where('slug', 'usertech')->first();
        $usertechPermissions = Permission::whereIn('slug', [
            'videos.view', 'videos.upload', 'videos.edit',
            'analytics.view',
        ])->pluck('id');
        $usertech->permissions()->attach($usertechPermissions);

        // Sportif Amateur
        $userdiv = Role::where('slug', 'userdiv')->first();
        $userdivPermissions = Permission::whereIn('slug', [
            'programs.view',
            'exercises.view',
            'sessions.view',
            'performances.view',
            'videos.view',
        ])->pluck('id');
        $userdiv->permissions()->attach($userdivPermissions);
    }
}