<?php

namespace App\Services\V1;

use Illuminate\Http\Request;

class ClienteQuery {

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

    // Transform query to Array to pass to Eloquent
    public function transform(Request $request) {
        $eloQuery = [];

        foreach($this->allowedParms as $parm=>$operators) {  // $parm=>$operators: 'id' => ['eq']
            $query = $request->query($parm);                 // get what's in query for this field

            if(!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$parm] ?? $parm;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $eloQuery; //return Array: [['column', 'operator', 'value']]
    }

}
