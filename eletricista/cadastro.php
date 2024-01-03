<!DOCTYPE html>
<?php
    include '../sql/config.php';
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "Salvar";
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    
    if($acao = "editar"){
        try {
            $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
            
            $query = "SELECT * FROM eletricista WHERE id = :id";

            $stmt = $conexao->prepare($query);
            $stmt->bindValue(":id", $id);

            $stmt->execute();
            $eletricista = $stmt->fetch();

        } catch(Exception $e){
            print("Erro ...<br>".$e->getMessage());
            die();
        }
    }
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <form action="acao.php" method="post">
        <input type="text" readonly name="id" id="id" value="<?=$id?>">
        <div class="row mt-2">
            <div class="col-5">
                <label for="nome" class="form-label">Nome Completo:</label>
                <input type="text" name="nome" id="nome" class="form-control border-success text-center" value="<?php if($id != 0) echo $eletricista["nome"];?>" required>
            </div>
            <div class="col-2 ms-4">
                <label for="dataNasc" class="form-label">Data de Nascimento:</label>
            <input type="date" name="dataNasc" id="dataNasc" class="form-control border-success" value="<?php if($id != 0) echo $eletricista["dataNasc"]?>" required>
            </div>
            <div class="col-4 ms-5">
                <label for="sexo" class="form-check-label">Sexo:</label>
                <div class="row mt-3">
                    <div class="col-4">
                        <input type="radio" name="sexo" id="sexo" value="Feminino" class="form-check-input border-success" <?php if($id != 0){if($eletricista['sexo'] == "Feminino") echo "checked";}?>> Feminino
                    </div>
                    <div class="col-4">
                        <input type="radio" name="sexo" id="sexo" value="Masculino" class="form-check-input border-success" <?php if($id != 0){if($eletricista['sexo'] == "Masculino") echo "checked";}?>> Masculino
                    </div>
                    <div class="col-3">
                        <input type="radio" name="sexo" id="sexo" value="Outro" class="form-check-input border-success" <?php if($id != 0){if($eletricista['sexo'] == "Outro") echo "checked";}?>> Outro
                    </div>
                </div>
            </div>               
        </div>

        <div class="row mt-3">
                <div class="col-3">
                    <label for="cpf" class="form-label">CPF:</label>
                    <input type="text" name="cpf" id="cpf" class="form-control border-success text-center" placeholder="000.000.000-00" value="<?php if($id != 0) echo $eletricista["cpf"]?>" required>
                </div>  
                <div class="col-3">
                    <label for="celular" class="form-label">Celular:</label>
                    <input type="text" name="celular" id="celular" class="form-control border-success text-center" placeholder="(00) 00000-0000" value="<?php if($id != 0) echo $eletricista["celular"]?>" required>
                </div>
                <div class="col-6">
                    <label for="email" class="form-label">E-mail:</label>
                    <input type="text" name="email" id="email" class="form-control border-success text-center" placeholder="dominio@email.com" value="<?php if($id != 0) echo $eletricista["email"]?>" required>    
                </div>               
            </div>
            
            <div class="row mt-3">
                <div class="col-3">
                    <label for="cep" class="form-label">CEP:</label>
                    <input type="text" name="cep" id="cep" class="form-control border-success text-center" placeholder="00000-0000" value="<?php if($id != 0) echo $eletricista["cep"]?>" required>
                </div> 
                <div class="col-3">
                    <label for="estado" class="form-label">Estado:</label>
                    <select name="estado" id="estado" class="form-select border-success text-center" required>
                        <option value="selecione" <?php ?>>Selecione um estado...</option>
                        <option value="AC" <?php if($id != 0){if($eletricista['estado'] == "AC") echo "selected";}?>>Acre</option>
                        <option value="AL" <?php if($id != 0){if($eletricista['estado'] =="AL") echo "selected";}?>>Alagoas</option>
                        <option value="AP" <?php if($id != 0){if($eletricista['estado'] =="AP") echo "selected";}?>>Amapá</option>
                        <option value="AM" <?php if($id != 0){if($eletricista['estado'] =="AM") echo "selected";}?>>Amazonas</option>
                        <option value="BA" <?php if($id != 0){if($eletricista['estado'] =="BA") echo "selected";}?>>Bahia</option>
                        <option value="CE" <?php if($id != 0){if($eletricista['estado'] =="CE") echo "selected";}?>>Ceará</option>
                        <option value="DF" <?php if($id != 0){if($eletricista['estado'] =="DF") echo "selected";}?>>Distrito Federal</option>
                        <option value="ES" <?php if($id != 0){if($eletricista['estado'] =="ES") echo "selected";}?>>Espírito Santo</option>
                        <option value="GO" <?php if($id != 0){if($eletricista['estado'] =="GO") echo "selected";}?>>Goiás</option>
                        <option value="MA" <?php if($id != 0){if($eletricista['estado'] =="MA") echo "selected";}?>>Maranhão</option>
                        <option value="MT" <?php if($id != 0){if($eletricista['estado'] =="MG") echo "selected";}?>>Mato Grosso</option>
                        <option value="MS" <?php if($id != 0){if($eletricista['estado'] =="MS") echo "selected";}?>>Mato Grosso do Sul</option>
                        <option value="MG" <?php if($id != 0){if($eletricista['estado'] =="MG") echo "selected";}?>>Minas Gerais</option>
                        <option value="PA" <?php if($id != 0){if($eletricista['estado'] =="PA") echo "selected";}?>>Pará</option>
                        <option value="PB" <?php if($id != 0){if($eletricista['estado'] =="PB") echo "selected";}?>>Paraíba</option>
                        <option value="PR" <?php if($id != 0){if($eletricista['estado'] =="PR") echo "selected";}?>>Paraná</option>
                        <option value="PE" <?php if($id != 0){if($eletricista['estado'] =="PE") echo "selected";}?>>Pernambuco</option>
                        <option value="PI" <?php if($id != 0){if($eletricista['estado'] =="PI") echo "selected";}?>>Piauí</option>
                        <option value="RJ" <?php if($id != 0){if($eletricista['estado'] =="RJ") echo "selected";}?>>Rio de Janeiro</option>
                        <option value="RN" <?php if($id != 0){if($eletricista['estado'] =="RN") echo "selected";}?>>Rio Grande do Norte</option>
                        <option value="RS" <?php if($id != 0){if($eletricista['estado'] =="RS") echo "selected";}?>>Rio Grande do Sul</option>
                        <option value="RO" <?php if($id != 0){if($eletricista['estado'] =="RO") echo "selected";}?>>Rondônia</option>
                        <option value="RR" <?php if($id != 0){if($eletricista['estado'] =="RR") echo "selected";}?>>Roraima</option>
                        <option value="SC" <?php if($id != 0){if($eletricista['estado'] == "SC")echo "selected";}?>>Santa Catarina</option>
                        <option value="SP" <?php if($id != 0){if($eletricista['estado'] =="SP") echo "selected";}?>>São Paulo</option>
                        <option value="SE" <?php if($id != 0){if($eletricista['estado'] =="SE") echo "selected";}?>>Sergipe</option>
                        <option value="TO" <?php if($id != 0){if($eletricista['estado'] =="TO") echo "selected";}?>>Tocantins</option>
                        <option value="EX" <?php if($id != 0){if($eletricista['estado'] =="EX") echo "selected";}?>>Estrangeiro</option>
                    </select>
                </div>
                <div class="col-3">
                    <label for="cidade" class="form-label">Cidade:</label>
                    <input type="text" name="cidade" id="cidade" class="form-control border-success text-center" value="<?php if($id != 0) echo $eletricista["cidade"]?>" required> 
                </div>
                <div class="col-3">
                    <label for="bairro" class="form-label">Bairro:</label>
                    <input type="text" name="bairro" id="bairro" class="form-control border-success text-center" value="<?php if($id != 0) echo $eletricista["bairro"]?>" required> 
                </div>                     
            </div>

            <div class="row mt-3">
                <div class="col-3">
                    <label for="rua" class="form-label">Rua:</label>
                    <input type="text" name="rua" id="rua" class="form-control border-success text-center" value="<?php if($id != 0) echo $eletricista["rua"]?>" required>
                </div> 
                <div class="col-7">
                    <label for="complemento" class="form-label">Complemento:</label>
                    <input type="text" name="complemento" id="complemento" class="form-control border-success text-center" placeholder="Ex: Casa" value="<?php if($id != 0) echo $eletricista["complemento"]?>">
                </div>
                <div class="col-2">
                    <label for="numero" class="form-label">Número:</label>
                    <input type="text" name="numero" id="numero" class="form-control border-success text-center" value="<?php if($id != 0) echo $eletricista["numero"]?>">
                </div>                 
            </div>

            <div class="row mt-3">
                <div class="col-3">
                    <label for="usuario" class="form-label">Nome de usuário:</label>
                    <input type="text" name="usuario" id="usuario" class="form-control border-success text-center" value="<?php if($id != 0) echo $eletricista["usuario"];?>" required>
                </div>
                <div class="col-3">
                    <label for="gerente" class="form-label">Gerente Responsável:</label>
                    <select name="gerente" id="gerente" class="form-select border-success text-center" required>
                        <?php
                            try{
                                $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
                
                                $query = "SELECT * FROM gerente";
                
                                $stmt = $conexao->prepare($query);
                                $stmt->execute();
                                $gerentes = $stmt->fetchAll();
                                
                                foreach($gerentes as $value){
                                    echo "<option value='{$value['id']}'>{$value['nome']}</option>";
                                }
                            }catch(Exception $e){
                                print("Erro ...<br>".$e->getMessage());
                                die();
                            }
                        ?>
                    </select>
                </div>
                <div class="col-3">
                    <label for="matricula" class="form-label">Matrícula:</label>
                    <input type="text" name="matricula" id="matricula" class="form-control border-success text-center" value="<?php if($id != 0) echo $eletricista["matricula"]?>" required>
                </div>
                <div class="col-3">
                    <label for="senha" class="form-label">Criar Senha:</label>
                    <input type="password" name="senha" id="senha" class="form-control border-success text-center" value="<?php if($id != 0) echo $eletricista["senha"]?>" required>
                </div>
                <div class="col-3">
                    <label for="confirmaSenha" class="form-label">Confirmar Senha:</label>
                    <input type="password" name="confirmaSenha" id="confirmaSenha" class="form-control border-success text-center" required>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-1">
                    <button class="btn btn-secondary border-dark"><a href="index.html" class="link texto branco">Voltar</a></button>
                </div>
                <div class="col-1">
                    <button class="btn secundario border-success branco texto" name="acao" id="acao" value="<?php if($id != 0) echo "editar"; else echo "Salvar"?>"><?php if($id != 0) echo $acao; else echo "Salvar";?></button>
                </div>
            </div>
    </form>
</body>
</html>