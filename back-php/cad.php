<?php
require "conect.php";

// Receber os dados do formulário
$matricula = $_POST['matricula'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = md5($_POST['senha']); // Usar a função md5 para criptografar a senha
$data_cadastro = date('Y-m-d'); // Data atual no formato YYYY-MM-DD
$nivel = $_POST['nivel'];

// Preparar a consulta SQL com prepared statements
$stmt = $conn->prepare("INSERT INTO usuario (nome, matricula, email, senha, data_cadastro, nivel)
VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $nome, $matricula, $email, $senha, $data_cadastro, $nivel);

// Executar a consulta SQL
if ($stmt->execute()) {
    // Redirecionar o usuário para a página index.php
    header("Location: ../index.php");
    exit; // Encerrar o script para garantir que o redirecionamento seja executado
} else {
    echo 'Erro ao inserir os dados: ' . $stmt->error;
}

// Fechar a conexão com o banco de dados
$stmt->close();
$conn->close();
