<?php 
$_SESSION['logado'] = false;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Francisco Embalagens</title>
    <link rel="shortcut icon" href="multimidia/images/icon.png " type="image/x-icon">
    <link rel="stylesheet" href="style/style.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <style>
        /*importando fontes*/
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');

        /* mudar a cor das setas para preta */
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            filter: invert(0%) sepia(100%) saturate(0%) hue-rotate(0deg) brightness(0%) contrast(100%);
        }

        /* tamanho das setas do carrossel */
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            width: 20px;
            height: 20px;
        }

        * {
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #FFF;
        }
    </style>
</head>

<body>
    <?php
        session_start(); // inicia a sessão de logado
    ?>

    <?php
    require_once 'includes/header.php';
    ?>
    <main>
        <!-- CAROUSEL bootstrap -->
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" data-bs-interval="7000">
            <!-- Botões Inferiores do Carousel -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="3"
                    aria-label="Slide 4"></button>
            </div>

            <!-- Bannerss/Imagens/Vídeos -->
            <div class="carousel-inner">
                <!-- Primeiro Banner -->
                <div class="carousel-item active">
                    <img class="d-block w-100" src="multimidia/marketing/mk/1-1.png" alt="First slide">
                </div>
                <!-- Segundo Banner -->
                <div class="carousel-item">
                    <video class="d-block w-100" src="multimidia/marketing/mk/videoMarketing-1.mp4" type="video/mp4"
                        autoplay muted loop id="video-mkt"></video>
                </div>
                <!-- Terceiro Banner -->
                <div class="carousel-item">
                    <img class="d-block w-100" src="multimidia/marketing/mk/2-2.png" alt="Second slide">
                </div>
                <!-- Quarto Banner -->
                <div class="carousel-item">
                    <img class="d-block w-100" src="multimidia/marketing/mk/3-3.png" alt="Third slide">
                </div>
            </div>

            <!-- Controles laterais (seta) -->
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>

        <!-- MOSTRUÁRIO DESKTOP -->
        <div class="container" id="most-desk">
            <div class="row">
                <!-- Primeiro bloco -->
                <div class="col-12 d-flex justify-content-between align-items-center" id="invertido">
                    <div class="container_texto text-center me-3">
                        <h4 class="texto-titulo">DESIGNS ÚNICOS</h4>
                        <p class="texto-menor">Sacolas personalizadas no melhor estilo <br>que você deseja, com
                            qualidade e <br>designs únicos.</p>
                    </div>
                    <img src="multimidia/marketing/mk/sacolasImagem1_380px.png" alt="" class="img-fluid">
                </div>

                <!-- Segundo bloco -->
                <div class="col-12 d-flex justify-content-between align-items-center" id="teste">
                    <img src="multimidia/marketing/mk/sacolasImagem2_350px.png" alt="" class="img-fluid me-3">
                    <div class="container_texto text-center">
                        <h4 class="texto-titulo">ANOS DE SERVIÇO</h4>
                        <p class="texto-menor">Há mais de cinco anos, nos dedicamos a <br>satisfazer nossos clientes com
                            produtos e <br>serviços de alta qualidade.</p>
                    </div>
                </div>

                <!-- Terceiro bloco -->
                <div class="col-12 d-flex justify-content-between align-items-center" id="invertido">
                    <div class="container_texto text-center me-3">
                        <h4 class="texto-titulo">ESTILO E COMPROMISSO <br> AMBIENTAL</h4>
                        <p class="texto-menor">Sacolas lindas e sustentáveis para levar <br>onde e quando quiser. Estilo
                            e <br>responsabilidade ambiental unidos para <br>seu cotidiano.</p>
                    </div>
                    <img src="multimidia/marketing/mk/sacolasImagem3_350px.png" alt="" class="img-fluid">
                </div>
            </div>
        </div>
        <!-- FIM MOSTRUÁRIO DESKTOP -->

        <!-- MOSTRUÁRIO MOBILE -->
        <div class="container" id="most-mob">
            <div class="row">
                <!-- Primeiro bloco -->
                <div class="col-12 text-center mb-4">
                    <img src="multimidia/marketing/mk/sacolasImagem1_380px.png" alt=""
                        class="img-fluid mx-auto d-block">
                    <div class="container_texto text-center mt-3">
                        <h4 class="texto-titulo">DESIGNS ÚNICOS</h4>
                        <p class="texto-menor">Sacolas personalizadas no melhor estilo <br>que você deseja, com
                            qualidade e <br>designs únicos.</p>
                    </div>
                </div>

                <!-- Segundo bloco -->
                <div class="col-12 text-center mb-4">
                    <img src="multimidia/marketing/mk/sacolasImagem2_350px.png" alt=""
                        class="img-fluid mx-auto d-block">
                    <div class="container_texto text-center mt-3">
                        <h4 class="texto-titulo">ANOS DE SERVIÇO</h4>
                        <p class="texto-menor">Há mais de cinco anos, nos dedicamos a <br>satisfazer nossos clientes com
                            produtos e <br>serviços de alta qualidade.</p>
                    </div>
                </div>

                <!-- Terceiro bloco -->
                <div class="col-12 text-center">
                    <img src="multimidia/marketing/mk/sacolasImagem3_350px.png" alt=""
                        class="img-fluid mx-auto d-block">
                    <div class="container_texto text-center mt-3">
                        <h4 class="texto-titulo">ESTILO E COMPROMISSO <br> AMBIENTAL</h4>
                        <p class="texto-menor">Sacolas lindas e sustentáveis para levar <br>onde e quando quiser. Estilo
                            e <br>responsabilidade ambiental unidos para <br>seu cotidiano.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIM MOSTRUÁRIO MOBILE -->

    </main>
    <?php
    require_once 'includes/footer.php';
    ?>