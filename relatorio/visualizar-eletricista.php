<!DOCTYPE html>
<?php
    session_start();
    $pagina = "Relatórios";
    include '../sql/config.php';
    $id = isset($_GET['relatorio']) ? $_GET['relatorio'] : 0;
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$pagina?></title>
    <?php include "../eletricista/link.html";?>
</head>
<body>
    <?php include "../navbar/nav-eletricista.php";?>

    <div class="container-fluid">
        <div class="row mt-5 ms-2">
            <div class="col-7 mt-2">
                <div class="row mt-5 ms-4">
                <?php
                    try{
                        $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);

                        $query = "SELECT  texto, id, eletricista FROM relatorio";
        
                        $stmt = $conexao->prepare($query);
                        $stmt->execute();
                        $relatorios = $stmt->fetchAll();
                        
                        foreach($relatorios as $relatorio){
                            if($_SESSION['idEletricista'] === $relatorio['eletricista']){
                                if($relatorio['id'] == $id){
                                    echo "<textarea name='relatorio' id='relatorio'>{$relatorio['texto']}</textarea>";
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
            <div class="col-4 mt-3">  
                <div class="row">
                    <h4 class="titulo verde">Dados do Medidor</h4>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="row bg-success border border-dark border-end-0">
                            <p class="texto branco text-center mt-3">Código Antigo</p>
                            <?php
                                try{
                                    $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);

                                    $query = "SELECT  codAntigo, id, eletricista FROM relatorio";
                    
                                    $stmt = $conexao->prepare($query);
                                    $stmt->execute();
                                    $relatorios = $stmt->fetchAll();
                                    
                                    foreach($relatorios as $relatorio){
                                        if($_SESSION['idEletricista'] === $relatorio['eletricista']){
                                            if($relatorio['id'] == $id){
                                                echo "<input type='text' readonly value='{$relatorio['codAntigo']}' class='form-control rounded-0 text-center'>";
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
                    <div class="col-6">
                        <div class="row bg-success border border-dark rounded-start-0 rounded-bottom-0 rounded-end-2">
                            <p class="texto branco text-center mt-3">Código Novo</p>
                            <?php
                                try{
                                    $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);

                                    $query = "SELECT  codNovo, id, eletricista FROM relatorio";
                    
                                    $stmt = $conexao->prepare($query);
                                    $stmt->execute();
                                    $relatorios = $stmt->fetchAll();
                                    
                                    foreach($relatorios as $relatorio){
                                        if($_SESSION['idEletricista'] === $relatorio['eletricista']){
                                            if($relatorio['id'] == $id){
                                                echo "<input type='text' readonly value='{$relatorio['codNovo']}' class='form-control rounded-0 text-center'>";
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
                <div class="row">
                    <div class="col-12">
                        <div class="row bg-success border border-dark border-top-0 border-bottom-0 text-center">
                            <p class="texto branco text-center mt-3">Tipo</p>
                        </div>
                        <div class="row border border-dark border-top-0 text-center rounded-bottom">
                        <?php
                                try{
                                    $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);

                                    $query = "SELECT  tipo, id, eletricista FROM relatorio";
                    
                                    $stmt = $conexao->prepare($query);
                                    $stmt->execute();
                                    $relatorios = $stmt->fetchAll();
                                    
                                    foreach($relatorios as $relatorio){
                                        if($_SESSION['idEletricista'] === $relatorio['eletricista']){
                                            if($relatorio['id'] == $id){
                                                echo "<input type='text' readonly value='".ucWords($relatorio['tipo'])."' class='form-control rounded-bottom text-center'>";
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

                <div class="row">
                    <h4 class="titulo verde mt-5">Sobre o Procedimento</h4>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="row bg-success border border-dark rounded-top">
                            <p class="texto branco text-center mt-3">Nome do Procedimento</p>
                            <?php
                                try{
                                    $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);

                                    $query = "SELECT  substituicao.nome, substituicao, substituicao.id, relatorio.id, relatorio.eletricista FROM relatorio, substituicao WHERE relatorio.substituicao = substituicao.id";
                    
                                    $stmt = $conexao->prepare($query);
                                    $stmt->execute();
                                    $relatorios = $stmt->fetchAll();
                                    
                                    foreach($relatorios as $relatorio){
                                        if($_SESSION['idEletricista'] === $relatorio['eletricista']){
                                            if($relatorio['id'] == $id){
                                                echo "<input type='text' readonly value='".ucWords($relatorio['nome'])."' class='form-control rounded-0 text-center'>";
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
                        <div class="row bg-success border border-dark border-top-0 border-bottom-0">
                            <p class="texto branco text-center mt-3">Data do Procedimento</p>
                        </div>
                        <div class="row border border-dark border-top-0">
                            <?php
                                try{
                                    $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);

                                    $query = "SELECT  dataSub, relatorio.id, relatorio.eletricista FROM relatorio, substituicao";
                    
                                    $stmt = $conexao->prepare($query);
                                    $stmt->execute();
                                    $relatorios = $stmt->fetchAll();
                                    
                                    foreach($relatorios as $relatorio){
                                        if($_SESSION['idEletricista'] === $relatorio['eletricista']){
                                            if($relatorio['id'] == $id){
                                                echo "<input type='text' readonly value='".date("d/m/Y", strtotime($relatorio['dataSub']))."' class='form-control rounded-0 text-center'>";
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
                        <div class="row bg-success border border-dark border-top-0 border-bottom-0">
                            <p class="texto branco text-center mt-3">Aconteceu algum acidente?</p>
                        </div>
                        <div class="row border border-dark border-top-0 text-center rounded-bottom">
                            <?php
                                try{
                                    $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);

                                    $query = "SELECT  acidente, id, eletricista FROM relatorio";
                    
                                    $stmt = $conexao->prepare($query);
                                    $stmt->execute();
                                    $relatorios = $stmt->fetchAll();
                                    
                                    foreach($relatorios as $relatorio){
                                        if($_SESSION['idEletricista'] === $relatorio['eletricista']){
                                            if($relatorio['id'] == $id){
                                                echo "<input type='text' readonly value='".ucWords($relatorio['acidente'])."' class='form-control rounded-bottom text-center'>";
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

                <div class="row mt-3 mb-5">
                    <div class="col-2"></div>
                    <div class="col-5">
                        <?php
                            echo "<a href='cadastro-relatorio.php?acao=editar&id={$id}'><button class='btn btn-dark'>Editar Relatório</button></a>";
                        ?>
                    </div>
                    <div class="col-1">
                        <?php
                            echo "<a href='acao.php?acao=excluir&id={$id}'><button class='btn btn-danger'>Excluir</button></a>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>