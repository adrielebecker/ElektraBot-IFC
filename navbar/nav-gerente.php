<nav class="navbar border-bottom border-success sticky-top bg-white">
    <div class="container-fluid">
        <div class="col-2">
            <a href="../gerente/index.php" class="nav-link ms-2"><img src="../img/logo/logo-nav.png" alt="logo da elektrabot" width="80%"></a>
        </div>
        <div class="col-8 mt-4 text-center">
            <p class="texto verde fs-5"><?= $pagina ?></p>
        </div>
        <div class="col-1"></div>
        <div class="col-1">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header border-bottom border-success mt-2">
                    <h4 class="titulo ms-5 mt-1">O que você deseja?</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active mt-2 text-white" aria-current="page" href="../gerente/conta.php"><b>MINHA CONTA</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active mt-4 text-white" aria-current="page" href="../gravacao/gravacao-gerente.php"><b>GRAVAÇÕES</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active mt-4 text-white" aria-current="page" href="../gerente/relatorios.php"><b>RELATÓRIOS</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active mt-4 text-white" aria-current="page" href="../substituicao/cadastro-substituicao.php"><b>DESIGNAR SUBSTITUIÇÕES</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active mt-4 text-white" aria-current="page" href="../substituicao/substituicoes-gerente.php"><b>NOTIFICAÇÕES</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active mt-4 text-white" aria-current="page" href="../gerente/eletricistas.php"><b>ELETRICISTAS</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active mt-4 text-white" aria-current="page" href="../gerente/desenvolvedores.php"><b>SOBRE OS DESENVOLVEDORES</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active mt-4 text-white" aria-current="page" href="../gerente/index.php"><b>PÁGINA INICIAL</b></a>
                    </li>
                    <li class="nav-item">
                        <a href="../funcao/acao.php?acao=sair" class="btn text-white texto" name="acao" id="acao">Logoff</a>
                    </li>
                </ul>
                </div>
            </div>
        </div>
    </div>
  </nav>