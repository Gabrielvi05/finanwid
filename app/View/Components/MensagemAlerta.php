<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MensagemAlerta extends Component
{
    public $tipo;
    public $mensagem;

    public function __construct($tipo = 'info', $mensagem = '')
    {
        $this->tipo = $tipo;
        $this->mensagem = $mensagem;
    }

    public function render()
    {
        return view('components.mensagem-alerta');
    }
}
