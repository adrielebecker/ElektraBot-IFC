<?php
    include '../sql/config.php';

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
    $gerente = isset($_POST['gerente']) ? $_POST['gerente'] : "";
    $foto = isset($_FILES['foto']) ? $_FILES['foto'] : "nenhum";
    $senha = isset($_POST['senha']) ? $_POST['senha'] : "";
    $senha = sha1($senha);

    
    echo "<pre>";
        var_dump($_POST);
        var_dump($_GET);
    echo "</pre>";
    
    echo "foto: ";
    var_dump($foto);
    
    if(isset($foto) && $foto != "nenhum"){
        $ext = strtolower(substr($foto['name'],-4)); //Pegando extensão do arquivo
        if($ext != ""){
            $new_name = date("YmdHis") . $ext; // novo nome
            $dir = '../img/eletricistas/'; //Diretório para uploads 
            move_uploaded_file($foto['tmp_name'], $dir.$new_name); //Fazer upload do arquivo
        }
    }

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            $acao =  $_POST['acao'] ? $_POST['acao'] : "";
            break;
        
        case 'GET':
            $acao = $_GET['acao'] ? $_GET['acao'] : "";
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
    }

    function bindar($stmt){
        global $id, $usuario, $nome, $dataNasc, $sexo, $cpf, $matricula, $celular, $email, $estado, $cidade, $bairro, $rua, $complemento, $numero, $cep, $senha, $gerente, $new_name;

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
        $stmt->bindValue(":gerente",$gerente);

        var_dump($new_name);
        if($new_name == NULL && $id == 0){
            $stmt->bindValue(":foto",'user.png');
        } else{
            $stmt->bindValue(":foto", $new_name);
        } 
    }

    function verificaUsuario($conexao, $usuario){
        $query = "SELECT * FROM eletricista";
        $stmt = $conexao->prepare($query);
        $stmt->execute();
        $eletricistas = $stmt->fetchAll();

        if($eletricistas != NULL){
            foreach($eletricistas as $eletricista){
                if($eletricista['usuario'] != $usuario){
                    $user = true;
                } else{
                    $user = false;
                }
            }
        } else{
            $user = true;
        }
        return $user;
    }

    function salvar(){
        global $usuario, $nome, $dataNasc, $sexo, $cpf, $matricula, $celular, $email, $estado, $cidade, $bairro, $rua, $complemento, $numero, $cep, $senha, $gerente, $new_name;
        try {
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
            /* ":" deixa mais generico que usar variavel */

            $user = verificaUsuario($conexao, $usuario);

            echo $user;
            if($user == true){
                $query = "INSERT INTO eletricista(usuario, nome, dataNasc, sexo, cpf, matricula, celular, email, estado, cidade, bairro, rua, complemento, numero, cep, senha, gerente, foto) VALUES(:usuario, :nome, :dataNasc, :sexo, :cpf, :matricula, :celular, :email, :estado, :cidade, :bairro, :rua, :complemento, :numero, :cep, :senha, :gerente, :foto)"; 
                
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
            global $id, $new_name;
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD); 
            if($new_name != ""){
                $query = "UPDATE eletricista SET usuario = :usuario, nome = :nome, dataNasc = :dataNasc, sexo = :sexo, cpf = :cpf, matricula = :matricula, celular = :celular, email = :email, estado = :estado, cidade = :cidade, bairro = :bairro, rua = :rua, complemento = :complemento, numero = :numero, cep = :cep, senha = :senha, gerente = :gerente, foto = :foto WHERE id = :id";
            } else{
                $query = "UPDATE eletricista SET usuario = :usuario, nome = :nome, dataNasc = :dataNasc, sexo = :sexo, cpf = :cpf, matricula = :matricula, celular = :celular, email = :email, estado = :estado, cidade = :cidade, bairro = :bairro, rua = :rua, complemento = :complemento, numero = :numero, cep = :cep, senha = :senha, gerente = :gerente WHERE id = :id";
            }
            
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
        // try{
        //     $id = isset($_GET["id"]) ? $_GET["id"]: 0;
    
        //     $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
        //     $query = "DELETE FROM eletricista WHERE id = :id";
        //     $stmt = $conexao->prepare($query);
        //     $stmt->bindValue(":id", $id);

        //     $stmt->execute();
    
        // } catch(PDOExeptio $e){
        //     print("Erro ao conectar com o banco de dados . . . <br>".$e->getMenssage());
        //     die();
        // }

        try{
            $id = isset($_GET['id']) ? $_GET['id'] : 0;

            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
            $query = "UPDATE eletricista SET ativo = :ativo WHERE id = :id";
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(":ativo", "nao");
            $stmt->bindValue(":id", $id);

            $stmt->execute();

            header('Location: ../login.php');
        } catch(PDOExeptio $e){
            print("Erro ao conectar com o banco de dados . . . <br>".$e->getMenssage());
            die();
        }
    }
        
?>