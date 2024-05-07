<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\ClientesFilter;
use App\Models\Cliente;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\V1\StoreClienteRequest;
use App\Http\Requests\V1\UpdateClienteRequest;
use App\Http\Resources\V1\ClienteCollection;
use App\Http\Resources\V1\ClienteResource;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //cria objeto
        $filter = new ClientesFilter();
        //esse metodo vai retornar um array
        $filterItems = $filter->transform($request); //[['column', 'operator', 'value']]
        //buscar juntamente dados de fatura
        $includeFaturas = $request->query('includeFaturas');
        
        $clientes = Cliente::where($filterItems);
        
        if ($includeFaturas) {
            $clientes = $clientes->with('faturas');
        }

        return new ClienteCollection($clientes->paginate()->appends($request->query()));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteRequest $request)
    {
        return new ClienteResource(Cliente::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        $includeFaturas = request()->query('includeFaturas');

        if($includeFaturas) {
            return new ClienteResource($cliente->loadMissing('faturas'));
        }

        return new ClienteResource($cliente);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        $cliente->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
