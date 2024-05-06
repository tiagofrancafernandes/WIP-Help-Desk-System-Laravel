<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'uuid',
            'name' => fake()?->name(),
            'email' => str()?->random(5) . '_' . fake()?->email(),
            'can_open_tickets' => fake()?->boolean(90),
            'password' => Hash::make('password'),
        ];
    }
}
