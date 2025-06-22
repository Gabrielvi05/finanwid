<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class TransacaoController extends Controller
{
    public function getTransacoes(Request $request)
    {
        $usuarioId = Session::get('usuario_id');

        if (!$usuarioId) {
            return response()->json(['erro' => 'Usuário não autenticado'], 401);
        }

        $resultados = DB::table('transacoes')
            ->selectRaw('MONTH(data) AS mes, tipo, SUM(valor) AS total')
            ->where('usuario_id', $usuarioId)
            ->groupBy('mes', 'tipo')
            ->get();

        $receitas = array_fill(0, 12, 0);
        $despesas = array_fill(0, 12, 0);

        foreach ($resultados as $row) {
            $mes = (int) $row->mes - 1;
            if ($mes < 0 || $mes > 11) {
                continue;
            }

            $valor = (float) $row->total;
            $tipo = strtolower($row->tipo);

            if ($tipo === 'receita') {
                $receitas[$mes] += $valor;
            } elseif ($tipo === 'despesa') {
                $despesas[$mes] += $valor;
            }
        }

        return response()->json([
            'receitas' => array_values($receitas),
            'despesas' => array_values($despesas),
        ]);
    }

    public function inserir(Request $request)
    {
        $usuarioId = Session::get('usuario_id');

        if (!$usuarioId) {
            return response()->json(['erro' => 'Usuário não autenticado'], 401);
        }

        $request->validate([
            'tipo' => 'required|in:receita,despesa',
            'categoria' => 'required|string|max:50',
            'valor' => 'required|numeric',
            'data' => 'required|date',
            'forma_pagamento' => 'nullable|string|max:50',
            'recorrente' => 'nullable|boolean',
        ]);

        $transacaoExistente = DB::table('transacoes')
            ->where([
                ['usuario_id', $usuarioId],
                ['tipo', $request->tipo],
                ['categoria', $request->categoria],
                ['valor', $request->valor],
                ['data', $request->data],
            ])
            ->first();

        if ($transacaoExistente) {
            return response()->json(['erro' => 'Transação já existe para esta data.']);
        }

        DB::table('transacoes')->insert([
            'usuario_id' => $usuarioId,
            'tipo' => $request->tipo,
            'categoria' => $request->categoria,
            'valor' => $request->valor,
            'data' => $request->data,
            'forma_pagamento' => $request->forma_pagamento,
            'recorrente' => $request->recorrente ? 1 : 0,
        ]);

        return response()->json(['success' => true]);
    }

    public function importar(Request $request)
    {
        $usuarioId = Session::get('usuario_id');

        if (!$usuarioId) {
            return redirect()->back()->withErrors('Usuário não autenticado.');
        }

        $request->validate([
            'arquivo_csv' => 'required|file|mimes:csv,txt'
        ]);

        $arquivo = $request->file('arquivo_csv');
        $linhas = file($arquivo->getPathname());

        if (!$linhas || count($linhas) < 2) {
            return redirect()->back()->withErrors('Arquivo CSV vazio ou inválido.');
        }

        $separador = strpos($linhas[0], ';') !== false ? ';' : ',';

        foreach ($linhas as $i => $linha) {
            if ($i === 0) continue; // pular cabeçalho

            $dados = str_getcsv(trim($linha), $separador);

            if (count($dados) < 3) continue;

            // Data
            $dataBr = preg_match('/\d{2}\/\d{2}\/\d{4}/', $dados[0]);
            $data = $dataBr
                ? \DateTime::createFromFormat('d/m/Y', $dados[0])->format('Y-m-d')
                : date('Y-m-d', strtotime($dados[0]));

            // Valor - corrigido para não remover ponto decimal
            $valorRaw = str_replace([' ', 'R$'], ['', ''], $dados[1]);
            $valorRaw = str_replace(',', '.', $valorRaw);
            $valor = floatval($valorRaw);

            // Descrição
            $descricao = $dados[3] ?? null;

            // Tipo
            $tipoRaw = strtolower(trim($dados[4] ?? ''));
            if (in_array($tipoRaw, ['receita', 'despesa'])) {
                $tipo = $tipoRaw;
            } else {
                $tipo = $valor >= 0 ? 'receita' : 'despesa';
            }

            // Ajustar valor se despesa
            if ($tipo === 'despesa' && $valor < 0) {
                $valor = abs($valor);
            }
            if ($tipo === 'receita' && $valor < 0) {
                $valor = abs($valor);
            }

            // Categoria, se existir
            $categoria = $dados[5] ?? 'importado';

            DB::table('transacoes')->insert([
                'usuario_id' => $usuarioId,
                'tipo' => $tipo,
                'categoria' => $categoria,
                'valor' => $valor,
                'data' => $data,
                'forma_pagamento' => 'banco',
                'recorrente' => 0,
                'descricao' => $descricao,
            ]);
        }
        return redirect()->route('dashboard')->with('success', 'Transações importadas com sucesso!');
    }
}
