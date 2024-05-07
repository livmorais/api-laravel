<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
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
            'faturaId' => ['required', 'integer'],
            'nome' => ['required'],
            'quantidade' => ['required', 'numeric'],
            'preco' => ['required', 'numeric'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'fatura_id' => $this->faturaId,
            'nome_produto' =>$this->nome
        ]);
    }
}
