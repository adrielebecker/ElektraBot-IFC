<!DOCTYPE html>
<?php 
    session_start();
    include 'sql/config.php';
    $diretorio = "video/substituicao-longa.mp4";

    var_dump($_SESSION);
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
   
</head>
<body>
    <form action="gravacao/acao.php" method="post">
        <video width='600' controls autoplay muted>
            <source src='video/substituicao-longa.mp4' type='video/mp4'>
        </video>
        <br>
        Nome
        <select name="substituicao" id="substituicao" class="form-select border-success text-center" required>
            <?php
                try{
                    $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
                    
                    $query = "SELECT * FROM substituicao";
                    
                    $stmt = $conexao->prepare($query);
                    $stmt->execute();
                    $substituicao = $stmt->fetchAll();
                    
                    foreach($substituicao as $value){
                        if($_SESSION['idEletricista'] == $value['eletricista']){
                            if($id != 0){
                                echo "<option value='{$value['id']}' selected>{$value['dataSub']}</option>";
                            } else{
                                echo "<option value='{$value['id']}'>{$value['nome']}</option>";
                            }
                        } else{
                            echo "<option value='nenhum'>Nenhuma substituição! Volte mais tarde</option>";
                        }
                    }
                }catch(Exception $e){
                    print("Erro ...<br>".$e->getMessage());
                    die();
                }
                echo "</select><br>";

                echo "<input type='hidden' name='diretorio' value='{$diretorio}'>";
            ?>

        <br>
        <button name="acao" id="acao" value="salvar">Salvar</button>

    </form>
</body>
</html>