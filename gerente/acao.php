<?php
    include '../sql/config.php';
    echo "<script src='../js/funcoes.js'></script>";

    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : "";
    $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
    $dataNasc = isset($_POST['dataNasc']) ? $_POST['dataNasc'] : "";
    $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : "";
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : "";
    $matricula = isset($_POST['matricula']) ? $_POST['matricula'] : "";
    $celular = isset($_POST['celular']) ? $_POST['celular'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $estado = isset($_POST['estado']) ? $_POST['estado'] : "";
    $cidade = isset($_POST['cidade']) ? $_POST['cidade'] : "";
    $bairro = isset($_POST['bairro']) ? $_POST['bairro'] : "";
    $rua = isset($_POST['rua']) ? $_POST['rua'] : "";
    $complemento = isset($_POST['complemento']) ? $_POST['complemento'] : "";
    $numero = isset($_POST['numero']) ? $_POST['numero'] : "";
    $cep = isset($_POST['cep']) ? $_POST['cep'] : "";
    $senha = isset($_POST['senha']) ? $_POST['senha'] : "";
    $senha = sha1($senha);

    echo "<pre>";
        var_dump($_POST);
        var_dump($_GET);
    echo "</pre>";

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            $acao =  isset($_POST['acao']) ? $_POST['acao'] : "";
            break;
        
        case 'GET':
            $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
            break;
    }

    switch ($acao) {
        case 'Salvar':
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
        case 'Transferir eletricista(s)':
            transferir();
            break;
    }

    function bindar($stmt){
        global $id, $usuario, $nome, $dataNasc, $sexo, $cpf, $matricula, $celular, $email, $estado, $cidade, $bairro, $rua, $complemento, $numero, $cep, $senha;

        /* bindar = trocar o valor genérico pelo real*/
        $stmt->bindValue(":usuario",$usuario);
        $stmt->bindValue(":nome",$nome);
        $stmt->bindValue(":dataNasc",$dataNasc); 
        $stmt->bindValue(":sexo",$sexo);
        $stmt->bindValue(":cpf",$cpf);
        $stmt->bindValue(":matricula",$matricula);
        $stmt->bindValue(":celular",$celular);
        $stmt->bindValue(":email",$email);
        $stmt->bindValue(":estado",$estado);
        $stmt->bindValue(":cidade",$cidade);
        $stmt->bindValue(":bairro",$bairro);
        $stmt->bindValue(":rua",$rua);
        $stmt->bindValue(":complemento",$complemento);
        $stmt->bindValue(":numero",$numero);
        $stmt->bindValue(":cep",$cep);
        $stmt->bindValue(":senha",$senha);
    }

    function verificaUsuario($conexao, $usuario){
        $query = "SELECT * FROM gerente";
        $stmt = $conexao->prepare($query);
        $stmt->execute();
        $gerentes = $stmt->fetchAll();

        foreach($gerentes as $gerente){
            if($gerente['usuario'] != $usuario){
                $user = true;
            } else{
                $user = false;
            }
        }
        return $user;
    }

    function salvar(){
        global $usuario, $nome, $dataNasc, $sexo, $cpf, $matricula, $celular, $email, $estado, $cidade, $bairro, $rua, $complemento, $numero, $cep, $senha;

        try {
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
            /* ":" deixa mais generico que usar variavel */
            $user = verificaUsuario($conexao, $usuario);

            if($user == true){
                $query = "INSERT INTO gerente(usuario, nome, dataNasc, sexo, cpf, matricula, celular, email, estado, cidade, bairro, rua, complemento, numero, cep, senha) VALUES(:usuario, :nome, :dataNasc, :sexo, :cpf, :matricula, :celular, :email, :estado, :cidade, :bairro, :rua, :complemento, :numero, :cep, :senha)"; 
                
                /* stmt -> statement -> execução do código -> mandar o BD executar algo */
                $stmt = $conexao->prepare($query);
                bindar($stmt);
                $stmt->execute();    
                header('Location: ../login.php?cadastro=true');
            } else{
                header('Location: cadastro.php?erroUsuario=true');
            }
        } catch(Exception $e){
            if($e->getCode() == '23000'){
                header('Location: cadastro.php?erro_sql=true');
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
            $query = "UPDATE gerente SET usuario = :usuario, nome = :nome, dataNasc = :dataNasc, sexo = :sexo, cpf = :cpf, matricula = :matricula, celular = :celular, email = :email, estado = :estado, cidade = :cidade, bairro = :bairro, rua = :rua, complemento = :complemento, numero = :numero, cep = :cep, senha = :senha WHERE id = :id";
            
            /* stmt -> statement -> execução do código -> mandar o BD executar algo */
            $stmt = $conexao->prepare($query);

            bindar($stmt);
            $stmt->bindValue(":id", $id);
            $stmt->execute();

            header('Location: conta.php?salvo=true');
        } catch(Exception $e){
            if($e->getCode() == '23000'){
                header('Location: cadastro.php?erro_sql=true');
            } else{
                print("Erro ...<br>".$e->getMessage());
                die();
            }
        }
        
    }
    function excluir(){
        try{
            $id = isset($_GET['id']) ? $_GET['id'] : 0;

            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
            $query = "UPDATE gerente SET ativo = :ativo WHERE id = :id";
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(":ativo", "nao");
            $stmt->bindValue(":id", $id);

            $stmt->execute();

            header('Location: ../login.php?excluido=true');
        } catch(PDOExeptio $e){
            print("Erro ao conectar com o banco de dados . . . <br>".$e->getMenssage());
            die();
        } catch(PDOException $e){
            if($e->getCode() == '23000'){
                header('Location: transferencia.php?erro_sql=true');
            } else{
                print("Erro ...<br>".$e->getMessage());
                die();
            }
        }

        // try{
        //     $id = isset($_GET['id']) ? $_GET['id'] : 0;
    
        //     $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
        //     $query = "DELETE FROM gerente WHERE id = :id";
        //     $stmt = $conexao->prepare($query);
        //     $stmt->bindValue(":id", $id);
    
        //     $stmt->execute();
        //     echo "foi";
            
        // } catch(PDOException $e){
        //     if($e->getCode() == '23000'){
        //         header('Location: transferencia.php?erro_sql=true');
        //     } else{
        //         print("Erro ...<br>".$e->getMessage());
        //         die();
        //     }
        // }
    }

    function buscar(){
        try{
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);  
        
            $busca = isset($_GET['busca']) ? $_GET['busca']:"";
            $query = "SELECT eletricista.nome, eletricista.email, eletricista.celular, gerente.nome, gerente.id FROM gerente, eletricista WHERE gerente.id = eletricista.gerente";

            if ($busca != ""){
                $busca = '%'.$busca.'%';
                $query .= ' WHERE eletricista.nome like :busca' ;
            }
        
            $stmt = $conexao->prepare($query);
        
            if ($busca != ""){
                $stmt->bindValue(':busca', $busca);
            }
        
            $stmt->execute();
            $eletricistas = $stmt->fetchAll();
            echo json_encode($eletricistas);
        
        }catch(PDOExeptio $e){
            print("Erro ao conectar com o banco de dados . . . <br>".$e->getMenssage());
            die();
        }
    }   

    function transferir(){
        try {
            $idEletricista = isset($_POST['idEletricista']) ? $_POST['idEletricista'] : array();
            $idGerente = isset($_POST['idGerente']) ? $_POST['idGerente'] : "";

            foreach($idEletricista as $eletricista){
                $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);  
                $query = "UPDATE eletricista SET gerente = :gerente WHERE id = :id";

                $stmt = $conexao->prepare($query);
                $stmt->bindValue(":gerente",$idGerente);
                $stmt->bindValue(":id", $eletricista);
                $stmt->execute();
            }
        } catch(Exception $e){
            print("Erro ...<br>".$e->getMessage());
            die();
        }   
    }
?>