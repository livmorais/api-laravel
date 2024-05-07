<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'faturaId' => $this->fatura_id,
            'nome' => $this->nome_produto,
            'quantidade' => $this->quantidade,
            'preco' => $this->preco,
        ];
    }
}
