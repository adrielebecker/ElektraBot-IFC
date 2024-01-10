<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <?php include 'link.html';?>
</head>
<body>
    <?php include "navbar/nav-todos.php";?>
    
    <section id="home">
        <div class="container mt-5">
            <figure>
                <img src="img/logo/logo-grande.png" alt="logo da elektrabot" width="90%">
            </figure>
        </div>
    </section>

    <section id="sobre">
        <div class="container">
            <div class="row">
                <div class="col-5 ms-4">
                    <div class="row text-center mt-4">
                        <h3 class="titulo branco sobre-margin">SOBRE A ELEKTRABOT</h3>
                    </div>
                    <div class="row text-center mt-4">
                        <p class="texto branco sobre-tam">A ElektraBot é um projeto que busca trazer mais segurança 
                            aos eletricitários que realizam a substituição de medidores 
                            de energia elétrica, além disso, busca proporcionar, aos
                            procedimentos, maior agilidade e precisão. <br>
                            Foi desenvolvido na disciplina de Prática
                            Profissionalizante Orientada, dentro do Instituito
                            Federal Catarinense - Campus Rio do Sul.
                        </p>
                    </div>
                </div>
                <div class="col-1"></div>
                <div class="col-4 mt-5">
                    <img src="img/sobre/sobre-img.png" alt="imagem ilustrativa de eletricista" width="150%">
                </div>
                <div class="row mt-5">
                    <img src="img/sobre/raios.png" alt="raios decorativos" width="100%">
                </div> 
            </div>
            <br><br>
        </div>
    </section>

    <section id="desenvolvedores">
        <div class="container mt-5">
            <br><br>
            <div class="row">
                <h3 class="titulo verde mt-5">DESENVOLVEDORAS</h3>
            </div>

            <div class="row mt-5">
                <div class="col-2"></div>
                <div class="card border-light" style="width: 18rem;">
                    <img src="img/desenvolvedores/img-adriele.png" class="card-img-top" alt="Adriele Becker desenvolvedora">
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
                    <img src="img/desenvolvedores/img-camilly.png" class="card-img-top" alt="Camilly Vitoria desenvolvedora">
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
    </section>

    <br><br>

    <section id="contato">
        <br>
        <div class="container">
            <div class="row mt-3">
                <h3 class="titulo branco">INFORMAÇÕES DE CONTATO</h3>
            </div>
            <div class="row mt-4">
                <div class="col-4">
                    <h6 class="branco text-center titulo">Adriele Becker</h6>
                    <p class="branco text-center texto mt-4">
                        E-mail: 
                        <a href="mailto:adrielebecker14@gmail.com" class="link branco">adrielebecker14@gmail.com</a>
                    </p>
                    <p class="branco text-center texto">
                        Instagram: 
                        <a href="https://www.instagram.com/adriele_becker14/" class="link branco">@adriele_becker14</a>
                    </p>
                </div>
                <div class="col-4">
                    <h6 class="branco text-center titulo">Camilly Vitória</h6>
                    <p class="branco text-center texto mt-4">
                        E-mail: 
                        <a href="mailto:almeidacamillyvitoria398@gmail.com" class="link branco">almeidacamillyvitoria398@gmail.com</a>
                    </p>
                    <p class="branco text-center texto">
                        Instagram: 
                        <a href="https://www.instagram.com/camilly_vitoriax/" class="link branco">@camilly_vitoriax</a>
                    </p>
                </div>
                <div class="col-4">
                    <h6 class="branco text-center titulo">ElektraBot</h6>
                    <p class="branco text-center texto mt-4">
                        E-mail: 
                        <a href="mailto:elektrabotifc@gmail.com" class="link branco">elektrabotifc@gmail.com</a>
                    </p>
                    <p class="branco text-center texto">
                        Instagram: 
                        <a href="https://www.instagram.com/elektrabot_ifc/" class="link branco">@elektrabot_ifc</a>
                    </p>
                </div>
            </div>
        </div>
        <br>
    </section>
    <br><br>

    <?php include 'footer.html';?>
</body>
</html>