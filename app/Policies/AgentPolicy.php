<?php

namespace App\Policies;

use App\Actions\Role\GetActiveRole;
use App\Enums\UserRole;
use App\Models\Agent;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AgentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Agent $agent): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, User $target): bool
    {
        if ($target->agent) {
            return false;
        }

        $role = app(GetActiveRole::class)();

        if (!$role) {
            return false;
        }

        if ($role->name === UserRole::ADMIN->value) {
            if ($user->id === $target->id) {
                return true;
            }

            if (!$target->hasRole(UserRole::ADMIN)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Agent $agent): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Agent $agent): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Agent $agent): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Agent $agent): bool
    {
        return false;
    }
}
