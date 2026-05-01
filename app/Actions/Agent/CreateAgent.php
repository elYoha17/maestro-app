<?php

namespace App\Actions\Agent;

use App\Models\Agent;
use App\Models\User;

class CreateAgent
{
    public function __invoke(User $user, array $data): Agent
    {
        return $user->agent()->create($data);
    }
}
