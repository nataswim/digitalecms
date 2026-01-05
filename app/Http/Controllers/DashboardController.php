<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_users' => User::count(),
            'total_roles' => Role::count(),
            'total_permissions' => Permission::count(),
            'active_users' => User::whereNotNull('last_login_at')
                ->where('last_login_at', '>=', now()->subDays(30))
                ->count(),
            'recent_users' => User::with('role')
                ->latest()
                ->take(5)
                ->get(),
            'roles_distribution' => Role::withCount('users')
                ->get()
                ->map(fn($role) => [
                    'name' => $role->name,
                    'count' => $role->users_count
                ]),
        ];

        return view('dashboard', compact('stats'));
    }

    public function admin(): View
    {
        $stats = [
            'total_users' => User::count(),
            'total_roles' => Role::count(),
            'total_permissions' => Permission::count(),
            'active_roles' => Role::where('is_active', true)->count(),
            'recent_users' => User::with('role')
                ->latest()
                ->take(10)
                ->get(),
            'users_by_role' => Role::withCount('users')
                ->orderBy('users_count', 'desc')
                ->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}