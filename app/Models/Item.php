<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public $timestamps = true; 

    protected $fillable = [
        'fatura_id',
        'nome_produto',
        'quantidade',
        'preco'
    ];

    public function fatura() {
        return $this->belongsTo(Fatura::class);
    }
}
