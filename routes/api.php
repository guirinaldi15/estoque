<?php
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

    Route::get('/produto', [ProdutoController::class, 'index']);
    Route::post('/produto', [ProdutoController::class, 'store']);
    Route::put('/produto', [ProdutoController::class, 'update']);
    Route::delete('/produto/delete/{id}', [ProdutoController::class, 'delete']);

    Route::get('/cliente', [ClienteController::class, 'index']);
    Route::post('/cliente', [ClienteController::class, 'store']);
    Route::put('/cliente', [ClienteController::class, 'update']);
    Route::delete('/cliente/delete/{id}', [ClienteController::class, 'delete']);