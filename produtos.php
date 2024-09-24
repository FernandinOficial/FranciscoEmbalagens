<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos | Francisco Embalagens</title>
    <link rel="shortcut icon" href="multimidia/images/icon.png " type="image/x-icon">
    <link rel="stylesheet" href="style/style.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script defer src="script/script.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');

        body {
            background-color: #FFF;
        }
    </style>
    <script defer src="script/script.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const isLoggedIn = <?php echo isset($_SESSION['logado']) && $_SESSION['logado'] ? 'true' : 'false'; ?>;
            if (isLoggedIn) {
                const login = document.getElementById("login");
                if (login) {
                    login.remove();
                }
            }
        });
    </script>
</head>

<body>
    <?php
    session_start();
    
    if (isset($_SESSION['logado']) && $_SESSION['logado']) {
        echo '<script>login.remove()</script>';
    } else {
    }

    ?>
    <?php
    require_once "includes/header.php";
    ?>

    <main>
        <h1 class="text-center">Sacolas Kraft</h1>
        <div class="container_imgProdutos">
            <img src="multimidia/marketing/produtos/produtoKraft.png" alt="sacolas kraft"
                class="img-fluid img_produtos">
            <img src="multimidia/marketing/produtos/produtoKraft.png" alt="modelos e tamanhos sacolas kraft"
                class="img-fluid img_produtos">
        </div>

        <table>
            <thead>
                <tr>
                    <th>Modelos</th>
                    <th>Dimensões</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>P1</td>
                    <td>15cm x 11,5cm | 5cm</td>
                </tr>
                <tr>
                    <td>P2</td>
                    <td>22cm x 14cm | 7cm</td>
                </tr>
                <tr>
                    <td>P3</td>
                    <td>19cm x 23cm | 8cm</td>
                </tr>
                <tr>
                    <td>P4</td>
                    <td>28cm x 19cm | 8cm</td>
                </tr>
                <tr>
                    <td>P6</td>
                    <td>23cm x 29cm | 12cm</td>
                </tr>
                <tr>
                    <td>P7</td>
                    <td>32cm x 29cm | 12cm</td>
                </tr>
            </tbody>
        </table>

        <br>
        <hr class="hr_produtos">
        <br>
        <h1 class="text-center">Sacolas Plásticas</h1>
        <div class="container_imgProdutos">
            <img src="multimidia/marketing/produtos/produtoPlastico.png" alt="sacolas plásticas"
                class="img-fluid img_produtos">
            <img src="multimidia/marketing/produtos/produtoPlastico.png" alt="modelos e tamanhos sacolas plásticas"
                class="img-fluid img_produtos">
        </div>

        <table>
            <thead>
                <tr>
                    <th>Modelos</th>
                    <th>Dimensões</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>P1</td>
                    <td>15cm x 11,5cm | 5cm</td>
                </tr>
                <tr>
                    <td>P2</td>
                    <td>22cm x 14cm | 7cm</td>
                </tr>
                <tr>
                    <td>P3</td>
                    <td>19cm x 23cm | 8cm</td>
                </tr>
                <tr>
                    <td>P4</td>
                    <td>28cm x 19cm | 8cm</td>
                </tr>
                <tr>
                    <td>P6</td>
                    <td>23cm x 29cm | 12cm</td>
                </tr>
                <tr>
                    <td>P7</td>
                    <td>32cm x 29cm | 12cm</td>
                </tr>
            </tbody>
        </table>
        <br>
        <hr class="hr_produtos">
        <br>
        <h1 class="text-center">Sacolas Plásticas</h1>
        <div class="container_imgProdutos">
            <img src="multimidia/marketing/produtos/produtoKraft.png" alt="sacolas kraft"
                class="img-fluid img_produtos">
            <img src="multimidia/marketing/produtos/produtoKraftTamanhos.png" alt="modelos e tamanhos sacolas kraft"
                class="img-fluid img_produtos">
        </div>

        <table>
            <thead>
                <tr>
                    <th>Modelos</th>
                    <th>Dimensões</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>P1</td>
                    <td>15cm x 11,5cm | 5cm</td>
                </tr>
                <tr>
                    <td>P2</td>
                    <td>22cm x 14cm | 7cm</td>
                </tr>
                <tr>
                    <td>P3</td>
                    <td>19cm x 23cm | 8cm</td>
                </tr>
                <tr>
                    <td>P4</td>
                    <td>28cm x 19cm | 8cm</td>
                </tr>
                <tr>
                    <td>P6</td>
                    <td>23cm x 29cm | 12cm</td>
                </tr>
                <tr>
                    <td>P7</td>
                    <td>32cm x 29cm | 12cm</td>
                </tr>
            </tbody>
        </table>
        <br><br>
        <?php
        require_once 'includes/footer.php';
        ?>