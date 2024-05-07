<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class ItensFilter extends ApiFilter {
    protected $safeParms = [
        'faturaId' => ['eq'],
        'nome' => ['eq'],
        'quantidade' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'preco' => ['eq', 'lt', 'lte', 'gt', 'gte']
    ];

    protected $columnMap = [
        'faturaId' => 'fatura_id',
        'nome' => 'nome_produto'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'ne' => '!='
    ];
} 