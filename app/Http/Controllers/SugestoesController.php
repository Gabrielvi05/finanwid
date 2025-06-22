<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SugestaoRecebida;

class SugestoesController extends Controller
{
    public function enviar(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email',
            'mensagem' => 'required|string',
        ]);

        // Enviar email para você
        Mail::to('seuemail@dominio.com')->send(new SugestaoRecebida($data));

        return redirect()->route('sugestoes')->with('success', 'Mensagem enviada com sucesso!');
    }
}
