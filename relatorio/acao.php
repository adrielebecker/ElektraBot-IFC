<?php
    include '../sql/config.php';
    session_start();
    
    $id = $_POST['id'] ? $_POST['id'] : 0;
    $texto = $_POST['texto'] ? $_POST['texto'] : "";
    $codNovo = $_POST['codNovo'] ? $_POST['codNovo'] : "";
    $codAntigo = $_POST['codAntigo'] ? $_POST['codAntigo'] : "";
    $tipo = $_POST['tipo'] ? $_POST['tipo'] : "";
    $substituicao = $_POST['substituicao'] ? $_POST['substituicao'] : "";
    $dataSub = $_POST['dataSub'] ? $_POST['dataSub'] : "";
    $acidente = $_POST['acidente'] ? $_POST['acidente'] : "";
    $idEletricista = $_SESSION['idEletricista'];
    $idGerente = $_SESSION['idGerente'];


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
    }

    function bindar($stmt){
        global $texto, $codNovo, $codAntigo, $tipo, $substituicao, $dataSub, $acidente, $idEletricista, $idGerente;

        $stmt->bindValue(":texto", $texto);
        $stmt->bindValue(":codNovo", $codNovo);
        $stmt->bindValue(":codAntigo", $codAntigo);
        $stmt->bindValue(":tipo", $tipo);
        $stmt->bindValue(":substituicao", $substituicao);
        $stmt->bindValue(":dataSub", $dataSub);
        $stmt->bindValue(":acidente", $acidente);
        $stmt->bindValue(":eletricista", $idEletricista);
        $stmt->bindValue(":gerente", $idGerente);

    }
    function salvar(){
        try {
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
          
            $query = "INSERT INTO relatorio(texto, codNovo, codAntigo, tipo, substituicao, dataSub, acidente, eletricista, gerente) VALUES (:texto, :codNovo, :codAntigo, :tipo, :substituicao, :dataSub, :acidente, :eletricista, :gerente)";
            
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
            $query = "UPDATE relatorio SET texto = :texto, codNovo = :codNovo, codAntigo = :codAntigo, tipo = :tipo, substituicao = :substituicao, dataSub = :dataSub, acidente = :acidente, eletricista = :eletricista, gerente = :gerente WHERE id = :id";
            
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