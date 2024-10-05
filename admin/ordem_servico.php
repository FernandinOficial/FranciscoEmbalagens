<?php
include_once 'auth.php';  //verificar se esta logado
include_once '../auth/includes/db_connect.php';

$erro = '';
$success = '';

// Inserir/Atualizar Ordem de Serviço
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["data_ordem_servico"], $_POST["id_cli"], $_POST["id_usu"])) {
        if (empty($_POST["data_ordem_servico"]) || empty($_POST["id_cli"]) || empty($_POST["id_usu"])) {
            $erro = "Todos os campos são obrigatórios.";
        } else {
            $id_ordem_servico = isset($_POST["id_ordem_servico"]) ? $_POST["id_ordem_servico"] : -1;
            $data_ordem_servico = $_POST["data_ordem_servico"];
            $id_cli = $_POST["id_cli"];
            $id_usu = $_POST["id_usu"];

            if ($id_ordem_servico == -1) { // Inserir nova ordem de serviço
                $stmt = $mysqli->prepare("INSERT INTO Ordem_Servico (data_ordem_servico, id_cli, id_usu) VALUES (?, ?, ?)");
                $stmt->bind_param("sii", $data_ordem_servico, $id_cli, $id_usu);

                if ($stmt->execute()) {
                    $success = "Ordem de serviço cadastrada com sucesso.";
                } else {
                    $erro = "Erro ao cadastrar ordem de serviço: " . $stmt->error;
                }
            } else { // Atualizar ordem de serviço existente
                $stmt = $mysqli->prepare("UPDATE Ordem_Servico SET data_ordem_servico = ?, id_cli = ?, id_usu = ? WHERE id_ordem_servico = ?");
                $stmt->bind_param("siii", $data_ordem_servico, $id_cli, $id_usu, $id_ordem_servico);

                if ($stmt->execute()) {
                    $success = "Ordem de serviço atualizada com sucesso.";
                } else {
                    $erro = "Erro ao atualizar ordem de serviço: " . $stmt->error;
                }
            }
        }
    } else {
        $erro = "Todos os campos são obrigatórios.";
    }
}

// Desabilitar Ordem de Serviço
if (isset($_GET["id_ordem_servico"]) && is_numeric($_GET["id_ordem_servico"]) && isset($_GET["del"])) {
    $id_ordem_servico = (int) $_GET["id_ordem_servico"];
    $stmt = $mysqli->prepare("UPDATE Ordem_Servico SET ativo = 0 WHERE id_ordem_servico = ?"); // Supondo que há uma coluna 'ativo' na tabela
    $stmt->bind_param('i', $id_ordem_servico);
    if ($stmt->execute()) {
        $success = "Ordem de serviço desabilitada com sucesso.";
    } else {
        $erro = "Erro ao desabilitar ordem de serviço: " . $stmt->error;
    }
}

// Listar Ordens de Serviço
$result = $mysqli->query("SELECT os.*, c.nome_cli, u.nome_usu FROM Ordem_Servico os LEFT JOIN Cliente c ON os.id_cli = c.id_cli LEFT JOIN Usuario u ON os.id_usu = u.id_usu"); // Todos os ordens de serviço
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Ordens de Serviço</title>
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
    <h1>Cadastro de Ordens de Serviço</h1>

    <?php if (!empty($erro)): ?>
        <p style="color: red;"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <p style="color: green;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <!-- Formulário para adicionar ou editar ordem de serviço -->
    <form action="ordem_servico.php" method="POST">
        <input type="hidden" name="id_ordem_servico"
            value="<?= isset($_POST['id_ordem_servico']) ? $_POST['id_ordem_servico'] : -1 ?>">

        <label for="data_ordem_servico">Data da Ordem de Serviço:</label><br>
        <input type="date" name="data_ordem_servico"
            value="<?= isset($_POST['data_ordem_servico']) ? htmlspecialchars($_POST['data_ordem_servico']) : '' ?>"
            required><br><br>

        <label for="id_cli">Cliente:</label><br>
        <select name="id_cli" required>
            <option value="">Selecione um cliente</option>
            <?php
            // Listar clientes para o dropdown
            $clientes = $mysqli->query("SELECT id_cli, nome_cli FROM Cliente");
            while ($cliente = $clientes->fetch_assoc()) {
                $selected = (isset($_POST['id_cli']) && $_POST['id_cli'] == $cliente['id_cli']) ? 'selected' : '';
                echo "<option value='{$cliente['id_cli']}' $selected>{$cliente['nome_cli']}</option>";
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

        <button
            type="submit"><?= (isset($_POST['id_ordem_servico']) && $_POST['id_ordem_servico'] != -1) ? 'Salvar' : 'Cadastrar' ?></button>
    </form>

    <hr>

    <!-- Exibição das ordens de serviço -->
    <h2>Lista de Ordens de Serviço</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Cliente</th>
                <th>Usuário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($ordem_servico = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($ordem_servico['id_ordem_servico']) ?></td>
                    <td><?= htmlspecialchars($ordem_servico['data_ordem_servico']) ?></td>
                    <td><?= htmlspecialchars($ordem_servico['nome_cli']) ?></td>
                    <td><?= htmlspecialchars($ordem_servico['nome_usu']) ?></td>
                    <td>
                        <a href="ordem_servico.php?id_ordem_servico=<?= $ordem_servico['id_ordem_servico'] ?>&del=1"
                            onclick="return confirm('Tem certeza que deseja desabilitar esta ordem de serviço?')">Desabilitar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>