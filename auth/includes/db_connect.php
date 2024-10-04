<?php
    include_once 'db_config.php';
    $mysqli = new mysqli("31.170.167.153", "u335479363_alunos4", '$en4C2024', "u335479363_alunos4");
    
    // vai checar a conexão e se der falha vai mostrar um erro
    if ($mysqli->connect_errno) {
        die('Falha ao conectar ao Banco de Dados: ' . $mysqli->connect_error);
    }
