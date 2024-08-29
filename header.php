<head>
    <script defer src="script/script.js"></script>
</head>
<nav>
    <!-- Bootstrap implementado-->
    <div class="dropdown">
        <button id="btn-dropdown" class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="multimidia/images/navButton_39x45.png" alt="Botão de Navegação">
        </button>
        <ul class="dropdown-menu">
            <li><button class="dropdown-item" type="button"><a
                        href="login.php"><?php echo 'OLÁ, (USER)'; ?></a></button>
            </li>
            <li><button class="dropdown-item" type="button"><a href="produto.php">PRODUTOS</a></button></li>
            <li><button class="dropdown-item" type="button"><a href="#footer-logo">CONTATO</a></button></li>
            <li><button class="dropdown-item" onclick="togglePopup()">SOBRE</button></li>
            <div id="account">
                <a href="login.php">
                    <li class="account" id="login">LOGIN</li>
                </a>
                <a href="index.php">
                    <li class="account" id="logout">LOGOUT</li>
                </a>
            </div>
        </ul>
    </div>
    <div id="logo">
        <a href="index.php"><img src="multimidia/images/icon/franciscoLogo_200px.png"
                alt="Logo Francisco Embalagens"></a>
    </div>

    <aside class="aside_whats">
        <a href="https://wa.me/19999989819" target="blank"><img src="multimidia/images/whats.png" alt="WhatsApp"></a>
    </aside>
</nav>
<div class="popup" id="popup-1">
    <div class="overlay"></div>
    <div class="content">
        <div class="close-btn" onclick="togglePopup()">&times;
        </div>
        <h1>Sobre</h1><br>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo aspernatur laborum rem sed laudantium
            excepturi veritatis voluptatum architecto, dolore quaerat totam officiis nisi animi accusantium alias
            inventore nulla atque debitis.</p>
    </div>
</div>
<aside id="home">
    <a class="home" href="index.php"><img src="multimidia/images/home_35px.png" alt="Home"></a>
</aside>