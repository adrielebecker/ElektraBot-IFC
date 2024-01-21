<?php
    include '../sql/config.php';
    session_start();
    
    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    $texto = isset($_POST['relatorio']) ? $_POST['relatorio'] : "";
    $codNovo = isset($_POST['codNovo']) ? $_POST['codNovo'] : "";
    $codAntigo = isset($_POST['codAntigo']) ? $_POST['codAntigo'] : "";
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : "";
    $substituicao = isset($_POST['substituicao']) ? $_POST['substituicao'] : "";
    $acidente = isset($_POST['acidente']) ? $_POST['acidente'] : "";
    $idEletricista = $_SESSION['idEletricista'];
    $idGerente = $_SESSION['idGerente'];
    
    echo "<pre> POST:";
    var_dump($_POST);

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            $acao = $_POST['acao'] ? $_POST['acao'] : "";
            break;
        case 'GET':
            $acao = $_GET['acao'] ? $_GET['acao'] : "";
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
    }

    function bindar($stmt){
        global $texto, $codNovo, $codAntigo, $tipo, $substituicao, $acidente, $idEletricista, $idGerente;

        $stmt->bindValue(":texto", $texto);
        $stmt->bindValue(":codNovo", $codNovo);
        $stmt->bindValue(":codAntigo", $codAntigo);
        $stmt->bindValue(":tipo", $tipo);
        $stmt->bindValue(":substituicao", $substituicao);
        $stmt->bindValue(":acidente", $acidente);
        $stmt->bindValue(":eletricista", $idEletricista);
        $stmt->bindValue(":gerente", $idGerente);

    }
    function salvar(){
        try {
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
          
            $query = "INSERT INTO relatorio(texto, codNovo, codAntigo, tipo, substituicao, acidente, eletricista, gerente) VALUES (:texto, :codNovo, :codAntigo, :tipo, :substituicao, :acidente, :eletricista, :gerente)";
            
            $stmt = $conexao->prepare($query);

            bindar($stmt);

            $stmt->execute();

            echo "foi";
        } catch(Exception $e){
            print("Erro ...<br>".$e->getMessage());
            die();
        }
    }

    function editar(){
        try {
            global $id;
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);  
            $query = "UPDATE relatorio SET texto = :texto, codNovo = :codNovo, codAntigo = :codAntigo, tipo = :tipo, substituicao = :substituicao, acidente = :acidente, eletricista = :eletricista, gerente = :gerente WHERE id = :id";
            
            $stmt = $conexao->prepare($query);

            bindar($stmt);
            $stmt->bindValue(":id", $id);
            $stmt->execute();

            header('Location: cadastro-relatorio.php');
        } catch(Exception $e){
            print("Erro ...<br>".$e->getMessage());
            die();
        }
    }

    function excluir(){
        try{
            $id = isset($_GET["id"])? $_GET["id"]:0;
    
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
            $query = "DELETE FROM relatorio WHERE id = :id";
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(":id",$id);
    
            $stmt->execute();
    
        } catch(PDOExeptio $e){
            print("Erro ao conectar com o banco de dados . . . <br>".$e->getMenssage());
            die();
        }
    }
?>