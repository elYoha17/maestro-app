<?php

namespace App\Actions\Role;

use App\Models\Role;
use Illuminate\Http\Request;

class GetActiveRole
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected Request $request) {}

    /**
     * Invoke the class instance.
     */
    public function __invoke(): ?Role
    {
        $user = $this->request->user();
        if ($user === null) {
            return null;
        }

        return $user->roles->first(fn (Role $role) => $role->name === $this->request->session()->get('role'));
    }
}
