<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreFacturaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user != null && $user->tokenCan('create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        // payload will be like: [{clienteId: ...}, {customerId: ...}, ...] -> an array that has objects representing invoices
        // validate individual objects inside an array = json array that contains json objects.
        return [
            '*.clienteId' => ['required', 'integer'],
            '*.importe'  =>  ['required', 'numeric'],
            '*.estado'  => ['required', Rule::in(['Pagado', 'Facturado', 'Nulo'])],
            '*.fechaFacturacion'  => ['required', 'date_format:Y-m-d H:i:s'],
            '*.fechaPago'  =>  ['date_format:Y-m-d H:i:s', 'nullable'],
        ];
    }

    protected function prepareForValidation() {
        $data = [];

        foreach($this->toArray() as $obj) {
            $obj['cliente_id'] = $obj['clienteId'] ?? null;
            $obj['fecha_facturacion'] = $obj['fechaFacturacion'] ?? null;
            $obj['fecha_pago'] = $obj['fechaPago'] ?? null;

            $data[] = $obj;
        }

        $this->merge($data);
    }
}
