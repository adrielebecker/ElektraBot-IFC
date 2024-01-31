<?php
    include '../sql/config.php';
    echo "<script src='../js/funcoes.js'></script>";
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
        case 'Fazer a consulta':
            buscar();
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

            header('Location: gravacao-eletricista.php');
    
        }catch(Exception $e){
            if($e->getCode() == '23000'){
               header('Location: ../eletricista/camera.php?erro_sql=true');
            } else{
                print("Erro ...<br>".$e->getMessage());
                die();
            }
        }

    }

    function buscar(){
        try{
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);  
        
            $busca = isset($_GET['busca']) ? $_GET['busca']:"";
            // $query = "SELECT * FROM substituicao";
            $query = "SELECT video, gravacao.eletricista, substituicao.nome, substituicao, substituicao.id FROM substituicao, gravacao WHERE substituicao.id = gravacao.substituicao";

            if ($busca != ""){
                $busca = $busca.'%';
                $query .= ' WHERE substituicao.nome like :busca' ;
            }
        
            $stmt = $conexao->prepare($query);
        
            if ($busca != ""){
                $stmt->bindValue(':busca', $busca);
            }
        
            $stmt->execute();
            $gravacoes = $stmt->fetchAll();
            // var_dump($gravacoes);
            echo json_encode($gravacoes);
        
        }catch(PDOExeptio $e){
            print("Erro ao conectar com o banco de dados . . . <br>".$e->getMenssage());
            die();
        }
    }
?>