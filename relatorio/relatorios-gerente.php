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
                            try{
                                $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
            
                                $query = "SELECT  tipo, relatorio.id, substituicao.nome, eletricista.gerente FROM substituicao, relatorio, eletricista WHERE relatorio.substituicao = substituicao.id AND substituicao.eletricista = eletricista.id";
                
                                $stmt = $conexao->prepare($query);
                                $stmt->execute();
                                $relatorios = $stmt->fetchAll();
                                
                                if(empty($relatorios)){
                                    echo "<h6 class='text-center titulo mt-5'>Ainda não há relatórios!</h6>";
                                } else{
                                    foreach($relatorios as $relatorio){
                                        // var_dump($relatorio);
                                        if($_SESSION['idGerente'] === $relatorio['gerente']){
                                            echo "<div class='border border-success rounded mt-2 text-center'>
                                                    <a href='visualizar-gerente.php?relatorio={$relatorio['id']}' class='link texto fs-5 text-reset'>
                                                        <p class='texto mt-2'><b class='verde'>".ucWords($relatorio['nome'])."</b> <br> <i class='tam10'> Tipo do Medidor: <br>".ucWords($relatorio['tipo'])."</i></p>
                                                    </a>
                                            </div>";
                                        } else{
                                            echo "<h6 class='text-center titulo mt-5'>Ainda não há relatórios!</h6>";
                                            break;
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

        <div class="row">
            <div class="col-12 mt-1">
                <h5 class="text-center titulo verde">Pesquisar Relatório:</h5>
            </div>
        </div>

        <div class="row mt-3 text-center">
            <div class="col-3"></div>
            <div class="col-4">
                <form action="" method="post">
                    <input type="text" name="busca" id="busca" placeholder="Pesquise pelo nome" class="form-control text-center border-success">
            </div>
            <div class="col-2">
                    <input type="submit" name="acao" id="acao" class="btn btn-success" value="Fazer a consulta">
                </form> 
            </div>
        </div>
            
        <div class="col-12">
            <div class="row mt-4">
                <?php
                    try{
                        $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);

                        $busca = isset($_POST['busca']) ? $_POST['busca']: "";
                        $query = "SELECT relatorio.id, substituicao.nome, eletricista.gerente FROM substituicao, relatorio, eletricista WHERE substituicao.id = relatorio.substituicao AND substituicao.eletricista = eletricista.id";
                        
                        if ($busca != ""){
                            $busca = $busca.'%';
                            $query .= ' AND nome like :busca' ;
                        }

                        $stmt = $conexao->prepare($query);

                        if ($busca != ""){
                            $stmt->bindValue(':busca',$busca);
                        }

                        $stmt->execute();
                        $relatorios = $stmt->fetchAll();

                        if(empty($relatorios)){
                            echo "<h4 class='text-center titulo mt-5'>Ainda não há relatórios!</h4>
                                <div class='col-4'></div>
                                <div class='col-4 ms-4 mt-4 bg-image'>
                                    <img src='../img/icones/pasta.png' width='60%' class='img-relatorio ms-5'>
                                </div>";
                        } else{
                            foreach($relatorios as $relatorio){
                                // var_dump($relatorio);
                                if($_SESSION['idGerente'] === $relatorio['gerente']){
                                    echo "<div class='col-2 mt-4 text-center'>
                                        <a href='visualizar-gerente.php?relatorio={$relatorio['id']}' class='link texto fs-5 text-reset'><img src='../img/icones/pastaRelatorio.png'></a>
                                        <p class='texto preto fs-6'>".ucWords($relatorio['nome'])."</p>
                                    </div>";
                                } else{
                                    echo "<h4 class='text-center titulo mt-5'>Ainda não há relatórios!</h4>
                                        <div class='col-4'></div>
                                        <div class='col-4 ms-4 mt-4 bg-image'>
                                            <img src='../img/icones/pasta.png' width='60%' class='img-relatorio ms-5'>
                                        </div>";
                                    break;
                                }
                            }
                        }
                        

                    }catch(PDOExeptio $e){
                        print("Erro ao conectar com o banco de dados . . . <br>".$e->getMenssage());
                        die();
                    }
                ?>
            </div>
        </div>
    </div>  
</body>
</html>