<?php
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            $acao = $_POST['acao'] ? $_POST['acao'] : "";
            break;
        
        case 'GET':
            $acao = $_GET['acao'] ? $_GET['acao'] : "";
            break;
    }

    switch ($acao) {
        case 'entrar':
            entrar();
            break;
        case 'sair':
            sair();
            break;
    }

    function entrar(){
        $usuario = $_POST['usuario'] ? $_POST['usuario'] : "";
        $cargo = $_POST['cargo'] ? $_POST['cargo'] : "";
        $senha = $_POST['senha'] ? $_POST['senha'] : "";

        include '../sql/config.php';

        if($cargo = "gerente"){
            try {
                $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);

                $query = "SELECT * FROM gerente";

                $stmt = $conexao->prepare($query);
                $stmt->execute();
                $gerentes = $stmt->fetchAll();

                foreach($gerentes as $gerente){
                    if(strtolower($gerente['usuario']) == strtolower($usuario) && $gerente['senha'] == $senha){
                        session_start();
                        $_SESSION['nomeGerente'] = $gerente['nome'];
                        $_SESSION['idGerente'] = $gerente['id'];
                        $_SESSION['sexoGerente'] = $gerente['sexo'];
                        header('Location: ../gerente/index.php');
                    } 
                    else{
                        echo "Usuário ou senha incorretos!";
                    }
                }
            } catch(Exception $e){
                print("Erro ...<br>".$e->getMessage());
                die();
            }
        }
    }

    function sair(){
        session_start();
        session_destroy();
        header('Location: ../login.php');
    }
?>