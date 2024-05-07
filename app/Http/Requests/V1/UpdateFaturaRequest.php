<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFaturaRequest extends FormRequest
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
                'clienteId' => ['required'],
                'total' => ['required'],
                'status' => ['required', Rule::in(['F', 'P', 'V', 'f', 'p', 'v'])],
                'dataFaturamento' => ['required'],
                'dataPagamento' => ['required']
            ];
        } else {
            return [
                'clienteId' => ['sometimes','required'],
                'total' => ['sometimes','required'],
                'status' => ['sometimes', 'required', Rule::in(['F', 'P', 'V', 'f', 'p', 'v'])],
                'dataFaturamento' => ['sometimes', 'required'],
                'dataPagamento' => ['sometimes', 'required']
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this->clienteId) {
            $this->merge([
                'cliente_id' => $this->clienteId,
            ]);
        }
        if ($this->dataFaturamento) {
            $this->merge([
                'data_faturamento' => $this->dataFaturamento,
            ]);
        }
        if ($this->dataPagamento) {
            $this->merge([
                'data_pagamento' => $this->dataPagamento,
            ]);
        }
    }

}