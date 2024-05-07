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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => ['required'],
            'tipo' => ['required', Rule::in(['F', 'J', 'f', 'j'])],
            'email' => ['required', 'email'],
            'endereco' => ['required'],
            'cidade' => ['required'],
            'estado' => ['required'],
            'cep' => ['required']
        ];
    }
}
