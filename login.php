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
            padding: 10px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .title {
            border-radius: 25px 25px 0 0;
            box-shadow: 8px 5px 5px #333;
            background-color: #D9D9D9;
            border-bottom: 2px solid #333;
        }

        form {
            border-radius: 0 0 25px 25px;
            box-shadow: 8px 5px 5px #333;
            background-color: #D9D9D9;
        }

        img {
            background-color: #D9D9D9;
            border-radius: 10px;
            box-shadow: 5px 2px 2px #333;
        }

        input {
            border-radius: 15px;
            background-color: #CACACA;
        }
        
    </style>
</head>

<body>
    <header>
        <img src="multimidia/images/icon/franciscoLogo_100x35.png" alt="">
    </header>
    <main>
        <div class="title">
            <h1>Faça seu login</h1>
        </div>
        <form action="autenticar.php">
            <label for="email">Email</label><br>
            <input type="email" name="email" placeholder="Email"><br><br>

            <label for="password">Password</label><br>
            <input type="password" name="password" placeholder="Password"><br><br>

            <label for="reapeat">Repeat Password</label><br>
            <input type="password" name="repeat" placeholder="Repeat"><br><br>
            <input type="submit" value="Enviar">
        </form>
    </main>
</body>

</html>