<?php

namespace App\Actions\Role;

use Illuminate\Http\Request;

class GetActiveRoleName
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected Request $request) {}

    /**
     * Invoke the class instance.
     */
    public function __invoke(): ?string
    {
        if ($this->request->user() !== null) {
            $activeRole = $this->request->session()->get('role');

            if ($activeRole !== null && $this->request->user()->hasRole($activeRole)) {
                return $activeRole;
            }
        }

        $this->request->session()->forget('role');

        return null;
    }
}
