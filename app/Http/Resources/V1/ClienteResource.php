<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'tipo' =>  $this->tipo,
            'direccion' => $this->direccion,
            'ciudad' =>  $this->ciudad,
            'estado' =>  $this->estado,
            'codigoPostal' => $this->codigo_postal         // camelCase
        ];
    }
}
