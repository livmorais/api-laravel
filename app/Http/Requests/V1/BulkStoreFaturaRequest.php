<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreFaturaRequest extends FormRequest
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
            '*.clienteId' => ['required', 'integer'],
            '*.total' => ['required', 'nullable', 'numeric'],
            '*.status' => ['required', Rule::in(['F', 'P', 'V', 'f', 'p', 'v'])],
            '*.dataFaturamento' => ['required', 'date_format:Y-m-d H:i:s'],
            '*.dataPagamento' => ['date_format:Y-m-d H:i:s', 'nullable']
        ];
    }

    protected function prepareForValidation()
    {
        $data = [];

        foreach($this->toArray() as $obj) {
            $obj['cliente_id'] = $obj['clienteId'] ?? null;
            $obj['data_faturamento'] = $obj['dataFaturamento'] ?? null;
            $obj['data_pagamento'] = $obj['dataPagamento'] ?? null;

            $data[] = $obj;
        }

        $this->merge($data);
    }
}