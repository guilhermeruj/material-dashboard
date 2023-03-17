<!DOCTYPE html>
<html>

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

    <title>Ouvidoria</title>
</head>

<body>
    <section class="my-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <img src="./node_modules/img/ouvidoria.png" alt="Imagem do logotipo" class="img-fluid max-width-100">
                </div>
            </div>
        </div>
    </section>
    <div class="container mt-5 form-style">
        <h1 class="text-center mb-4">Dados Encaminhados com Sucesso</h1>
        <p class="text-center">Seu formulário foi encaminhado com sucesso e seu número de protocolo é:</p>
        <h2 class="text-center mb-5"><?php echo $_GET['protocolo']; ?></h2>
        <div class="d-flex justify-content-center">
            <a href="https://www.saearaguari.org" class="btn">Voltar</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>