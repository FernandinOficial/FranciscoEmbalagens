<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Francisco Embalagens</title>
    <link rel="shortcut icon" href="multimidia/images/cadeado.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/style.css" type="text/css">
    <script defer src="script/script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"/>
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

    #form_login {
        padding: 25px;
    }

    .title_user {
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
    }

    .title_user img {
        height: 60px;
        width: 60px;
    }
    .title_user h2 {
        margin-top: 20px;
        font-size: 25px;
    }

    .img_icons img {
        height: 38px;
        width: 38px;
        background-color: #fff;
        padding: 4px;
        border-radius: 30px;
    }

    .inputs input {
        height: 36px;
        width: 199px;
        border-radius: 30px;
        border: none;
    }
    .inputs label {
        font-size: 15px;
        font-weight: bold;
    }
    .inputs i {
        margin-top: 5px;
        margin-bottom: 5px;
    }

    #input_submit {
        height: 36px;
        width: 200px;
        border-radius: 30px;
        border: none;
        background-color: #2F6427;
        color: #ACEFAC;
        font-weight: bold;
    }

    #a_login {
        color: #ACEFAC;
    }
</style>

<body>
    <?php
    include_once 'header.php';
    ?>
    <main id="container">
        <form action="index.php" method="post" id="form_login">
            <div class="title_user">
                <img src="multimidia/images/usuario.png" alt="Logo de usuário">
                <h2>LOGIN</h2>
            </div><br>

            <div class="inputs">
                <label for="email">E-mail</label><br>
                <i class="fa-solid fa-envelope"></i>
                <input type="email" id="email" name="email"><br><br>

                <label for="password">Senha</label><br>
                <i class="fa-solid fa-key"></i>
                <input type="password" id="password" name="password"><br><br><br>

                <input type="submit" value="Entrar" id="input_submit">
            </div><br><br>

            <div class="img_icons">
                <a href="#"><img src="multimidia/images/google.png" alt="Ícone do google"></a>
                <a href="#"><img src="multimidia/images/facebook.png" alt="Ícone do facebook"></a>
            </div><br><br>

            <a href="cadastro.php" id="a_login">Esqueceu a senha?</a>
        </form>
    </main>
</body>

</html>