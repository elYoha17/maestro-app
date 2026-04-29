<?php

use App\Models\Role;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('roles page is displayed with the user roles and active role', function () {
    $role = Role::create([
        'name' => 'admin',
        'label' => 'Administrateur',
        'description' => 'Accede aux fonctionnalites d administration.',
    ]);

    $user = User::factory()->create();
    $user->roles()->attach($role);

    $this->actingAs($user)
        ->withSession(['role' => $role->name])
        ->get(route('roles.edit'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('settings/roles')
            ->where('auth.role', $role->name)
            ->has('roles', 1)
            ->where('roles.0.name', $role->name)
            ->where('roles.0.label', $role->label)
            ->where('roles.0.description', $role->description)
            ->where('roles.0.is_active', true),
        );
});

test('user can activate one of their roles', function () {
    $role = Role::create([
        'name' => 'admin',
        'label' => 'Administrateur',
        'description' => 'Accede aux fonctionnalites d administration.',
    ]);

    $user = User::factory()->create();
    $user->roles()->attach($role);

    $this->actingAs($user)
        ->put(route('roles.activate', $role))
        ->assertRedirect(route('roles.edit'))
        ->assertSessionHas('role', $role->name);
});

test('user can deactivate their active role', function () {
    $role = Role::create([
        'name' => 'admin',
        'label' => 'Administrateur',
        'description' => 'Accede aux fonctionnalites d administration.',
    ]);

    $user = User::factory()->create();
    $user->roles()->attach($role);

    $this->actingAs($user)
        ->withSession(['role' => $role->name])
        ->delete(route('roles.deactivate'))
        ->assertRedirect(route('roles.edit'))
        ->assertSessionMissing('role');
});

test('active role is removed from the session when it is no longer assigned', function () {
    $role = Role::create([
        'name' => 'admin',
        'label' => 'Administrateur',
        'description' => 'Accede aux fonctionnalites d administration.',
    ]);

    $user = User::factory()->create();
    $user->roles()->attach($role);
    $user->roles()->detach($role);

    $this->actingAs($user)
        ->withSession(['role' => $role->name])
        ->get(route('roles.edit'))
        ->assertOk()
        ->assertSessionMissing('role')
        ->assertInertia(fn (Assert $page) => $page
            ->component('settings/roles')
            ->where('auth.role', null)
            ->has('roles', 0),
        );
});
