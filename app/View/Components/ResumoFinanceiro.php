<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class ResumoFinanceiro extends Component
{
    public $userId;
    public $receitasTotal;
    public $despesasTotal;
    public $saldoTotal;

    public function __construct($userId)
    {
        $this->userId = $userId;

        // Exemplo: buscar do banco os totais do mês atual para o usuário
        $mesAtual = date('m');
        $anoAtual = date('Y');

        $this->receitasTotal = DB::table('transacoes')
            ->where('user_id', $this->userId)
            ->where('tipo', 'receita')
            ->whereMonth('data', $mesAtual)
            ->whereYear('data', $anoAtual)
            ->sum('valor');

        $this->despesasTotal = DB::table('transacoes')
            ->where('user_id', $this->userId)
            ->where('tipo', 'despesa')
            ->whereMonth('data', $mesAtual)
            ->whereYear('data', $anoAtual)
            ->sum('valor');

        $this->saldoTotal = $this->receitasTotal - $this->despesasTotal;
    }

    public function render()
{
    $userId = session('usuario_id');

    $mesAtual = date('m');
    $anoAtual = date('Y');

    $totalReceitas = Transacao::where('usuario_id', $userId)
        ->where('tipo', 'receita')
        ->whereMonth('data', $mesAtual)
        ->whereYear('data', $anoAtual)
        ->sum('valor');

    $totalDespesas = Transacao::where('usuario_id', $userId)
        ->where('tipo', 'despesa')
        ->whereMonth('data', $mesAtual)
        ->whereYear('data', $anoAtual)
        ->sum('valor');

    $saldo = $totalReceitas - $totalDespesas;

    return view('components.resumo-financeiro', [
        'totalReceitas' => $totalReceitas,
        'totalDespesas' => $totalDespesas,
        'saldo' => $saldo,
    ]);
}

}
