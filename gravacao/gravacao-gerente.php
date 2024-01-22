<!DOCTYPE html>
<?php
    include '../sql/config.php';
    session_start();
    $pagina = "Gravações";

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
                            try{
                                $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
            
                                $query = "SELECT video, gravacao.gerente, gravacao.eletricista, substituicao.nome, substituicao.id, eletricista.nome, eletricista.id FROM substituicao, gravacao, eletricista WHERE substituicao.id = gravacao.substituicao AND gravacao.eletricista = eletricista.id";
                
                                $stmt = $conexao->prepare($query);
                                $stmt->execute();
                                $gravacoes = $stmt->fetchAll();
                                
                                foreach($gravacoes as $gravacao){
                                    if($_SESSION['idGerente'] === $gravacao['gerente']){
                                        if($gravacao == NULL){
                                            echo "<h4 class='text-center titulo mt-5'>Ainda não há gravações!</h4>";
                                            break;
                                        } else{
                                            echo "<div class='border border-success rounded mt-2 text-center'>
                                                    <a href='video-gerente.php?video={$gravacao['video']}&nome={$gravacao['3']}&eletricista={$gravacao['eletricista']}' class='link texto fs-5 text-reset'>
                                                        <p class='texto mt-2'><b class='verde'>".ucWords($gravacao['3'])."</b> <br> <i class='tam10'> Eletricista: <br>".ucWords($gravacao['nome'])."</i></p>
                                                    </a>
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
        </div>

        <div class="row mt-3">
            <?php
                try{
                    $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);

                    $query = "SELECT video, gravacao.gerente, gravacao.eletricista, substituicao.nome, substituicao.id, eletricista.nome, eletricista.id FROM substituicao, gravacao, eletricista WHERE substituicao.id = gravacao.substituicao AND gravacao.eletricista = eletricista.id";
    
                    $stmt = $conexao->prepare($query);
                    $stmt->execute();
                    $gravacoes = $stmt->fetchAll();
                    
                    foreach($gravacoes as $gravacao){
                        if($_SESSION['idGerente'] === $gravacao['gerente']){
                            if($gravacao == NULL){
                                echo "<h4 class='text-center titulo mt-5'>Ainda não há gravações!</h4>
                                    <div class='col-4'></div>
                                    <div class='col-4 ms-4 mt-4 bg-image'>
                                        <img src='../img/icones/video.png' width='60%' class='img-gravacao ms-5'>
                                    </div>";
                                break;
                            } else{
                                echo "<div class='col-2 mt-4 text-center'>
                                    <a href='video-gerente.php?video={$gravacao['video']}&nome={$gravacao['3']}&eletricista={$gravacao['eletricista']}' class='link texto fs-5 text-reset'><img src='../img/icones/video.png'></a>
                                    <p class='texto'><b>".ucWords($gravacao['3'])."</b> <br> <i class='tam10'> Eletricista: <br>".ucWords($gravacao['nome'])."</i></p>
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