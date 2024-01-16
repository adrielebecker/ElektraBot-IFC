<?php
    include '../sql/config.php';
    session_start();

    $idEletricista = $_SESSION['idEletricista'];
    $idGerente = $_SESSION['idGerente'];
    $diretorio = isset($_POST['diretorio']) ? $_POST['diretorio'] : "";
    $substituicao = isset($_POST['substituicao']) ? $_POST['substituicao'] : "";

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
    }

    function bindar($stmt){
        global $idGerente, $idEletricista, $diretorio, $substituicao;

        $stmt->bindValue(":gerente", $idGerente);
        $stmt->bindValue(":eletricista", $idEletricista);
        $stmt->bindValue(":video", $diretorio);
        $stmt->bindValue(":substituicao", $substituicao);
    }

    function salvar(){
        try{
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);

            $query = "INSERT INTO gravacao(eletricista, gerente, video, substituicao) VALUES(:eletricista, :gerente, :video, :substituicao)";

            $stmt = $conexao->prepare($query);

            bindar($stmt);

            $stmt->execute();
        }catch(Exception $e){
            print("Erro ...<br>".$e->getMessage());
            die();
        }

        header('Location: gravacao-eletricista.php');
    }
?>