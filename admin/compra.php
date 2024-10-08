<?php
include_once 'auth.php';  // Verifica se está logado
include_once '../auth/includes/db_connect.php';

date_default_timezone_set('America/Sao_Paulo');  //Brasilia

$erro = '';
$success = '';

// Inserir/Atualizar Compra
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["data_compra"], $_POST["id_for"], $_POST["id_usu"], $_POST["prev_entrega"], $_POST["preco_compra"])) {
        if (empty($_POST["data_compra"]) || empty($_POST["id_for"]) || empty($_POST["id_usu"]) || empty($_POST["prev_entrega"]) || empty($_POST["preco_compra"])) {
            $erro = "Todos os campos são obrigatórios.";
        } else {
            $id_compra = isset($_POST["id_compra"]) ? $_POST["id_compra"] : -1;

            // Verifique se o campo data_compra foi preenchido
            $data_compra = $_POST["data_compra"]; // pega a data do formulário ou a data atual

            $id_for = $_POST["id_for"];
            $id_usu = $_POST["id_usu"];
            $prev_entrega = $_POST["prev_entrega"];
            $preco_compra = $_POST["preco_compra"];
            $data_entrega_efetiva = !empty($_POST["data_entrega_efetiva"]) ? $_POST["data_entrega_efetiva"] : null;

            if ($id_compra == -1) { // Inserir nova compra
                $stmt = $mysqli->prepare("INSERT INTO Compra (data_compra, id_for, id_usu, prev_entrega, data_entrega_efetiva, preco_compra) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("siisds", $data_compra, $id_for, $id_usu, $prev_entrega, $data_entrega_efetiva, $preco_compra);

                if ($stmt->execute()) {
                    $success = "Compra registrada com sucesso.";
                } else {
                    $erro = "Erro ao registrar compra: " . $stmt->error;
                }
            } else { // Atualizar compra existente
                $stmt = $mysqli->prepare("UPDATE Compra SET data_compra = ?, id_for = ?, id_usu = ?, prev_entrega = ?, data_entrega_efetiva = ?, preco_compra = ? WHERE id_compra = ?");
                $stmt->bind_param("siisdis", $data_compra, $id_for, $id_usu, $prev_entrega, $data_entrega_efetiva, $preco_compra, $id_compra);

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
    <title>Compras | Francisco Embalagens</title>
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
        <input type="hidden" name="id_compra" value="<?= isset($_GET['id_compra']) ? $_GET['id_compra'] : -1 ?>">

        <!-- Campo para a data da compra -->
        <input type="hidden" name="data_compra" value="<?= date('Y-m-d H:i:s') ?>">

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

        <label for="prev_entrega">Previsão de Entrega:</label><br>
        <input type="date" name="prev_entrega"
            value="<?= isset($_POST['prev_entrega']) ? htmlspecialchars($_POST['prev_entrega']) : '' ?>" required><br><br>

        <label for="preco_compra">Preço da Compra:</label><br>
        <input type="number" step="0.01" name="preco_compra" min="0.01"
            value="<?= isset($_POST['preco_compra']) ? htmlspecialchars($_POST['preco_compra']) : '' ?>" required><br><br>

        <label for="data_entrega_efetiva">Data de Entrega Efetiva (opcional):</label><br>
        <input type="date" name="data_entrega_efetiva"
            value="<?= isset($_POST['data_entrega_efetiva']) ? htmlspecialchars($_POST['data_entrega_efetiva']) : '' ?>"><br><br>

        <button type="submit"><?= (isset($_POST['id_compra']) && $_POST['id_compra'] != -1) ? 'Salvar' : 'Cadastrar' ?></button>
    </form>

    <hr>

    <!-- Exibição das compras -->
    <h2>Lista de Compras</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID Compra</th>
                <th>Data Compra</th>
                <th>Fornecedor</th>
                <th>Usuário</th>
                <th>Previsão de Entrega</th>
                <th>Data Entrega Efetiva</th>
                <th>Preço</th>
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
                    <td><?= htmlspecialchars($compra['prev_entrega']) ?></td>
                    <td><?= htmlspecialchars($compra['data_entrega_efetiva']) ?></td>
                    <td><?= htmlspecialchars($compra['preco_compra']) ?></td>
                    <td>
                        <a href="compra.php?id_compra=<?= $compra['id_compra'] ?>">Editar</a>
                        <a href="compra.php?id_compra=<?= $compra['id_compra'] ?>&delete=true"
                            onclick="return confirm('Tem certeza que deseja remover esta compra?')">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>
