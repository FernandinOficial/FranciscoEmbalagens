<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box; /* Adicionado para garantir que padding e border não afetem o tamanho dos elementos */
        }

        ul {
            list-style-type: none;
            padding: 0; /* Adicionado para remover padding extra */
        }

        nav {
            height: 80px;
            background-color: #2F6427;
            display: flex;
            align-items: center;
            position: relative; /* Adicionado para posicionar dropdown-content corretamente */
        }

        .dropdown-content {
            display: none;
            background-color: green;
            color: white;
            width: 150px;
            position: absolute; /* Adicionado para posicionar dropdown-content abaixo do botão */
            top: 100%; /* Coloca o dropdown abaixo do botão */
            left: 0;
            z-index: 1; /* Garante que o dropdown apareça acima de outros elementos */
            padding: 10px 0; /* Adicionado para espaçar o conteúdo */
        }

        a {
            text-decoration: none;
            color: white; /* Alterado para garantir que os links sejam visíveis sobre o fundo verde */
        }

        #dropdown {
            position: relative;
            display: inline-block;
        }

        #dropdownHeader {
            display: flex;
            align-items: center; /* Adicionado para centralizar verticalmente o conteúdo */
        }

        #dropbtn {
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer; /* Adicionado para indicar que é um botão clicável */
        }

        #dropbtn img {
            margin-left: 10px; /* Adicionado para adicionar espaçamento ao lado da imagem */
            background-image: url(multimidia/images/navButton_39x45.png);
        }
        #dropdownHeader{
            width: 400px;
            display: flex;
            justify-content: space-around;
            background-color: red;
        }
    </style>
    <script defer src="js/script.js"></script>
</head>

<body>
    <nav>
        <div id="dropdown">
            <div id="dropdownHeader">
                <button id="dropbtn">Mostrar</button>
                <!-- Logo Francisco -->
                <img id="logo" src="multimidia/images/icon/franciscoLogo_81x47.png" alt="Logo do Francisco Embalagens">
            </div>
            <div class="dropdown-content">
                <ul>
                    <li>Produtos</li>
                    <li><a href="headerTeste.html">Header Embalagens</a></li>
                </ul>
            </div>
        </div>
    </nav>