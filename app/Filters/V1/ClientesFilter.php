<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

use Illuminate\Http\Request;

class ClientesFilter extends ApiFilter {

    // Query example: clientes?codigoPostal[gt]=30000

    // Fields and operators we are allowed to filter on
    protected $allowedParms = [
        'id' => ['eq'],
        'nombre' => ['eq'],
        'tipo' =>  ['eq'],
        'direccion' => ['eq'],
        'ciudad' =>  ['eq'],
        'estado' =>  ['eq'],
        'codigoPostal' => ['eq', 'gt', 'lt']
    ];

    // Transform fields to DB columns
    protected $columnMap = [
        'codigoPostal' => 'codigo_postal'
    ];

    // Transform query operators to Eloquent operators
    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>='
    ];

}
