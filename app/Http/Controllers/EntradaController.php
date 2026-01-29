<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
        return response()->json($entradas);
    }
    public function delete($id)
    {
        $entrada = Entrada::find($id);
        if (!$entrada) {
            return response()->json(['erro' => 'Entrada não encontrada'], 404);
        }

        return DB::transaction(function () use ($entrada) {
            $produto = Produto::find($entrada->produto_id);
            if ($produto) {
                $produto->quantidade = max(0, $produto->quantidade - $entrada->quantidade);
                $produto->save();
            }

            $entrada->delete();

            return response()->json(['mensagem' => 'Entrada deletada com sucesso']);
        });
    }
};
