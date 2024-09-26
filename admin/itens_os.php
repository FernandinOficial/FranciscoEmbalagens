<?php
include_once '../auth/includes/db_connect.php';

$erro = '';
$success = '';

// Inserir/Atualizar Item de Ordem de Serviço
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id_ordem_servico"], $_POST["id_serv"], $_POST["preco_itens_os"])) {
        if (empty($_POST["id_ordem_servico"]) || empty($_POST["id_serv"]) || empty($_POST["preco_itens_os"])) {
            $erro = "Todos os campos são obrigatórios.";
        } else {
            $id_itens_os = isset($_POST["id_itens_os"]) ? $_POST["id_itens_os"] : -1;
            $id_ordem_servico = $_POST["id_ordem_servico"];
            $id_serv = $_POST["id_serv"];
            $preco_itens_os = $_POST["preco_itens_os"];

            if ($id_itens_os == -1) { // Inserir novo item
                $stmt = $mysqli->prepare("INSERT INTO Itens_os (id_ordem_servico, id_serv, preco_itens_os) VALUES (?, ?, ?)");
                $stmt->bind_param("iid", $id_ordem_servico, $id_serv, $preco_itens_os);

                if ($stmt->execute()) {
                    $success = "Item de ordem de serviço cadastrado com sucesso.";
                } else {
                    $erro = "Erro ao cadastrar item de ordem de serviço: " . $stmt->error;
                }
            } else { // Atualizar item existente
                $stmt = $mysqli->prepare("UPDATE Itens_os SET id_serv = ?, preco_itens_os = ? WHERE id_ordem_servico = ? AND id_serv = ?");
                $stmt->bind_param("dii", $id_serv, $preco_itens_os, $id_ordem_servico, $id_serv); // Ajustar bind_param de acordo com os tipos corretos

                if ($stmt->execute()) {
                    $success = "Item de ordem de serviço atualizado com sucesso.";
                } else {
                    $erro = "Erro ao atualizar item de ordem de serviço: " . $stmt->error;
                }
            }
        }
    } else {
        $erro = "Todos os campos são obrigatórios.";
    }
}

// Remover Item de Ordem de Serviço
if (isset($_GET["id_ordem_servico"], $_GET["id_serv"]) && is_numeric($_GET["id_ordem_servico"]) && is_numeric($_GET["id_serv"])) {
    $id_ordem_servico = (int) $_GET["id_ordem_servico"];
    $id_serv = (int) $_GET["id_serv"];

    $stmt = $mysqli->prepare("DELETE FROM Itens_os WHERE id_ordem_servico = ? AND id_serv = ?");
    $stmt->bind_param('ii', $id_ordem_servico, $id_serv);
    if ($stmt->execute()) {
        $success = "Item de ordem de serviço removido com sucesso.";
    } else {
        $erro = "Erro ao remover item de ordem de serviço: " . $stmt->error;
    }
}

// Listar Itens de Ordem de Serviço
$result = $mysqli->query("SELECT io.*, s.nome_serv FROM Itens_os io LEFT JOIN Servico s ON io.id_serv = s.id_serv");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Itens de Ordem de Serviço</title>
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
    <h1>Cadastro de Itens de Ordem de Serviço</h1>

    <?php if (!empty($erro)): ?>
        <p style="color: red;"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <p style="color: green;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <!-- Formulário para adicionar ou editar item de ordem de serviço -->
    <form action="itens_os.php" method="POST">
        <input type="hidden" name="id_itens_os"
            value="<?= isset($_POST['id_itens_os']) ? $_POST['id_itens_os'] : -1 ?>">

        <label for="id_ordem_servico">Ordem de Serviço:</label><br>
        <select name="id_ordem_servico" required>
            <option value="">Selecione uma ordem de serviço</option>
            <?php
            // Listar ordens de serviço para o dropdown
            $ordens = $mysqli->query("SELECT id_ordem_servico FROM Ordem_Servico");
            while ($ordem = $ordens->fetch_assoc()) {
                $selected = (isset($_POST['id_ordem_servico']) && $_POST['id_ordem_servico'] == $ordem['id_ordem_servico']) ? 'selected' : '';
                echo "<option value='{$ordem['id_ordem_servico']}' $selected>{$ordem['id_ordem_servico']}</option>";
            }
            ?>
        </select><br><br>

        <label for="id_serv">Serviço:</label><br>
        <select name="id_serv" required>
            <option value="">Selecione um serviço</option>
            <?php
            // Listar serviços para o dropdown
            $servicos = $mysqli->query("SELECT id_serv, nome_serv FROM Servico");
            while ($servico = $servicos->fetch_assoc()) {
                $selected = (isset($_POST['id_serv']) && $_POST['id_serv'] == $servico['id_serv']) ? 'selected' : '';
                echo "<option value='{$servico['id_serv']}' $selected>{$servico['nome_serv']}</option>";
            }
            ?>
        </select><br><br>

        <label for="preco_itens_os">Preço:</label><br>
        <input type="number" step="0.01" name="preco_itens_os"
            value="<?= isset($_POST['preco_itens_os']) ? htmlspecialchars($_POST['preco_itens_os']) : '' ?>"
            required><br><br>

        <button
            type="submit"><?= (isset($_POST['id_itens_os']) && $_POST['id_itens_os'] != -1) ? 'Salvar' : 'Cadastrar' ?></button>
    </form>

    <hr>

    <!-- Exibição dos itens de ordem de serviço -->
    <h2>Lista de Itens de Ordem de Serviço</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID Ordem Serviço</th>
                <th>ID Serviço</th>
                <th>Nome Serviço</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($item = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($item['id_ordem_servico']) ?></td>
                    <td><?= htmlspecialchars($item['id_serv']) ?></td>
                    <td><?= htmlspecialchars($item['nome_serv']) ?></td>
                    <td><?= htmlspecialchars($item['preco_itens_os']) ?></td>
                    <td>
                        <a href="itens_os.php?id_ordem_servico=<?= $item['id_ordem_servico'] ?>&id_serv=<?= $item['id_serv'] ?>"
                            onclick="return confirm('Tem certeza que deseja remover este item?')">Remover</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>