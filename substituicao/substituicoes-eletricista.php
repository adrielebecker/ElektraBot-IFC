<!DOCTYPE html>
<?php
    session_start();
    $pagina = "Notificações";
    $hoje = date("Y/m/d");
    $busca = isset($_POST['busca']) ? $_POST['busca'] : "";
    include '../sql/config.php';

    try{
        $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);  
    
        $busca = isset($_POST['busca'])?$_POST['busca']:"";
        $query = "SELECT * FROM substituicao";
        
        if ($busca != ""){
            $busca = '%'.$busca.'%';
            $query .= ' WHERE nome like :busca' ;
        }
    
        $stmt = $conexao->prepare($query);
    
        if ($busca != ""){
            $stmt->bindValue(':busca',$busca);
        }
    
        $stmt->execute();
        $substituicao = $stmt->fetchAll();
        
    
    }catch(PDOExeptio $e){
        print("Erro ao conectar com o banco de dados . . . <br>".$e->getMenssage());
        die();
    }

?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$pagina?></title>
    <?php include '../eletricista/link.html';?>
</head>
<body>
    <?php include '../navbar/nav-eletricista.php';?>
    <div class="container">
        <div class="row">
            <div class="col-3 mt-3">
                <button class="navbar-toggler border border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarToggleExternalContent">
                    <h6 class="texto verde mt-1">Acesso rápido</h6>
                </button>

                <div class="offcanvas p-5 offcanvas-start text-center" id="navbarToggleExternalContent">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                    <h5 class="texto text-dark pt-4">DESIGNADAS</h5>
                    <?php
                        foreach($jsonSubstituicao as $value){
                            if($_SESSION['nomeGerente'] == $value['gerente']){   
                                if($value['concluida'] == NULL && $hoje < $value['dataSubstituicao']){
                                    echo "<div class='row mt-2'>
                                            <a href='visualizar-notificacao.php?nomeSubstituicao={$value['nome']}&id={$value['id']}' class='text-reset link'>".ucwords($value['nome'])."</a>
                                        </div>";
                                }
                            }
                        }
                    ?>

                    <h5 class="texto text-danger pt-4">PENDENTES</h5>
                    <?php
                        foreach($jsonSubstituicao as $value){
                            if($_SESSION['nomeGerente'] == $value['gerente']){   
                                if($hoje > $value['dataSubstituicao']){
                                    if($value['concluida'] == NULL){
                                        echo "<div class='row mt-2'>
                                                <a href='visualizar-notificacao.php?nomeSubstituicao={$value['nome']}&id={$value['id']}' class='text-reset link'>".ucwords($value['nome'])."</a>
                                            </div>";
                                    }
                                }
                            }
                        }
                    ?>

                    <h5 class="texto verde pt-4">CONCLUÍDAS</h5>
                    <?php
                        foreach($jsonSubstituicao as $value){
                            if($_SESSION['nomeGerente'] == $value['gerente']){   
                                if($value['concluida'] != NULL){
                                    echo "<div class='row mt-2'>
                                            <a href='visualizar-notificacao.php?nomeSubstituicao={$value['nome']}&id={$value['id']}' class='text-reset link'>".ucwords($value['nome'])."</a>
                                        </div>";
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-1">
                <h5 class="text-center titulo verde">Mostrar:</h5>
            </div>
        </div>

        <div class="row mt-3 text-center">
            <div class="col-3"></div>
            <div class="col-4">
                <form action="" method="post">
                    <input type="text" name="busca" id="busca" placeholder="Pesquise aqui" class="form-control text-center border-success">
            </div>
            <div class="col-2">
                    <input type="submit" name="acao" id="acao" class="btn btn-success" value="Fazer a consulta">
                </form> 
            </div>
        </div>
            
        <div class="col-12">
            <div class="row mt-4">
                <table class="table text-center table-bordered border-dark mt-3">
                <?php
                    try{
                        $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);

                        $busca = isset($_POST['busca'])?$_POST['busca']:"";
                        $query = "SELECT * FROM substituicao";
                        
                        if ($busca != ""){
                            $busca = $busca.'%';
                            $query .= ' WHERE nome like :busca' ;
                        }

                        $stmt = $conexao->prepare($query);

                        if ($busca != ""){
                        $stmt->bindValue(':busca',$busca);
                        }

                        $stmt->execute();
                        $substituicoes = $stmt->fetchAll();
                        
                        echo "<thead class='bg-success branco'><tr><th>Nome</th><th>Data</th><th>Situação</th><th>Detalhes</th></tr></thead>";
                        foreach($substituicoes as $substituicao){
                            if($substituicao['situacao'] == "pendente"){
                                $situacao = "<b style='color: #F00'>Pendente</b>";
                            } elseif($substituicao['situacao'] == "concluída"){
                                $situacao = "<b style='color: #0F0'>Concluída</b>";
                            }
                            // var_dump($substituicao);
                            if($_SESSION['idEletricista'] == $substituicao['eletricista']){
                                echo "<tbody><tr><td>".ucWords($substituicao["nome"])."</td><td>".date("d/m/Y", strtotime($substituicao['dataSub']))."</td><td>".ucWords($situacao)."</td><td><a href=visualizar-eletricista.php?idSubstituicao={$substituicao['0']}>Detalhes</a></td></tr></tbody>";
                            }
                        }

                    }catch(PDOExeptio $e){
                        print("Erro ao conectar com o banco de dados . . . <br>".$e->getMenssage());
                        die();
                    }
                    ?>
                    </table>
            </div>
        </div>
    </div>
</body>
</html>