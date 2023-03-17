<?php
include "conect.php";
// Verifica se o protocolo foi recebido via GET
if (isset($_POST['protocolo'])) {
    $protocolo = $_POST['protocolo'];
    $status = $_POST['situacao'];

    // Atualiza a coluna "status" na tabela desejada
    $sql = "UPDATE solicitacoes SET situacao = '$status' WHERE numero_protocolo = '$protocolo'";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../pages/analiste-ouvidoria.php?protocolo=$protocolo");
    } else {
        echo "Erro ao atualizar coluna: " . $conn->error;
    }
}
