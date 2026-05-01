<?php

namespace Database\Factories;

use App\Actions\Agent\GenerateMatricula;
use App\Models\Agent;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Agent>
 */
class AgentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sex = fake()->numberBetween(0, 2);
        $gender = match ($sex) {
            1 => 'male',
            2 => 'female',
            default => null,
        };

        return [
            'first_name' => fake()->firstName($gender),
            'last_name' => fake()->lastName($gender),
            'other_name' => fake()->optional()->lastName($gender),
            'sex' => $sex,
            'birth_date' => fake()->optional()->dateTimeBetween('-60 years', '-18 years')?->format('Y-m-d'),
            'phone_number' => fake()->optional()->phoneNumber(),
            'address' => fake()->optional()->address(),
            'is_active' => fake()->boolean(75),
        ];
    }

    public function withUser(): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => User::factory(),
        ]);
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
