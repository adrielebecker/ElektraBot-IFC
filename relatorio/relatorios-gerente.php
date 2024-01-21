<!DOCTYPE html>
<?php
    include '../sql/config.php';
    session_start();
    $pagina = "Relatórios";
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$pagina?></title>
    <?php include '../gerente/link.html';?>
</head>
<body>
    <?php include '../navbar/nav-gerente.php';?>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <button class="navbar-toggler border border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarToggleExternalContent">
                    <h6 class="texto verde mt-1">Acesso rápido</h6>
                </button>

                <div class="offcanvas p-5 offcanvas-start text-center" id="navbarToggleExternalContent">
                    <div class="offcanvas-header ms-5">
                        <h5 class="offcanvas-title titulo verde ms-4" id="offcanvasLabel"><?=$pagina?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>

                    <div class="offcanvas-body">
                        <?php
                            foreach($jsonGravacao as $value){
                                if($_SESSION['idEletricista'] == $value['idEletricista']){   
                                    echo "<div class='row'>
                                            <a href='video.php?video={$value['video']}' class='link texto fs-5 text-reset'> {$value['video']} </a>
                                        </div>";
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <?php
                try{
                    $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);

                    $query = "SELECT  texto, codAntigo, codNovo, tipo, acidente, relatorio.gerente, substituicao, substituicao.nome, substituicao.id, relatorio.id FROM substituicao, relatorio WHERE substituicao.id = relatorio.substituicao";
    
                    $stmt = $conexao->prepare($query);
                    $stmt->execute();
                    $relatorios = $stmt->fetchAll();
                    
                    foreach($relatorios as $relatorio){
                        if($_SESSION['idGerente'] === $relatorio['gerente']){
                            if($relatorio == NULL){
                                echo "<h4 class='text-center titulo mt-5'>Ainda não há gravações!</h4>
                                    <div class='col-4'></div>
                                    <div class='col-4 ms-4 mt-4 bg-image'>
                                        <img src='../img/icones/pasta.png' width='60%' class='img-relatorio ms-5'>
                                    </div>";
                                break;
                            } else{
                                echo "<div class='col-2 mt-4 text-center'>
                                    <a href='visualizar-gerente.php?relatorio={$relatorio['id']}' class='link texto fs-5 text-reset'><img src='../img/icones/pastaRelatorio.png'></a>
                                    <p class='texto preto fs-6'>".ucWords($relatorio['nome'])."</p>
                                </div>";
                            }
                        } 
                    }
                } catch(Exception $e){
                    print("Erro ...<br>".$e->getMessage());
                    die();
                
                }
            ?>
            </div>
        </div>
    </div>
</body>
</html>