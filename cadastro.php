<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="multimidia/images/cadeado.png" type="image/x-icon">
    <link rel="stylesheet" href="style/style.css" type="text/css">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        a {
            text-decoration: none;
            color: green;
        }

        main {
            padding: 60px;
        }

        .title {
            border-radius: 25px 25px 0 0;
            background-color: #739E73;
            text-align: center;
        }

        form {
            border-radius: 0 0 25px 25px;
            background-color: #739E73;
            text-align: center;
        }

        form div {
            padding-top: 20px;
        }

        input {
            border-radius: 30px;
            background-color: #fff;
            width: 190px;
            margin-left: 0;
            margin-right: 0;
            padding: 10px;
            font-size: 12px;
            border: none;
            margin-top: 3px;
        }

        #submit input {
            margin-left: auto;
            margin-right: auto;
            width: 200px;
            color: #ACEFAC;
            background-color: #2F6427;
            font-weight: bold;
            font-size: 16px;
            border: none;
        }

        h5 {
            float: left;
            margin-left: 15px;
        }

        .user {
            margin-top: 10px;
            margin-bottom: 10px;
            width: 50px;
        }
    </style>
</head>

<body>
    <?php
    require_once 'header.php';
    ?>
    <main>
        <div class="title">
            <img class="user" src="multimidia/images/iconMeuUsuario.png" alt="Ícone de usuário">
        </div>
        <form action="autenticar.php">

            <label for="name">Nome</label><br>
            <input type="text" name="nome"><br><br>

            <label for="snome">Sobrenome</label><br>
            <input type="text" name="snome"><br><br>

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
            </div><br>
            <h5>Já possui uma conta? Clique <a href="login.html">aqui</a></h5><br><br>
            </div>
        </form>
    </main>
</body>


</html>