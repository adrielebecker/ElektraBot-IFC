<!DOCTYPE html>
<?php 
    $pagina = "Câmera";
    $video = 'video/substituicao-curta.mp4';
    session_start();
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$pagina?></title>
   
</head>
<body>

    <video width='600' controls autoplay muted>
        <source src='video/substituicao-longa.mp4' type='video/mp4'>
    </video>
    <?php
        echo "<a href='gravacao/acao.php?diretorio=video/substituicao-longa.mp4&idEletricista=".$_SESSION['idEletricista']."'>Salvar</a>";
    ?>
</body>
</html>