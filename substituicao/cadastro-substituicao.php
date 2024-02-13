<!DOCTYPE html>
<?php
    $pagina = "Designar Substituições";
    session_start();
    // var_dump($_SESSION);
    include '../sql/config.php';

    $situacao = "pendente";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "Salvar";
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    
    if($acao = "editar"){
        try {
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
            
            $query = "SELECT * FROM substituicao WHERE id = :id";

            $stmt = $conexao->prepare($query);
            $stmt->bindValue(":id", $id);

            $stmt->execute();
            $substituicao = $stmt->fetch();

        } catch(Exception $e){
            print("Erro ...<br>".$e->getMessage());
            die();
        }
    }
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$pagina?></title>
    <?php include '../gerente/link.html';?>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
    
</head>
<body>
    <?php include '../navbar/nav-gerente.php'; ?>
    <div class="container">
        <div class="row mt-4">
            <h3 class="titulo verde text-center">Nova Substituição</h3>
        </div>

        <div class="row">
            <div class="col-6 mt-3">
                <form action="acao.php" method="post">
                <input type="hidden" name="id" id='id' value="<?=$id?>">
                <div class="row mt-5">
                    <div class="col-5">
                        <div class="row bg-success rounded">
                            <p class="texto branco text-center mt-3">Nome da Substituição:</p>
                            <input type="text" name="nome" id="nome" value="<?php if($id != 0) echo ucWords($substituicao["nome"]);?>" class="form-control text-center border-success">
                        </div>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-5">
                        <div class="row bg-success rounded">
                            <p class="texto branco text-center mt-3">Gerente:</p>
                            <input type="hidden" name="gerente" id="gerente" class="form-control text-center border-success" value="<?=$_SESSION['idGerente']?>">
                            <input type="text" class="form-control text-center border-success" value="<?=ucWords($_SESSION['nomeGerente'])?>" readonly>
                        </div>
                    </div>
                </div>
                    <div class="row mt-4">
                        <div class="col-5 mt-4">
                            <div class="row bg-success rounded">
                                <p class="texto text-center branco mt-3">Eletricista no projeto:</p>
                                <select name="eletricista" id="eletricista" class="form-select border-success text-center">
                                    <option value="selecione">Selecione um eletricista...</option>
                                    <?php
                                        try{
                                            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
                            
                                            $query = "SELECT * FROM eletricista";
                            
                                            $stmt = $conexao->prepare($query);
                                            $stmt->execute();
                                            $eletricista = $stmt->fetchAll();
                                            
                                            foreach($eletricista as $value){
                                                if($_SESSION['idGerente'] == $value['gerente']){
                                                    if($id != 0){
                                                        echo "<option value='{$value['id']}' selected>".ucWords($value['nome'])."</option>";
                                                    } else{
                                                        echo "<option value='{$value['id']}'>".ucWords($value['nome'])."</option>";
                                                    }
                                                }
                                            }
                                        }catch(Exception $e){
                                            print("Erro ...<br>".$e->getMessage());
                                            die();
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-5 mt-4">
                            <div class="row bg-success rounded">
                                <p class="texto branco text-center mt-3">Data da Substituição:</p>
                                <input type="date" name="dataSub" id="dataSub" value="<?php if($id != 0) echo $substituicao["dataSub"];?>" class="form-control text-center border-success">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-5">
                            <div class="row bg-success rounded">
                                <p class="texto branco text-center mt-3">Situação do Projeto:</p>
                                <input type="text" name="situacao" id="situacao" value="<?php if($id != 0) echo ucWords($substituicao["situacao"]); elseif($id == 0) echo ucWords($situacao);?>" class="form-control text-center border-success" readonly>
                            </div>
                        </div>
                        <div class="col-1 ms-5"></div>
                        <div class="col-2 ms-4 mt-4">
                            <button type="submit" class="btn btn-success" name="acao" id="acao" value="<?php if($id != 0) echo "editar"; else echo "salvar"?>">Enviar</button>
                        </div>
                        <div class="col-2 mt-4">                            
                            <a href="substituicoes-gerente.php" class='btn btn-danger'>Cancelar</a>
                        </div>
                    </div>
            </div>
            <div class="col-6 mt-4">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-11">
                        <h6 class="texto verde text-center">LOCALIZAÇÃO</h6>
                    </div>
                </div>

                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-11">
                        <input type="hidden" name='latitude' id='latitude'>
                        <input type="hidden" name='longitude' id='longitude'>

                        <div id="map" class="border border-success rounded-3"></div>
                        <script>
                            var map = L.map('map').setView([<?php if($id != 0) echo ucWords($substituicao["latitude"]); else echo -27.217712470118357;?>, <?php if($id != 0) echo ucWords($substituicao["longitude"]); else echo -49.64618682861328;?>], 15);

                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '© OpenStreetMap contributors'
                            }).addTo(map);

                            var marker = L.marker([<?php if($id != 0) echo ucWords($substituicao["latitude"]); else echo "";?>, <?php if($id != 0) echo ucWords($substituicao["longitude"]); else echo "";?>], {draggable: true}).addTo(map);
                            map.on('click', function(ev) {
                                var latlng = ev.latlng;
                                marker.setLatLng(latlng); ''
                                document.getElementById('latitude').value = latlng.lat;
                                document.getElementById('longitude').value = latlng.lng;
                            });
                        </script>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>