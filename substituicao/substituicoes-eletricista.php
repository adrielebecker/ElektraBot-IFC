<!DOCTYPE html>
<?php
    session_start();
    $pagina = "Substituições";
    $hoje = date("Y/m/d");
    $busca = isset($_POST['busca']) ? $_POST['busca'] : "";
    $concluida = isset($_GET['concluida']) ? $_GET['concluida'] : "";
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
                    <h5 class="titulo verde">CONCLUÍDAS</h5>
                    <?php
                        try{
                            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);

                            $query = "SELECT substituicao.id, substituicao.nome, substituicao.eletricista, dataSub, situacao, eletricista.id, eletricista.nome FROM substituicao, eletricista WHERE eletricista.id = substituicao.eletricista";

                            $stmt = $conexao->prepare($query);
                            $stmt->execute();
                            $substituicoes = $stmt->fetchAll();
                            
                            foreach($substituicoes as $substituicao){
                                if(strtolower($substituicao['situacao']) == "concluída" && $substituicao['eletricista'] == $_SESSION['idEletricista']){
                                    echo "<div class='border border-success rounded mt-2 text-center'>
                                            <a href='visualizar-eletricista.php?idSubstituicao={$substituicao['0']}&idEletricista={$substituicao['eletricista']}&substituicao={$substituicao['nome']}' class='link texto fs-5 text-reset'>
                                                <p class='texto mt-2'><b class='verde'>".ucWords($substituicao['1'])."</b> <br> <i class='tam10'> Data da Substituição: <br>".date("d/m/Y", strtotime($substituicao['dataSub']))."</i></p>
                                            </a>
                                        </div>";
                                } else{
                                    echo "<p class='texto'>Nenhuma substituição concluída!</p>";
                                }
                            }

                        }catch(PDOExeptio $e){
                            print("Erro ao conectar com o banco de dados . . . <br>".$e->getMenssage());
                            die();
                        }
                    ?>
                    
                    <h5 class="titulo text-danger pt-4">PENDENTES</h5>
                    <?php
                    try{
                        $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);

                        $query = "SELECT substituicao.id, substituicao.nome, substituicao.eletricista, dataSub, situacao, eletricista.id, eletricista.nome FROM substituicao, eletricista WHERE eletricista.id = substituicao.eletricista";

                        $stmt = $conexao->prepare($query);
                        $stmt->execute();
                        $substituicoes = $stmt->fetchAll();
                    
                        foreach($substituicoes as $substituicao){
                            if(strtolower($substituicao['situacao']) == "pendente" && $substituicao['eletricista'] == $_SESSION['idEletricista']){
                                echo "<div class='border border-danger rounded mt-2 text-center'>
                                        <a href='visualizar-eletricista.php?idSubstituicao={$substituicao['0']}&idEletricista={$substituicao['eletricista']}&substituicao={$substituicao['nome']}' class='link texto fs-5 text-reset'>
                                            <p class='texto mt-2'><b class='text-danger'>".ucWords($substituicao['1'])."</b> <br> <i class='tam10'> Data da Substituição: <br>".date("d/m/Y", strtotime($substituicao['dataSub']))."</i></p>
                                        </a>
                                    </div>";
                            } else{
                                echo "<p class='texto'>Nenhuma substituição pendente!</p>";
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
        <div class="row">
            <div class="col-12 mt-1">
                <h5 class="text-center titulo verde">Pesquisar substituição:</h5>
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

                        $busca = isset($_POST['busca']) ? $_POST['busca']:"";
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
                        
                        echo "<table class='table text-center table-bordered border-dark mt-3 align-middle'>
                        <thead class='bg-success branco'><tr><th>Nome</th><th>Data</th><th>Situação</th><th>Detalhes</th></tr></thead>";
                        foreach($substituicoes as $substituicao){
                            if(strtolower($substituicao['situacao']) == "pendente"){
                                $situacao = "<b style='color: #F00'>Pendente</b>";
                            } elseif(strtolower($substituicao['situacao']) == "concluída"){
                                $situacao = "<b style='color: #0F0'>Concluída</b>";
                            }
                            // var_dump($substituicao);
                            if($_SESSION['idEletricista'] == $substituicao['eletricista']){
                                echo "<tbody><tr><td>".ucWords($substituicao["nome"])."</td><td>".date("d/m/Y", strtotime($substituicao['dataSub']))."</td><td>".ucWords($situacao)."</td><td><a href='visualizar-eletricista.php?idSubstituicao={$substituicao['0']}' class='btn btn-outline-success'>Detalhes</a></td></tr></tbody>";
                            }
                        }
                        echo "</table>";

                    }catch(PDOExeptio $e){
                        print("Erro ao conectar com o banco de dados . . . <br>".$e->getMenssage());
                        die();
                    }
                    ?>
            </div>
        </div>
    </div>
    <script language='javascript'>
        var concluida = <?=$concluida?>;
        if(concluida == true){
            alert('Substituição concluída!');
            window.location.href = 'substituicoes-eletricista.php';
        } else{
            alert('Substituição pendente');
        }
    </script>
</body>
</html>