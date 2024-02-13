<!DOCTYPE html>
<?php
    include "../sql/config.php";
    include '../funcao/acao.php';
    session_start();
    
    $pagina = "Transferência";
    $erroE = isset($_GET['eletricista']) ? $_GET['eletricista'] : "false";
    $idEletricista = isset($_GET['idEletricista']) ? $_GET['idEletricista'] : array();
    $idGerente = isset($_GET['idGerente']) ? $_GET['idGerente'] : 0;

    if($acao == "transferir"){
        try {
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
            
            foreach($idEletricista as $value){
                var_dump($value);
                $query = "SELECT * FROM eletricista WHERE id = :id";
                $stmt = $conexao->prepare($query);
                $stmt->bindValue(":id", $value['idEletricista']);
    
                $stmt->execute();
                $eletricista = $stmt->fetch();
            }


        } catch(Exception $e){
            print("Erro ...<br>".$e->getMessage());
            die();
        }
    }
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$pagina?></title>
    <?php include "link.html";?>
</head>
<body>
    <?php include "../navbar/nav-gerente.php";?>
    <?php
        if($erroE == 'true'){
            echo "<script>
                    alert('Antes de excluir sua conta transfira seus eletricistas para outro gerente!');
                    window.location.href = 'transferencia.php';
                    </script>";
        }
    ?>
    <div class="container">

        <div class="row">
            <div class="col-6">
                <h6 class="texto verde text-center mt-5">Selecione o(s) eletricista(s) que deseja transferir:</h6>
            </div>
            <div class="col-6">
                <h6 class="texto verde text-center mt-5">Selecione para que gerente deseja transferir:</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-6 text-center">
                <div class="row mt-4">
                    <form action="acao.php" method="post">
                    <?php
                        try{
                            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
                            $query = "SELECT * FROM eletricista";

                            $stmt = $conexao->prepare($query);

                            $stmt->execute();
                            $eletricistas = $stmt->fetchAll();
                        
                            foreach($eletricistas as $eletricista){
                                // var_dump($eletricista);
                                if($_SESSION['idGerente'] == $eletricista['gerente']){
                                    echo "<div class='col-12'> 
                                            <input name='idEletricista[]' id='idEletricista[]' value='".$eletricista['id']."'type='checkbox' class='form-check-input border-dark'> ".ucWords($eletricista["nome"])."
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
        
            <div class="col-6 text-center">
                <div class="row mt-4">
                    <?php
                        try{
                            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
                            $query = "SELECT * FROM gerente";
                        
                            $stmt = $conexao->prepare($query);
                            $stmt->execute();
                            $gerentes = $stmt->fetchAll();
                        
                            foreach($gerentes as $gerente){
                                // var_dump($gerente);
                                if($_SESSION['idGerente'] != $gerente['id']){
                                    echo "<div class='col-12'> 
                                            <input name='idGerente' id='idGerente' value='".$gerente['id']."' type='radio' class='form-check-input border-dark'> ".ucWords($gerente["nome"])."
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
        <div class="row mt-5">
            <div class="col-5"></div>
            <div class="col-2">
                <input type="submit" name="acao" id="acao" value="Transferir eletricista(s)" class="btn btn-success">
            </div>
        </div>
        </form>
    </div>
</body>
</html>