<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Fatura;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fatura>
 */
class FaturaFactory extends Factory
{
    protected $model = Fatura::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['F', 'P', 'V']);

        return [
            'cliente_id' => Cliente::factory(),
            'total' => $this->faker->numberBetween(100, 20000),
            'status' => $status,
            'data_faturamento' => $this->faker->dateTimeThisDecade(),
            'data_pagamento' => $status == 'P' ? $this->faker->dateTimeThisDecade() : NULL
        ];
    }
}
