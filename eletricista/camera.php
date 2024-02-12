<!DOCTYPE html>
<?php 
    include '../sql/config.php';
    $pagina = "Câmera";
    $diretorio = "video/substituicao-longa.mp4";

    $erro = isset($_GET['erro_sql']) ? $_GET['erro_sql'] : "";
    var_dump($erro);
    session_start();
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$pagina?></title>
    <?php include 'link.html'; ?>
</head>
<body>
    <?php include '../navbar/nav-eletricista.php'; ?>

    <nav class="navbar">
        <div class="col-6 ms-3">
            <button class="navbar-toggler border border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <h6 class="texto verde">Conectar Dispositivo</h6>
            </button>
        </div>
        <div class="offcanvas" id="navbarToggleExternalContent">
            <div class="m-5 ms-0">
                <ul class="mt-5 pb-5 border-bottom border-success">
                    <li class="nav-link">
                        <h5 class="titulo verde text-center mt-5">Conectar Dispositivo</h5>
                    </li>
                    <li class="nav-link">
                        <p class="text-center mt-5 texto">Certifique-se que o Bluetooth <br> está ligado...</p>
                    </li>
                    <li class="nav-link">
                        <div class="d-flex align-items-center mt-5">
                            <div class="spinner-border text-success" role="status"></div>
                                <strong class="ms-2">BUSCANDO DISPOSITIVOS...</strong>
                        </div>
                    </li>
                </ul>
                <ul>
                    <li class="nav-link">
                        <h5 class="titulo verde text-center mt-5">Dispositivos</h5>
                    </li>
                    <li class="text-center border border-bottom-0 border-success nav-link">
                        <p class="text-center mt-3">ELEKTRABOT - Robô</p>
                        <img src="../img/logo/logo-rob.png" alt="" width="40%">
                    </li>
                    <li class="text-center border border-top-0 border-success nav-link">
                        <button class="btn">Conectar Dispositivo</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h5 class="titulo verde text-center">Visualização em tempo real:</h5>
            </div>
        </div>

        <form action="../gravacao/acao.php" method="post">
            <div class="row">
                <div class="col-6 ms-1 mt-5">
                    <video width='500' controls autoplay muted>
                        <source src='../video/substituicao-longa.mp4' type='video/mp4'>
                    </video>
                </div>

                <div class="col-4 ms-5 mt-5">
                    <div class="row mt-5"></div>
                    <h5 class="texto text-center mt-5">Nome da Substituição:</h5>
                    <select name="substituicao" id="substituicao" class="form-select border-success text-center mt-4" required>
                    <?php
                        try{
                            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
                            
                            $query = "SELECT * FROM substituicao";
                            
                            $stmt = $conexao->prepare($query);
                            $stmt->execute();
                            $substituicao = $stmt->fetchAll();
                            
                            foreach($substituicao as $value){
                                if($_SESSION['idEletricista'] == $value['eletricista']){
                                    echo "<option value='{$value['id']}'>".ucWords($value['nome'])."</option>";
                                }
                            }
                        }catch(Exception $e){
                            print("Erro ...<br>".$e->getMessage());
                            die();
                        }
                        echo "</select><br>";

                        echo "<input type='hidden' name='diretorio' value='{$diretorio}'>";
                    ?>
                    <div class="row mt-4">
                        <div class="col-2">
                            <button name="acao" id="acao" value="salvar" class="btn btn-success">Salvar</button>
                        </div>
                    </div>
            </form>
            </div>
        </div>
    </div>

    <script language="javascript">
        var erro = "<?php echo $erro;?>";
        if(erro == "true"){
            erroDuplicado();
            window.location.href = 'camera.php';
        } 
    </script>
</body>
</html>