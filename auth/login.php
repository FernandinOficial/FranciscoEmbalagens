<?php
session_start();

if (isset($_SESSION['logado'])) {
    header('Location:../index.php');
    exit;
}
?>
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
    include_once 'includes/db_connect.php'; // Incluindo a conexão com o banco
    
    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Verifica se os campos estão preenchidos
        if (empty($email)) {
            echo "<p>E-mail é obrigatório.</p>";
        } elseif (empty($password)) {
            echo "<p>Senha é obrigatória.</p>";
        } else {
            // Prepara a consulta
            $stmt = $mysqli->prepare("SELECT id_usu, nome_usu FROM `Usuario` WHERE email_usu = ? AND senha = ?");
            $stmt->bind_param('ss', $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            // Verifica se o usuário existe 
            if ($result->num_rows > 0) {
                // Busca os dados do usuário
                $user = $result->fetch_assoc(); // Armazena os dados do usuário
                $_SESSION['logado'] = true; // Marcar como logado
                $_SESSION['nome'] = $user['nome_usu']; // nome do usuário na sessão
                $id = $user['id_usu']; // ID do usuário na sessão
                $_SESSION['id'] = $id;
    
                // Redireciona após o login
                echo '<script>window.location.href = "../index.php";</script>';
                exit;
            } else {
                echo "<p>E-mail ou senha incorretos.</p>";
            }

        }
    }
    ?>

    <?php
    include_once 'includes/header.php';
    ?>
    <main id="container">
        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post" id="form_login">
            <div class="title_user">
                <img src="../multimidia/images/usuario.png" alt="Logo de usuário">
                <h2>LOGIN</h2>
            </div>

            <div class="inputs">
                <!-- COMEÇO FORM -->
                <!-- EMAIL -->
                <label for="email">E-mail</label><br>
                <i class="fa-solid fa-envelope"></i>
                <input type="email" id="email" name="email"><br><br>

                <!-- SENHA -->
                <label for="password">Senha</label><br>
                <i class="fa-solid fa-key"></i>
                <input type="password" id="password" name="password"><br>
                <!-- FIM FORM -->

                <a href="password/recuperar_senha.php" id="a_login" style="font-size: 13px;">Esqueceu sua senha?</a>
                <br><br>
                <input type="submit" value="Entrar" id="input_submit">
            </div><br>

            <div class="img_icons">
                Login With:
                <a href="#"><img src="../multimidia/images/google.png" alt="Ícone do google"></a>
                <a href="#"><img src="../multimidia/images/facebook.png" alt="Ícone do facebook"></a>
            </div><br>

            <a href="cadastro.php" id="a_login">Não possui uma conta?</a>
        </form>
    </main>
    <?php
    require_once 'includes/footer.php';
    ?>