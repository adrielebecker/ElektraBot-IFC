<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>
</head>
<body>
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
</body>
</html>