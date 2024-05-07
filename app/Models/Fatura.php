<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fatura extends Model
{
    use HasFactory;

    public $timestamps = true; 

    protected $fillable = [
        'cliente_id',
        'total',
        'status',
        'data_faturamento',
        'data_pagamento'
    ];

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    public function itens() {
        return $this->hasMany(Item::class);
    }

}
