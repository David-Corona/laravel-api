<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipo = $this->faker->randomElement(['Persona', 'Empresa']);
        $nombre = $tipo == 'Persona' ? $this->faker->name() : $this->faker->company();

        return [
            'nombre' => $nombre,
            'tipo' => $tipo,
            'email' => $this->faker->email(),
            'direccion' => $this->faker->streetAddress(),
            'ciudad' => $this->faker->city(),
            'estado' => $this->faker->state(),
            'codigo_postal' => $this->faker->postcode()
        ];

    }
}
