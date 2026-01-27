<?php

namespace App\Http\Controllers;

use App\Models\Saida;
use Illuminate\Http\Request;

class SaidaController extends Controller
{
    public function index(){
        return response()->json(['mensagem' => 'Sistema de Controle de Estoque v1.0']);
    }
    public function delete($id){
        $saida = Saida::find($id);

        if($saida == null){
            return response()->json(['erro' => 'Saída não encontrada']);
        }
        $saida->delete();
        return response()->json(['mensagem' => 'Saída deletada com sucesso']);
    }
    public function store(Request $request){
        $saida = Saida::create([
            'produto_id' => $request->produto_id,
            'quantidade' => $request->quantidade,
            'id_cliente' => $request->id_cliente
        ]);

        return response()->json($saida);
    }
}
