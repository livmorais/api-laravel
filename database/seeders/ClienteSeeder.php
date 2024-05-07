<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Fatura;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Cliente::factory()
            ->count(100)
            ->has(
                Fatura::factory()
                    ->count(5)
                    ->hasItens(3), // Supondo que você queira 3 itens por fatura
                'faturas' // Nome do relacionamento no modelo Cliente
            )
            ->create();
    }
}
