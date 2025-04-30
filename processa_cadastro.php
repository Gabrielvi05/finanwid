<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome     = $_POST['nome'];
    $email    = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha    = $_POST['senha'];

    // Criptografa a senha
    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

    // Prepara a SQL com a tabela "cadastro"
    $sql = "INSERT INTO cadastro (nome, email, telefone, senha) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Associa os parâmetros
        $stmt->bind_param("ssss", $nome, $email, $telefone, $senhaCriptografada);

        // Executa
        if ($stmt->execute()) {
            echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='cadastro.html';</script>";
        } else {
            echo "Erro ao cadastrar: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Erro na preparação da query: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Requisição inválida.";
}
?>
