<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PermissionController extends Controller
{
    public function index(): View
    {
        $permissions = Permission::withCount('roles')
            ->orderBy('module')
            ->orderBy('name')
            ->paginate(20);
        
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create(): View
    {
        $modules = Permission::distinct()->pluck('module')->filter();
        
        return view('admin.permissions.create', compact('modules'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:permissions',
            'slug' => 'required|string|max:100|unique:permissions',
            'module' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        Permission::create($validated);

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission créée avec succès.');
    }

    public function show(Permission $permission): View
    {
        $permission->load('roles');
        
        return view('admin.permissions.show', compact('permission'));
    }

    public function edit(Permission $permission): View
    {
        $modules = Permission::distinct()->pluck('module')->filter();
        
        return view('admin.permissions.edit', compact('permission', 'modules'));
    }

    public function update(Request $request, Permission $permission): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:permissions,name,' . $permission->id,
            'slug' => 'required|string|max:100|unique:permissions,slug,' . $permission->id,
            'module' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $permission->update($validated);

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission modifiée avec succès.');
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        if ($permission->roles()->count() > 0) {
            return back()->with('error', 'Impossible de supprimer une permission attribuée à des rôles.');
        }

        $permission->delete();

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission supprimée avec succès.');
    }
}