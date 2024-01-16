<!DOCTYPE html>
<?php
    session_start();
    include '../sql/config.php';
    $_GET['acao'] = "";
    include '../funcao/acao.php';
    $pagina = "Minha Conta";
    ?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$pagina?></title>
    <?php include "link.html";?>
</head>
<body>
    <?php include "../navbar/nav-eletricista.php";?>
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
            
                            $query = "SELECT * FROM eletricista";
            
                            $stmt = $conexao->prepare($query);
                            $stmt->execute();
                            $eletricistas = $stmt->fetchAll();
                            
                            foreach($eletricistas as $eletricista){
                                if($_SESSION['idEletricista'] === $eletricista['id']){
                                    echo "<a class='btn btn-success texto' href='cadastro.php?acao=editar&id=".$eletricista["id"]."'>Alterar Dados</a>";
                                    echo "<a class='btn btn-danger mt-3 texto' href='acao.php?acao=excluir&id=".$eletricista["id"]."'>Excluir Conta</a>";
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
                    
                                    $query = "SELECT * FROM eletricista";
                    
                                    $stmt = $conexao->prepare($query);
                                    $stmt->execute();
                                    $gerentes = $stmt->fetchAll();

                                    foreach($gerentes as $eletricista){
                                        if($_SESSION['idGerente'] == $eletricista['id']){
                                            echo "<tr>
                                                    <td>".ucWords($eletricista['nome'])."</td>
                                                    <td>".date("d/m/Y", strtotime($eletricista['dataNasc']))."</td>
                                                    <td>".$eletricista['sexo']."</td>
                                                    <td>".formataCpf($eletricista['cpf'])."</td>
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
                    
                                    $query = "SELECT * FROM eletricista";
                    
                                    $stmt = $conexao->prepare($query);
                                    $stmt->execute();
                                    $gerentes = $stmt->fetchAll();

                                    foreach($gerentes as $eletricista){
                                        if($_SESSION['idGerente'] == $eletricista['id']){
                                            echo "<tr>
                                                    <td>".$eletricista['usuario']."</td>
                                                    <td>".$eletricista['matricula']."</td>
                                                    <td>Eletricista</td>
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
                    
                                    $query = "SELECT * FROM eletricista";
                    
                                    $stmt = $conexao->prepare($query);
                                    $stmt->execute();
                                    $gerentes = $stmt->fetchAll();

                                    foreach($gerentes as $eletricista){
                                        if($_SESSION['idGerente'] == $eletricista['id']){
                                            echo "<tr>
                                                    <td>".formataTelefone($eletricista['celular'])."</td>
                                                    <td>".$eletricista['email']."</td>
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
                    
                                    $query = "SELECT * FROM eletricista";
                    
                                    $stmt = $conexao->prepare($query);
                                    $stmt->execute();
                                    $gerentes = $stmt->fetchAll();

                                    foreach($gerentes as $eletricista){
                                        if($_SESSION['idGerente'] == $eletricista['id']){
                                            echo "<tr>
                                                    <td>".ucWords($eletricista['estado'])."</td>
                                                    <td>".ucWords($eletricista['cidade'])."</td>
                                                    <td>".ucWords($eletricista['bairro'])."</td>
                                                    <td>".ucWords($eletricista['rua'])."</td>
                                                    <td>".ucWords($eletricista['complemento'])."</td>
                                                    <td>".$eletricista['numero']."</td>
                                                    <td>".formataCep($eletricista['cep'])."</td>
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
</body>
</html>