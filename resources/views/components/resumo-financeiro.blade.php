<div class="row">
    <div class="col-md-4">
        <div class="card p-4 text-center bg-success text-white">
            <h3>R$ {{ number_format($receitasTotal, 2, ',', '.') }}</h3>
            <p>Receitas Totais Mês</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-4 text-center bg-danger text-white">
            <h3>R$ {{ number_format($despesasTotal, 2, ',', '.') }}</h3>
            <p>Despesas Totais Mês</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-4 text-center bg-primary text-white">
            <h3>R$ {{ number_format($saldoTotal, 2, ',', '.') }}</h3>
            <p>Saldo Disponível Mês</p>
        </div>
    </div>
</div>
