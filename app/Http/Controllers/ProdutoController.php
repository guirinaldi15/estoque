<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index (){

$produto= Produto::all();
return response()->json($produto);

    }


public function store(Request $request){
$produto = Produto::create([

'marca' => $request->marca,
'descricao' => $request ->descricao,
'valor_unitario' => $request ->valor_unitario,
'quantidade_estoque'=> $request ->quantidade_estoque,
'faixa_etaria_minima'=>$request ->faixa_etaria_minima
]);

return response()->json($produto);



}

public function update(Request $request){
$produto = Produto::find($request->id);

if($produto == null){
    return response()-> json(['erro'=> 'Tarefa não encontrada']);
}

if(isset($request->marca)){
    $produto-> marca = $request->marca;
}
if(isset($request->descricao)){
    $produto->descricao = $request ->descricao;
}
if(isset($request->valor_unitario)){
    $produto->valor_unitario = $request->valor_unitario;
}
if(isset($request->quantidade_estoque)){
    $produto->quantidade_estoque = $request ->quantidade_estoque;
}
if(isset($request->faixa_etaria_minima)){
    $produto->faixa_etaria_minima = $request ->faixa_etaria_minima;
}


$produto ->update();
return response()->json(['mensagem' => 'atualizada']);

}

public function delete($id){
    $produto = Produto::find($id);

    if ($produto == null){
        return response()->json(['erro' => 'Tarefa não encontrada']);
    }
    $produto->delete();
    return response()->json(['mensagem'=>'Tarefa deletada com sucesso']);
}




}