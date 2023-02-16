<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

use Illuminate\Http\Request;

class FacturasFilter extends ApiFilter {

    protected $allowedParms = [
        'id' => ['eq'],
        'clienteId' => ['eq'],
        'importe' =>  ['eq', 'gt', 'lt', 'gte', 'lte'],
        'estado' => ['eq', 'ne'],
        'fechaFacturacion' =>  ['eq', 'gt', 'lt', 'gte', 'lte'],
        'estfechaPagoado' =>  ['eq', 'gt', 'lt', 'gte', 'lte'],
    ];

    protected $columnMap = [
        'clienteId' => 'cliente_id',
        'fechaFacturacion' => 'fecha_facturacion',
        'fechaPago' => 'fecha_pago'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'ne' => '!='
    ];

}
