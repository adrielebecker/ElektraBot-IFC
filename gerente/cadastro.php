<!DOCTYPE html>
<?php
    include '../sql/config.php';
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "Salvar";
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $erro = isset($_GET['erro_sql']) ? $_GET['erro_sql'] : "";
    $erroUsuario = isset($_GET['erroUsuario']) ? $_GET['erroUsuario'] : "";
    
    if($acao = "editar"){
        try {
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
            
            $query = "SELECT * FROM gerente WHERE id = :id";

            $stmt = $conexao->prepare($query);
            $stmt->bindValue(":id", $id);

            $stmt->execute();
            $gerente = $stmt->fetch();

        } catch(Exception $e){
            print("Erro ...<br>".$e->getMessage());
            die();
        }
    }

    if($acao == "salvar"){
        $pagina = "Cadastro";
    } else{
        $pagina = "Alterar Dados";
    }
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <?php include 'link.html';?>
</head>
<body>
    <?php if($id != 0) include '../navbar/nav-gerente.php'; else include '../navbar/nav-outro.php'; ?>
    <div class="container">
        <div class="row mt-4">
            <h5 class="titulo verde text-center">Preencha o Formulário:</h5>
        </div>
        <form action="acao.php" method="post">
            <input type="hidden" name="id" id="id" value="<?=$id?>">
            <div class="row mt-2">
                <div class="col-5">
                    <label for="nome" class="form-label">Nome Completo:</label>
                    <input type="text" name="nome" id="nome" minLength="3" class="form-control border-success text-center" value="<?php if($id != 0) echo $gerente["nome"];?>">
                </div>
                <div class="col-2 ms-4">
                    <label for="dataNasc" class="form-label">Data de Nascimento:</label>
                <input type="date" name="dataNasc" id="dataNasc" class="form-control border-success" value="<?php if($id != 0) echo $gerente["dataNasc"]?>">
                </div>
                <div class="col-4 ms-5">
                    <label for="sexo" class="form-check-label">Sexo:</label>
                    <div class="row mt-3">
                        <div class="col-4">
                            <input type="radio" name="sexo" id="sexo" value="Feminino" class="form-check-input border-success" <?php if($id != 0){if($gerente['sexo'] == "Feminino") echo "checked";}?>> Feminino
                        </div>
                        <div class="col-4">
                            <input type="radio" name="sexo" id="sexo" value="Masculino" class="form-check-input border-success" <?php if($id != 0){if($gerente['sexo'] == "Masculino") echo "checked";}?>> Masculino
                        </div>
                        <div class="col-3">
                            <input type="radio" name="sexo" id="sexo" value="Outro" class="form-check-input border-success" <?php if($id != 0){if($gerente['sexo'] == "Outro") echo "checked";}?>> Outro
                        </div>
                    </div>
                </div>               
            </div>
    
            <div class="row mt-3">
                    <div class="col-3">
                        <label for="cpf" class="form-label">CPF:</label>
                        <input type="text" name="cpf" id="cpf" minLength="11" maxLength="11" class="form-control border-success text-center" placeholder="000.000.000-00" value="<?php if($id != 0) echo $gerente["cpf"]?>">
                    </div>  
                    <div class="col-3">
                        <label for="celular" class="form-label">Celular:</label>
                        <input type="text" name="celular" id="celular" minLength="11" maxLength="11" class="form-control border-success text-center" placeholder="(00) 00000-0000" value="<?php if($id != 0) echo $gerente["celular"]?>">
                    </div>
                    <div class="col-6">
                        <label for="email" class="form-label">E-mail:</label>
                        <input type="email" name="email" id="email" class="form-control border-success text-center" placeholder="dominio@email.com" value="<?php if($id != 0) echo $gerente["email"]?>">    
                    </div>               
                </div>
                
                <div class="row mt-3">
                    <div class="col-3">
                        <label for="cep" class="form-label">CEP:</label>
                        <input type="text" name="cep" id="cep" class="form-control border-success text-center" placeholder="00000-0000" value="<?php if($id != 0) echo $gerente["cep"]?>">
                    </div> 
                    <div class="col-3">
                        <label for="estado" class="form-label">Estado:</label>
                        <select name="estado" id="estado" class="form-select border-success text-center">
                            <option value="selecione" <?php ?>>Selecione um estado...</option>
                            <option value="AC" <?php if($id != 0){if($gerente['estado'] == "AC") echo "selected";}?>>Acre</option>
                            <option value="AL" <?php if($id != 0){if($gerente['estado'] =="AL") echo "selected";}?>>Alagoas</option>
                            <option value="AP" <?php if($id != 0){if($gerente['estado'] =="AP") echo "selected";}?>>Amapá</option>
                            <option value="AM" <?php if($id != 0){if($gerente['estado'] =="AM") echo "selected";}?>>Amazonas</option>
                            <option value="BA" <?php if($id != 0){if($gerente['estado'] =="BA") echo "selected";}?>>Bahia</option>
                            <option value="CE" <?php if($id != 0){if($gerente['estado'] =="CE") echo "selected";}?>>Ceará</option>
                            <option value="DF" <?php if($id != 0){if($gerente['estado'] =="DF") echo "selected";}?>>Distrito Federal</option>
                            <option value="ES" <?php if($id != 0){if($gerente['estado'] =="ES") echo "selected";}?>>Espírito Santo</option>
                            <option value="GO" <?php if($id != 0){if($gerente['estado'] =="GO") echo "selected";}?>>Goiás</option>
                            <option value="MA" <?php if($id != 0){if($gerente['estado'] =="MA") echo "selected";}?>>Maranhão</option>
                            <option value="MT" <?php if($id != 0){if($gerente['estado'] =="MG") echo "selected";}?>>Mato Grosso</option>
                            <option value="MS" <?php if($id != 0){if($gerente['estado'] =="MS") echo "selected";}?>>Mato Grosso do Sul</option>
                            <option value="MG" <?php if($id != 0){if($gerente['estado'] =="MG") echo "selected";}?>>Minas Gerais</option>
                            <option value="PA" <?php if($id != 0){if($gerente['estado'] =="PA") echo "selected";}?>>Pará</option>
                            <option value="PB" <?php if($id != 0){if($gerente['estado'] =="PB") echo "selected";}?>>Paraíba</option>
                            <option value="PR" <?php if($id != 0){if($gerente['estado'] =="PR") echo "selected";}?>>Paraná</option>
                            <option value="PE" <?php if($id != 0){if($gerente['estado'] =="PE") echo "selected";}?>>Pernambuco</option>
                            <option value="PI" <?php if($id != 0){if($gerente['estado'] =="PI") echo "selected";}?>>Piauí</option>
                            <option value="RJ" <?php if($id != 0){if($gerente['estado'] =="RJ") echo "selected";}?>>Rio de Janeiro</option>
                            <option value="RN" <?php if($id != 0){if($gerente['estado'] =="RN") echo "selected";}?>>Rio Grande do Norte</option>
                            <option value="RS" <?php if($id != 0){if($gerente['estado'] =="RS") echo "selected";}?>>Rio Grande do Sul</option>
                            <option value="RO" <?php if($id != 0){if($gerente['estado'] =="RO") echo "selected";}?>>Rondônia</option>
                            <option value="RR" <?php if($id != 0){if($gerente['estado'] =="RR") echo "selected";}?>>Roraima</option>
                            <option value="SC" <?php if($id != 0){if($gerente['estado'] == "SC")echo "selected";}?>>Santa Catarina</option>
                            <option value="SP" <?php if($id != 0){if($gerente['estado'] =="SP") echo "selected";}?>>São Paulo</option>
                            <option value="SE" <?php if($id != 0){if($gerente['estado'] =="SE") echo "selected";}?>>Sergipe</option>
                            <option value="TO" <?php if($id != 0){if($gerente['estado'] =="TO") echo "selected";}?>>Tocantins</option>
                            <option value="EX" <?php if($id != 0){if($gerente['estado'] =="EX") echo "selected";}?>>Estrangeiro</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="cidade" class="form-label">Cidade:</label>
                        <input type="text" name="cidade" id="cidade" class="form-control border-success text-center" value="<?php if($id != 0) echo $gerente["cidade"]?>"> 
                    </div>
                    <div class="col-3">
                        <label for="bairro" class="form-label">Bairro:</label>
                        <input type="text" name="bairro" id="bairro" class="form-control border-success text-center" value="<?php if($id != 0) echo $gerente["bairro"]?>"> 
                    </div>                     
                </div>
    
                <div class="row mt-3">
                    <div class="col-3">
                        <label for="rua" class="form-label">Rua:</label>
                        <input type="text" name="rua" id="rua" class="form-control border-success text-center" value="<?php if($id != 0) echo $gerente["rua"]?>">
                    </div> 
                    <div class="col-7">
                        <label for="complemento" class="form-label">Complemento:</label>
                        <input type="text" name="complemento" id="complemento" class="form-control border-success text-center" placeholder="Ex: Casa" value="<?php if($id != 0) echo $gerente["complemento"]?>">
                    </div>
                    <div class="col-2">
                        <label for="numero" class="form-label">Número:</label>
                        <input type="text" name="numero" id="numero" class="form-control border-success text-center" value="<?php if($id != 0) echo $gerente["numero"]?>">
                    </div>                 
                </div>
    
                <div class="row mt-3">
                    <div class="col-3">
                        <label for="usuario" class="form-label">Nome de usuário:</label>
                        <input type="text" name="usuario" id="usuario" class="form-control border-success text-center" value="<?php if($id != 0) echo $gerente["usuario"];?>">
                    </div>
                    <div class="col-3">
                        <label for="matricula" class="form-label">Matrícula:</label>
                        <input type="text" name="matricula" id="matricula" class="form-control border-success text-center" value="<?php if($id != 0) echo $gerente["matricula"]?>">
                    </div>
                    <div class="col-3">
                        <label for="senha" class="form-label">Criar Senha:</label>
                        <input type="password" name="senha" id="senha" class="form-control border-success text-center" value="<?php if($id != 0) echo $gerente["senha"]?>">
                    </div>
                    <div class="col-3">
                        <label for="confirmaSenha" class="form-label">Confirmar Senha:</label>
                        <input type="password" name="confirmaSenha" id="confirmaSenha" class="form-control border-success text-center">
                    </div>
                </div>
    
                <div class="row mt-4">
                    <div class="col-1">
                        <button class="btn secundario border-success branco texto" name="acao" id="acao" value="<?php if($id != 0) echo "editar"; else echo "Salvar"?>"><?php if($id != 0) echo $acao; else echo "Salvar";?></button>
                    </div>
                </form>
                    <div class="col-1">
                        <?php
                            if($id != 0){
                                echo "<button class='btn btn-secondary border-dark'><a href='conta.php' class='link texto branco'>Voltar</a></button>";
                            } elseif($id == 0){
                                echo "<button class='btn btn-secondary border-dark'><a href='../index.php' class='link texto branco'>Voltar</a></button>";
                            }
                        ?>
                    </div>
                </div>
    </div>
    <script> 
        var erro = <?=$erro?>;
        if(erro == true){
            alert("Não foi possível realizar o cadastro!");
            window.location.href = 'cadastro.php';
        }
    </script>
    <script> 
        var erroUsuario = <?=$erroUsuario?>;
        if(erroUsuario == true){
            alert("Esse nome de usuário não está mais disponível");
            window.location.href = 'cadastro.php';
        }
    </script>
</body>
</html>