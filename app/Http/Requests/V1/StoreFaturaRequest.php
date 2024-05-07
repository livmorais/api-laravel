<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFaturaRequest extends FormRequest
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
            'clienteId' => ['required', 'integer'],
            'total' => ['required', 'numeric'],
            'status' => ['required', Rule::in(['F', 'P', 'V', 'f', 'p', 'v'])],
            'data_faturamento' => ['required', 'date_format:Y-m-d H:i:s'],
            'data_pagamento' => ['date_format:Y-m-d H:i:s', 'nullable']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'cliente_id' => $this->clienteId,
            'data_faturamento' =>$this->dataFaturamento,
            'data_pagamento' =>$this->dataPagamento
        ]);
    }
}
