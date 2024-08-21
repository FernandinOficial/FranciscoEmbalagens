<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | Francisco Embalagens</title>
    <link rel="shortcut icon" href="multimidia/images/cadeado.png" type="image/x-icon">
    <link rel="stylesheet" href="style/style.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script defer src="script/script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
        /*importando fontes*/
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
    </style>
</head>
<style>
    #container {
        width: 235px;
        height: 380px;
        margin-left: auto;
        margin-right: auto;
        background-color: #739E73;
        border-radius: 30px;
        box-shadow: 5px 5px 8px rgba(0, 0, 0, 0.336);
        height: fit-content;
        margin-top: 75px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    #form_cadastro {
        padding: 20px;
    }

    .title_cadastro img {
        height: 60px;
        width: 60px;
        margin-left: auto;
        margin-right: auto;
    }

    .img_cadastro img {
        height: 38px;
        width: 38px;
        background-color: #fff;
        padding: 4px;
        border-radius: 30px;
    }

    .inputs_cadastro input {
        height: 36px;
        width: 199px;
        border-radius: 30px;
        border: none;
    }

    #cadastro_submit {
        height: 36px;
        width: 199px;
        border-radius: 30px;
        border: none;
        background-color: #2F6427;
        color: #ACEFAC;
        font-weight: bold;
    }

    #a_cadastro {
        color: #ACEFAC;
    }
</style>

<body>
    <?php
    require_once 'header.php';
    ?>
    <main id="container">
        <form action="index.php" method="post" id="form_cadastro">
            <div class="title_cadastro">
                <img src="multimidia/images/usuario.png" alt="Logo de usuário">
                <h2>Cadastrar-se</h2>
            </div><br>

            <div class="inputs_cadastro">
                <label for="name">Nome</label><br>
                <i class="fa-solid fa-user"></i>
                <input type="text" id="name" name="name"><br>

                <label for="lastname">Sobrenome</label><br>
                <i class="fa-solid fa-user"></i>
                <input type="text" id="lastname" name="lastname"><br>

                <label for="email">E-mail</label><br>
                <i class="fa-solid fa-envelope"></i>
                <input type="email" id="email" name="email"><br>

                <label for="password">Senha</label><br>
                <i class="fa-solid fa-key"></i>
                <input type="password" id="password" name="password"><br><br>

                <input type="submit" name="Cadastrar" id="cadastro_submit">
            </div><br>

            <div class="img_cadastro">
                <a href="#"><img src="multimidia/images/google.png" alt="Ícone do google"></a>
                <a href="#"><img src="multimidia/images/facebook.png" alt="Ícone do facebook"></a>
            </div><br>

            <a href="login.php" id="a_cadastro">Já possui uma conta?</a>
        </form>
        </form>
    </main>
</body>


</html>