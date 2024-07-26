<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');

        .inter {
            font-family: "Inter", sans-serif;
        }
        *{
            margin: 0;
            padding: 0;
        }
        nav {
            height: 170px;
            background-color: #2F6427;
            display: flex;
            justify-content: ;
            align-items: center;
        }
        nav #logo{
            
        }
        /* Dropdown button */
        #dropdown{
            display: flex;
        }
        #dropdown img{
            width: 120px;
        }
        .dropdown-content{
            display: none;
        }

    </style>
    <script defer src="js/script.js"></script> <!--defer indica que o js vai ser executado apos a compilaçõo do HTML-->
</head>

<body>
    <header>
        <nav>
            <div id="dropdown">
                <button id="dropbtn">
                    <img src="multimidia/images/navButton_39x45.png">
                </button>
                <div class="dropdown-content">
                    <a href="#">OLÁ, USER</a>
                    <a href="#">PRODUTO</a>

                    <a href="#">CONTATO</a>
                    <a href="#">SOBRE</a>

                    <ul>
                        <li id="log">
                            <a href="" class="login">LOGIN</a>
                            <a href="" class="logout">LOGOUT</a>
                        </li>
                    </ul>
                </div>
                <!--Logo francisco-->
                <img id="logo" src="multimidia/images/icon/franciscoLogo_81x47.png" alt="Logo do Francisco Embalagens">
            </div>
        </nav>
    </header>