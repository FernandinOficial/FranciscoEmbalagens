<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Francisco Embalagens</title>
    <link rel="shortcut icon" href="multimidia/images/icon.png " type="image/x-icon">
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script defer src="script/script.js"></script>
</head>

<body>
    <?php
    require_once 'header.php';
    ?>
    <main>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="multimidia/marketing/mk/1.png" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="multimidia/marketing/mk/2.png" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="multimidia/marketing/mk/3.png" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div id="itens">
            <img class="imgs-itens" src="multimidia/marketing/mk/1.png" alt="Sacolas Personalizadas">
            <h4>DESIGNS UNICOS</h4>
            <p>Sacolas personalizadas no melhor estilo que você deseja, com qualidade e designs únicos.</p>

            <img class="imgs-itens" src="multimidia/marketing/mk/1.png" alt="Anos de Serviço">
            <h4>ANOS DE SERVIÇO</h4>
            <p>Há mais de cinco anos, nos dedicamos a satisfazer nossos clientes com produtos e serviços de alta
                qualidade.</p>

            <img class="imgs-itens" src="multimidia/marketing/mk/1.png" alt="Estilos e Compromisso ambiental">
            <h4>ESTILO E COMPROMISSO AMBIENTAL</h4>
            <p>Sacolas lindas e sustentáveis para levar onde e quando quiser. Estilo e responsabilidade ambiental unidos
                para seu cotidiano.</p>
        </div>
    </main>
    <?php
    require_once 'footer.php';
    ?>