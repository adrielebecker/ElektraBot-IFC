<?php
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
            break;
        
        case 'GET':
            $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
            break;
    }

    switch ($acao) {
        case 'entrar':
            entrar();
            break;
        case 'sair':
            sair();
            break;
        case 'cadastrar':
            cadastrar();
            break;
    }

    function entrar(){
        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : "";
        $cargo = isset($_POST['cargo']) ? $_POST['cargo'] : "";
        $senha = isset($_POST['senha']) ? $_POST['senha'] : "";

        include '../sql/config.php';

        if($cargo == "gerente"){
            try {
                $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);

                $query = "SELECT * FROM gerente";

                $stmt = $conexao->prepare($query);
                $stmt->execute();
                $gerentes = $stmt->fetchAll();
                var_dump($gerentes);
                foreach($gerentes as $gerente){
                    if($gerente['usuario'] == $usuario && $gerente['senha'] == $senha && $gerente['ativo'] != "nao"){
                        var_dump($gerente);
                        session_start();
                        $_SESSION['nomeGerente'] = $gerente['nome'];
                        $_SESSION['idGerente'] = $gerente['id'];
                        $_SESSION['sexoGerente'] = $gerente['sexo'];
                        header('Location: ../gerente/index.php');
                    } 
                }
            } catch(Exception $e){
                print("Erro ...<br>".$e->getMessage());
                die();
            }
        } elseif($cargo == "eletricista"){
            try {
                $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);

                $query = "SELECT * FROM eletricista";

                $stmt = $conexao->prepare($query);
                $stmt->execute();
                $eletricistas = $stmt->fetchAll();

                foreach($eletricistas as $eletricista){
                    if($eletricista['usuario'] == $usuario && $eletricista['senha'] == $senha && $eletricista['ativo'] != 'nao'){
                        session_start();
                        $_SESSION['nomeEletricista'] = $eletricista['nome'];
                        $_SESSION['idEletricista'] = $eletricista['id'];
                        $_SESSION['sexoEletricista'] = $eletricista['sexo'];
                        $_SESSION['idGerente'] = $eletricista['gerente'];
                        header('Location: ../eletricista/index.php');
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

    function cadastrar(){
        $cargo = isset($_POST['cargo']) ? $_POST['cargo'] : "";

        if($cargo == "eletricista"){
            header('Location: ../eletricista/cadastro.php');
        } else{
            header('Location: ../gerente/cadastro.php');
        }
    }

    function formataCpf($cpf){
        $cpf= substr($cpf,0,-8).".".substr($cpf, 3, -5).".".substr($cpf, -5, -2)."-".substr($cpf,-2);
        return $cpf;
    }

    function formataTelefone($number){
        $number="(".substr($number,0,2).") ".substr($number,2,-4)."-".substr($number,-4);
        return $number;
    }

    function formataCep($cep){
        $cep= substr($cep,0,-4)."-".substr($cep,-4);
        return $cep;
    }
?>
