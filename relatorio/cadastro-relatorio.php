<!DOCTYPE html>
<?php
    session_start();
    var_dump($_SESSION);
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "Salvar";
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    include '../sql/config.php';
    
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
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>
</head>
<body>
    <form action="acao.php" method="post">
        <input type="text" name="id" id="id" value="<?=$id?>" readonly><br>
        <label for="texto">Escreva seu relatório aqui:</label><br>
        <textarea name="texto" id="texto" cols="30" rows="10" value="<?php if($id != 0) echo $relatorio["texto"];?>"><?php if($id != 0) echo $relatorio["texto"];?></textarea>
        <br>
        <label for="medidor">Dados do Medidor</label><br>
        <label for="codNovo">Código Novo</label>
        <input type="text" name="codNovo" id="codNovo" value="<?php if($id != 0) echo $relatorio["codNovo"];?>"> <br>  

        <label for="codAntigo">Código Antigo</label>
        <input type="text" name="codAntigo" id="codAntigo" value="<?php if($id != 0) echo $relatorio["codAntigo"];?>"> <br>

        <label for="tipo">Tipo</label>
        <input type="radio" name="tipo" id="tipo" value="Monofásico" <?php if($id != 0 && $relatorio['tipo'] == "Monofásico") echo "checked";?>> Monofásico
        <input type="radio" name="tipo" id="tipo" value="Bifásico" <?php if($id != 0 && $relatorio['tipo'] == "Bifásico") echo "checked";?>> Bifásico
        <input type="radio" name="tipo" id="tipo" value="Trifásico" <?php if($id != 0 && $relatorio['tipo'] == "Trifásico") echo "checked";?>> Trifásico <br><br>

        <label for="procedimento">Sobre o Procedimento:</label><br>
        <label for="nome">Nome do Procedimento</label>
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
                            if($id != 0 && $relatorio['substituicao'] == $value['id']){
                                echo "<option value='{$value['id']}' selected>{$value['nome']}</option>";
                            } else{
                                echo "<option value='{$value['id']}'>{$value['nome']}</option>";
                            }
                        }else{
                            echo "<option value='nenhum'>Nenhuma substituição! Volte mais tarde</option>";
                        }
                    }
                }catch(Exception $e){
                    print("Erro ...<br>".$e->getMessage());
                    die();
                }
            ?>
        </select>
        <br>

        <label for="dataSub">Data do Procedimento</label>
        <select name="dataSub" id="dataSub" class="form-select border-success text-center" required>
            <?php
                try{
                    $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
    
                    $query = "SELECT * FROM substituicao";
    
                    $stmt = $conexao->prepare($query);
                    $stmt->execute();
                    $substituicao = $stmt->fetchAll();
                    
                    foreach($substituicao as $value){
                        if($_SESSION['idEletricista'] == $value['eletricista']){
                            if($id != 0 && $relatorio['dataSub'] == $value['dataSub']){
                                echo "<option value='{$value['dataSub']}' selected>{$value['dataSub']}</option>";
                            } else{
                                echo "<option value='{$value['dataSub']}'>{$value['dataSub']}</option>";
                            }
                        } else{
                            echo "<option value='nenhum'>Nenhuma substituição! Volte mais tarde</option>";
                        }
                    }
                }catch(Exception $e){
                    print("Erro ...<br>".$e->getMessage());
                    die();
                }
            ?>
        </select>
        <br>

        <label for="acidente">Aconteceu algum acidente?</label>
        <input type="radio" name="acidente" id="acidente" value="Sim" <?php if($id != 0 && $relatorio['acidente'] == "Sim") echo "checked";?>>  Sim
        <input type="radio" name="acidente" id="acidente" value="Não" <?php if($id != 0 && $relatorio['acidente'] == "Não") echo "checked";?>> Não

        <button name="acao" id="acao" value="<?php if($id != 0) echo "editar"; else echo "salvar";?>">Salvar</button>
    </form>
</body>
</html>