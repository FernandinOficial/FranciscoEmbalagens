<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Francisco Embalagens</title>
    <link rel="shortcut icon" href="multimidia/images/icon.png " type="image/x-icon">
    <link rel="stylesheet" href="style/style.css">
    <script defer src="script/script.js"></script>
</head>

<body>
    <?php
    require_once 'header.php';
    ?>
    <main>
        <div class="carrossel">
            <div class="container" id="img">
                <img class="banner" src="multimidia/marketing/mk/1.png" alt="Banner 1">
                <img class="banner" src="multimidia/marketing/mk/2.png" alt="Banner 2">
                <img class="banner" src="multimidia/marketing/mk/3.png" alt="Banner 3">
            </div>
        </div>
        <div id="itens">
            <img class="imgs-itens" src="multimidia/marketing/mk/1.png" alt="Sacolas Personalizadas">
            <p>Sacolas personalizadas no melhor estilo que você deseja, com qualidade e design únicos.</p>

            <img class="imgs-itens" src="multimidia/marketing/mk/1.png" alt="Anos de Serviço">
            <p>Há mais de cinco anos, nos dedicamos a satisfazer nossos clientes com produtos e serviços de alta
                qualidade.</p>

            <img class="imgs-itens" src="multimidia/marketing/mk/1.png" alt="Estilos e Compromisso ambiental">
            <p>Sacolas lindas e sustentáveis para levar onde e quando quiser. Estilo e responsabilidade ambiental unidos
                para seu cotidiano.</p>
        </div>
    </main>
    <?php
    require_once 'footer.php';
    ?>