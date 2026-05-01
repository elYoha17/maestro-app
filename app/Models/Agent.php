<?php

namespace App\Models;

use App\Actions\Agent\GenerateMatricula;
use App\Enums\Gender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'other_name',
        'sex',
        'birth_date',
        'phone_number',
        'address',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'sex' => Gender::class,
            'birth_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Agent $agent) {
            $agent->matricula = app(GenerateMatricula::class)();
        });
    }
}
