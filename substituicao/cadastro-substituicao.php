<!DOCTYPE html>
<?php
    session_start();
    var_dump($_SESSION);
    include '../sql/config.php';

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
    <title>Designar Substituição</title>
</head>
<body>
    <form action="acao.php" method="post">
        <input type="text" name="id" id="id" value="<?=$id?>" readonly> <br>
        <label for="nome">Nome da Substituição</label>
        <input type="text" name="nome" id="nome" value="<?php if($id != 0) echo $substituicao["nome"];?>"> <br>

        <label for="gerente">Gerente</label>
        <input type="hidden" name="gerente" id="gerente" value="<?=$_SESSION['idGerente']?>">
        <input type="text" name="" id="" value="<?=$_SESSION['nomeGerente']?>" readonly> <br>

        <label for="eletricista">Eletricista</label>
        <select name="eletricista" id="eletricista" class="form-select border-success text-center" required>
            <?php
                try{
                    $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
    
                    $query = "SELECT * FROM eletricista";
    
                    $stmt = $conexao->prepare($query);
                    $stmt->execute();
                    $eletricista = $stmt->fetchAll();
                    
                    foreach($eletricista as $value){
                        echo "<option value='{$value['id']}'>{$value['nome']}</option>";
                    }
                }catch(Exception $e){
                    print("Erro ...<br>".$e->getMessage());
                    die();
                }
            ?>
        </select>
        <br>

        <label for="dataSub">Data da Substituição</label>
        <input type="date" name="dataSub" id="dataSub" value="<?php if($id != 0) echo $substituicao["dataSub"];?>"> <br>

        <label for="localizacao">Localização</label><br>
        <iframe class="border border-success rounded-3" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3548.2225635105933!2d-49.642396925310535!3d-27.212161305780715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1spt-BR!2sbr!4v1697839360200!5m2!1spt-BR!2sbr" width="400" height="300" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <input type="hidden" name="localizacao" id="localizacao" value="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3548.2225635105933!2d-49.642396925310535!3d-27.212161305780715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1spt-BR!2sbr!4v1697839360200!5m2!1spt-BR!2sbr">
            <br>

        situacao:
        <input type="text" readonly name="situacao" id="situacao" value="<?php if($id == 0) echo "pendente";?>">
        <button name="acao" id="acao" value="<?php if($id != 0) echo "editar"; else echo "salvar";?>">Salvar</button>
    </form>
</body>
</html>