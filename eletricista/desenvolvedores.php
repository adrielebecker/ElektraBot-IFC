<!DOCTYPE html>
<?php
    $pagina = "Sobre os desenvolvedores";
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$pagina?></title>
    <?php include "link.html";?>
</head>
<body>
    <?php include "../navbar/nav-eletricista.php";?>
    <div class="container mt-5">
        <div class="row">
            <h3 class="titulo verde text-center">DESENVOLVEDORAS</h3>
        </div>

        <div class="row mt-4">
            <div class="col-2"></div>
            <div class="card border-light" style="width: 18rem;">
                <img src="../img/desenvolvedores/img-adriele.png" class="card-img-top" alt="Adriele Becker desenvolvedora">
                <div class="card-body">
                    <h5 class="card-title text-center"><b>ADRIELE BECKER</b></h5>
                    <p class="card-text text-center texto">
                        Estudante do Curso Técnico em Informática para Internet, no IFC, <i>campus</i> Rio do Sul. <br>
                        16 anos. <br>
                        Braço do Trombudo, SC.
                    </p>
                </div>
            </div>
            <div class="col-2"></div>
            <div class="card border-light" style="width: 18rem;">
                <img src="../img/desenvolvedores/img-camilly.png" class="card-img-top" alt="Camilly Vitoria desenvolvedora">
                <div class="card-body">
                    <h5 class="card-title text-center"><b>CAMILLY VITÓRIA <br> ALMEIDA DOS SANTOS</b></h5>
                    <p class="card-text text-center texto">
                        Estudante do Curso Técnico em Informática para Internet, no IFC, <i>campus</i> Rio do Sul. <br>
                        16 anos. <br>
                        Rio do Sul, SC.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <?php include "footer.html";?>
</body>
</html>