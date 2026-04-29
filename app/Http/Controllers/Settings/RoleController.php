<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RoleController extends Controller
{
    public function edit(Request $request): Response
    {
        $roles = $request->user()
            ->roles()
            ->select(['id', 'name', 'label', 'description'])
            ->orderBy('roles.label')
            ->get();
            
        return Inertia::render('settings/roles', [
            'roles' => $roles,
        ]);
    }

    public function activate(Request $request, Role $role): RedirectResponse
    {
        abort_unless($request->user()->roles()->whereKey($role->getKey())->exists(), 403);

        $request->session()->put('role', $role->name);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Role activated.'),
        ]);

        return back();
    }

    public function deactivate(Request $request): RedirectResponse
    {
        $request->session()->forget('role');

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Role deactivated.'),
        ]);

        return back();
    }
}
