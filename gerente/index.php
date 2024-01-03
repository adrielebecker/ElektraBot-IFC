<!DOCTYPE html>
<?php 
    session_start();
    echo "Bem vindo, ".$_SESSION['nomeGerente'];
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>teste</title>
</head>
<body>
    <br>
    <a href="../funcao/acao.php?acao=sair">Sair</a>
</body>
</html>