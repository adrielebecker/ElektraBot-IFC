<?php
    include '../sql/config.php';

    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
    $gerente = isset($_POST['gerente']) ? $_POST['gerente'] : "";
    $eletricista = isset($_POST['eletricista']) ? $_POST['eletricista'] : "";
    $localizacao = isset($_POST['localizacao']) ? $_POST['localizacao'] : "";
    $dataSub = isset($_POST['dataSub']) ? $_POST['dataSub'] : "";
    $situacao = isset($_POST['situacao']) ? $_POST['situacao'] : "";

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
            break;
        case 'GET':
            $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
            break;
    }

    switch ($acao) {
        case 'salvar':
            salvar();
            break;
        case 'editar':
            editar();
            break;
        case 'excluir':
            excluir();
            break;
        case 'concluir':
            concluir();
            break;
    }

    function bindar($stmt){
        global $nome, $gerente, $eletricista, $localizacao, $dataSub, $situacao;
        $stmt->bindValue(":nome", $nome);
        $stmt->bindValue(":gerente", $gerente);
        $stmt->bindValue(":eletricista", $eletricista);
        $stmt->bindValue(":localizacao", $localizacao);
        $stmt->bindValue(":dataSub", $dataSub);
        $stmt->bindValue(":situacao", $situacao);

    }

    function salvar(){
        try {
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);

            $query = "INSERT INTO substituicao(nome, gerente, eletricista, localizacao, dataSub, situacao) VALUES(:nome, :gerente, :eletricista, :localizacao, :dataSub, :situacao)";

            $stmt = $conexao->prepare($query);

            bindar($stmt);

            $stmt->execute();
        } catch (Exception $e) {
            print("Erro ...<br>".$e->getMessage());
            die();
        }
    }

    function editar(){
        try {
            global $id;
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);  
            $query = "UPDATE substituicao SET nome = :nome, gerente = :gerente, eletricista = :eletricista, localizacao = :localizacao, dataSub = :dataSub, situacao = :situacao WHERE id = :id";
            
            $stmt = $conexao->prepare($query);

            bindar($stmt);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            
        } catch(Exception $e){
            print("Erro ...<br>".$e->getMessage());
            die();
        }
    }

    function excluir(){
        try{
            $id = isset($_GET["id"])? $_GET["id"]:0;
    
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
            $query = "DELETE FROM substituicao WHERE id = :id";
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(":id",$id);
    
            $stmt->execute();
    
        } catch(PDOExeptio $e){
            print("Erro ao conectar com o banco de dados . . . <br>".$e->getMenssage());
            die();
        }
    }

    function concluir(){
        try {
            global $id;
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);  
            $query = "UPDATE substituicao SET nome = :nome, gerente = :gerente, eletricista = :eletricista, localizacao = :localizacao, dataSub = :dataSub, situacao = :situacao WHERE id = :id";
            
            $stmt = $conexao->prepare($query);

            bindar($stmt);
            $stmt->bindValue(":id", $id);
            $stmt->execute();

        } catch(Exception $e){
            print("Erro ...<br>".$e->getMessage());
            die();
        }
    }
?>