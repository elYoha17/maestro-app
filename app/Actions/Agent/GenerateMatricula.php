<?php

namespace App\Actions\Agent;

use App\Models\Agent;
use Illuminate\Support\Str;

class GenerateMatricula
{
    protected const int LENGTH = 16;

    public function __invoke(): string
    {
        do {
            $matricula = Str::random(self::LENGTH);
        } while (Agent::where('matricula', $matricula)->exists());

        return $matricula;
    }
}
