<?php
require_once "./back_php/conect.php";

if (isset($_GET['protocolo'])) {
    $protocolo = filter_input(INPUT_GET, 'protocolo', FILTER_SANITIZE_NUMBER_INT);

    // Prepara o comando SQL de busca na tabela
    $sql = "SELECT * FROM protocolos WHERE protocolo = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $protocolo);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $dados = mysqli_fetch_assoc($result);

?>
        <html lang="en">

        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="icon" href="./node_modules/img/favicon.png" type="image/png">
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css">
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
            <script>

            </script>

            <title>E-Sic</title>
        </head>

        <body>
            <div class="container">
                <div class="row">
                    <div class="mb-3">
                        <p class="h1 text-center"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="logo-superior">
                        <img class="img-fluid" src="./node_modules/img/fale_sae.png" alt="">
                    </div>
                    <div class="container fundo-cinza">

                        <div class="row">
                            <div class="alert alert-primary" role="alert" aria-live="assertive" aria-label="Sucesso: Protocolo realizado com sucesso.">
                                Protocolo realizado com sucesso.
                            </div>
                        </div>
                        <hr>
                        <div class="row" role="region" aria-label="Detalhes do protocolo">
                            <p aria-label="Número do protocolo">Número de protocolo</p>
                            <h2 aria-labelledby="numero-protocolo"><?php echo $dados['protocolo']; ?></h2>
                            <p aria-label="Nome do solicitante">Nome do solicitante</p>
                            <h2 aria-labelledby="nome-solicitante"><?php echo $dados['nome']; ?></h2>
                        </div>
                        <hr>
                        <div class="row">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" aria-label="Retornar para o site" href="#">Retornar para o Site</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" aria-label="Fazer outra solicitação" href="#">Fazer outra solicitação</a>
                                </li>
                            </ul>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="node_modules/jquery/dist/jquery.js"></script>
            <script src="node_modules/popper.js/dist/popper.js"></script>
            <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
            <script src="node_modules/bootstrap/js/src/app.js"></script>
        </body>

        </html>

<?php
    } else {
        // Protocolo não encontrado
        echo "Protocolo não encontrado";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>