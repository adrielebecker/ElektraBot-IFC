<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="funcao/acao.php" method="post">
        <label for="usuario" class="form-label texto verde">USUÁRIO:</label>
        <input type="text" name="usuario" id="usuario" class="form-control border-success">

        <label for="cargo" class="form-label texto verde">CARGO:</label>
        <select name="cargo" id="cargo" class="form-select border-success">
            <option value="Eletricista">Eletricista</option>
            <option value="Gerente">Gerente</option>
        </select>

        <label for="senha" class="form-label texto verde">SENHA:</label>
        <input type="password" name="senha" id="senha" class="form-control border-success">

        <button class="btn secundario border-success" type="submit" name="acao" id="acao" value="entrar">Entrar</button>
    </form>
</body>
</html>