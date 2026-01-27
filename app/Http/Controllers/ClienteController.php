<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $cliente = Cliente::all();
        return response()->json($cliente);
    }
    public function store(Request $request)
    {
        if (Cliente::where('cpf', $request->cpf)->exists()) {
            return response()->json(['erro' => 'CPF ja cadastrado']);
        }
        $cliente = Cliente::create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'idade' => $request->idade,
        ]);
        return response()->json($cliente, 201);
    }
    public function update(Request $request)
    {
        $cliente = Cliente::find($request->id);

        if ($cliente == null) {
            return response()->json(['erro' => 'Tarefa não encontrada']);
        }
        if (isset($request->nome)) {
            $cliente->nome = $request->nome;
        }
        if (isset($request->cpf)) {
            $cliente->cpf = $request->cpf;
        }
        if (isset($request->idade)) {
            $cliente->idade = $request->idade;
            $cliente->update();

            return response()->json(['mensagem' => 'atualizada']);
        }
    }
    public function delete($id)
    {
        $cliente = Cliente::find($id);

        if ($cliente == null) {
            return response()->json(['erro' => 'Tarefa não encontrada']);
        }
        $cliente->delete();
        return response()->json(['mensagem' => 'Tarefa deletada com sucesso']);
    }
}
