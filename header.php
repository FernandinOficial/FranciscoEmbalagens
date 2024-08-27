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
            <li><button class="dropdown-item" type="button"><a href="">CONTATO</a></button></li>
            <li><button class="dropdown-item" type="button"><a href="">SOBRE</a></button></li>
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
        <a href="index.php"><img src="multimidia/images/icon/franciscoLogo_81x47.png"
                alt="Logo Francisco Embalagens"></a>
    </div>

    <aside class="aside_whats">
        <a href="https://wa.me/19999989819"><img src="multimidia/images/whats.png" alt="WhatsApp"></a>
    </aside>
    <aside class="aside_gmail">
        <a href="#"><img src="multimidia/images/gmail.png" alt="Gmail"></a>
    </aside>
</nav>
<aside id="home">
    <a class="home" href="index.php"><img src="multimidia/images/home_35px.png" alt="Home"></a>
</aside>