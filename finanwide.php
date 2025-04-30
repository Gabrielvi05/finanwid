<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle Financeiro - FinanWise</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Poppins', sans-serif;
            transition: background-color 0.3s, color 0.3s;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .chart-container {
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .dark-mode {
            background-color: #181818;
            color: white;
        }
        .dark-mode .card,
        .dark-mode .chart-container {
            background: #222;
            color: white;
        }
        .toggle-btn {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
        }
        .toggle-btn img {
            width: 50px;
            height: 50px;
        }
        .toggle-btn.active img {
            filter: invert(1);
        }
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <ul class="nav nav-tabs mb-4" id="financeTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" data-bs-target="#dashboard" type="button" role="tab">Painel</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="lancamentos-tab" data-bs-toggle="tab" data-bs-target="#lancamentos" type="button" role="tab">Lançamentos</button>
            </li>
        </ul>

        <div class="tab-content" id="financeTabContent">
            <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                <div class="row text-center">
                    <h2 class="mb-4">Painel Financeiro</h2>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card p-4 text-center bg-success text-white">
                            <h3 id="receitasTotal">R$ 0</h3>
                            <p>Receitas Totais Mês</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card p-4 text-center bg-danger text-white">
                            <h3 id="despesasTotal">R$ 0</h3>
                            <p>Despesas Totais Mês</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card p-4 text-center bg-primary text-white">
                            <h3 id="saldoTotal">R$ 0</h3>
                            <p>Saldo Disponível Mês</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-8">
                        <div class="chart-container">
                            <canvas id="financeChart"></canvas>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="chart-container">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="lancamentos" role="tabpanel">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="card p-4">
                            <h5>Registrar Transação</h5>
                            <form id="formTransacao">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="tipo" class="form-label">Tipo</label>
                                        <select id="tipo" class="form-select">
                                            <option value="receita">Receita</option>
                                            <option value="despesa">Despesa</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="categoria" class="form-label">Categoria</label>
                                        <select id="categoria" class="form-select">
                                            <option value="salario">Salário</option>
                                            <option value="lazer">Lazer</option>
                                            <option value="mantimentos">Mantimentos</option>
                                            <option value="transporte">Transporte</option>
                                            <option value="saude">Saúde</option>
                                            <option value="educacao">Educação</option>
                                            <option value="moradia">Moradia</option>
                                            <option value="outros">Outros</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="valor" class="form-label">Valor</label>
                                        <input type="number" class="form-control" id="valor" placeholder="Ex: 250.00">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="data" class="form-label">Data</label>
                                        <input type="date" class="form-control" id="data">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="forma_pagamento" class="form-label">Forma de Pagamento</label>
                                        <select id="forma_pagamento" class="form-select">
                                            <option value="dinheiro">Dinheiro</option>
                                            <option value="cartao">Cartão</option>
                                            <option value="pix">Pix</option>
                                            <option value="boleto">Boleto</option>
                                            <option value="outro">Outro</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 d-flex align-items-end">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="recorrente">
                                            <label class="form-check-label" for="recorrente">Recorrente</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" onclick="registrarTransacao()">Salvar Transação</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button class="toggle-btn" onclick="toggleDarkMode()">
        <img src="https://img.icons8.com/ios-filled/50/000000/sun.png" alt="Modo Escuro">
    </button>

    <button class="logout-btn" onclick="logout()">Sair</button>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function toggleDarkMode() {
        document.body.classList.toggle("dark-mode");
        document.querySelector('.toggle-btn').classList.toggle('active');
        const darkModeEnabled = document.body.classList.contains("dark-mode");
        localStorage.setItem("darkMode", darkModeEnabled);
    }

    function logout() {
        window.location.href = "login.html";
    }

    let dadosFinanceiros = {
        receitas: [],
        despesas: []
    };

    function atualizarValores() {
        const mesAtual = new Date().getMonth();
        const totalReceitas = dadosFinanceiros.receitas[mesAtual] || 0;
        const totalDespesas = dadosFinanceiros.despesas[mesAtual] || 0;
        const saldo = totalReceitas + totalDespesas;

        document.getElementById('receitasTotal').textContent = `R$ ${totalReceitas.toFixed(2)}`;
        document.getElementById('despesasTotal').textContent = `R$ ${Math.abs(totalDespesas).toFixed(2)}`;
        document.getElementById('saldoTotal').textContent = `R$ ${saldo.toFixed(2)}`;

        financeChart.data.datasets[0].data = dadosFinanceiros.receitas;
        financeChart.data.datasets[1].data = dadosFinanceiros.despesas.map(d => -d);
        financeChart.update();

        pieChart.data.datasets[0].data = [totalReceitas, Math.abs(totalDespesas)];
        pieChart.update();
    }

    function carregarTransacoes() {
        fetch('get_transacoes.php')
            .then(response => response.json())
            .then(data => {
                if (data.erro) {
                    console.error(data.erro);
                    return;
                }
                dadosFinanceiros.receitas = data.receitas;
                dadosFinanceiros.despesas = data.despesas;
                atualizarValores();
            })
            .catch(err => console.error("Erro ao carregar transações:", err));
    }

    function registrarTransacao() {
        const tipo = document.getElementById('tipo').value;
        const categoria = document.getElementById('categoria').value.trim();
        const valor = parseFloat(document.getElementById('valor').value);
        const data = document.getElementById('data').value;
        const formaPagamento = document.getElementById('forma_pagamento').value;
        const recorrente = document.getElementById('recorrente').checked ? 1 : 0;

        if (!categoria || isNaN(valor) || valor <= 0 || !data) {
            alert("Por favor, preencha todos os campos obrigatórios.");
            return;
        }

        const formData = new FormData();
        formData.append("tipo", tipo);
        formData.append("categoria", categoria);
        formData.append("valor", valor);
        formData.append("data", data);
        formData.append("forma_pagamento", formaPagamento);
        formData.append("recorrente", recorrente);

        fetch("insert_transacao.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(text => {
            console.log("Resposta recebida:", text);
            try {
                const data = JSON.parse(text);
                if (data.erro) {
                    alert("Erro: " + data.erro);
                } else {
                    alert("Transação salva com sucesso!");
                    if (recorrente) {
                        duplicarTransacaoParaMesesFuturos(tipo, valor, categoria, formaPagamento);
                    }
                    document.getElementById("formTransacao").reset();
                    carregarTransacoes(); // Atualiza sem reload!
                }
            } catch (err) {
                console.error("Erro ao interpretar JSON:", err);
                alert("Erro ao processar a resposta do servidor.");
            }
        })
        .catch(error => {
            console.error("Erro ao registrar transação:", error);
            alert("Erro ao registrar transação.");
        });
    }

    function duplicarTransacaoParaMesesFuturos(tipo, valor, categoria, formaPagamento) {
        const mesAtual = new Date().getMonth();
        const anoAtual = new Date().getFullYear();
        for (let i = 1; i <= 12 - mesAtual; i++) {
            const mesFuturo = new Date(anoAtual, mesAtual + i, 1);
            const dataFutura = mesFuturo.toISOString().split('T')[0];

            const formData = new FormData();
            formData.append("tipo", tipo);
            formData.append("categoria", categoria);
            formData.append("valor", valor);
            formData.append("data", dataFutura);
            formData.append("forma_pagamento", formaPagamento);
            formData.append("recorrente", 1);

            fetch("insert_transacao.php", {
                method: "POST",
                body: formData
            }).then(res => res.text())
              .then(text => console.log("Resposta duplicada:", text))
              .catch(error => console.error("Erro ao duplicar:", error));
        }
    }

    const ctx1 = document.getElementById('financeChart').getContext('2d');
    const financeChart = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            datasets: [
                {
                    label: 'Receitas',
                    data: [],
                    backgroundColor: 'green',
                    borderColor: 'green',
                    borderWidth: 1
                },
                {
                    label: 'Despesas',
                    data: [],
                    backgroundColor: 'red',
                    borderColor: 'red',
                    borderWidth: 1
                }
            ]
        }
    });

    const ctx2 = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(ctx2, {
        type: 'pie',
        data: {
            datasets: [{
                data: [0, 0],
                backgroundColor: ['green', 'red']
            }],
            labels: ['Receitas', 'Despesas']
        }
    });

    window.onload = function () {
        if (localStorage.getItem("darkMode") === "true") {
            document.body.classList.add("dark-mode");
            document.querySelector('.toggle-btn').classList.add('active');
        }
        carregarTransacoes();
    };
</script>

</body>
</html>
