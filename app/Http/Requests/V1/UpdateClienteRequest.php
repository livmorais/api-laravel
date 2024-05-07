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
        $user = $this->user();
        
        return $user != null && $user->tokenCan('update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();

        if($method == 'PUT') {
            return [
                'nome' => ['required'],
                'tipo' => ['required', Rule::in(['F', 'J', 'f', 'j'])],
                'email' => ['required', 'email'],
                'endereco' => ['required'],
                'cidade' => ['required'],
                'estado' => ['required'],
                'cep' => ['required']
            ];
        } else {
            return [
                'nome' => ['sometimes','required'],
                'tipo' => ['sometimes', 'required', Rule::in(['F', 'J', 'f', 'j'])],
                'email' => ['sometimes', 'required', 'email'],
                'endereco' => ['sometimes', 'required'],
                'cidade' => ['sometimes', 'required'],
                'estado' => ['sometimes', 'required'],
                'cep' => ['sometimes', 'required']
            ];
        }
    }
}
