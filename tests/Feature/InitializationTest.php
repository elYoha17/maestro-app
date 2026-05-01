<?php

use App\Enums\UserRole;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\InitializationSeeder;

beforeEach(function () {
    $this->seed(InitializationSeeder::class);
});

test('admin role exists', function () {
    $this->assertDatabaseHas('roles', [
        'name' => UserRole::ADMIN->value,
    ]);
});

test('admin user exists', function () {
    $this->assertDatabaseHas('users', [
        'email' => 'admin@example.com',
    ]);
});

test('admin user has admin role', function () {
    $user = User::query()
        ->where('email', 'admin@example.com')
        ->first();

    $role = Role::query()
        ->where('name', UserRole::ADMIN->value)
        ->first();

    expect($user->roles->contains($role))->toBeTrue();
});
