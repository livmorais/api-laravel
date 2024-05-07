<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class FaturasFilter extends ApiFilter {
    protected $safeParms = [
        'clienteId' => ['eq'],
        'total' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'status' => ['eq', 'ne'],
        'dataFaturamento' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'dataPagamento' => ['eq', 'lt', 'lte', 'gt', 'gte']
    ];

    protected $columnMap = [
        'clienteId' => 'cliente_id',
        'dataFaturamento' => 'data_faturamento',
        'dataPagamento' => 'data_pagamento'
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