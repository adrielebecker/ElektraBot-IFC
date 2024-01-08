<!DOCTYPE html>
<?php
    session_start();
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta</title>
</head>
<body>
    <table border=1>
        <?php
            include '../sql/config.php';

            try {
                $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);

                $query = "SELECT * FROM substituicao";

                $stmt = $conexao->prepare($query);
                $stmt->execute();
                $substituicoes = $stmt->fetchAll();

                
                echo "<tr><th>Nome</th><th>Gerente</th><th>Data</th><th>Localização</th><th>Concluir</th></tr>";

                foreach($substituicoes as $substituicao){
                    if($_SESSION['idEletricista'] === $substituicao['eletricista']){
                        $concluir = "<a href=acao.php?acao=concluir&id=".$substituicao["id"].">Concluir</a>";
                        echo "<tr><td>".$substituicao["nome"]."</td>"."<td>".$substituicao["gerente"]."</td>"."<td>".$substituicao["dataSub"]."</td>"."<td>".$substituicao["localizacao"]."</td><td>$concluir</td></tr>";
                    }
                }
            } catch(Exception $e){
                print("Erro ...<br>".$e->getMessage());
                die();
            }
        ?>
    </table>
</body>
</html>