<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SugestaoRecebida extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->markdown('emails.sugestao.recebida')
                    ->with([
                        'nome' => $this->data['nome'],
                        'email' => $this->data['email'],
                        'mensagem' => $this->data['mensagem'],
                    ]);
    }
}
