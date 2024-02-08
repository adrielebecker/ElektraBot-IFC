<!DOCTYPE html>
<?php
    $cadastro = isset($_GET['cadastro']) ? $_GET['cadastro'] : "";
    $excluido = isset($_GET['excluido']) ? $_GET['excluido'] : "";
    $incorreto = isset($_GET['incorreto']) ? $_GET['incorreto'] : "";
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php include 'link.html'; ?>
</head>
<body>
    <?php include "navbar/nav-todos.php"?>
    <div class="container">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-4 mt-5">
                <br><br>
                <img src="img/login/eletricista.png" alt="" width="60%">
            </div>
            <div class="col-1"></div>
            <div class="col-6 card-login">
                <br><br><br>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <h4 class="titulo verde text-center">Login</h4>
                    </div>
                </div>
                <form action="funcao/acao.php" method="post">
                    <div class="row mt-3">
                        <div class="col-2"></div>
                        <div class="col-6 ms-5">
                            <label for="usuario" class="form-label texto verde">USUÁRIO:</label>
                            <input type="text" name="usuario" id="usuario" class="form-control border-success">
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-6 ms-5">
                            <label for="cargo" class="form-label texto verde">CARGO:</label>
                            <select name="cargo" id="cargo" class="form-select border-success">
                                <option value="eletricista">Eletricista</option>
                                <option value="gerente">Gerente</option>
                            </select>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-6 ms-5">
                            <label for="senha" class="form-label texto verde">SENHA:</label>
                            <input type="password" name="senha" id="senha" class="form-control border-success">
                        </div>
                    </div>
        
                    <div class="row mt-4">
                        <div class="col-5"></div>
                        <div class="col-2 ms-2">
                            <button class="btn secundario border-success" type="submit" name="acao" id="acao" value="entrar">Entrar</button>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <a href="cadastrar.php" class="text-end text-success">Cadastrar</a>
                    </div>
                </form>
                <br>
            </div>
        </div>
    </div>
    <script language="javascript">
        var cadastro = <?=$cadastro;?>;
        if(cadastro == true){
            alert("Cadastro efetuado com sucesso!");
        }
    </script>
    <script>
        var excluido = <?=$excluido?>;
        if(excluido == true){
            alert("A conta foi excluída com sucesso!");
        }
    </script>
    <script>
        var incorreto = <?=$incorreto?>;
        if(incorreto == true){
            alert("Usuário ou senha incorretos!");
        }
    </script>
</body>
</html>