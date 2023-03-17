<?php

include "conect.php";
session_start();

// Verifica se o usuário enviou o formulário de login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados enviados pelo usuário
    $matricula = $_POST['matricula'];
    $senha = $_POST['senha'];
    $lembrar = isset($_POST['lembrar']);

    // Prepara a consulta SQL para buscar um usuário com a matrícula informada
    $stmt = $conn->prepare("SELECT * FROM usuario WHERE matricula = ?");
    $stmt->bind_param("s", $matricula);

    // Executa a consulta SQL
    $stmt->execute();

    // Obtém o resultado da consulta SQL
    $result = $stmt->get_result();

    // Verifica se o usuário foi encontrado
    if ($result->num_rows == 1) {
        // Obtém os dados do usuário
        $usuario = $result->fetch_assoc();

        // Criptografa a senha informada pelo usuário em MD5
        $senha_md5 = md5($senha);

        // Verifica se a senha criptografada é igual à senha armazenada no banco de dados
        if ($senha_md5 == $usuario['senha']) {
            // Se as credenciais são válidas, salva o nome e a matrícula do usuário na sessão
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['matricula'] = $usuario['matricula'];
            $_SESSION['nivel'] = $usuario['nivel'];

            // Define a duração da sessão
            if ($lembrar) {
                // Se o usuário marcou a opção "lembrar-me", define a duração da sessão como 1 semana
                $duracao = 7 * 24 * 60 * 60;
            } else {
                // Caso contrário, define a duração da sessão como 30 minutos
                $duracao = 30 * 60;
            }
            session_set_cookie_params($duracao);

            // Redireciona o usuário para a página de boas-vindas
            header('Location: ../index.php');
            exit;
        } else {
            // Se as credenciais são inválidas, exibe uma mensagem de erro
            header('Location: ../pages/sign-in.php');
        }
    } else {
        // Se as credenciais são inválidas, exibe uma mensagem de erro
        header('Location: ../pages/sign-in.php');
    }
}
