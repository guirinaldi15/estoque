<?php

namespace App\Http\Controllers;

use App\Models\Saida;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Produto;

class SaidaController extends Controller
{

    public function index()
    {
        $saidas = Saida::all();
        return view('saidas.index', compact('saidas'));
    }

    public function create()
    {
        return view('saidas.create');
    }

    public function store(Request $request)
    {

        $cliente = Cliente::find($request->id_cliente);
        if ($cliente == null) {
            return response()->json(['erro' => 'Cliente não encontrado']);
        }


        $produto = Produto::find($request->id_produto);
        if ($produto == null) {
            return response()->json(['erro' => 'Produto não encontrado']);
        }


        if ($cliente->idade < $produto->faixa_etaria_minima) {
            return response()->json(['erro' => 'Cliente não possui idade para comprar este produto']);
        }


        if ($produto->quantidade_estoque < $request->quantidade) {
            return response()->json(['erro' => 'Quantidade insuficiente em estoque']);
        }

        $saida = Saida::create([
            'id_produto' => $request->id_produto,
            'id_cliente' => $request->id_cliente,
            'quantidade' => $request->quantidade,
        ]);


        $produto->quantidade_estoque = $produto->quantidade_estoque - $request->quantidade;
        $produto->update();

        return response()->json($saida);
    }
};
