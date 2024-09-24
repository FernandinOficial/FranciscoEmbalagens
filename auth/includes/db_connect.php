<?php
    include_once 'db_config.php';
    $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
    
    // vai checar a conexão e se der falha vai mostrar um erro
    if ($mysqli->connect_errno) {
        die("Falha ao conectar ao Banco de Dados: " . $mysqli->connect_error);
    }
