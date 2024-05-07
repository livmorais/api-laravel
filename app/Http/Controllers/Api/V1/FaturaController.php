<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Fatura;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreFaturaRequest;
use App\Http\Requests\V1\UpdateFaturaRequest;
use App\Http\Resources\V1\FaturaCollection;
use App\Http\Resources\V1\FaturaResource;
use App\Filters\V1\FaturasFilter;
use App\Http\Requests\V1\BulkStoreFaturaRequest;
use Illuminate\Support\Arr;


class FaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new FaturasFilter();
        $filterItems = $filter->transform($request); //[['column', 'operator', 'value']]

        $includeItens = $request->query('includeItens');
        
        $faturas = Fatura::where($filterItems);
        
        if ($includeItens) {
            $faturas = $faturas->with('itens');
        }

        return new FaturaCollection($faturas->paginate()->appends($request->query()));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function bulkStoreFatura(BulkStoreFaturaRequest $request) 
    {
        $bulk = collect($request->all())->map(function($arr, $key) {

            $arr['created_at'] = now();
            $arr['updated_at'] = now();
            return Arr::except($arr, ['clienteId', 'dataFaturamento', 'dataPagamento']);
        });

        Fatura::insert($bulk->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFaturaRequest $request)
    {
        return new FaturaResource(Fatura::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Fatura $fatura)
    {
        $includeItens = request()->query('includeItens');

        if($includeItens) {
            return new FaturaResource($fatura->loadMissing('itens'));
        }

        return new FaturaResource($fatura);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fatura $fatura)
    {
        return new FaturaResource($fatura);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFaturaRequest $request, Fatura $fatura)
    {
        $fatura->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fatura $fatura)
    {
        //
    }
}
