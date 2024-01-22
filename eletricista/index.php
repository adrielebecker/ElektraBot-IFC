<!DOCTYPE html>
<?php
    session_start();
    // var_dump($_SESSION);
    $nome = explode(" ", $_SESSION['nomeEletricista']);
    // var_dump($nome);
    if($_SESSION['sexoEletricista'] == "Feminino"){
        $pagina = "Bem Vinda, ".ucWords($nome[0])."!";
    } else{
        $pagina = "Bem Vindo, ".ucWords($nome[0])."!";
    }
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <?php include "link.html";?>
</head>
<body>
    <?php include "../navbar/nav-eletricista.php";?>
    <div class="container">
        <div class="row mt-5">
            <div class="col-3"></div>
            <div class="col-6">
                <img src="../img/logo/logo-grande.png" alt="" width="100%">
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-3">
                <a href="camera.php" class="link">
                    <div class="card secundario border-success rounded-4">
                        <img src="../img/icones/camera.png" alt="camera" width="50%" class="rounded mx-auto d-block">
                        <div class="card-body">
                            <h5 class="titulo branco text-center">CÂMERA</h5>
                            <p class="texto branco text-center sobre-tam mt-3">
                                Esta funcionalidade permite que o eletricista visualize a câmera implantada no robô, em tempo real.
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-3">
                <a href="../gravacao/gravacao-eletricista.php" class="link">
                    <div class="card secundario border-success rounded-4">
                        <img src="../img/icones/gravacoes.png" alt="gravações" width="50%" class="rounded mx-auto d-block">
                        <div class="card-body">
                            <h5 class="titulo branco text-center">GRAVAÇÕES</h5>
                            <p class="texto branco text-center sobre-tam mt-3">
                                Aqui são armazenados todos os procedimentos. <br> As gravações podem ser visualizadas pelo eletricista.
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-3">
                <a href="../relatorio/relatorios-eletricista.php" class="link">
                    <div class="card secundario border-success rounded-4">
                        <img src="../img/icones/relatorio.png" alt="Relatórios" width="40%" class="rounded mx-auto d-block mt-3">
                        <div class="card-body">
                            <h5 class="titulo branco text-center mt-2">RELATÓRIOS</h5>
                            <p class="texto branco text-center sobre-tam mt-3">
                                O eletricista pode criar relatórios sobre os procedimentos e adicionar algumas informações chave.
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-3">
                <a href="../substituicao/substituicoes-eletricista.php" class="link">
                    <div class="card secundario border-success rounded-4">
                        <img src="../img/icones/medidor-eletrico.png" alt="substituições" width="40%" class="rounded mx-auto d-block mt-3">
                        <div class="card-body">
                            <h5 class="titulo branco text-center mt-2">SUBSTITUIÇÕES</h5>
                            <p class="texto branco text-center sobre-tam mt-3">
                                Esta funcionalidade permite que o eletricista visualize todas as substituições que lhe foram designadas.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <br><br><br><br>           
    </div>

    <?php include "footer.html";?>
</body>
</html>