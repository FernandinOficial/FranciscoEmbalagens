<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Francisco Embalagens</title>
    <link rel="shortcut icon" href="multimidia/images/cadeado.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/style.css" type="text/css">
    <script defer src="script/script.js"></script>
</head>

<body>
    <?php
    include_once 'header.php';
    ?>
    <main>
        <form action="index.php" method="post">
            <div id="login_title">
                <img class="login_icon" src="multimidia/images/iconMeuUsuario.png" alt="Ícone de usuário">
            </div>
            <h2>LOGIN</h2>
            <label for="email">E-mail</label>
            <input type="email" name="email"><br>

            <label for="senha">Senha</label>
            <input type="password" name="password"><br>

            <div class="login_with">
                <h5>Login with:</h5>
                <img src="multimidia/images/icon_google.png" alt=" Ícone Google">
                <img src="" alt="Ícone Facebook"><br>
            </div>

            <div class="login_submit">
                <input type="submit" value="Entrar" id="login_submit"><br>
            </div>

            <h5>Não tem uma conta? acesse <a href="cadastro.php">aqui</h5>
        </form>
    </main>
</body>

</html>