<?php
include_once '../auth/includes/db_connect.php';

$erro = '';
$success = '';

// Inserir/Atualizar Cliente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nome_cli"], $_POST["email_cli"], $_POST["senha_cli"], $_POST["cpf_cli"], $_POST["rua"], $_POST["numero"], $_POST["bairro"], $_POST["cidade"])) {
        if (empty($_POST["nome_cli"]) || empty($_POST["email_cli"]) || empty($_POST["senha_cli"]) || empty($_POST["cpf_cli"]) || empty($_POST["rua"]) || empty($_POST["numero"]) || empty($_POST["bairro"]) || empty($_POST["cidade"])) {
            $erro = "Todos os campos são obrigatórios.";
        } else {
            $id_cli = isset($_POST["id_cli"]) ? $_POST["id_cli"] : -1;
            $nome_cli = $_POST["nome_cli"];
            $email_cli = $_POST["email_cli"];
            $senha_cli = $_POST["senha_cli"]; // Adicionando senha do cliente
            $cpf_cli = $_POST["cpf_cli"];
            $rua = $_POST["rua"];
            $numero = $_POST["numero"];
            $bairro = $_POST["bairro"];
            $cidade = $_POST["cidade"];

            if ($id_cli == -1) { // Inserir novo cliente
                $stmt = $mysqli->prepare("INSERT INTO Cliente (nome_cli, email_cli, senha_cli, cpf_cli, rua, numero, bairro, cidade) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssss", $nome_cli, $email_cli, $senha_cli, $cpf_cli, $rua, $numero, $bairro, $cidade);

                if ($stmt->execute()) {
                    $success = "Cliente cadastrado com sucesso.";
                } else {
                    $erro = "Erro ao cadastrar cliente: " . $stmt->error;
                }
            } else { // Atualizar cliente existente
                $stmt = $mysqli->prepare("UPDATE Cliente SET nome_cli = ?, email_cli = ?, senha_cli = ?, cpf_cli = ?, rua = ?, numero = ?, bairro = ?, cidade = ? WHERE id_cli = ?");
                $stmt->bind_param("ssssssssi", $nome_cli, $email_cli, $senha_cli, $cpf_cli, $rua, $numero, $bairro, $cidade, $id_cli);

                if ($stmt->execute()) {
                    $success = "Cliente atualizado com sucesso.";
                } else {
                    $erro = "Erro ao atualizar cliente: " . $stmt->error;
                }
            }
        }
    } else {
        $erro = "Todos os campos são obrigatórios.";
    }
}

// Deletar Cliente
if (isset($_GET["id_cli"]) && is_numeric($_GET["id_cli"]) && isset($_GET["del"])) {
    $id_cli = (int) $_GET["id_cli"];
    $stmt = $mysqli->prepare("DELETE FROM Cliente WHERE id_cli = ?");
    $stmt->bind_param('i', $id_cli);
    if ($stmt->execute()) {
        $success = "Cliente excluído com sucesso.";
    } else {
        $erro = "Erro ao excluir cliente: " . $stmt->error;
    }
}

// Buscar clientes para exibição
$clientes = $mysqli->query("SELECT * FROM Cliente ORDER BY id_cli DESC");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Cliente</title>
</head>

<body>
    <h1>Cadastro de Clientes</h1>

    <?php if (!empty($erro)): ?>
        <p style="color: red;"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <p style="color: green;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <!-- Formulário para adicionar ou editar cliente -->
    <form action="cliente.php" method="POST">
        <input type="hidden" name="id_cli" value="<?= isset($_POST['id_cli']) ? $_POST['id_cli'] : -1 ?>">

        <label for="nome_cli">Nome do Cliente:</label><br>
        <input type="text" name="nome_cli"
            value="<?= isset($_POST['nome_cli']) ? htmlspecialchars($_POST['nome_cli']) : '' ?>" required><br><br>

        <label for="email_cli">E-mail:</label><br>
        <input type="email" name="email_cli"
            value="<?= isset($_POST['email_cli']) ? htmlspecialchars($_POST['email_cli']) : '' ?>" required><br><br>

        <label for="senha_cli">Senha:</label><br>
        <input type="password" name="senha_cli" required><br><br>

        <label for="cpf_cli">CPF:</label><br>
        <input type="text" name="cpf_cli"
            value="<?= isset($_POST['cpf_cli']) ? htmlspecialchars($_POST['cpf_cli']) : '' ?>" required><br><br>

        <label for="rua">Rua:</label><br>
        <input type="text" name="rua" value="<?= isset($_POST['rua']) ? htmlspecialchars($_POST['rua']) : '' ?>"
            required><br><br>

        <label for="numero">Número:</label><br>
        <input type="text" name="numero"
            value="<?= isset($_POST['numero']) ? htmlspecialchars($_POST['numero']) : '' ?>" required><br><br>

        <label for="bairro">Bairro:</label><br>
        <input type="text" name="bairro"
            value="<?= isset($_POST['bairro']) ? htmlspecialchars($_POST['bairro']) : '' ?>" required><br><br>

        <label for="cidade">Cidade:</label><br>
        <input type="text" name="cidade"
            value="<?= isset($_POST['cidade']) ? htmlspecialchars($_POST['cidade']) : '' ?>" required><br><br>

        <button
            type="submit"><?= (isset($_POST['id_cli']) && $_POST['id_cli'] != -1) ? 'Salvar' : 'Cadastrar' ?></button>
    </form>

    <hr>

    <!-- Exibição dos clientes -->
    <h2>Lista de Clientes</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>CPF</th>
                <th>Rua</th>
                <th>Número</th>
                <th>Bairro</th>
                <th>Cidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($cliente = $clientes->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($cliente['id_cli']) ?></td>
                    <td><?= htmlspecialchars($cliente['nome_cli']) ?></td>
                    <td><?= htmlspecialchars($cliente['email_cli']) ?></td>
                    <td><?= htmlspecialchars($cliente['cpf_cli']) ?></td>
                    <td><?= htmlspecialchars($cliente['rua']) ?></td>
                    <td><?= htmlspecialchars($cliente['numero']) ?></td>
                    <td><?= htmlspecialchars($cliente['bairro']) ?></td>
                    <td><?= htmlspecialchars($cliente['cidade']) ?></td>
                    <td>
                        <!-- Botão de editar -->
                        <form action="cliente.php" method="POST" style="display:inline-block;">
                            <input type="hidden" name="id_cli" value="<?= $cliente['id_cli'] ?>">
                            <input type="hidden" name="nome_cli" value="<?= htmlspecialchars($cliente['nome_cli']) ?>">
                            <input type="hidden" name="email_cli" value="<?= htmlspecialchars($cliente['email_cli']) ?>">
                            <input type="hidden" name="cpf_cli" value="<?= htmlspecialchars($cliente['cpf_cli']) ?>">
                            <input type="hidden" name="rua" value="<?= htmlspecialchars($cliente['rua']) ?>">
                            <input type="hidden" name="numero" value="<?= htmlspecialchars($cliente['numero']) ?>">
                            <input type="hidden" name="bairro" value="<?= htmlspecialchars($cliente['bairro']) ?>">
                            <input type="hidden" name="cidade" value="<?= htmlspecialchars($cliente['cidade']) ?>">
                            <button type="submit">Editar</button>
                        </form>
                        <!-- Botão de deletar -->
                        <a href="cliente.php?id_cli=<?= $cliente['id_cli'] ?>&del=1"
                            onclick="return confirm('Tem certeza que deseja excluir este cliente?')">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>