<head>
<style>
    /* Dropdown button */
    #nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .dropdown .dropbtn {
        font-size: 16px;
        border: none;
        outline: none;
        background-color: inherit;
        font-family: inherit;
        margin: 0;
        display: block;
        justify-content: center;
    }

    /* Dropdown content (hidden por definição) */
    .dropdown-content {
        margin-top: 17px;
        margin-left: -10px;
        padding-left: 15px;
        display: none;
        align-items: center;
        position: absolute;
        background-color: #739E73;
        height: 268px;
        width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    /* Links inside the dropdown */
    .dropdown-content a {
        color: black;
        background-color: #90BE90;
        width: 123px;
        margin-top: 10px;
        padding: 12px 16px;
        text-decoration: none;
        justify-content: center;
        display: block;
        text-align: center;
    }


    /* Show the dropdown menu on hover */
    .dropdown:hover .dropdown-content {
        display: block;
    }

    #log {
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 12px;
        width: 130px;
    }

    #log .login {
        color: #38C938;
        background-color: #739E73;
    }

    #log .logout {
        color: #C41212;
        background-color: #739E73;
    }

    a {
        font-weight: bold;
    }
</style>
</head>
<body>
    <header>
        <nav style="height:70px;background-color: #2F6427;">
            <div id="nav">
                <div class="dropdown">
                    <button class="dropbtn"><img src="multimidia/images/navButton_39x45.png">
                        <i class="fa fa-caret-down"></i>
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
                </div>
                <!--Logo francisco-->
                <img src="multimidia/images/icon/franciscoLogo_81x47.png" alt="Logo do Francisco Embalagens">
            </div>
        </nav>
    </header>