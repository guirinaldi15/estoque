<?php

namespace App\Http\Controllers;

use App\Models\Saida;
use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Http\Request;

class SaidaController extends Controller

{

      public function index() {
         $data = Saida::all();

            return response()->json($data);
     }

   public function store(Request $request) {
       
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

     

     public function delete($id){
         $saida = Saida::find($id);

        if ($saida == null) {
            return response()->json(['erro' => 'Tarefa não encontrada']);
        }

        $produto = Produto::find($saida->id_produto);
        if ($produto == null) {
            return response()->json(['erro' => 'Produto não encontrado']);
        }
       
        $produto->quantidade_estoque = $produto->quantidade_estoque + $saida->quantidade;
        $produto->update();

        $saida->delete();

        return response()->json(['mensagem' => 'Tarefa deletada com sucesso']);
   
     }
};
