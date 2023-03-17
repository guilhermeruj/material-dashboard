<?php
include "./back-php/conect.php";

// Inicia a sessão
session_start();

// Verifica se existe os dados da sessão de login
if (!isset($_SESSION["nome"]) || !isset($_SESSION["matricula"])) {
  // Usuário não logado! Redireciona para a página de login
  header("location: ./pages/sign-in.php");
  die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">

  <title>
    Adm SAE
  </title>

  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />


  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

  <!-- CSS Files -->



  <link id="pagestyle" href="./assets/css/material-dashboard.css" rel="stylesheet" />

</head>

<body class="g-sidenav-show  bg-gray-100">

  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">

    <?php include "./back-php/menu-pages.php"; ?>

  </aside>

  <main class="main-content border-radius-lg ">
    <!-- Navbar -->

    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">

          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm">Pages</li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">index</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Dashboard</h6>

        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">

          <ul class="navbar-nav  justify-content-end">

            <li class="nav-item d-flex align-items-center">
              <a href="./back-php/sair.php" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>

                <span class="d-sm-inline d-none">Sair</span>

              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-lg-7 position-relative z-index-2">
          <div class="card card-plain mb-4">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-lg-6">
                  <div class="d-flex flex-column h-100">
                    <h2 class="font-weight-bolder mb-0">Estatisticas Gerais</h2>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-5 col-sm-5">
              <?php
              // Verifica o nivel de acesso
              if ($_SESSION['nivel'] == "esic" || $_SESSION['nivel'] == "adm") {
              ?>
                <div class="card  mb-2">
                  <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                      <i class="material-icons opacity-10">leaderboard</i>
                    </div>
                    <?php
                    // Executa uma consulta SQL para contar o número de linhas na tabela "usuarios"
                    $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM protocolos");
                    $dados = mysqli_fetch_assoc($result);

                    // Obtém o número total de linhas
                    $total_linhas = $dados['total'];

                    ?>
                    <div class="text-end pt-1">
                      <p class="text-sm mb-0 text-capitalize">Protocolos abertos | <b>E-SIC</b></p>
                      <h4 class="mb-0"><?php echo $total_linhas; ?></h4>
                    </div>
                  </div>

                  <hr class="dark horizontal my-0">
                  <div class="card-footer p-3">
                    <?php
                    // Faz a consulta SQL para obter o total de protocolos concluídos e o total de protocolos pendentes
                    $query = "SELECT COUNT(*) AS total, status FROM protocolos GROUP BY status";
                    $result = mysqli_query($conn, $query);

                    // Obtém o número total de protocolos e o número de protocolos concluídos
                    $total_protocolos = 0;
                    $total_concluidos = 0;

                    while ($row = mysqli_fetch_assoc($result)) {
                      $total_protocolos += $row['total'];
                      if ($row['status'] == 'Concluido') {
                        $total_concluidos = $row['total'];
                      }
                    }

                    // Calcula a porcentagem de protocolos concluídos
                    if ($total_protocolos > 0) {
                      $porcentagem_concluidos = round(($total_concluidos / $total_protocolos) * 100, 2);
                    } else {
                      $porcentagem_concluidos = 0;
                    }

                    ?>

                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder"><?php echo $porcentagem_concluidos . "%"; ?></span>Totais de protocolos concluidos</p>
                  </div>
                </div>
              <?php
              }
              // Verifica o nivel de acesso
              if ($_SESSION['nivel'] == "ouvidoria" || $_SESSION['nivel'] == "adm") {
              ?>
                <div class="card  mb-2">
                  <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                      <i class="material-icons opacity-10">groups</i>
                    </div>
                    <div class="text-end pt-1">
                      <p class="text-sm mb-0 text-capitalize ">Protocolos abertos | <b>Ouvidoria</b></p>

                      <?php
                      // Executa uma consulta SQL para contar o número de linhas na tabela "usuarios"
                      $query = "SELECT COUNT(*) AS total, situacao FROM solicitacoes GROUP BY situacao";
                      $result = mysqli_query($conn, $query);

                      // Obtém o número total de protocolos e o número de protocolos concluídos
                      $total_ouvidoria = 0;
                      $total_concluidos_ov = 0;

                      while ($row = mysqli_fetch_assoc($result)) {
                        $total_ouvidoria += $row['total'];
                        if ($row['situacao'] == 'concluido') {
                          $total_concluidos_ov = $row['total'];
                        }
                      }

                      // Calcula a porcentagem de protocolos concluídos
                      if ($total_ouvidoria > 0) {
                        $porcentagem_concluidos_ov = round(($total_concluidos / $total_ouvidoria) * 100, 2);
                      } else {
                        $porcentagem_concluidos_ov = 0;
                      }
                      ?>
                      <?php
                      // Executa uma consulta SQL para contar o número de linhas na tabela "usuarios"
                      $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM solicitacoes");
                      $dados = mysqli_fetch_assoc($result);

                      // Obtém o número total de linhas
                      $total_linhas_ov = $dados['total'];

                      ?>
                      <h4 class="mb-0 "><?php echo $total_linhas_ov; ?></h4>
                    </div>
                  </div>
                <?php } ?>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <p class="mb-0"><span class="text-success text-sm font-weight-bolder"><?php echo $porcentagem_concluidos . "%"; ?></span>Totais de protocolos concluidos</p>
                </div>
                </div>

            </div>
            <!-- <div class="col-lg-5 col-sm-5 mt-sm-0 mt-4">
              <div class="card  mb-2">
                <div class="card-header p-3 pt-2 bg-transparent">
                  <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">store</i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize ">Protocolos abertos | <b>Alvaras</b></p>
                    <h4 class="mb-0 ">34k</h4>
                  </div>
                </div>

                <hr class="horizontal my-0 dark">
                <div class="card-footer p-3">
                  <p class="mb-0 "><span class="text-success text-sm font-weight-bolder">+1% </span>Respondidos</p>
                </div>
              </div>
            </div> -->
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div id="globe" class="position-absolute end-0 top-10 mt-sm-3 mt-7 me-lg-7">
            <canvas width="700" height="600" class="w-lg-100 h-lg-100 w-75 h-75 me-lg-0 me-n10 mt-lg-5"></canvas>
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
                <a href="https://www.gkdata.com.br" class="font-weight-bold" target="_blank">GK Data</a>
                for a better web.
              </div>
            </div>
          </div>
        </div>
      </footer>

    </div>


  </main>

  <!--   Core JS Files   -->
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>

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
  <script src="./assets/js/material-dashboard.min.js?v=3.0.4"></script>
</body>

</html>