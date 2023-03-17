<?php
include "conect.php";
// Verifica se o protocolo foi recebido via GET
if (isset($_POST['protocolo'])) {
    $protocolo = $_POST['protocolo'];
    $status = $_POST['status'];

    // Atualiza a coluna "status" na tabela desejada
    $sql = "UPDATE protocolos SET status = '$status' WHERE protocolo = '$protocolo'";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../pages/analiste.php?protocolo=$protocolo");
    } else {
        echo "Erro ao atualizar coluna: " . $conn->error;
    }
}
