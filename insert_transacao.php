<?php
session_start();
include 'conexao.php'; // Arquivo de conexão com o banco de dados

// Verifique se o usuário está autenticado
if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(["erro" => "Usuário não autenticado."]);
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'];
    $categoria = $_POST['categoria'];
    $valor = floatval($_POST['valor']);
    $data = $_POST['data'];
    $forma_pagamento = $_POST['forma_pagamento'] ?? '';
    $recorrente = isset($_POST['recorrente']) ? intval($_POST['recorrente']) : 0;

    // Verifica se a transação já existe para o mesmo usuário e data
    $query = "SELECT * FROM transacoes WHERE usuario_id = ? AND tipo = ? AND categoria = ? AND valor = ? AND data = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issds", $usuario_id, $tipo, $categoria, $valor, $data);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["erro" => "Transação já existe para esta data."]);
    } else {
        $insertQuery = "INSERT INTO transacoes (usuario_id, tipo, categoria, valor, data, forma_pagamento, recorrente) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("issdssi", $usuario_id, $tipo, $categoria, $valor, $data, $forma_pagamento, $recorrente);

        if ($stmt->execute()) {
            echo json_encode(["sucesso" => true]);
        } else {
            echo json_encode(["erro" => "Erro ao inserir transação."]);
        }
    }
} else {
    echo json_encode(["erro" => "Requisição inválida."]);
}
?>
