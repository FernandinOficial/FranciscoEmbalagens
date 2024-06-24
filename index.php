<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Francisco Embalagens</title>
    <link rel="shortcut icon" href="multimidia/images/icon.png " type="image/x-icon">
    <link rel="stylesheet" href="style/style.css" type="text/css">
    <link rel="stylesheet" href="style/index.css" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .container {
            margin-top: 10vh;
        }

        .img-banner {
            width: 100vw;
            height: 20vh;
        }

        .carousel-indicators li {
            /*São os botoes radio input*/
            width: 12px;
            height: 12px;
            position: relative;
            top: 55px;
            /*onde se posiciona o input*/
            background-color: #bbb;
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            /*curta transição*/
            border: none;
        }

        .carousel-indicators .active {
            /*São os botoes radio input apos ativos*/
            background-color: #717171;
            transform: scale(1.2);
        }

        .carousel-indicators li:hover {
            /*São os botoes radio input apos passar o cursor por cima*/
            background-color: #555;
        }


        
        /* Dropdown button */
        .dropdown .dropbtn {
            font-size: 16px;
            border: none;
            outline: none;
            padding: 14px 16px;
            background-color: inherit;
            font-family: inherit;
            /* Important for vertical align on mobile phones */
            margin: 0;
            /* Important for vertical align on mobile phones */
        }
        /* Add a red background color to navbar links on hover */
        .navbar a:hover,
        .dropdown:hover .dropbtn {
            background-color: red;
        }

        /* Dropdown content (hidden by default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            float: none;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        /* Add a grey background color to dropdown links on hover */
        .dropdown-content a:hover {
            background-color: #ddd;
        }

        /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {
            display: block;
        }

    </style>
</head>
    <?php 
        require_once 'header.php';
    ?>
    <main>
        <div class="container"> <!--container pai-->
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicadores -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <!--Tipo de radio para ir no banner-->
                    <li data-target="#myCarousel" data-slide-to="1"></li> <!--Tipo de radio para ir no banner-->
                    <li data-target="#myCarousel" data-slide-to="2"></li> <!--Tipo de radio para ir no banner-->
                </ol>

                <!--Troca de banners -->
                <div class="carousel-inner">

                    <div class="item active">
                        <img src="multimidia/marketing/1.png" alt="banner 1" class="img-banner" style="height: 20vh;">
                        <div class="carousel-caption"> <!--carrosel capturado-->
                        </div>
                    </div>

                    <div class="item">
                        <img src="multimidia/marketing/2.png" alt="banner 2" class="img-banner" style="height: 20vh;">
                        <div class="carousel-caption"> <!--carrosel capturado-->
                        </div>
                    </div>

                    <div class="item">
                        <img src="multimidia/marketing/3.png" alt="banner 3" class="img-banner" style="height: 20vh;">
                        <div class="carousel-caption"> <!--carrosel capturado-->
                        </div>
                    </div>
                </div>

                <!-- Left and right controles ou setas para passar o banner -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </main>
    <?php
        require_once 'footer.php';
    ?>