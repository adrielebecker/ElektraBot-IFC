<!DOCTYPE html>
<?php
    session_start();
    $pagina = "Substituições";
    $hoje = date("Y/m/d");
    $busca = isset($_POST['busca']) ? $_POST['busca'] : "";
    $sucesso = isset($_GET['sucesso']) ? $_GET['sucesso'] : "";
    $erro = isset($_GET['erro']) ? $_GET['erro'] : "";
    $alterado = isset($_GET['alterado']) ? $_GET['alterado'] : "";

    include '../sql/config.php';

    try{
        $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);  
    
        $busca = isset($_POST['busca'])?$_POST['busca']:"";
        $query = "SELECT substituicao.id, substituicao.nome, substituicao.eletricista dataSub, situacao, eletricista.id, eletricista.nome, eletricista.gerente FROM substituicao, eletricista WHERE eletricista.id = substituicao.eletricista";
        
        if ($busca != ""){
            $busca = '%'.$busca.'%';
            $query .= ' AND substituicao.nome LIKE :busca' ;
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
    <?php include '../gerente/link.html';?>
</head>
<body>
    <?php include '../navbar/nav-gerente.php';?>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <button class="navbar-toggler border border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarToggleExternalContent">
                    <h6 class="texto verde mt-4">Acesso rápido</h6>
                </button>

                <div class="offcanvas p-5 offcanvas-start text-center" id="navbarToggleExternalContent">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                    <?php
                    try{
                        $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);

                        $query = "SELECT substituicao.id, substituicao.nome, substituicao.eletricista dataSub, situacao, eletricista.id, eletricista.nome, eletricista.gerente FROM substituicao, eletricista WHERE eletricista.id = substituicao.eletricista";

                        $stmt = $conexao->prepare($query);
                        $stmt->execute();
                        $substituicoes = $stmt->fetchAll();
                        
                        if(!empty($substituicoes)){
                            echo "<h5 class='titulo verde'>CONCLUÍDAS</h5>";
                            foreach($substituicoes as $substituicao){
                                if(strtolower($substituicao['situacao']) == "concluída"){
                                    echo "<div class='border border-success rounded mt-2 text-center'>
                                            <a href='visualizar-gerente.php?idSubstituicao={$substituicao['0']}&idGerente={$substituicao['gerente']}&substituicao={$substituicao['nome']}' class='link texto fs-5 text-reset'>
                                                <p class='texto mt-2'><b class='verde'>".ucWords($substituicao['1'])."</b> <br> <i class='tam10'> Eletricista: <br>".ucWords($substituicao['nome'])."</i></p>
                                            </a>
                                        </div>";
                                } else{
                                    echo "<p class='texto'>Nenhuma substituição concluída!</p>";
                                }
                            }
                        } else{
                            echo "<h5 class='titulo verde text-center mt-5'>Ainda não há substituições!</h5>";
                        }
                    }catch(PDOExeptio $e){
                        print("Erro ao conectar com o banco de dados . . . <br>".$e->getMenssage());
                        die();
                    }
                    ?>
                    
                    <?php
                    try{
                        $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);

                        $query = "SELECT substituicao.id, substituicao.nome, substituicao.eletricista dataSub, situacao, eletricista.id, eletricista.nome, eletricista.gerente FROM substituicao, eletricista WHERE eletricista.id = substituicao.eletricista";

                        $stmt = $conexao->prepare($query);
                        $stmt->execute();
                        $substituicoes = $stmt->fetchAll();
                    
                        if(!empty($substituicoes)){
                            echo "<h5 class='titulo text-danger pt-4'>PENDENTES</h5>";
                            foreach($substituicoes as $substituicao){
                                // var_dump($substituicao);
                                if(strtolower($substituicao['situacao']) == "pendente"){
                                    echo "<div class='border border-danger rounded mt-2 text-center'>
                                            <a href='visualizar-gerente.php?idSubstituicao={$substituicao['0']}&idGerente={$substituicao['gerente']}&substituicao={$substituicao['nome']}' class='link texto fs-5 text-reset'>
                                                <p class='texto mt-2'><b class='text-danger'>".ucWords($substituicao['1'])."</b> <br> <i class='tam10'> Eletricista: <br>".ucWords($substituicao['nome'])."</i></p>
                                            </a>
                                        </div>";
                                } else{
                                    echo "<p class='texto'>Nenhuma substituição pendente!</p>";
                                }
                            }
                        }
                    } catch(PDOExeptio $e){
                        print("Erro ao conectar com o banco de dados . . . <br>".$e->getMenssage());
                        die();
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
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
                <?php
                    try{
                        $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);

                        $busca = isset($_POST['busca']) ? $_POST['busca'] : "";
                        $query = "SELECT substituicao.id, substituicao.nome, substituicao.eletricista, dataSub, situacao, eletricista.id, eletricista.nome, eletricista.gerente FROM substituicao, eletricista WHERE eletricista.id = substituicao.eletricista";
                       
                        if ($busca != ""){
                            $busca = $busca.'%';
                            $query .= ' AND substituicao.nome like :busca' ;
                        }

                        $stmt = $conexao->prepare($query);

                        if ($busca != ""){
                            $stmt->bindValue(':busca',$busca);
                        }

                        $stmt->execute();
                        $substituicoes = $stmt->fetchAll();
                        
                        if(!empty($substituicoes)){
                            echo "<table class='table text-center table-bordered border-dark mt-3 align-middle'>
                            <thead class='bg-success branco'><tr><th>Nome</th><th>Data</th><th>Situação</th><th>Detalhes</th><th>Editar</th><th>Excluir</th></tr></thead>";
                            foreach($substituicoes as $substituicao){
                                // var_dump($substituicao);
                                if(strtolower($substituicao['situacao']) == "pendente"){
                                    $situacao = "<b style='color: #F00'>Pendente</b>";
                                } elseif(strtolower($substituicao['situacao']) == "concluída"){
                                    $situacao = "<b style='color: #0F0'>Concluída</b>";
                                }
                                // var_dump($substituicao);
                                echo "<tbody><tr><td>".ucWords($substituicao["1"])."</td><td>".date("d/m/Y", strtotime($substituicao['dataSub']))."</td><td>".ucWords($situacao)."</td><td><a href='visualizar-gerente.php?idSubstituicao={$substituicao['0']}&idGerente={$substituicao['gerente']}&substituicao={$substituicao['1']}' class='btn btn-outline-success'>Detalhes</a></td><td><a href='cadastro-substituicao.php?id={$substituicao['0']}&acao=editar' class='btn btn-outline-warning'>Editar</a></td><td><button onclick='excluirSubstituicao({$substituicao['0']}, {$substituicao['gerente']});' class='btn btn-outline-danger'>Excluir</button></td></tr></tbody>";
                            }
                            echo "</table>";
                        } else{
                            echo "<h5 class='titulo verde text-center mt-5'>Ainda não há substituições!</h5>";
                        }

                    }catch(PDOExeptio $e){
                        print("Erro ao conectar com o banco de dados . . . <br>".$e->getMenssage());
                        die();
                    }
                ?>
            </div>
        </div>
    </div>
    <script>
        var sucesso = <?=$sucesso?>; 
        if(sucesso == true){
            alert("Substituição designada com sucesso!");
            window.location.href = "substituicoes-gerente.php";
        }
        
    </script>
    <script>
        var erro = <?=$erro?>;
        if(erro == true){
            alert("O eletricista já está trabalhando na substituição, não é mais possível excluí-la!");
        }
    </script>
     <script>
        var alterado = <?=$alterado?>;
        if(alterado == true){
            alert("Edições salvas com sucesso!");
        }
    </script>
</body>
</html>