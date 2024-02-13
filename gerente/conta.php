<!DOCTYPE html>
<?php
    session_start();
    // var_dump($_SESSION);
    include '../sql/config.php';
    $_GET['acao'] = "";
    include '../funcao/acao.php';
    $pagina = "Minha Conta";
    $salvo = isset($_GET['salvo']) ? $_GET['salvo'] : "";
    ?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$pagina?></title>
    <?php include "link.html";?>
</head>
<body>
    <?php include "../navbar/nav-gerente.php";?>
    <div class="container">
        <div class="row mt-5">
            <div class="col-2 mt-4 img-user">
                <div class="row">
                    <h6 class="titulo verde text-center">Foto de Perfil</h6>
                </div>
                <div class="row mt-3">
                    <img src="../img/icones/user.png" alt="" width="80%">
                </div>
                <div class="row">
                    <p class="text-center mt-2 texto">Alterar imagem:</p>
                </div>
                <div class="row">
                    <input type="file" name="foto" id="foto" class="formFileSm">
                </div>
                <div class="row mt-5">
                    <?php
                        try {
                            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
            
                            $query = "SELECT * FROM gerente";
            
                            $stmt = $conexao->prepare($query);
                            $stmt->execute();
                            $gerentes = $stmt->fetchAll();
                            
                            foreach($gerentes as $gerente){
                                if($_SESSION['idGerente'] === $gerente['id']){
                                    echo "<a class='btn btn-success texto' href='cadastro.php?acao=editar&id=".$gerente["id"]."'>Alterar Dados</a>";
                                    echo "<a class='btn btn-danger mt-3 texto 'onclick='excluirContaG({$gerente['id']})'>Excluir Conta</a>";
                                }
                            }
                        } catch(Exception $e){
                            print("Erro ...<br>".$e->getMessage());
                            die();
                        }
                    ?>
                </div>
            </div>
            <div class="col-1"></div>
            <div class="col-9">
                <div class="row mt-5">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h6 class="texto verde text-center nav-link active bg-success border-dark border-bottom-0" style="color: #FFF;">Dados Pessoais</h6>
                        </li>
                    </ul>
                    <table class="table text-center table-bordered border-dark">
                        <thead class="bg-success branco">
                            <tr>
                                <th>Nome Completo</th>
                                <th>Data de Nascimento</th>
                                <th>Sexo</th>
                                <th>CPF</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                try {
                                    $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
                    
                                    $query = "SELECT * FROM gerente";
                    
                                    $stmt = $conexao->prepare($query);
                                    $stmt->execute();
                                    $gerentes = $stmt->fetchAll();

                                    foreach($gerentes as $gerente){
                                        if($_SESSION['idGerente'] == $gerente['id']){
                                            echo "<tr>
                                                    <td>".ucWords($gerente['nome'])."</td>
                                                    <td>".date("d/m/Y", strtotime($gerente['dataNasc']))."</td>
                                                    <td>".$gerente['sexo']."</td>
                                                    <td>".formataCpf($gerente['cpf'])."</td>
                                                </tr>";
                                        }
                                    }
                                } catch(Exception $e){
                                    print("Erro ...<br>".$e->getMessage());
                                    die();
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="row mt-4">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h6 class="nav-link active bg-success border-dark border-bottom-0" style="color: #FFF;">Dados da Empresa</h6>
                        </li>
                    </ul>
                    <table class="table text-center table-bordered border-dark">
                        <thead class="bg-success branco">
                            <tr>
                                <th>Nome de Usuário</th>
                                <th>Matrícula</th>
                                <th>Cargo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                try {
                                    $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
                    
                                    $query = "SELECT * FROM gerente";
                    
                                    $stmt = $conexao->prepare($query);
                                    $stmt->execute();
                                    $gerentes = $stmt->fetchAll();

                                    foreach($gerentes as $gerente){
                                        if($_SESSION['idGerente'] == $gerente['id']){
                                            echo "<tr>
                                                    <td>".$gerente['usuario']."</td>
                                                    <td>".$gerente['matricula']."</td>
                                                    <td>Gerente</td>
                                                </tr>";
                                        }
                                    }
                                } catch(Exception $e){
                                    print("Erro ...<br>".$e->getMessage());
                                    die();
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="row mt-4">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h6 class="titulo verde text-center nav-link active bg-success border-dark border-bottom-0" style="color: #FFF;">Dados de Contato</h6>
                        </li>
                    </ul>
                    <table class="table text-center table-bordered border-dark">
                        <thead class="bg-success branco">
                            <tr>
                                <th>Celular</th>
                                <th>E-mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                try {
                                    $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
                    
                                    $query = "SELECT * FROM gerente";
                    
                                    $stmt = $conexao->prepare($query);
                                    $stmt->execute();
                                    $gerentes = $stmt->fetchAll();

                                    foreach($gerentes as $gerente){
                                        if($_SESSION['idGerente'] == $gerente['id']){
                                            echo "<tr>
                                                    <td>".formataTelefone($gerente['celular'])."</td>
                                                    <td>".$gerente['email']."</td>
                                                </tr>";
                                        }
                                    }
                                } catch(Exception $e){
                                    print("Erro ...<br>".$e->getMessage());
                                    die();
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="row mt-4">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h6 class="titulo verde text-center nav-link active bg-success border-dark border-bottom-0" style="color: #FFF;">Dados de Endereço</h6>
                        </li>
                    </ul>
                    <table class="table text-center table-bordered border-dark">
                        <thead class="bg-success branco">
                            <tr>
                                <th>Estado</th>
                                <th>Cidade</th>
                                <th>Bairro</th>
                                <th>Rua</th>
                                <th>Complemento</th>
                                <th>Número</th>
                                <th>CEP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                try {
                                    $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
                    
                                    $query = "SELECT * FROM gerente";
                    
                                    $stmt = $conexao->prepare($query);
                                    $stmt->execute();
                                    $gerentes = $stmt->fetchAll();

                                    foreach($gerentes as $gerente){
                                        if($_SESSION['idGerente'] == $gerente['id']){
                                            echo "<tr>
                                                    <td>".ucWords($gerente['estado'])."</td>
                                                    <td>".ucWords($gerente['cidade'])."</td>
                                                    <td>".ucWords($gerente['bairro'])."</td>
                                                    <td>".ucWords($gerente['rua'])."</td>
                                                    <td>".ucWords($gerente['complemento'])."</td>
                                                    <td>".$gerente['numero']."</td>
                                                    <td>".formataCep($gerente['cep'])."</td>
                                                </tr>";
                                        }
                                    }
                                } catch(Exception $e){
                                    print("Erro ...<br>".$e->getMessage());
                                    die();
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

        </div>
    </div>
    <script>
        var salvo = <?=$salvo?>;
        if(salvo == true){
            alert("Alterações salvas com sucesso!");
            window.location.href = 'conta.php';
        }
    </script>
</body>
</html>