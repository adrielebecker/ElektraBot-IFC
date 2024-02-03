<!DOCTYPE html>
<?php
    include '../sql/config.php';
    session_start();
    // var_dump($_SESSION);
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "Salvar";
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $idSubstituicao = isset($_GET['substituicao']) ? $_GET['substituicao'] : 0;

    $erro = isset($_GET['erro_sql']) ? $_GET['erro_sql'] : "";
    
    if($acao = "editar"){
        try {
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
            
            $query = "SELECT * FROM relatorio WHERE id = :id";

            $stmt = $conexao->prepare($query);
            $stmt->bindValue(":id", $id);

            $stmt->execute();
            $relatorio = $stmt->fetch();

        } catch(Exception $e){
            print("Erro ...<br>".$e->getMessage());
            die();
        }
    }

    $acao = isset($_GET['acao']) ? $_GET['acao'] : "salvar";
    if($acao == "salvar"){
        $pagina = "Cadastro";
    } else{
        $pagina = "Alterar Relatório";
    }
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$pagina?></title>
    <?php include "../eletricista/link.html";?>
</head>
<body>
    <?php include "../navbar/nav-eletricista.php";?>
    
    <div class="container-fluid">
        <div class="row mt-2 ms-2">
            <div class="col-7 mt-4 pt-4">
                <div class="row">
                    <h6 class="titulo verde">Escreva seu relatório aqui:</h6>
                </div>
                <div class="row mt-2">
                    <form action="acao.php" method="post">
                        <textarea name="relatorio" id="relatorio" cols="80" rows="20"><?php if($id != 0) echo $relatorio["texto"];?></textarea>
                </div>
            </div>
            <div class="col-4 mt-5">  
                <div class="row">
                    <h4 class="titulo verde">Dados do Medidor</h4>
                </div>
                <input type="hidden" name="id" id="id" value="<?=$id?>">
                <div class="row">
                    <div class="col-6">
                        <div class="row bg-success border border-dark border-end-0 rounded-top rounded-end-0">
                            <p class="texto branco text-center mt-3">Código Antigo</p>
                            <input type="text" name="codAntigo" id="codAntigo" value="<?php if($id != 0) echo $relatorio["codAntigo"];?>" class="form-control rounded-0 text-center ">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row bg-success border border-dark rounded-top">
                            <p class="texto branco text-center mt-3">Código Novo</p>
                            <input type="text" name="codNovo" id="codNovo" value="<?php if($id != 0) echo $relatorio["codNovo"];?>" class="form-control rounded-0 text-center">
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-12">
                        <div class="row bg-success border border-dark border-top-0 border-bottom-0 text-center">
                            <p class="texto branco text-center mt-3">Tipo</p>
                        </div>
                        <div class="row border border-dark border-top-0 p-2 text-center rounded-bottom">
                            <div class="col-4">
                                <input type="radio" name="tipo" id="tipo" value="Monofásico" <?php if($id != 0){if($relatorio['tipo'] == "Monofásico") echo "checked";}?> class="form-check-input"> Monofásico
                            </div>
                            <div class="col-4">
                                <input type="radio" name="tipo" id="tipo" value="Bifásico" <?php if($id != 0){if($relatorio['tipo'] == "Bifásico") echo "checked";}?> class="form-check-input"> Bifásico
                            </div>
                            <div class="col-4">
                                <input type="radio" name="tipo" id="tipo" value="Trifásico" <?php if($id != 0){if($relatorio['tipo'] == "Trifásico") echo "checked";}?> class="form-check-input"> Trifásico
                            </div>
                        </div>
                    </div>
                </div>   

                <div class="row">
                    <h4 class="titulo verde mt-5">Sobre o Procedimento</h4>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="row bg-success border border-dark rounded-top">
                            <p class="texto branco text-center mt-3">Nome do Procedimento</p>
                            <select name="substituicao" id="substituicao" class="form-select border-success text-center" required>
                            <?php
                                try{
                                    $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
                    
                                    $query = "SELECT * FROM substituicao";
                    
                                    $stmt = $conexao->prepare($query);
                                    $stmt->execute();
                                    $substituicao = $stmt->fetchAll();
                                    
                                    foreach($substituicao as $value){
                                        if($_SESSION['idEletricista'] == $value['eletricista']){
                                            if($id != 0 && $idSubstituicao == $value['id']){
                                                echo "<option value='{$value['id']}' selected>".ucWords($value['nome'])."</option>";
                                            } else{
                                                echo "<option value='{$value['id']}'>".ucWords($value['id'])."</option>";
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
                        <div class="row bg-success border border-dark border-top-0 border-bottom-0">
                            <p class="texto branco text-center mt-3">Aconteceu algum acidente?</p>
                        </div>
                        <div class="row border border-dark border-top-0 p-2 text-center rounded-bottom">
                            <div class="col-2"></div>
                            <div class="col-4">
                                <input type="radio" name="acidente" id="acidente" value="Sim" <?php if($id != 0){if($relatorio['acidente'] == "Sim") echo "checked";}?> class="form-check-input"> Sim
                            </div>
                            <div class="col-4">
                                <input type="radio" name="acidente" id="acidente" value="Não" <?php if($id != 0){if($relatorio['acidente'] == "Não") echo "checked";}?> class="form-check-input"> Não
                            </div>
                        </div>
                    </div>
                </div>   

                <div class="row mt-3 mb-5">
                    <div class="col-6"></div>
                    <div class="col-1 ms-3">
                        <button type="submit" class="btn btn-success" name="acao" id="acao" value="<?php if($id != 0) echo "editar"; else echo "salvar";?>">Enviar</button>
                        </form>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-1">
                        <a href="relatorios-eletricista.php"><button class="btn btn-danger">Cancelar</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script language="javascript">
        var erro = "<?php echo $erro;?>";
        if(erro == "true"){
            erroDuplicado();
        } 
    </script>
</body>
</html>