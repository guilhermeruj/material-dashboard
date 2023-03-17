<?php

// Configurações de conexão com o banco de dados
$host = "localhost"; // Nome do servidor do banco de dados
$usuario = "saeara69_gkdata"; // Nome do usuário do banco de dados
$senha = "kjgLPzz^};BI"; // Senha do usuário do banco de dados
$banco = "saeara69_adm"; // Nome do banco de dados

// Conecta ao banco de dados
$conn = mysqli_connect($host, $usuario, $senha, $banco);

// Verifica se a conexão foi bem sucedida
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}


// Configurações de conexão com o banco de dados
//$host = "localhost"; // Nome do servidor do banco de dados
//$usuario = "root"; // Nome do usuário do banco de dados
//$senha = ""; // Senha do usuário do banco de dados
//$banco = "e_sic"; // Nome do banco de dados

// Conecta ao banco de dados
//$conn = mysqli_connect($host, $usuario, $senha, $banco);

// Verifica se a conexão foi bem sucedida
// if (!$conn) {
//     die("Conexão falhou: " . mysqli_connect_error());
// }
