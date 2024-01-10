<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargo</title>
    <?php include 'link.html'; ?>
</head>
<body>
    <?php include "navbar/nav-todos.php"; ?>
    <div class="container">
        <br><br>
        <div class="col-6 card-senha mt-5">
            <br><br>
            <div class="row">
                <div class="col-12">
                    <h4 class="titulo verde text-center">Quem é você?</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h6 class="texto verde text-center">Antes de começar o cadastro, <br> 
                        selecione qual o seu cargo dentro da empresa:</h6>
                </div>
            </div>
            <br>
            <form action="funcao/acao.php" method="post">
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <select name="cargo" id="cargo" class="form-select text-center">
                            <option value="eletricista">Eletricista</option>
                            <option value="gerente">Gerente</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-4"></div>
                    <div class="col-2">
                        <button class="btn btn-secondary border-dark"><a href="index.php" class="link branco">Voltar</a></button>
                    </div>
                    <div class="col-2">
                        <button class="btn secundario branco border-success" type="submit" name="acao" id="acao" value="cadastrar">Continuar</button>
                    </div>
                </div>
            </form>
            <br><br>
        </div>
    </div>
</body>
</html> 