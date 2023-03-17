<?php

include "conect.php";
// Verifica se o protocolo foi recebido via GET
if (isset($_GET['anexo'])) {
    // ID do anexo a ser baixado
    $anexo = $_GET['anexo'];

    // Executa a consulta no banco de dados para obter o nome do anexo
    $sql = "SELECT anexo, caminho_anexo FROM solicitacoes WHERE anexo = $anexo";
    $result = $conn->query($sql);

    // Verifica se houve resultado na consulta
    if ($result->num_rows > 0) {
        // Obtém o resultado da consulta
        $row = $result->fetch_assoc();

        // Caminho completo do arquivo
        $file_path = $row["caminho_anexo"] . $row["anexo"];

        // Define o nome do arquivo a ser salvo
        $file_name = $row["anexo"];

        // Inicia o download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $file_name . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);

        header("Location: ../pages/ouvidoria.php");
    } else {
        echo "Anexo não encontrado no banco de dados.";
    }
}
