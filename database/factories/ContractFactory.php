<?php

namespace Database\Factories;

use App\Enums\EntityDocumentType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract>
 */
class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => str(str()?->random(5))->append('_' . fake()?->email())->lower()->toString(),
            'document_type' => EntityDocumentType::CNPJ,
            'document_value' => fake()->numerify('##############'),
        ];
    }
}
