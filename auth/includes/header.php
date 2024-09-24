<head>
    <script defer src="../script/script.js"></script>
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
<nav>
    <?php

    if (isset($_SESSION['logado']) && $_SESSION['logado']) {
        echo 'logado'; // O usuário está logado
        echo '<script>login.remove()</script>';
    } else {
        echo 'não logado'; // O usuário não está logado
    }

    ?>
    <!-- Bootstrap implementado-->
    <div class="dropdown">
        <button id="btn-dropdown" class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../multimidia/images/navButton_39x45.png" alt="Botão de Navegação">
        </button>
        <ul class="dropdown-menu">
            <li><button class="dropdown-item" type="button"><a
                        href="../auth/login.php"><?php echo 'OLÁ, (USER)'; ?></a></button>
            </li>
            <li><button class="dropdown-item" type="button"><a href="../produtos.php">PRODUTOS</a></button></li>
            <li><button class="dropdown-item" type="button"><a href="#footer-logo">CONTATO</a></button></li>
            <li><button class="dropdown-item" type="button"><a onclick="togglePopup()">SOBRE</a></button></li>
            <div id="account">
                <a href="login.php">
                    <li class="account" id="login">LOGIN</li>
                </a>
                <a href="../index.php">
                    <li class="account" id="logout">LOGOUT</li>
                </a>
            </div>
        </ul>
    </div>
    <div id="logo">
        <a href="../index.php"><img src="../multimidia/images/icon/franciscoLogo_200px.png"
                alt="Logo Francisco Embalagens"></a>
    </div>

    <aside class="aside_whats">
        <a href="https://wa.me/19999989819" target="blank"><img src="../multimidia/images/whats.png" alt="WhatsApp"></a>
    </aside>
</nav>
<div class="popup" id="popup-1">
    <div class="overlay"></div>
    <div class="content">
        <div class="close-btn" onclick="togglePopup()">&times;
        </div>
        <h1>Sobre</h1><br>
        <p>Empresa atuando na área de produção de sacolas e embalagens na cidade de Itapira, SP.
            Desde meados de 2015, trazemos qualidade impecável aos nossos produtos e prezamos pelo melhor atendimento
            aos nossos clientes.
            Em caso de interesse em nossos serviços, entre em contato conosco! </p>
    </div>
</div>