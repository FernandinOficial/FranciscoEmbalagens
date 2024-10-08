<?php
    session_start();
    
    date_default_timezone_set(getenv('APP_TIMEZONE') ?: 'America/Sao_Paulo');  // Configurando timezone com variável de ambiente

    // echo isset($_SESSION['logado']) && $_SESSION['logado'] ? 'true' : 'false';  //verificar se esta logado (para teste)

    if ($_SESSION['logado'] == false){
      header('Location:../index.php');
      exit;
    }
  ?>