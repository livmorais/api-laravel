<?php

namespace Database\Factories;
use App\Models\Item;
use App\Models\Fatura;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fatura_id' => Fatura::factory(),
            'nome_produto'=> $this->faker->word(),
            'quantidade' => $this->faker->numberBetween(1, 15),
            'preco' => $this->faker->numberBetween(100, 20000)
        ];
    }

    // public function configure()
    // {
    //     return $this->afterCreating(function (Fatura $fatura) {
    //         \App\Models\Item::factory()->count(2)->create([
    //             'fatura_id' => $fatura->id,
    //         ]);
    //     });
    // }
}
