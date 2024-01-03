<!DOCTYPE html>
<?php
    session_start();
    var_dump($_SESSION);
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "Salvar";
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    include '../sql/config.php';
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
        <textarea name="texto" id="texto" cols="30" rows="10"></textarea>
        <br>
        <label for="medidor">Dados do Medidor</label><br>
        <label for="codNovo">Código Novo</label>
        <input type="text" name="codNovo" id="codNovo"> <br>  

        <label for="codAntigo">Código Antigo</label>
        <input type="text" name="codAntigo" id="codAntigo"> <br>

        <label for="tipo">Tipo</label>
        <input type="radio" name="tipo" id="tipo" value="Monofásico"> Monofásico
        <input type="radio" name="tipo" id="tipo" value="Bifásico"> Bifásico
        <input type="radio" name="tipo" id="tipo" value="Trifásico"> Trifásico <br><br>

        <label for="procedimento">Sobre o Procedimento:</label><br>
        <label for="nome">Nome do Procedimento</label>
        <select name="nome" id="nome" class="form-select border-success text-center" required>
            <?php
                try{
                    $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
    
                    $query = "SELECT * FROM substituicao";
    
                    $stmt = $conexao->prepare($query);
                    $stmt->execute();
                    $substituicao = $stmt->fetchAll();
                    
                    foreach($substituicao as $value){
                        echo "<option value='{$value['id']}'>{$value['nome']}</option>";
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
                        echo "<option value='{$value['dataSub']}'>{$value['dataSub']}</option>";
                    }
                }catch(Exception $e){
                    print("Erro ...<br>".$e->getMessage());
                    die();
                }
            ?>
        </select>
        <br>

        <label for="acidente">Aconteceu algum acidente?</label>
        <input type="radio" name="acidente" id="acidente" value="Sim"> Sim
        <input type="radio" name="acidente" id="acidente" value="Não"> Não

        <button name="acao" id="acao" value="salvar">Salvar</button>
    </form>
</body>
</html>