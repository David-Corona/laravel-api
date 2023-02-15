<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cliente;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Factura>
 */
class FacturaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $estado = $this->faker->randomElement(['Facturado', 'Pagado', 'Nulo']);

        return [
            'cliente_id' => Cliente::factory(),
            'importe' => $this->faker->numberBetween(50,10000),
            'estado' => $estado,
            'fecha_facturacion' => $this->faker->dateTimeThisDecade(),
            'fecha_pago' => $estado == 'Pagado' ? $this->faker->dateTimeThisDecade() : NULL
        ];
    }
}
