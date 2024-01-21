<!DOCTYPE html>
<?php
    include '../sql/config.php';
    $pagina = 'Vídeo';
    $video = isset($_GET['video']) ? $_GET['video'] : "";
    $nome = isset($_GET['nome']) ? $_GET['nome'] : "";
    $idEletricista = isset($_GET['eletricista']) ? $_GET['eletricista'] : 0;
    session_start();
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$pagina?></title>
    <?php include '../eletricista/link.html';?>
</head>
<body>
    <?php include '../navbar/nav-gerente.php';?>
    
    <div class="container">
        <div class="row">
            <div class="col-3 ms-2">
                <button class="navbar-toggler border border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarToggleExternalContent">
                    <h6 class="texto verde mt-3">Acesso rápido</h6>
                </button>

                <div class="offcanvas p-5 offcanvas-start text-center" id="navbarToggleExternalContent">
                    <div class="offcanvas-header ms-5">
                        <h5 class="offcanvas-title titulo verde ms-4" id="offcanvasLabel">Gravações</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <?php
                            foreach($json as $value){
                                if($_SESSION['idEletri'] == $value['idEletri']){
                                    echo "<div class='row'>
                                            <a href='video.php?video={$value['video']}' class='link texto fs-5 text-reset'> {$value['video']} </a>
                                        </div>";
                                }
                            }
                        ?>
                        <div class="row mt-5">
                            <div class="col-8">
                                <a href="gravacoes.php" class="link texto verde"> Voltar para gravações</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 ms-4"></div>
            <div class="col-2 mt-2 pt-1 ms-5">
                <a href="gravacao-eletricista.php" class="link verde mt-5">Voltar</a>
            </div>
        </div>

        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="row">
                    <h4 class="text-center titulo verde"><?=$nome?></h4>
                </div>
                <div class="row text-center">
                    <?php
                        try{
                            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
        
                            $query = "SELECT nome, id, gerente FROM eletricista";
            
                            $stmt = $conexao->prepare($query);
                            $stmt->execute();
                            $eletricistas = $stmt->fetchAll();
                            
                            foreach($eletricistas as $eletricista){
                                if($_SESSION['idGerente'] === $eletricista['gerente']){
                                    if($idEletricista == $eletricista['id']){
                                        echo "<p>Eletricista: <em>".ucWords($eletricista['nome'])."</em></p>";
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

        <div class="row">
            <div class="col-2"></div>
            <div class="col-8 ms-5">
                <?php
                    echo "<video width='600' controls autoplay muted>
                            <source src='../{$video}' type='video/mp4'>
                        </video>";
                ?>
            </div>
        </div>
    </div>

</body>
</html>