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
    
    // echo "<pre> POST:";
    // var_dump($_POST);
    // echo "<pre> GET:";
    // var_dump($_GET);

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
        case 'Fazer a consulta':
            buscar();
            break;
    }

    function bindar($stmt){
        global $texto, $codNovo, $codAntigo, $tipo, $substituicao, $acidente;

        $stmt->bindValue(":texto", $texto);
        $stmt->bindValue(":codNovo", $codNovo);
        $stmt->bindValue(":codAntigo", $codAntigo);
        $stmt->bindValue(":tipo", $tipo);
        $stmt->bindValue(":substituicao", $substituicao);
        $stmt->bindValue(":acidente", $acidente);
    }

    function buscarId($substituicao, $conexao){
        $query = "SELECT * FROM relatorio";
        $stmt = $conexao->prepare($query);
        $stmt->execute();
        $relatorios = $stmt->fetchALL();

        foreach($relatorios as $relatorio){
            if($relatorio['substituicao'] == $substituicao){
                $idGravacao = $relatorio['id'];
                return $idGravacao;
            }
        }
    }

    function salvar(){
        global $substituicao;
        try {
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
          
            $query = "INSERT INTO relatorio(texto, codNovo, codAntigo, tipo, substituicao, acidente) VALUES (:texto, :codNovo, :codAntigo, :tipo, :substituicao, :acidente)";
            
            $stmt = $conexao->prepare($query);
            bindar($stmt);
            $stmt->execute();

            $idRelatorio = buscarId($substituicao, $conexao);

            echo "id".$idRelatorio;
            $query = "UPDATE substituicao SET relatorio = :relatorio WHERE id = :substituicao";
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':substituicao', $substituicao);
            $stmt->bindValue(':relatorio', $idRelatorio);
            $stmt->execute();
            header('Location: relatorios-eletricista.php?salvo=true');
        } catch(Exception $e){
            if($e->getCode() == '23000'){
                header('Location: cadastro-relatorio.php?erro_sql=true');
            } else{
                print("Erro ...<br>".$e->getMessage());
                die();
            }
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

            header('Location: relatorios-eletricista.php?salvo=true');
        } catch(Exception $e){
            print("Erro ...<br>".$e->getMessage());
            die();
        }
    }

    function excluir(){
        try{
            $id = isset($_GET["id"]) ? $_GET["id"]: 0;
    
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
            $query = "DELETE FROM relatorio WHERE id = :id";
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(":id",$id);
    
            $stmt->execute();
    
        } catch(PDOExeptio $e){
            print("Erro ao conectar com o banco de dados . . . <br>".$e->getMenssage());
            die();
        }
        header('Location: ../relatorio/relatorios-eletricista.php?excluido=true');
    }

    function buscar(){
        try{
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);  
        
            $busca = isset($_GET['busca']) ? $_GET['busca']:"";

            $query = "SELECT  texto, codAntigo, codNovo, tipo, acidente, relatorio.eletricista, substituicao, substituicao.nome, substituicao.id, relatorio.id FROM substituicao, relatorio WHERE substituicao.id = relatorio.substituicao";

            if ($busca != ""){
                $busca = $busca.'%';
                $query .= ' WHERE nome like :busca' ;
            }
        
            $stmt = $conexao->prepare($query);
        
            if ($busca != ""){
                $stmt->bindValue(':busca', $busca);
            }
        
            $stmt->execute();
            $relatorios = $stmt->fetchAll();
            echo json_encode($relatorios);
        
        }catch(PDOExeptio $e){
            print("Erro ao conectar com o banco de dados . . . <br>".$e->getMenssage());
            die();
        }
    }
?>