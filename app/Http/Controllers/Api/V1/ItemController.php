<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\ItensFilter;
use App\Models\Item;
use App\Models\Fatura;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Requests\V1\BulkStoreItemRequest;
use App\Http\Resources\V1\ItemCollection;
use App\Http\Resources\V1\ItemResource;
use Illuminate\Support\Arr;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // return new ItemCollection(Item::paginate());
        $filter = new ItensFilter();
        $queryItems = $filter->transform($request); //[['column', 'operator', 'value']]

        if (count($queryItems) == 0) {
            return new ItemCollection(Item::paginate());
        } else {
            $itens = Item::where($queryItems)->paginate();

            return new ItemCollection($itens->appends($request->query()));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    
    public function bulkStoreItem(BulkStoreItemRequest $request) 
    {
        $bulk = collect($request->all())->map(function($arr, $key) {

            $arr['created_at'] = now();
            $arr['updated_at'] = now();
            return Arr::except($arr, ['faturaId', 'nome']);
        });

        Item::insert($bulk->toArray());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        return new ItemResource(Item::create($request->all()));
    }



    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return new ItemResource($item);
    }    


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        if ($item->delete()) {
            return response()->json(null, 204);
        } else {
            return response()->json(['message' => 'Falha ao excluir o item.'], 500);
        }
    }
}
