<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::query()->updateOrCreate([
                'name' => UserRole::ADMIN->value,
            ], [
                'label' => 'Administrateur',
                'description' => 'Vous êtes administrateur',
            ]
        );

        User::query()->updateOrCreate([
                'email' => 'admin@example.com',
            ], [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
            ]
        )->roles()->sync([$adminRole->id]);
    }
}
