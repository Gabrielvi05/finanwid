<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class ResumoFinanceiro extends Component
{
    public function render()
    {
        $usuarioId = session('usuario_id');

        if (!$usuarioId) {
            return view('components.resumo-financeiro', [
                'totalReceitas' => 0,
                'totalDespesas' => 0,
                'saldo' => 0,
            ]);
        }

        $mesAtual = date('m');
        $anoAtual = date('Y');

        $totalReceitas = DB::table('transacoes')
            ->where('usuario_id', $usuarioId)
            ->where('tipo', 'receita')
            ->whereMonth('data', $mesAtual)
            ->whereYear('data', $anoAtual)
            ->sum('valor');

        $totalDespesas = DB::table('transacoes')
            ->where('usuario_id', $usuarioId)
            ->where('tipo', 'despesa')
            ->whereMonth('data', $mesAtual)
            ->whereYear('data', $anoAtual)
            ->sum('valor');

        $saldo = $totalReceitas - $totalDespesas;

        return view('components.resumo-financeiro', [
            'receitasTotal' => $totalReceitas,
            'despesasTotal' => $totalDespesas,
            'saldoTotal' => $saldo,
        ]);

    }
}
