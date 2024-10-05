<?php
include_once 'auth.php';  //verificar se esta logado
include_once '../auth/includes/db_connect.php';

$erro = '';
$success = '';

// Inserir/Atualizar Compra
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["data_compra"], $_POST["id_for"], $_POST["id_usu"], $_POST["previsao_entrega_compra"])) {
        if (empty($_POST["data_compra"]) || empty($_POST["id_for"]) || empty($_POST["id_usu"]) || empty($_POST["previsao_entrega_compra"])) {
            $erro = "Todos os campos são obrigatórios.";
        } else {
            $id_compra = isset($_POST["id_compra"]) ? $_POST["id_compra"] : -1;
            $data_compra = $_POST["data_compra"];
            $id_for = $_POST["id_for"];
            $id_usu = $_POST["id_usu"];
            $previsao_entrega_compra = $_POST["previsao_entrega_compra"];

            if ($id_compra == -1) { // Inserir nova compra
                $stmt = $mysqli->prepare("INSERT INTO Compra (data_compra, id_for, id_usu, previsao_entrega_compra) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("siis", $data_compra, $id_for, $id_usu, $previsao_entrega_compra);

                if ($stmt->execute()) {
                    $success = "Compra registrada com sucesso.";
                } else {
                    $erro = "Erro ao registrar compra: " . $stmt->error;
                }
            } else { // Atualizar compra existente
                $stmt = $mysqli->prepare("UPDATE Compra SET data_compra = ?, id_for = ?, id_usu = ?, previsao_entrega_compra = ? WHERE id_compra = ?");
                $stmt->bind_param("siisi", $data_compra, $id_for, $id_usu, $previsao_entrega_compra, $id_compra);

                if ($stmt->execute()) {
                    $success = "Compra atualizada com sucesso.";
                } else {
                    $erro = "Erro ao atualizar compra: " . $stmt->error;
                }
            }
        }
    } else {
        $erro = "Todos os campos são obrigatórios.";
    }
}

// Remover Compra
if (isset($_GET["id_compra"]) && is_numeric($_GET["id_compra"])) {
    $id_compra = (int) $_GET["id_compra"];

    $stmt = $mysqli->prepare("DELETE FROM Compra WHERE id_compra = ?");
    $stmt->bind_param('i', $id_compra);
    if ($stmt->execute()) {
        $success = "Compra removida com sucesso.";
    } else {
        $erro = "Erro ao remover compra: " . $stmt->error;
    }
}

// Listar Compras
$result = $mysqli->query("SELECT c.*, f.nome_for, u.nome_usu FROM Compra c LEFT JOIN Fornecedor f ON c.id_for = f.id_for LEFT JOIN Usuario u ON c.id_usu = u.id_usu");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Compras</title>
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
    <h1>Cadastro de Compras</h1>

    <?php if (!empty($erro)): ?>
        <p style="color: red;"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <p style="color: green;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <!-- Formulário para adicionar ou editar compra -->
    <form action="compra.php" method="POST">
        <input type="hidden" name="id_compra" value="<?= isset($_POST['id_compra']) ? $_POST['id_compra'] : -1 ?>">

        <label for="data_compra">Data da Compra:</label><br>
        <input type="date" name="data_compra"
            value="<?= isset($_POST['data_compra']) ? htmlspecialchars($_POST['data_compra']) : '' ?>" required><br><br>

        <label for="id_for">Fornecedor:</label><br>
        <select name="id_for" required>
            <option value="">Selecione um fornecedor</option>
            <?php
            // Listar fornecedores para o dropdown
            $fornecedores = $mysqli->query("SELECT id_for, nome_for FROM Fornecedor");
            while ($fornecedor = $fornecedores->fetch_assoc()) {
                $selected = (isset($_POST['id_for']) && $_POST['id_for'] == $fornecedor['id_for']) ? 'selected' : '';
                echo "<option value='{$fornecedor['id_for']}' $selected>{$fornecedor['nome_for']}</option>";
            }
            ?>
        </select><br><br>

        <label for="id_usu">Usuário:</label><br>
        <select name="id_usu" required>
            <option value="">Selecione um usuário</option>
            <?php
            // Listar usuários para o dropdown
            $usuarios = $mysqli->query("SELECT id_usu, nome_usu FROM Usuario");
            while ($usuario = $usuarios->fetch_assoc()) {
                $selected = (isset($_POST['id_usu']) && $_POST['id_usu'] == $usuario['id_usu']) ? 'selected' : '';
                echo "<option value='{$usuario['id_usu']}' $selected>{$usuario['nome_usu']}</option>";
            }
            ?>
        </select><br><br>

        <label for="previsao_entrega_compra">Previsão de Entrega:</label><br>
        <input type="date" name="previsao_entrega_compra" value="<?= isset($_POST['previsao_entrega_compra']) ? htmlspecialchars($_POST['previsao_entrega_compra']) : '' ?>" required><br><br>

        <button type="submit"><?= (isset($_POST['id_compra']) && $_POST['id_compra'] != -1) ? 'Salvar' : 'Cadastrar' ?></button>
    </form>

    <hr>

    <!-- Exibição das compras -->
    <h2>Lista de Compras</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Data da Compra</th>
                <th>Fornecedor</th>
                <th>Usuário</th>
                <th>Previsão de Entrega</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($compra = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($compra['id_compra']) ?></td>
                    <td><?= htmlspecialchars($compra['data_compra']) ?></td>
                    <td><?= htmlspecialchars($compra['nome_for']) ?></td>
                    <td><?= htmlspecialchars($compra['nome_usu']) ?></td>
                    <td><?= htmlspecialchars($compra['previsao_entrega_compra']) ?></td>
                    <td>
                        <a href="compra.php?id_compra=<?= $compra['id_compra'] ?>" onclick="return confirm('Tem certeza que deseja remover esta compra?')">Remover</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>