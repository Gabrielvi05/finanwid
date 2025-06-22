<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cadastro;
use Illuminate\Support\Facades\Hash;

class CadastroController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'nome'     => 'required|string|min:3|max:255',
        'email'    => 'required|email|unique:cadastro,email',
        'telefone' => 'required|string|max:20',
        'senha'    => 'required|string|min:6|confirmed',
    ]);

    $cadastro = Cadastro::create([
        'nome'     => $validated['nome'],
        'email'    => $validated['email'],
        'telefone' => $validated['telefone'],
        'senha'    => Hash::make($validated['senha']),
    ]);

    return redirect('/login')->with('success', 'Cadastro realizado com sucesso!');
}
}



