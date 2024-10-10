<?php 
include_once '../auth/includes/auth.php';

echo '<a href="../index.php">HOME</a><br><br>';

// Verificar se a requisição foi feita via clique no link
if (isset($_GET['subdir'])) {
    // Armazenar o subdiretório passado como parâmetro
    $subdirectory = $_GET['subdir'];

    // Exibir o valor
    echo "Subdiretório: " . htmlspecialchars($subdirectory) . "<br>";

    // Chamar o script Bash e passar a variável como argumento
    $output = shell_exec('/bin/addOs.bash ' . escapeshellarg($subdirectory) . ' 2>&1');
    
    // Exibir a saída do script Bash
    echo "<pre>Saída do addOs.bash:\n$output</pre>";

    // Chamar o comando npm run e passar a variável como argumento
    $npmCommand = 'npm test'; // Substitua pelo nome do seu script
    $npmOutput = shell_exec($npmCommand . ' 2>&1');
    
    // Exibir a saída do comando npm
    echo "<pre>Saída do npm run:\n$npmOutput</pre>";
} else {
    echo "Nenhum subdiretório especificado.";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testes</title>
</head>
<body>
    <h1>Área de Testes</h1>
    <p style="background-color: #ff4d4d;width: max-content;">Uso para PROGRAMADORES<br>NÃO CLIQUE</p>

    <!-- Link para executar o script PHP passando o subdiretório -->
    <a href="index.php?subdir=fernando2024">addOs</a>
</body>
</html>
