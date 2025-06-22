<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cadastro;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $usuario = Cadastro::where('email', $request->email)->first();

        if ($usuario && Hash::check($request->password, $usuario->senha)) {
            Session::put('usuario_id', $usuario->id);
            Session::put('usuario_nome', $usuario->nome);

            return redirect()->route('dashboard');
        }

        return redirect()->route('login')->with('erro', 'E-mail ou senha incorretos.');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }
}
