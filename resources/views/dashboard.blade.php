<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Controle Financeiro - FinanWise</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />
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
            /* Fixando altura para evitar mudança de tamanho inicial */
            min-height: 350px;
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
                            <h3 id="receitasTotal">R$ 0,00</h3>
                            <p>Receitas Totais Mês</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card p-4 text-center bg-danger text-white">
                            <h3 id="despesasTotal">R$ 0,00</h3>
                            <p>Despesas Totais Mês</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card p-4 text-center bg-primary text-white">
                            <h3 id="saldoTotal">R$ 0,00</h3>
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
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="tipo" class="form-label">Tipo</label>
                                        <select id="tipo" name="tipo" class="form-select">
                                            <option value="receita">Receita</option>
                                            <option value="despesa">Despesa</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="categoria" class="form-label">Categoria</label>
                                        <select id="categoria" name="categoria" class="form-select">
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
                                        <input type="number" step="0.01" name="valor" class="form-control" id="valor" placeholder="Ex: 250.00" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="data" class="form-label">Data</label>
                                        <input type="date" name="data" class="form-control" id="data" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="forma_pagamento" class="form-label">Forma de Pagamento</label>
                                        <select id="forma_pagamento" name="forma_pagamento" class="form-select">
                                            <option value="dinheiro">Dinheiro</option>
                                            <option value="cartao">Cartão</option>
                                            <option value="pix">Pix</option>
                                            <option value="boleto">Boleto</option>
                                            <option value="outro">Outro</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 d-flex align-items-end">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="recorrente" name="recorrente" value="1">
                                            <label class="form-check-label" for="recorrente">Recorrente</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" onclick="registrarTransacao()">Salvar Transação</button>
                            </form>
                        </div>
            <div class="card p-4 mt-4">
                <h5>Importar Transações via CSV</h5>
                @if(session('success'))
                    <div class="alert alert-success mt-2">{{ session('success') }}</div>
                @endif
                @if($errors->any()) 
                    <div class="alert alert-danger mt-2">{{ $errors->first() }}</div>
                @endif
                <form action="{{ route('importar.transacoes') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="arquivo_csv" class="form-label">Selecione o arquivo CSV</label>
                        <input type="file" name="arquivo_csv" class="form-control" required>
                        <small class="text-muted">Formato esperado: data,valor,descricao,tipo</small>
                    </div>
                    <button type="submit" class="btn btn-success">Importar CSV</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <button class="toggle-btn" onclick="toggleDarkMode()">
        <img src="https://img.icons8.com/ios-filled/50/000000/sun.png" alt="Modo Escuro">
    </button>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
        @csrf
    </form>
    <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-btn">Sair</button>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function toggleDarkMode() {
        document.body.classList.toggle("dark-mode");
        document.querySelector('.toggle-btn').classList.toggle('active');
        const darkModeEnabled = document.body.classList.contains("dark-mode");
        localStorage.setItem("darkMode", darkModeEnabled);
    }

    let dadosFinanceiros = {
        receitas: Array(12).fill(0),
        despesas: Array(12).fill(0)
    };

    function atualizarValores() {
    const mesAtual = new Date().getMonth(); // 0-based index (Jan = 0)
    const totalReceitas = dadosFinanceiros.receitas[mesAtual] || 0;
    const totalDespesas = dadosFinanceiros.despesas[mesAtual] || 0;
    const saldo = totalReceitas - totalDespesas;  // <-- ajuste aqui

    document.getElementById('receitasTotal').textContent = `R$ ${totalReceitas.toFixed(2)}`;
    document.getElementById('despesasTotal').textContent = `R$ ${totalDespesas.toFixed(2)}`;
    document.getElementById('saldoTotal').textContent = `R$ ${saldo.toFixed(2)}`;

    financeChart.data.datasets[0].data = dadosFinanceiros.despesas;
    financeChart.data.datasets[1].data = dadosFinanceiros.receitas;
    financeChart.update();

    pieChart.data.datasets[0].data = [totalReceitas, totalDespesas];
    pieChart.update();
}

    function carregarTransacoes() {
    fetch('{{ url("api/transacoes") }}', {
        method: 'GET',
        credentials: 'same-origin' 
    })
    .then(response => response.json())
    .then(data => {
        console.log("Dados recebidos:", data); // Veja o objeto completo
        console.log('Receitas:', data.receitas);
        console.log('Despesas:', data.despesas);

        dadosFinanceiros.receitas = Array.isArray(data.receitas) ? data.receitas : Array(12).fill(0);
        dadosFinanceiros.despesas = Array.isArray(data.despesas) ? data.despesas : Array(12).fill(0);
        atualizarValores();
    })
    .catch(err => console.error("Erro ao carregar transações:", err));
}


    function registrarTransacao() {
        const form = document.getElementById('formTransacao');
        const formData = new FormData(form);

        fetch('{{ url("api/transacoes") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.sucesso || data.success) {
                alert("Transação salva com sucesso!");
                form.reset();
                carregarTransacoes();
            } else {
                alert(data.erro || "Erro ao salvar transação");
            }
        })
        .catch(err => {
            console.error("Erro ao registrar transação:", err);
            alert("Erro ao registrar transação.");
        });
    }

    const ctx1 = document.getElementById('financeChart').getContext('2d');
    const financeChart = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            datasets: [
                {
                    label: 'Despesas',
                    data: Array(12).fill(0),
                    borderColor: 'red',
                    backgroundColor: 'red',
                    borderWidth: 2,
                    fill: false,
                    order: 1,
                    tension: 0.1 // suaviza a linha
                },
                {
                    label: 'Receitas',
                    data: Array(12).fill(0),
                    borderColor: 'green',
                    backgroundColor: 'green',
                    borderWidth: 2,
                    fill: false,
                    order: 2,
                    tension: 0.1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
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
    carregarTransacoes(); // <- aqui
};

    </script>
</body>
</html>
