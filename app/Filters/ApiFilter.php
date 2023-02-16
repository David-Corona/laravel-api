<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter {

    protected $allowedParms = [];

    protected $columnMap = [];

    protected $operatorMap = [];

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
