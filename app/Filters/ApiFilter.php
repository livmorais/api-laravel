<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter {
    // parametros permitidos na filtragem da api
    protected $safeParms = [];

    // mapeando entre os parametros e as colunas no banco
    protected $columnMap = [];

    // mapeia os operadores da API para os operadores do eloquent/sql
    protected $operatorMap = [];

    // transforma os parâmetros da requisição em uma consulta eloquent
    public function transform(Request $request) {
        $eloQuery = []; 

         // Itera sobre os parâmetros seguros definidos
        foreach ($this->safeParms as $parm => $operators) {
            // Obtém o valor do parâmetro da requisição
            $query = $request->query($parm);

            if(!isset($query)) {
                continue; //se nao tiver pula pro proximo
            }
            // Obtem o nome da coluna correspondente ao parametro ou usa o proprio parametro se não tiver mapeamento
            $column = $this->columnMap[$parm] ?? $parm;

            // Itera sobre os operadores permitidos para verificar se estao presentes na req.
            foreach ($operators as $operator) {
                // Se o operador estiver definido no parametro da req, adiciona a condição a consulta eloquent
                if (isset($query[$operator])) {
                     // Adiciona a condição ao array de consulta usando o operador mapeado
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }
        // retorna o array de condições para consulta eloquent construida
        return $eloQuery;
    }
} 