<?php
    include '../sql/config.php';
    echo "<script src='../js/funcoes.js'></script>";
    
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
        global $diretorio, $substituicao;

        $stmt->bindValue(":substituicao", $substituicao);
        $stmt->bindValue(":video", $diretorio);
    }

    function buscarId($substituicao, $conexao){
        $query = "SELECT * FROM gravacao";
        $stmt = $conexao->prepare($query);
        $stmt->execute();
        $gravacoes = $stmt->fetchALL();

        foreach($gravacoes as $gravacao){
            if($gravacao['substituicao'] == $substituicao){
                $idGravacao = $gravacao['id'];
                return $idGravacao;
            }
        }
    }

    function salvar(){
        global $substituicao;
        try{
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);

            $query = "INSERT INTO gravacao(video, substituicao) VALUES(:video, :substituicao)";

            $stmt = $conexao->prepare($query);
            bindar($stmt);
            $stmt->execute();

            
            $idGravacao = buscarId($substituicao, $conexao);
            echo "id".$idGravacao;
            $query = "UPDATE substituicao SET gravacao = :gravacao WHERE id = :substituicao";
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':substituicao', $substituicao);
            $stmt->bindValue(':gravacao', $idGravacao);
            $stmt->execute();
            
            header('Location: gravacao-eletricista.php?salvo=true');            
            echo "foi";
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
            $query = "SELECT * FROM substituicao";

            if ($busca != ""){
                $busca = $busca.'%';
                $query .= ' AND substituicao.nome like :busca' ;
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