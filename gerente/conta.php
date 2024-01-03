<!DOCTYPE html>
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

                $query = "SELECT * FROM gerente";

                $stmt = $conexao->prepare($query);
                $stmt->execute();
                $gerentes = $stmt->fetchAll();

                echo "<tr><th>Usuário</th><th>Nome</th><th>Data de Nascimento</th><th>Sexo</th><th>E-mail</th><th>Editar</th><th>Excluir</th></tr>";

                foreach($gerentes as $gerente){
                    $editar = "<a href=cadastro.php?acao=editar&id=".$gerente["id"].">Alt</a>";
                    $excluir = "<a href='acao.php?acao=excluir&id=".$gerente["id"]."'>Exc</a>";
                    echo "<tr><td>".$gerente["usuario"]."</td>"."<td>".$gerente["nome"]."</td>"."<td>".$gerente["dataNasc"]."</td>"."<td>".$gerente["sexo"]."</td>"."<td>".$gerente["email"]."</td><td>$editar</td>"."<td>$excluir</td>"."</tr>";
                }
            } catch(Exception $e){
                print("Erro ...<br>".$e->getMessage());
                die();
            }
        ?>
    </table>
</body>
</html>