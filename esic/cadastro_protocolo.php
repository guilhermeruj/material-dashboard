<?php
require_once "./back_php/conect.php";

function gerarProtocolo($conn, $tabela, $coluna)
{
    do {
        $protocolo = rand(10000000, 99999999);
        $sql = "SELECT * FROM $tabela WHERE $coluna = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $protocolo);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    } while (mysqli_num_rows($result) > 0);

    return $protocolo;
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Recupera os dados do formulário e sanitiza
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING);
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
    $logradouro = filter_input(INPUT_POST, 'logradouro', FILTER_SANITIZE_STRING);
    $numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING);
    $complemento = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_STRING);
    $bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);
    $uf = filter_input(INPUT_POST, 'uf', FILTER_SANITIZE_STRING);
    $municipio = filter_input(INPUT_POST, 'municipio', FILTER_SANITIZE_STRING);
    $cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING);
    $assunto = filter_input(INPUT_POST, 'assunto', FILTER_SANITIZE_STRING);
    $prioridades = filter_input(INPUT_POST, 'prioridades', FILTER_SANITIZE_STRING);
    $tipoComentario = filter_input(INPUT_POST, 'tipoComentario', FILTER_SANITIZE_STRING);
    $tipoResposta2 = filter_input(INPUT_POST, 'tipoResposta2', FILTER_SANITIZE_STRING);
    $situacao = 'Não Iniciado';

    // Verifica se o arquivo foi enviado
    if (isset($_FILES['arquivo'])) {
        $arquivo = $_FILES['arquivo'];
        $arquivo_nome = $arquivo['name'];
        $arquivo_tipo = $arquivo['type'];
        $arquivo_tamanho = $arquivo['size'];
        $arquivo_tmp = $arquivo['tmp_name'];

        // Adiciona a pasta de upload ao nome do arquivo
        $diretorio_upload = '../uploads';
        $arquivo_nome = $diretorio_upload . $arquivo_nome;

        // Move o arquivo para a pasta de upload
        if (!move_uploaded_file($arquivo_tmp, $arquivo_nome)) {
            die('Erro ao mover arquivo para pasta de upload');
        }
    }

    // Gera um número de protocolo único
    $protocolo = gerarProtocolo($conn, "protocolos", "protocolo");

    // Prepara o comando SQL de inserção dos dados na tabela
    $sql = "INSERT INTO protocolos (id, protocolo, nome, email, mensagem, telefone, logradouro, numero, complemento, bairro, uf, municipio, cep, assunto, prioridades, tipoComentario, tipoResposta2, situacao, arquivo_nome, arquivo_tipo, arquivo_tamanho, arquivo_tmp) 
    VALUES ('', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        die('Erro na declaração SQL: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, 'sssssssssssssssssssss', $protocolo, $nome, $email, $mensagem, $telefone, $logradouro, $numero, $complemento, $bairro, $uf, $municipio, $cep, $assunto, $prioridades, $tipoComentario, $tipoResposta2, $situacao, $arquivo_nome, $arquivo_tipo, $arquivo_tamanho, $arquivo_tmp);
    if (!mysqli_stmt_execute($stmt)) {
        die('Erro na execução da declaração SQL: ' . mysqli_error($conn));
    }

    mysqli_stmt_close($stmt);

    if (mysqli_errno($conn)) {
        die('Erro no banco de dados: ' . mysqli_error($conn));
    }

    mysqli_close($conn);

    header("Location: sucesso.php?protocolo=$protocolo");
    exit;
}
