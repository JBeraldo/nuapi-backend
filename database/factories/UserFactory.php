<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'cpf' => fake()->cpf(false),
            'password' => static::$password ??= Hash::make('senha123'),
            'is_active' => true,
        ];
    }

    public function professor(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'specialization' => 'a' . fake()->randomNumber(7, true),
            ];
        });
    }
}
