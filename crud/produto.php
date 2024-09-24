<?php
include_once '../auth/includes/db_connect.php';

$erro = '';

//Inserir/Atualizar Produto
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["desc_prod"], $_POST["valor_prod"])) {
        //Validando campos obrigatórios
        if (empty($_POST["desc_prod"]) || empty($_POST["valor_prod"]) || empty($_POST["status_prod"])) {
            $erro = "Todos os campos são obrigatórios.";
        } else {
            $id_prod = isset($_POST["id_prod"]) ? $_POST["id_prod"] : -1;
            $desc_prod = $_POST["desc_prod"];
            $valor_prod = $_POST["valor_prod"];
            $status_prod = $_POST["status_prod"];

            //Inserindo ou atualizando no banco de dados
            if ($id_prod == -1) {
                $stmt = $mysqli->prepare("INSERT INTO `Produto` (`desc_prod`, `valor_prod`, `status_prod`) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $desc_prod, $valor_prod, $status_prod);

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

//Buscar produtos para exibição
$produtos = $mysqli->query("SELECT * FROM Produto ORDER BY id_prod DESC");

if (!$produtos) {
    $erro = "Erro ao buscar produtos: " . $mysqli->error;
}

//Preenchendo os valores para edição
$desc_prod = isset($_POST["desc_prod"]) ? $_POST["desc_prod"] : "";
$valor_prod = isset($_POST["valor_prod"]) ? $_POST["valor_prod"] : "";
$status_prod = isset($_POST["status_prod"]) ? $_POST["status_prod"] : "";
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

                <label for="valor_prod">Valor:</label><br>
                <input type="text" name="valor_prod" value="<?= htmlspecialchars($valor_prod) ?>" required><br><br>

                <label for="status_prod">Status do produto:</label><br>
                <select name="status_prod" required>
                    <option value="ativo" <?= ($status_prod == "ativo") ? "selected" : "" ?>>Ativo</option>
                    <option value="inativo" <?= ($status_prod == "inativo") ? "selected" : "" ?>>Inativo</option>
                </select><br><br>

                <input type="hidden" name="id_prod" value="<?= htmlspecialchars($id_prod) ?>">
                <button type="submit" style="cursor: pointer;"><?= ($id_prod == -1) ? "Cadastrar" : "Salvar" ?></button>
                <br><br>
            </fieldset>
        </div>
    </form>

    <hr>

    <!-- Exibição dos produtos -->
    <h2>Lista de Produtos</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descrição do produto</th>
                <th>Preço</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($produto = $produtos->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($produto['id_prod']) ?></td>
                    <td><?= htmlspecialchars($produto['desc_prod']) ?></td>
                    <td><?= htmlspecialchars($produto['valor_prod']) ?></td>
                    <td><?= htmlspecialchars($produto['status_prod']) ?></td>
                    <td>
                        <!-- Botão de editar -->
                        <form action="produto.php" method="POST" style="display:inline-block;">
                            <input type="hidden" name="id_prod" value="<?= $produto['id_prod'] ?>">
                            <input type="hidden" name="desc_prod" value="<?= htmlspecialchars($produto['desc_prod']) ?>">
                            <input type="hidden" name="valor_prod" value="<?= htmlspecialchars($produto['valor_prod']) ?>">
                            <input type="hidden" name="status_prod"
                                value="<?= htmlspecialchars($produto['status_prod']) ?>">
                            <button type="submit">Editar</button>
                        </form>
                        <!-- Botão de deletar -->
                        <a href="produto.php?id_prod=<?= $produto['id_prod'] ?>&del=1"
                            onclick="return confirm('Tem certeza que deseja desabilitar este produto?')">Desabilitar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>