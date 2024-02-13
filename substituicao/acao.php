<?php
    include '../sql/config.php';

    echo "POST:";
    var_dump($_POST);

    echo"GET:";
    var_dump($_GET);
    
    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
    $eletricista = isset($_POST['eletricista']) ? $_POST['eletricista'] : "";
    $dataSub = isset($_POST['dataSub']) ? $_POST['dataSub'] : "";
    $situacao = isset($_POST['situacao']) ? $_POST['situacao'] : "";
    $latitude = isset($_POST['latitude']) ? $_POST['latitude'] : "";
    $longitude = isset($_POST['longitude']) ? $_POST['longitude'] : "";

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
        case 'Fazer a consulta':
            buscar();
            break;
    }

    function bindar($stmt){
        global $nome, $eletricista, $latitude, $longitude, $dataSub, $situacao;
        $stmt->bindValue(":nome", $nome);
        $stmt->bindValue(":eletricista", $eletricista);
        $stmt->bindValue(":latitude", $latitude);
        $stmt->bindValue(":longitude", $longitude);
        $stmt->bindValue(":dataSub", $dataSub);
        $stmt->bindValue(":situacao", $situacao);
    }

    function salvar(){
        try {
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);

            $query = "INSERT INTO substituicao(nome, eletricista, latitude, longitude, dataSub, situacao) VALUES(:nome, :eletricista, :latitude, :longitude, :dataSub, :situacao)";

            $stmt = $conexao->prepare($query);

            bindar($stmt);

            $stmt->execute();

            var_dump($_POST);
            // header('Location: substituicoes-gerente.php?sucesso=true');
        } catch (Exception $e) {
            print("Erro ...<br>".$e->getMessage());
            die();
        }
    }

    function editar(){
        try {
            global $id;
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);  
            $query = "UPDATE substituicao SET nome = :nome, eletricista = :eletricista, latitude = :latitude, longitude = :longitude, dataSub = :dataSub, situacao = :situacao WHERE id = :id";
            
            $stmt = $conexao->prepare($query);

            bindar($stmt);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            
        } catch(Exception $e){
            print("Erro ...<br>".$e->getMessage());
            die();
        }
        header('Location: substituicoes-gerente.php?alterado=true');
    }

    function buscarSubstituicao($conexao, $id){
        $query = "SELECT * FROM substituicao";
        $stmt = $conexao->prepare($query);
        $stmt->execute();

        $substituicoes = $stmt->fetchAll();
        foreach($substituicoes as $substituicao){
            if($substituicao['id'] == $id){
                if($substituicao['gravacao'] != null || $substituicao['relatorio'] != null){
                    $excluir = false;
                } else{
                    $excluir = true;
                }
            }
        }
        return $excluir;
    }

    function excluir(){
        try{
            $id = isset($_GET["id"])? $_GET["id"] : 0;
    
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);

            $excluir = buscarSubstituicao($conexao, $id);
            
            if($excluir == true){
                $query = "DELETE FROM substituicao WHERE id = :id";
                $stmt = $conexao->prepare($query);
                $stmt->bindValue(":id",$id);
        
                $stmt->execute();
    
                header('Location: substituicoes-gerente.php');
            } else{
                header('Location: substituicoes-gerente.php?erro=true');
            }
    
        } catch(PDOExeptio $e){
            print("Erro ao conectar com o banco de dados . . . <br>".$e->getMenssage());
            die();
        }
    }

    function verificacao($conexao, $id){
        $query = "SELECT * FROM substituicao";
            
        $stmt = $conexao->prepare($query);
        $stmt->execute();
        $substituicoes = $stmt->fetchAll();
        
        foreach($substituicoes as $substituicao){
            if($substituicao['id'] == $id){
                if($substituicao['gravacao'] == null || $substituicao['relatorio'] == null){
                    return true;
                } 
            }
        }
    }

    function concluir(){
        try {
            $situacao = isset($_GET['situacao']) ? $_GET['situacao'] : "pendente";
            $id = isset($_GET['id']) ? $_GET['id'] : 0;

            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);  
            
            $verficacao = verificacao($conexao, $id);

            if($verficacao == true){
                header('Location: visualizar-eletricista.php?pendente=true&idSubstituicao='.$id);
            } else{
                $query = "UPDATE substituicao SET situacao = :situacao WHERE id = :id";
                $stmt = $conexao->prepare($query);
                
                $stmt->bindValue(":id", $id);
                $stmt->bindValue(":situacao", $situacao);
    
                $stmt->execute();
                header('Location: substituicoes-eletricista.php?concluida=true');
            }

        } catch(Exception $e){
            print("Erro ...<br>".$e->getMessage());
            die();
        }
    }

    function buscar(){
        try{
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);  
        
            $busca = isset($_GET['busca']) ? $_GET['busca']:"";
            $query = "SELECT * FROM substituicao";
            
            if ($busca != ""){
                $busca = $busca.'%';
                $query .= ' AND nome like :busca' ;
            }
        
            $stmt = $conexao->prepare($query);
        
            if ($busca != ""){
                $stmt->bindValue(':busca', $busca);
            }
        
            $stmt->execute();
            $usuarios = $stmt->fetchAll();
            // var_dump($usuarios);
            echo json_encode($usuarios);
        
        }catch(PDOExeptio $e){
            print("Erro ao conectar com o banco de dados . . . <br>".$e->getMenssage());
            die();
        }
    }
?>