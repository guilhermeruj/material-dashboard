<?php
include "../back-php/conect.php";

// Inicia a sessão
session_start();

// Verifica se existe os dados da sessão de login
if (!isset($_SESSION["nome"]) || !isset($_SESSION["matricula"])) {
  // Usuário não logado! Redireciona para a página de login
  header("location: ./pages/sign-in.php");
  die();
}
?>

<!--
=========================================================
* Material Dashboard 2 - v3.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Adm SAE
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-200">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <?php include "../back-php/menu.php"; ?>
  </aside>
  <div class="main-content position-relative max-height-vh-100 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">E-Sic</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Ouvidoria</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">

            <li class="nav-item d-flex align-items-center">
              <a href="../back-php/sair.php" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Sair</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/coffe-shop-com-paredes-de-madeira-sem-foco.jpg');">
        <span class="mask  bg-gradient-primary  opacity-6"></span>
      </div>
      <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4 mb-2">
          <div class="col-auto">
          </div>

          <?php
          // Executa a consulta SQL
          // Recebe o ID do protocolo via GET
          $protocolo = $_GET['protocolo'];

          // Executa a consulta SQL com o ID do protocolo recebido via GET
          $sql = "SELECT * FROM solicitacoes WHERE numero_protocolo	= $protocolo";
          $result = $conn->query($sql);

          // Verifica se a consulta retornou algum resultado
          if ($result->num_rows > 0) {
            // Armazena os dados em variáveis
            $row = $result->fetch_assoc();
            $id = $row["id"];
            $identificacao = $row["identificacao"];
            $tipo_solicitacao = $row["tipo_solicitacao"];
            $nome = $row["nome"];
            $rg = $row["rg"];
            $cpf = $row["cpf"];
            $tratamento = $row["tratamento"];
            $sexo = $row["sexo"];
            $telefone_fixo = $row["telefone_fixo"];
            $celular = $row["celular"];
            $email = $row["email"];
            $logradouro = $row["logradouro"];
            $numero = $row["numero"];
            $bairro = $row["bairro"];
            $estado = $row["estado"];
            $cidade = $row["cidade"];
            $cep = $row["cep"];
            $descricao = $row["descricao"];
            $complemento = $row["complemento"];
            $anexo = $row["anexo"];
            $data_registro = $row["data_registro"];
            $protocolo = $row["numero_protocolo"];
            $status = $row["situacao"];
          ?>

            <div class="col-auto my-auto">
              <div class="h-100">
                <h5 class="mb-1">
                  <?php echo $nome; ?>
                </h5>
                <p class="mb-0 font-weight-normal text-sm">
                  Protocolo <b><?php echo $protocolo; ?></b>
                </p>
              </div>
            </div>
        </div>
        <div class="row">
          <div class="row">
            <div class="col">
              <div class="card card-plain h-100">
                <div class="card-header pb-0 p-3">
                  <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                      <h6 class="mb-0">Mensagem</h6>
                    </div>
                  </div>
                </div>
                <div class="card-body p-3">
                  <p class="text-sm">
                    <b>Assunto: <?php echo $tipo_solicitacao; ?></b>
                  </p>
                  <p class="text-sm">
                    <?php echo $descricao; ?>
                  </p>
                  <hr class="horizontal gray-light my-4">
                  <ul class="list-group">
                    <!-- <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nome:</strong> &nbsp; <?php echo $nome; ?></li> -->
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">RG:</strong> &nbsp; <?php echo $rg; ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">CPF:</strong> &nbsp; <?php echo $cpf; ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Telefone Fixo:</strong> &nbsp; <?php echo $telefone_fixo; ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Celular:</strong> &nbsp; <?php echo $celular; ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">E-mail:</strong> &nbsp; <?php echo $email; ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Endereço:</strong> &nbsp; <?php echo $logradouro . ", " . $numero . " - " . $complemento . " - " . $bairro . " - " . $estado . " - " . $cidade . " - " . $cep; ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Anexo:
                        <?php
                        echo '<a class="nav-link" href="../back-php/dowloandax.php?anexo=' . $anexo . '"></strong> &nbsp;' . $anexo . '</li>';
                        ?>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Data de Registro:</strong> &nbsp; <?php echo $data_registro; ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Status:</strong> &nbsp; <?php echo $status; ?></li>
                    <form method="POST" action="../back-php/alterastatusouvi.php">
                      <div class="col-xl-4 col-lg-5 col-md-7">
                        <div class="input-group input-group-outline mb-3">
                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Alterar status</li>
                          <input type="hidden" name="protocolo" id="protocolo" value="<?php echo $protocolo; ?>">
                          <select id="status" name="status" class="form-control">
                            <option value="Em Andamento">Em Andamento</option>
                            <option value="Sem solução">Sem solução</option>
                            <option value="Concluido">Concluido</option>
                          </select>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Atualizar">
                      </div>
                    </form>

                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer py-4  ">
    <div class="container-fluid">
      <div class="row align-items-center justify-content-lg-between">
        <div class="col-lg-6 mb-lg-0 mb-4">
          <div class="copyright text-center text-sm text-muted text-lg-start">
            © <script>
              document.write(new Date().getFullYear())
            </script>,
            Desenvolvido por
            <a href="https://www.gkdata.com" class="font-weight-bold" target="_blank">GK Data</a>
            Desenvolvimento Web
          </div>
        </div>
      <?php   } else {
            echo "Não foram encontrados resultados";
          }
      ?>

      <!-- <div class="col-lg-6">
        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
          <li class="nav-item">
            <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
          </li>
          <li class="nav-item">
            <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
          </li>
          <li class="nav-item">
            <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
          </li>
          <li class="nav-item">
            <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
          </li>
        </ul>
      </div> -->
      </div>
    </div>
  </footer>
  </div>
  <!-- <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="material-icons py-2">settings</i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Material UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-icons">clear</i>
          </button>
        </div> -->
  <!-- End Toggle Button -->
  <!-- </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0"> -->
  <!-- Sidebar Backgrounds -->
  <!-- <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a> -->
  <!-- Sidenav Type -->
  <!-- <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p> -->
  <!-- Navbar Fixed -->
  <!-- <div class="mt-3 d-flex">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-3">
        <div class="mt-2 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <a class="btn bg-gradient-info w-100" href="https://www.creative-tim.com/product/material-dashboard-pro">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/material-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Material%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/material-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div> -->
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.0.4"></script>
</body>

</html>