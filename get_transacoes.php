<?php
require_once('conexao.php');

session_start();

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['erro' => 'Usuário não autenticado']);
    exit();
}

$query = "SELECT MONTH(data) AS mes, tipo, SUM(valor) AS total FROM transacoes WHERE usuario_id = ? GROUP BY mes, tipo";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['usuario_id']);
$stmt->execute();
$result = $stmt->get_result();

$receitas = array_fill(1, 12, 0);
$despesas = array_fill(1, 12, 0);

while ($row = $result->fetch_assoc()) {
    $mes = intval($row['mes']);
    $valor = floatval($row['total']);

    if ($row['tipo'] === 'receita') {
        $receitas[$mes] += $valor;
    } elseif ($row['tipo'] === 'despesa') {
        $despesas[$mes] -= $valor;  // Subtrai o valor das despesas (mudei de += para -=)
    }
}

echo json_encode([
    'receitas' => array_values($receitas),
    'despesas' => array_values($despesas)
]);
