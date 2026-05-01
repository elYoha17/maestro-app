<?php

use App\Models\Agent;
use App\Models\User;
use Database\Seeders\InitializationSeeder;

beforeEach(function () {
    $this->seed(InitializationSeeder::class);

    $this->actingAs(User::where('email', 'admin@example.com')->first());
});

test('admin can create an agent profile for a user', function () {
    $user = User::factory()->create();
    $agent = Agent::factory()->make();

    $response = $this
                    ->withSession(['role' => 'admin'])
                    ->post(route('agents.store', $user), $agent->toArray());

    $response->assertRedirect();

    $this->assertDatabaseHas('agents', [
        'user_id' => $user->id,
        'first_name' => $agent->first_name,
        'last_name' => $agent->last_name,
        'other_name' => $agent->other_name,
    ]);
});
