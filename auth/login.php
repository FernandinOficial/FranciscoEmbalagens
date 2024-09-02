<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Francisco Embalagens</title>
    <link rel="shortcut icon" href="../multimidia/images/cadeado.png" type="image/x-icon">
    <link rel="stylesheet" href="../style/style.css" type="text/css">
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

        body {
            background-color: #FFF;
        }
    </style>
</head>

<body>
    <?php
    include_once 'includes/header.php';
    ?>
    <main id="container">
        <form action="../index.php" method="post" id="form_login">
            <div class="title_user">
                <img src="../multimidia/images/usuario.png" alt="Logo de usuário">
                <h2>LOGIN</h2>
            </div>

            <div class="inputs">
                <label for="email">E-mail</label><br>
                <i class="fa-solid fa-envelope"></i>
                <input type="email" id="email" name="email" required><br><br>

                <label for="password">Senha</label><br>
                <i class="fa-solid fa-key"></i>
                <input type="password" id="password" name="password" required><br>
                <a href="password/recuperar_senha.php" id="a_login" style="font-size: 13px;">Esqueceu sua senha?</a>
                <br><br>
                <input type="submit" value="Entrar" id="input_submit">
            </div><br>

            <div class="img_icons">
                <a href="#"><img src="../multimidia/images/google.png" alt="Ícone do google"></a>
                <a href="#"><img src="../multimidia/images/facebook.png" alt="Ícone do facebook"></a>
            </div><br>

            <a href="cadastro.php" id="a_login">Não possui uma conta?</a>
        </form>
    </main>
    <?php
    require_once 'includes/footer.php';
    ?>