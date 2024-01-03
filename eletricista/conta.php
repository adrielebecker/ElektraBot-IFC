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

                $query = "SELECT * FROM eletricista";

                $stmt = $conexao->prepare($query);
                $stmt->execute();
                $eletricistas = $stmt->fetchAll();

                
                echo "<tr><th>Usuário</th><th>Nome</th><th>Data de Nascimento</th><th>Sexo</th><th>E-mail</th><th>Gerente</th><th>Editar</th><th>Excluir</th></tr>";

                foreach($eletricistas as $eletricista){
                    if($_SESSION['idEletricista'] === $eletricista['id']){
                        $editar = "<a href=cadastro.php?acao=editar&id=".$eletricista["id"].">Alt</a>";
                        $excluir = "<a href='acao.php?acao=excluir&id=".$eletricista["id"]."'>Exc</a>";
                        echo "<tr><td>".$eletricista["usuario"]."</td>"."<td>".$eletricista["nome"]."</td>"."<td>".$eletricista["dataNasc"]."</td>"."<td>".$eletricista["sexo"]."</td><td>".$eletricista["email"]."</td><td>".$eletricista['gerente']."<td>$editar</td>"."<td>$excluir</td>"."</tr>";
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