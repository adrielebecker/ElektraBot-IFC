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

                $query = "SELECT * FROM relatorio";

                $stmt = $conexao->prepare($query);
                $stmt->execute();
                $relatorios = $stmt->fetchAll();

                
                echo "<tr><th>Texto</th><th>Cod Antigo</th><th>Cod Novo</th><th>Nome</th><th>Editar</th><th>Excluir</th></tr>";

                foreach($relatorios as $relatorio){
                    if($_SESSION['idEletricista'] === $relatorio['eletricista']){
                        $editar = "<a href=cadastro-relatorio.php?acao=editar&id=".$relatorio["id"].">Alt</a>";
                        $excluir = "<a href='acao.php?acao=excluir&id=".$relatorio["id"]."'>Exc</a>";
                        echo "<tr><td>".$relatorio["texto"]."</td>"."<td>".$relatorio["codAntigo"]."</td>"."<td>".$relatorio["codNovo"]."</td>"."<td>".$relatorio["substituicao"]."</td><td>$editar</td>"."<td>$excluir</td>"."</tr>";
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