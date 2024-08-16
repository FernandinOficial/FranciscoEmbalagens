<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | Francisco Embalagens</title>
    <link rel="shortcut icon" href="multimidia/images/cadeado.png" type="image/x-icon">
    <link rel="stylesheet" href="style/style.css" type="text/css">
    <script defer src="script/script.js"></script>
</head>

<body>
    <?php
    require_once 'header.php';
    ?>
    <main>
        <div class="title">
            <img class="user" src="multimidia/images/iconMeuUsuario.png" alt="Ícone de usuário"><br><br><br>
        </div>
        <form action="autenticar.php" method="post">

            <label for="name">Nome</label><br>
            <input type="text" name="name"><br><br>

            <label for="lname">Sobrenome</label><br>
            <input type="text" name="lname"><br><br>

            <label for="email">Email</label><br>
            <input type="email" name="email"><br><br>

            <label for="senha">Senha</label><br>
            <input type="password" name="senha"><br><br><br>

            <div class="apis">
                <h5>Resgister with:</h5>
                <div><img src="" alt=""></div>
                <div><img src="" alt=""></div>
            </div>
            <br>

            <div id="submit">
                <input type="submit" value="Cadastrar" id="submit">
            </div><br><br>
            <h5>Já possui uma conta? Clique <a id="link_login" href="login.html">aqui</a></h5><br><br>
            </div>
        </form>
    </main>
</body>


</html>