<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FaturaResource extends JsonResource
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
            'clienteId' => $this->cliente_id,
            'total' => $this->total,
            'status' => $this->status,
            'dataFaturamento' => $this->data_faturamento,
            'dataPagamento' => $this->data_pagamento,
            'itens' => ItemResource::collection($this->whenLoaded('itens'))
        ];
    }
}
