<!DOCTYPE html>
<?php
    $pagina = "Visualizar Substituição";
    session_start();
    $idSubstituicao = isset($_GET['idSubstituicao']) ? $_GET['idSubstituicao'] : 0;
    include '../sql/config.php';
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$pagina?></title>
    <?php include '../eletricista/link.html';?>
</head>
<body>
    <?php include '../navbar/nav-eletricista.php'; ?>
    <div class="container">
        <div class="row mt-4">
            <h3 class="titulo verde text-center"></h3>
        </div>

        <div class="row">
            <div class="col-6 mt-3">
                <form action="acao.php" method="post">
                <div class="row mt-5">
                    <div class="col-5">
                        <div class="row bg-success rounded">
                            <p class="texto branco text-center mt-3">Nome da Substituição:</p>
                                <?php
                                    try{
                                        $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
                        
                                        $query = "SELECT * FROM substituicao";
                        
                                        $stmt = $conexao->prepare($query);
                                        $stmt->execute();
                                        $substituicoes = $stmt->fetchAll();
                                        
                                        foreach($substituicoes as $substituicao){
                                            if($idSubstituicao == $substituicao['id']){
                                                echo "<input type='text' name='nome' id='nome' value='".ucWords($substituicao['nome'])."' class='form-control text-center border-success'>";
                                            }
                                        }
                                    }catch(Exception $e){
                                        print("Erro ...<br>".$e->getMessage());
                                        die();
                                    }
                                ?>
                        </div>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-5">
                        <div class="row bg-success rounded">
                            <p class="texto branco text-center mt-3">Gerente:</p>
                                <?php
                                    try{
                                        $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
                        
                                        $query = "SELECT gerente.nome, gerente.id, substituicao.id FROM gerente, substituicao WHERE gerente.id = substituicao.gerente";
                        
                                        $stmt = $conexao->prepare($query);
                                        $stmt->execute();
                                        $substituicoes = $stmt->fetchAll();

                                        foreach($substituicoes as $substituicao){
                                            if($idSubstituicao == $substituicao['id']){
                                                echo "<input type='text' name='gerente' id='gerente' value='".ucWords($substituicao['nome'])."' class='form-control text-center border-success'>";
                                            }
                                        }
                                    }catch(Exception $e){
                                        print("Erro ...<br>".$e->getMessage());
                                        die();
                                    }
                                ?>
                        </div>
                    </div>
                </div>
                    <div class="row mt-4">
                        <div class="col-5 mt-4">
                            <div class="row bg-success rounded">
                                <p class="texto text-center branco mt-3">Eletricista no projeto:</p>
                                    <?php
                                        try{
                                            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
                            
                                            $query = "SELECT eletricista.nome, eletricista.id, substituicao.id FROM eletricista, substituicao WHERE eletricista.id = substituicao.eletricista";
                            
                                            $stmt = $conexao->prepare($query);
                                            $stmt->execute();
                                            $substituicoes = $stmt->fetchAll();

                                            foreach($substituicoes as $substituicao){
                                                if($idSubstituicao == $substituicao['id']){
                                                    echo "<input type='text' name='eletricista' id='eletricista' value='".ucWords($substituicao['nome'])."' class='form-control text-center border-success'>";
                                                }
                                            }
                                        }catch(Exception $e){
                                            print("Erro ...<br>".$e->getMessage());
                                            die();
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-5 mt-4">
                            <div class="row bg-success rounded">
                                <p class="texto branco text-center mt-3">Data da Substituição:</p>
                                <?php
                                    try{
                                        $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
                        
                                        $query = "SELECT * FROM substituicao";
                        
                                        $stmt = $conexao->prepare($query);
                                        $stmt->execute();
                                        $substituicoes = $stmt->fetchAll();
                                        
                                        foreach($substituicoes as $substituicao){
                                            if($idSubstituicao == $substituicao['id']){
                                                echo "<input type='text' name='dataSub' id='dataSub' value='".date("d/m/Y", strtotime($substituicao['dataSub']))."' class='form-control text-center border-success'>";
                                            }
                                        }
                                    }catch(Exception $e){
                                        print("Erro ...<br>".$e->getMessage());
                                        die();
                                    }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-5">
                            <div class="row bg-success rounded">
                                <p class="texto branco text-center mt-3">Situação do Projeto:</p>
                                <?php
                                    try{
                                        $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
                        
                                        $query = "SELECT * FROM substituicao";
                        
                                        $stmt = $conexao->prepare($query);
                                        $stmt->execute();
                                        $substituicoes = $stmt->fetchAll();
                                        
                                        foreach($substituicoes as $substituicao){
                                            if($idSubstituicao == $substituicao['id']){
                                                echo "<input type='text' name='situacao' id='situacao' value='".ucWords($substituicao['situacao'])."' class='form-control text-center border-success'>";
                                            }
                                        }
                                    }catch(Exception $e){
                                        print("Erro ...<br>".$e->getMessage());
                                        die();
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-1 ms-5"></div>
                        <div class="col-4 text-center ms-4 mt-3">
                            <?php
                                try{
                                    $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
                    
                                    $query = "SELECT * FROM substituicao";
                    
                                    $stmt = $conexao->prepare($query);
                                    $stmt->execute();
                                    $substituicoes = $stmt->fetchAll();
                                    
                                    foreach($substituicoes as $substituicao){
                                        if($idSubstituicao == $substituicao['id']){
                                            if($substituicao['situacao'] == "pendente"){
                                                echo "<a href=acao.php?acao=concluir&id=".$substituicao["id"]."&situacao=concluída>Concluir</a>";
                                            } else{
                                                echo "<p class='texto'>Parabéns: <b>".ucWords($substituicao['nome'])."</b> está <b class='verde'>Concluída</b>!</p>";
                                            }
                                        }
                                    }
                                }catch(Exception $e){
                                    print("Erro ...<br>".$e->getMessage());
                                    die();
                                }
                            ?>
                        </div>
                    </div>
            </div>
            <div class="col-6 mt-4">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10">
                        <h6 class="texto verde text-center ms-5">LOCALIZAÇÃO</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-10 mt-3">
                        <?php
                            try{
                                $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
                
                                $query = "SELECT * FROM substituicao";
                
                                $stmt = $conexao->prepare($query);
                                $stmt->execute();
                                $substituicoes = $stmt->fetchAll();
                                
                                foreach($substituicoes as $substituicao){
                                    if($idSubstituicao == $substituicao['id']){
                                        echo "<iframe class='border border-success rounded-3' src='".$substituicao['localizacao']."' width='400' height='300' loading='lazy' referrerpolicy='no-referrer-when-downgrade'></iframe>";
                                    }
                                }
                            }catch(Exception $e){
                                print("Erro ...<br>".$e->getMessage());
                                die();
                            }
                        ?>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>