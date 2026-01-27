<?php

namespace App\Http\Controllers;
use App\Models\Entrada;
use Illuminate\Http\Request;


class EntradaController extends Controller
{
    public function index(){
        return response()->json(['mensagem' => 'Sistema de Controle de Estoque v1.0']);
    }
    public function delete($id){
        $entrada = Entrada::find($id);

        if($entrada == null){
            return response()->json(['erro' => 'Entrada não encontrada']);
        }
        $entrada->delete();
        return response()->json(['mensagem' => 'Entrada deletada com sucesso']);
    }
      public function store(Request $request){
$entrada = Entrada::create([

'produto_id' => $request->produto_id,
'quantidade' => $request->quantidade
]);

return response()->json($entrada);

}
};