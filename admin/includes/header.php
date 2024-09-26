<head>
    <script defer src="../script/script.js"></script>
    <script defer src="script/script.js"></script>
</head>
<nav>
    <!-- Bootstrap implementado-->
    <div class="dropdown">
        <button id="btn-dropdown" class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../multimidia/images/navButton_39x45.png" alt="Botão de Navegação">
        </button>
        <ul class="dropdown-menu">
            <li><button class="dropdown-item" type="button"><a href="cliente.php">Cliente</a></button></li>
            <li><button class="dropdown-item" type="button"><a href="compra.php">Compra</a></button></li>
            <li><button class="dropdown-item" type="button"><a href="fornecedor.php">Fornecedor</a></button></li>
            <li><button class="dropdown-item" type="button"><a href="itens_compra.php">Itens Compra</a></button></li>
            <li><button class="dropdown-item" type="button"><a href="itens_os.php">Itens da OS</a></button></li>
            <li><button class="dropdown-item" type="button"><a href="ordem_servico.php">Ordem de Serviço</a></button>
            </li>
            <li><button class="dropdown-item" type="button"><a href="produto.php">Produtos</a></button></li>
            <li><button class="dropdown-item" type="button"><a href="servico.php">Serviço</a></button></li>
        </ul>
    </div>
    <div id="logo">
        <a href="../index.php"><img src="../multimidia/images/icon/franciscoLogo_200px.png" alt="Logo Francisco Embalagens"></a>
    </div>
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