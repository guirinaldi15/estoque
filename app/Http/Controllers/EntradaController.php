<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Produto;
use Illuminate\Http\Request;


class EntradaController extends Controller
{
    public function store(Request $request)
    {
        $produto = Produto::find($request->id_produto);
        if ($produto == null) {
            return response()->json(['erro' => 'Tarefa não encontrada']);
        }
        $entrada = Entrada::create([
            'id_produto' => $request->produto,
            'quantidade' => $request->quantidade
        ]);
        if (isset($request->quantidade)) {
            $produto->quantidade_estoque = $request->quantidade + $produto->quantidade_estoque;
        }
        $produto->update();

        return response()->json($entrada);
    }
    public function index()
    {
        $entradas = Entrada::all();
    }
};
