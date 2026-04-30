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
        return Inertia::render('settings/roles', [
            'roles' => $request->user()->roles,
        ]);
    }

    public function activate(Request $request, Role $role): RedirectResponse
    {
        if ($request->user()->hasRole($role)) {
            $request->session()->put('role', $role->name);
            
            Inertia::flash('toast', [
                'type' => 'success',
                'message' => __('Role activated.'),
            ]);
        } else {
            Inertia::flash('toast', [
                'type' => 'warning',
                'message' => __('You cannot active this role.'),
            ]);
        }

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
