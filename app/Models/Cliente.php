<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'tipo',
        'email',
        'direccion',
        'ciudad',
        'estado',
        'codigo_postal',
    ];

    public function facturas() {
        return $this->hasMany(Factura::class);
    }
}
