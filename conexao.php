<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "meu_banco"; // Altere aqui com o nome real do seu banco

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
//echo "Conexão realizada com sucesso!";
?>
