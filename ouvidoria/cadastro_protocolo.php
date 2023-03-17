<?php
require_once "./back_php/conect.php";

//verificaçãop do anexo
if (!empty($_FILES['anexo']['name'])) {

    // Definir o caminho da pasta de uploads
    $upload_dir = "./uploads/";

    // Gerar um nome único para o arquivo
    $upload_file = $upload_dir . uniqid() . '_' . basename($_FILES['anexo']['name']);

    // Verificar se o arquivo é uma imagem, PDF ou documento
    $allowed_types = array('image/jpeg', 'image/png', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    $file_type = mime_content_type($_FILES['anexo']['tmp_name']);

    if (in_array($file_type, $allowed_types)) {
        // Fazer o upload do arquivo
        if (move_uploaded_file($_FILES['anexo']['tmp_name'], $upload_file)) {
            // Atualizar o valor da variável $anexo com o nome do arquivo
            $anexo = $upload_file;
            // Definir o caminho do arquivo salvo
            $caminho_anexo = $upload_file;
        } else {
            echo "Erro ao fazer upload do arquivo";
        }
    } else {
        echo "O arquivo enviado não é uma imagem, PDF ou documento";
    }
}

//criação do protocolo
function gerarProtocolo($conn, $tabela, $campo)
{
    // Gerar um número aleatório de 6 dígitos
    $numero = rand(100000, 999999);

    // Verificar se o número já existe no banco de dados
    $sql = "SELECT COUNT(*) AS total FROM $tabela WHERE $campo = '$numero'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $total = $row['total'];

    // Se o número já existe, gerar um novo
    if ($total > 0) {
        gerarProtocolo($conn, $tabela, $campo);
    }

    return $numero;
}
// Verificar se o formulário foi enviado corretamente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber os dados do formulário através de $_POST
    $identificacao = $_POST["identificacao"];
    $tipo_solicitacao = $_POST["tipo-solicitacao"];
    $nome = $_POST["nome"];
    $rg = $_POST["rg"];
    $cpf = $_POST["cpf"];
    $tratamento = $_POST["tratamento"];
    $sexo = $_POST["sexo"];
    $telefone_fixo = $_POST["telefone-fixo"];
    $celular = $_POST["celular"];
    $email = $_POST["email"];
    $logradouro = $_POST["logradouro"];
    $numero = $_POST["numero"];
    $complemento = $_POST["complemento"];
    $bairro = $_POST["bairro"];
    $estado = $_POST["uf"];
    $cidade = $_POST["municipio"];
    $cep = $_POST["cep"];
    $descricao = $_POST["descricao"];
    $status = 'Não Inciado';

    // Verificar se os campos obrigatórios foram preenchidos
    if ($identificacao && $tipo_solicitacao && $nome && $logradouro && $numero) {

        // Sanitizar os dados recebidos
        $identificacao = mysqli_real_escape_string($conn, $identificacao);
        $tipo_solicitacao = mysqli_real_escape_string($conn, $tipo_solicitacao);
        $nome = mysqli_real_escape_string($conn, $nome);
        $rg = mysqli_real_escape_string($conn, $rg);
        $cpf = mysqli_real_escape_string($conn, $cpf);
        $tratamento = mysqli_real_escape_string($conn, $tratamento);
        $sexo = mysqli_real_escape_string($conn, $sexo);
        $telefone_fixo = mysqli_real_escape_string($conn, $telefone_fixo);
        $celular = mysqli_real_escape_string($conn, $celular);
        $email = mysqli_real_escape_string($conn, $email);
        $logradouro = mysqli_real_escape_string($conn, $logradouro);
        $numero = mysqli_real_escape_string($conn, $numero);
        $complemento = mysqli_real_escape_string($conn, $complemento);
        $bairro = mysqli_real_escape_string($conn, $bairro);
        $estado = mysqli_real_escape_string($conn, $estado);
        $cidade = mysqli_real_escape_string($conn, $cidade);
        $cep = mysqli_real_escape_string($conn, $cep);
        $descricao = mysqli_real_escape_string($conn, $descricao);
        $status = mysqli_real_escape_string($conn, $status);

        // Gerar o número de protocolo
        $numero_protocolo = gerarProtocolo($conn, 'solicitacoes', 'numero_protocolo');

        $sql = "INSERT INTO solicitacoes (id, identificacao, tipo_solicitacao, nome, rg, cpf, tratamento, sexo, telefone_fixo, celular, email, logradouro, numero, complemento, bairro, estado, cidade, cep, descricao, anexo, data_registro, numero_protocolo, situacao, caminho_anexo) 
        VALUES (NULL, '$identificacao', '$tipo_solicitacao', '$nome', '$rg', '$cpf', '$tratamento', '$sexo', '$telefone_fixo', '$celular', '$email', '$logradouro', '$numero', '$complemento', '$bairro', '$estado', '$cidade', '$cep', '$descricao', '$anexo', NOW(), '$numero_protocolo', '$status',  '$caminho_anexo')";
        if (mysqli_query($conn, $sql)) {
            if (mysqli_affected_rows($conn) > 0) {
                $protocolo = mysqli_insert_id($conn);
            } else {
                die('Erro ao inserir os dados');
            }
        } else {
            die('Erro ao executar a consulta: ' . mysqli_error($conn));
        }

        mysqli_close($conn);

        header("Location: sucesso.php?protocolo=$numero_protocolo");
        exit;
    }
}
