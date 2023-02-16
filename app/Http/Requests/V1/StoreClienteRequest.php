<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClienteRequest extends FormRequest
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
        return [
            'nombre' => ['required'],
            'tipo' =>  ['required', Rule::in(['Empresa', 'Persona'])],
            'email' => ['required', 'email'],
            'direccion' => ['required'],
            'ciudad' =>  ['required'],
            'estado' =>  ['required'],
            'codigoPostal' => ['required']
        ];
    }

    protected function prepareForValidation() {
        $this->merge([
            'codigo_postal' => $this->codigoPostal
        ]);
    }
}
