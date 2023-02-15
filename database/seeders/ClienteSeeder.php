<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cliente::factory()->count(2)->hasFacturas(4)->create();

        Cliente::factory()->count(4)->hasFacturas(3)->create();

        Cliente::factory()->count(30)->hasFacturas(1)->create();

        Cliente::factory()->count(14)->hasFacturas(2)->create();
    }
}
