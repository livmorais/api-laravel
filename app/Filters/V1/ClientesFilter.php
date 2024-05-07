<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class ClientesFilter extends ApiFilter {
    protected $safeParms = [
        'nome' => ['eq'],
        'tipo' => ['eq'],
        'email' => ['eq'],
        'endereco' => ['eq'],
        'cidade' => ['eq'],
        'estado' => ['eq'],
        'cep' => ['eq', 'gt', 'lt']
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>='
    ];
} 