<div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href=" https://adm.saearaguari.com.br " target="_blank">
        <span class="ms-1 font-weight-bold text-white">Administrativo SAE</span>
    </a>
</div>


<hr class="horizontal light mt-0 mb-2">

<div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
        <li class="nav-item">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <span class="nav-link-text ms-1">Olá,
                    <?php
                    echo $_SESSION['nome'];
                    ?>
                </span>
            </div>
        </li>
        <?php
        // Verifica o nivel de acesso
        if ($_SESSION['nivel'] == "esic" || $_SESSION['nivel'] == "adm") {
        ?>
            <li class="nav-item">
                <a class="nav-link text-white " href="./pages/esic.php">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>

                    <span class="nav-link-text ms-1">E-SIC</span>
                </a>
            </li>
            <!-- <li class="nav-item">
            <a class="nav-link text-white" href="./pages/esic.php">

                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">store</i>
                </div>

                <span class="nav-link-text ms-1">Alvaras</span>
            </a>
        </li> -->

        <?php
        }
        // Verifica o nivel de acesso
        if ($_SESSION['nivel'] == "ouvidoria" || $_SESSION['nivel'] == "adm") {
        ?>
            <li class="nav-item">
                <a class="nav-link text-white " href="./pages/ouvidoria.php">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">

                        <i class="material-icons opacity-10">groups</i>
                    </div>

                    <span class="nav-link-text ms-1">Ouvidoria</span>
                </a>
            </li>
        <?php }
        // Verifica o nivel de acesso
        if ($_SESSION['nivel'] == "adm") {
        ?>
            <li class="nav-item">
                <a class="nav-link text-white " href="./pages/sign-up.php">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>

                    <span class="nav-link-text ms-1">Novos Usuarios</span>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>