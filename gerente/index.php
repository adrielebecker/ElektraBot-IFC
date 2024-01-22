<!DOCTYPE html>
<?php
    session_start();
    $nome = explode(" ", $_SESSION['nomeGerente']);
    // var_dump($nome);
    if($_SESSION['sexoGerente'] == "Feminino"){
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
    <?php include "../navbar/nav-gerente.php";?>
    <div class="container">
        <div class="row mt-5">
            <div class="col-3"></div>
            <div class="col-6">
                <img src="../img/logo/logo-grande.png" alt="" width="100%">
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-3">
                <a href="../substituicao/cadastro-substituicao.php" class="link">
                    <div class="card secundario border-success rounded-4">
                        <img src="../img/icones/designar.png" alt="designar" width="40%" class="rounded mx-auto d-block mt-3">
                        <div class="card-body">
                            <h5 class="titulo branco text-center">Designar Substituição</h5>
                            <p class="texto branco text-center sobre-tam mt-3 mb-2">
                                O gerente pode designar um ou mais eletricistas a uma substituição e adicionar mais 
                                informações sobre a mesma.
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-3">
                <a href="../gravacao/gravacao-gerente.php" class="link">
                    <div class="card secundario border-success rounded-4">
                        <img src="../img/icones/gravacoes.png" alt="gravações" width="50%" class="rounded mx-auto d-block">
                        <div class="card-body">
                            <h5 class="titulo branco text-center">GRAVAÇÕES</h5>
                            <p class="texto branco text-center sobre-tam mt-4 mb-3">
                                Esta funcionalidade armazena todos os procedimentos feitos em tempo real <br>
                                As gravações podem ser visualizadas pelo gerente.
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-3">
                <a href="../relatorio/relatorios-gerente.php" class="link">
                    <div class="card secundario border-success rounded-4">
                        <img src="../img/icones/relatorio.png" alt="Relatórios" width="40%" class="rounded mx-auto d-block mt-3">
                        <div class="card-body">
                            <h5 class="titulo branco text-center mt-2">RELATÓRIOS</h5>
                            <p class="texto branco text-center sobre-tam mt-4">
                                O gerente pode visualizar os relatórios criados pelos eletricistas. <br>
                                É permitido que o gerente adicione comentários sobre o procedimento.
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-3">
                <a href="../substituicao/substituicoes-gerente.php" class="link">
                    <div class="card secundario border-success rounded-4">
                        <img src="../img/icones/medidor-eletrico.png" alt="notificações" width="40%" class="rounded mx-auto d-block mt-3">
                        <div class="card-body">
                            <h5 class="titulo branco text-center mt-2">SUBSTITUIÇÕES</h5>
                            <p class="texto branco text-center sobre-tam mt-4">
                                Todas as substituições, concluídas ou pendentes, poderam ser visualizadas nesta página. Além disso, o gerente pode editar ou excluir substituições.
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