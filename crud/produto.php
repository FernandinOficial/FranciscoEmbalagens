<?php
include_once '../auth/includes/db_connect.php';

$erro = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["desc_prod"], $_POST["valor_prod"])) {
        //Validando campos obrigatórios
        if (empty($_POST["desc_prod"]) || empty($_POST["valor_prod"])) {
            $erro = "Todos os campos são obrigatórios.";
        } else {
            $id_prod = isset($_POST["id_prod"]) ? $_POST["id_prod"] : -1;
            $desc_prod = $_POST["desc_prod"];
            $valor_prod = $_POST["valor_prod"];

            //Inserindo ou atualizando no banco de dados
            if ($id_prod == -1) {
                $stmt = $mysqli->prepare("INSERT INTO `Produto` (`desc_prod`, `valor_prod`) VALUES (?, ?)");
                $stmt->bind_param("ss", $desc_prod, $valor_prod);

                if ($stmt->execute()) {
                    header("Location: produto.php");
                    exit;
                } else {
                    $erro = "Erro ao cadastrar produto: " . $stmt->error;
                }
            } else {
                $erro = "Operação não suportada.";
            }
        }
    } else {
        $erro = "Todos os campos são obrigatórios.";
    }
}

//Processamento para deletar produto
if (isset($_GET["id_prod"]) && is_numeric($_GET["id_prod"]) && isset($_GET["del"])) {
    $id_prod = (int) $_GET["id_prod"];
    $stmt = $mysqli->prepare("DELETE FROM `Produto` WHERE id_prod = ?");
    $stmt->bind_param('i', $id_prod);
    $stmt->execute();

    header("Location: produto.php");
    exit;
}

//Preenchendo os valores para edição
$desc_prod = isset($_POST["desc_prod"]) ? $_POST["desc_prod"] : "";
$valor_prod = isset($_POST["valor_prod"]) ? $_POST["valor_prod"] : "";
$id_prod = isset($_POST["id_prod"]) ? $_POST["id_prod"] : -1;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto</title>
</head>

<body>
    <?php if (!empty($erro)): ?>
        <p><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>
    
    <form action="produto.php" method="POST">
        <div class="container">
            <fieldset id="fieldsetcad">
                <legend>
                    <h1>Produto</h1>
                </legend>

                <label for="desc_prod">Descrição do produto:</label><br>
                <input type="text" name="desc_prod" value="<?= htmlspecialchars($desc_prod) ?>" required><br><br>

                <label for="valor_prod">Preço:</label><br>
                <input type="text" name="valor_prod" value="<?= htmlspecialchars($valor_prod) ?>" required><br><br>

                <input type="hidden" name="id_prod" value="<?= htmlspecialchars($id_prod) ?>">
                <button type="submit" style="cursor: pointer;"><?= ($id_prod == -1) ? "Cadastrar" : "Salvar" ?></button>
                <br><br>
            </fieldset>
        </div>
    </form>
</body>

</html>