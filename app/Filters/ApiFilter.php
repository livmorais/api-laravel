<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter {
    protected $safeParms = [];

    protected $columnMap = [];

    // mapeia os operadores da API para os operadores do Eloquent 
    protected $operatorMap = [];

    // transforma os parâmetros da requisição em uma consulta Eloquent
    public function transform(Request $request) {
        $eloQuery = []; 

         // Itera sobre os parâmetros seguros definidos
        foreach ($this->safeParms as $parm => $operators) {
            // Obtém o valor do parâmetro da requisição
            $query = $request->query($parm);

            if(!isset($query)) {
                continue;
            }
            // Obtém o nome da coluna correspondente ao parâmetro ou usa o próprio parâmetro se não houver mapeamento
            $column = $this->columnMap[$parm] ?? $parm;

            // Itera sobre os operadores permitidos para o parâmetro
            foreach ($operators as $operator) {
                // Se o operador estiver definido no parâmetro da requisição, adiciona a condição à consulta Eloquent
                if (isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }
        // Retorna a consulta Eloquent construída
        return $eloQuery;
    }
} 