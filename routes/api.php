<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ClienteController;
use App\Http\Controllers\Api\V1\FaturaController;
use App\Http\Controllers\Api\V1\ItemController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'middleware' => 'auth:sanctum'], function() {
    Route::apiResource('clientes', ClienteController::class);
    Route::apiResource('faturas', FaturaController::class);
    Route::apiResource('items', ItemController::class);

    Route::post('faturas/bulk', ['uses' => 'FaturaController@bulkStoreFatura']);
    Route::post('items/bulk', ['uses' => 'ItemController@bulkStoreItem']);
});
