<?php
include_once 'auth.php';  //verificar se esta logado
include_once '../auth/includes/db_connect.php';

$erro = '';
$success = '';

// Inserir/Atualizar Itens de Compra
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id_compra"], $_POST["id_prod"], $_POST["preco"])) {
        if (empty($_POST["id_compra"]) || empty($_POST["id_prod"]) || empty($_POST["preco"])) {
            $erro = "Todos os campos são obrigatórios.";
        } else {
            $id_compra = $_POST["id_compra"];
            $id_prod = $_POST["id_prod"];
            $preco = $_POST["preco"];
            $id_item = isset($_POST["id_item"]) ? $_POST["id_item"] : null;

            if ($id_item === null) { // Inserir novo item
                $stmt = $mysqli->prepare("INSERT INTO Itens_Compra (id_compra, id_prod, preco) VALUES (?, ?, ?)");
                $stmt->bind_param("iis", $id_compra, $id_prod, $preco);

                if ($stmt->execute()) {
                    $success = "Item de compra registrado com sucesso.";
                } else {
                    $erro = "Erro ao registrar item de compra: " . $stmt->error;
                }
            } else { // Atualizar item existente
                $stmt = $mysqli->prepare("UPDATE Itens_Compra SET preco = ? WHERE id_compra = ? AND id_prod = ?");
                $stmt->bind_param("dii", $preco, $id_compra, $id_prod);

                if ($stmt->execute()) {
                    $success = "Item de compra atualizado com sucesso.";
                } else {
                    $erro = "Erro ao atualizar item de compra: " . $stmt->error;
                }
            }
        }
    } else {
        $erro = "Todos os campos são obrigatórios.";
    }
}

// Remover Item de Compra
if (isset($_GET["id_compra"], $_GET["id_prod"])) {
    $id_compra = (int) $_GET["id_compra"];
    $id_prod = (int) $_GET["id_prod"];

    $stmt = $mysqli->prepare("DELETE FROM Itens_Compra WHERE id_compra = ? AND id_prod = ?");
    $stmt->bind_param('ii', $id_compra, $id_prod);
    if ($stmt->execute()) {
        $success = "Item de compra removido com sucesso.";
    } else {
        $erro = "Erro ao remover item de compra: " . $stmt->error;
    }
}

// Listar Itens de Compra
$result = $mysqli->query("SELECT ic.*, p.nome_prod FROM Itens_Compra ic LEFT JOIN Produto p ON ic.id_prod = p.id_prod");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Itens de Compra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <?php
    include_once 'includes/header.php';
    ?>
    <h1>Cadastro de Itens de Compra</h1>

    <?php if (!empty($erro)): ?>
        <p style="color: red;"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <p style="color: green;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <!-- Formulário para adicionar ou editar item de compra -->
    <form action="itens_compra.php" method="POST">
        <input type="hidden" name="id_item" value="<?= isset($_POST['id_item']) ? $_POST['id_item'] : '' ?>">

        <label for="id_compra">ID da Compra:</label><br>
        <input type="number" name="id_compra"
            value="<?= isset($_POST['id_compra']) ? htmlspecialchars($_POST['id_compra']) : '' ?>" required><br><br>

        <label for="id_prod">ID do Produto:</label><br>
        <input type="number" name="id_prod"
            value="<?= isset($_POST['id_prod']) ? htmlspecialchars($_POST['id_prod']) : '' ?>" required><br><br>

        <label for="preco">Preço:</label><br>
        <input type="text" name="preco" value="<?= isset($_POST['preco']) ? htmlspecialchars($_POST['preco']) : '' ?>" required><br><br>

        <button type="submit"><?= (isset($_POST['id_item'])) ? 'Salvar' : 'Cadastrar' ?></button>
    </form>

    <hr>

    <!-- Exibição dos itens de compra -->
    <h2>Lista de Itens de Compra</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID da Compra</th>
                <th>ID do Produto</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($item = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($item['id_compra']) ?></td>
                    <td><?= htmlspecialchars($item['id_prod']) ?></td>
                    <td><?= htmlspecialchars($item['preco']) ?></td>
                    <td>
                        <a href="itens_compra.php?id_compra=<?= $item['id_compra'] ?>&id_prod=<?= $item['id_prod'] ?>" onclick="return confirm('Tem certeza que deseja remover este item de compra?')">Remover</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>