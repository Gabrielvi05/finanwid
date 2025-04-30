<?php
session_start();
include 'conexao.php'; // Conexão com o banco de dados

$email = $_POST['email'];
$senha = $_POST['senha'];

// Consulta ao banco de dados para verificar o e-mail
$sql = "SELECT * FROM cadastro WHERE email = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Erro na preparação: " . $conn->error);
}

$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($usuario = $result->fetch_assoc()) {
    // Verificar se a senha está correta
    if (password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        header("Location: finanwide.php");
        exit();
    } else {
        // Senha incorreta
        $_SESSION['erro_login'] = 'Senha incorreta.';
        header("Location: login.html?erro=" . urlencode($_SESSION['erro_login']));
        exit();
    }
} else {
    // Usuário não encontrado
    $_SESSION['erro_login'] = 'E-mail ou senha incorretos.';
    header("Location: login.html?erro=" . urlencode($_SESSION['erro_login']));
    exit();
}
?>
