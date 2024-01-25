<!DOCTYPE html>
<?php
    include "../sql/config.php";
    include '../funcao/acao.php';
    $pagina = "Eletricistas";
    session_start();
    // var_dump($_SESSION);
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

    <div class="container">
        <div class="row">
            <div class="col-12 mt-5">
                <h5 class="text-center titulo verde">Pesquisar Eletricista:</h5>
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
                        $query = "SELECT eletricista.nome, eletricista.email, eletricista.celular, gerente.nome, gerente.id FROM gerente, eletricista WHERE gerente.id = eletricista.gerente";
                        
                        if ($busca != ""){
                            $busca = '%'.$busca.'%';
                            $query .= ' AND eletricista.nome like :busca' ;
                        }

                        $stmt = $conexao->prepare($query);

                        if ($busca != ""){
                            $stmt->bindValue(':busca',$busca);
                        }

                        $stmt->execute();
                        $eletricistas = $stmt->fetchAll();
                    
                        foreach($eletricistas as $eletricista){
                            if($_SESSION['idGerente'] == $eletricista['id']){
                                echo "<div class='col-4'>
                                        <table class='table text-center table-bordered mt-4 table-sm'>
                                            <tr>
                                                <td><img src='../img/icones/user.png' width='20%' class='mt-2'></td></tr>
                                                <tr><th>".ucWords($eletricista['0'])."</th></tr>
                                                <tr><td>".$eletricista['email']."</td></tr>
                                                <tr><td>".formataTelefone($eletricista['celular'])."</td>
                                            </tr>
                                        </table>
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
</body>
</html>