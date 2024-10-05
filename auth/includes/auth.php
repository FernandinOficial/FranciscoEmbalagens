<?php
    session_start();

    // echo isset($_SESSION['logado']) && $_SESSION['logado'] ? 'true' : 'false';  //verificar se esta logado (para teste)

    if ($_SESSION['logado'] == false){
      header('Location:../index.php');
      exit;
    }
  ?>