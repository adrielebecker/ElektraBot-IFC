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
        <div class="row mt-4">
            <?php
                try {
                    $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
    
                    $query = "SELECT eletricista.nome, eletricista.email, eletricista.celular, gerente.nome, gerente.id FROM gerente, eletricista WHERE gerente.id = eletricista.gerente";
    
                    $stmt = $conexao->prepare($query);
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
                } catch(Exception $e){
                    print("Erro ...<br>".$e->getMessage());
                    die();
                }
            ?>
        </div>
    </div>
</body>
</html>