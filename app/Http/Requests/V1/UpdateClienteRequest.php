<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {

        $method = $this->method();

        if($method == 'PUT'){
            return [
                'nombre' => ['required'],
                'tipo' =>  ['required', Rule::in(['Empresa', 'Persona'])],
                'email' => ['required', 'email'],
                'direccion' => ['required'],
                'ciudad' =>  ['required'],
                'estado' =>  ['required'],
                'codigoPostal' => ['required']
            ];
        } else { //PATCH, sometimes rule: if not present, then not validated.
            return [
                'nombre' => ['sometimes', 'required'],
                'tipo' =>  ['sometimes', 'required', Rule::in(['Empresa', 'Persona'])],
                'email' => ['sometimes', 'required', 'email'],
                'direccion' => ['sometimes', 'required'],
                'ciudad' =>  ['sometimes', 'required'],
                'estado' =>  ['sometimes', 'required'],
                'codigoPostal' => ['sometimes', 'required']
            ];
        }
    }

    protected function prepareForValidation() {
        if($this->codigoPostal){
            $this->merge([
                'codigo_postal' => $this->codigoPostal
            ]);
        }
    }

}
