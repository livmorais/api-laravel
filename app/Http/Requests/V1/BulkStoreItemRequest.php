<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreItemRequest extends FormRequest
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
            '*.faturaId' => ['required', 'integer'],
            '*.nome' => ['required'],
            '*.quantidade' => ['required', 'numeric'],
            '*.preco' => ['required', 'numeric']
        ];
    }

    protected function prepareForValidation()
    {
        $data = [];

        foreach($this->toArray() as $obj) {
            $obj['fatura_id'] = $obj['faturaId'] ?? null;
            $obj['nome_produto'] = $obj['nome'] ?? null;

            $data[] = $obj;
        }

        $this->merge($data);
    }
}