<!DOCTYPE html>
<?php
    $pagina = "Visualizar Substituição";
    session_start();
    $idSubstituicao = isset($_GET['idSubstituicao']) ? $_GET['idSubstituicao'] : 0;
    $pendente = isset($_GET['pendente']) ? $_GET['pendente'] : 0;

    include '../sql/config.php';
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$pagina?></title>
    <?php include '../eletricista/link.html';?>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
    <?php include '../navbar/nav-eletricista.php'; ?>
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

                        $busca = isset($_POST['busca'])?$_POST['busca']:"";
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

                        $busca = isset($_POST['busca'])?$_POST['busca']:"";
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

        <div class="row mt-4">
            <h3 class="titulo verde text-center"></h3>
        </div>

        <div class="row">
            <div class="col-6 mt-3">
                <div class="row">
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
                        
                                        $query = "SELECT substituicao.id, gerente.nome, gerente.id, eletricista.id, eletricista.gerente FROM substituicao, eletricista, gerente WHERE substituicao.eletricista = eletricista.id AND eletricista.gerente = gerente.id";
                        
                                        $stmt = $conexao->prepare($query);
                                        $stmt->execute();
                                        $substituicoes = $stmt->fetchAll();

                                        foreach($substituicoes as $substituicao){
                                            // var_dump($substituicao);
                                            if($idSubstituicao == $substituicao['0']){
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
                                                if(strtolower($substituicao['situacao']) == "pendente"){
                                                    echo "<input type='text' style='color: #F00;' value='".ucWords($substituicao['situacao'])."' class='form-control text-center fw-bold border-success'>";
                                                } else{
                                                    echo "<input type='text' value='".ucWords($substituicao['situacao'])."' class='form-control  fw-bold verde text-center border-success'>";
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

                        <div class="col-2"></div>
                        <div class="col-5">
                            <div class="row">
                                <h6 class="texto verde text-center mt-3"><b>Visualizar:</b></h6>
                            </div>
                        
                            <div class="row mt-2">
                                <div class="col-2">
                                <?php
                                    try{
                                        $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
                        
                                        $query = "SELECT * FROM substituicao";
                        
                                        $stmt = $conexao->prepare($query);
                                        $stmt->execute();
                                        $substituicoes = $stmt->fetchAll();
                                        
                                        foreach($substituicoes as $substituicao){
                                            if($idSubstituicao == $substituicao['id']){
                                                if($substituicao['gravacao'] != null){
                                                    echo "<a href='../gravacao/video-eletricista.php?gravacao={$substituicao['gravacao']}'><button class='btn btn-outline-success texto verde'>Gravação</button></a>";
                                                } else{
                                                    echo "<button class='btn btn-outline-success texto verde' onClick='mensagemG();'>Gravação</button>";
                                                }
                                            }
                                        }
                                    }catch(Exception $e){
                                        print("Erro ...<br>".$e->getMessage());
                                        die();
                                    }
                                ?>
                                </div>
                                <div class="col-4"></div>
                                <div class="col-2">
                                <?php
                                    try{
                                        $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
                        
                                        $query = "SELECT * FROM substituicao";
                        
                                        $stmt = $conexao->prepare($query);
                                        $stmt->execute();
                                        $substituicoes = $stmt->fetchAll();
                                        
                                        foreach($substituicoes as $substituicao){
                                            if($idSubstituicao == $substituicao['id']){
                                                if($substituicao['relatorio'] != null){
                                                    echo "<a href='../relatorio/visualizar-eletricista.php?relatorio={$substituicao['relatorio']}'><button class='btn btn-outline-success texto verde'>Relatório</button></a>";
                                                } else{
                                                    echo "<button class='btn btn-outline-success texto verde' onClick='mensagemR();'>Relatório</button>";
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
                    </div>
                    <div class="row mt-4 mb-5">
                        <div class="col-12 text-center">
                            <?php
                                try{
                                    $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
                    
                                    $query = "SELECT * FROM substituicao";
                    
                                    $stmt = $conexao->prepare($query);
                                    $stmt->execute();
                                    $substituicoes = $stmt->fetchAll();
                                    
                                    foreach($substituicoes as $substituicao){
                                        if($idSubstituicao == $substituicao['id']){
                                            if(strtolower($substituicao['situacao']) == "pendente"){
                                                echo "<a href=acao.php?acao=concluir&id=".$substituicao["id"]."&situacao=concluída class='btn btn-success mt-1'>Concluir Substituição</a>";
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
            <div class="col-6">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-11">
                        <h6 class="texto verde text-center">LOCALIZAÇÃO</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-11">
                        <div id="map" class="border border-success rounded-3"></div>
                        <?php
                            try{
                                $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
                
                                $query = "SELECT * FROM substituicao";
                
                                $stmt = $conexao->prepare($query);
                                $stmt->execute();
                                $substituicoes = $stmt->fetchAll();
                                
                                foreach($substituicoes as $substituicao){
                                    if($idSubstituicao == $substituicao['id']){
                                        echo "<script>
                                        var map = L.map('map').setView([-27.217712470118357, -49.64618682861328], 12);
                    
                                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                            attribution: '© OpenStreetMap contributors'
                                        }).addTo(map);
                    
                                        L.marker([".ucWords($substituicao['latitude']).",".ucWords($substituicao['longitude'])."], {draggable: true}).addTo(map);
                                        </script>";
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
        </div>
    </div>
    <script language='javascript'>
        var pendente = <?=$pendente?>;
        if(pendente == true){
            alert("Relatório ou gravação ainda não estão concluídos, verifique!");
            window.location.href = 'visualizar-eletricista.php';
        }
    </script>
</body>
</html>