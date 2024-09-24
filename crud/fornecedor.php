<?php
include_once '../auth/includes/db_connect.php';

$erro = '';
$success = '';

//Inserir/Atualizar Fornecedor
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nome_for"], $_POST["cnpj"], $_POST["rua"], $_POST["numero"], $_POST["bairro"], $_POST["cidade"], $_POST["email_for"])) {
        if (empty($_POST["nome_for"]) || empty($_POST["cnpj"]) || empty($_POST["rua"]) || empty($_POST["numero"]) || empty($_POST["bairro"]) || empty($_POST["cidade"]) || empty($_POST["email_for"])) {
            $erro = "Todos os campos são obrigatórios.";
        } else {
            $id_for = isset($_POST["id_for"]) ? $_POST["id_for"] : -1;
            $nome_for = $_POST["nome_for"];
            $cnpj = $_POST["cnpj"];
            $rua = $_POST["rua"];
            $numero = $_POST["numero"];
            $bairro = $_POST["bairro"];
            $cidade = $_POST["cidade"];
            $email_for = $_POST["email_for"];

            if ($id_for == -1) { //Inserir novo fornecedor
                $stmt = $mysqli->prepare("INSERT INTO Fornecedor (nome_for, cnpj, rua, numero, bairro, cidade, email_for) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $nome_for, $cnpj, $rua, $numero, $bairro, $cidade, $email_for);

                if ($stmt->execute()) {
                    $success = "Fornecedor cadastrado com sucesso.";
                } else {
                    $erro = "Erro ao cadastrar fornecedor: " . $stmt->error;
                }
            } else { //Atualizar fornecedor existente
                $stmt = $mysqli->prepare("UPDATE Fornecedor SET nome_for = ?, cnpj = ?, rua = ?, numero = ?, bairro = ?, cidade = ?, email_for = ? WHERE id_for = ?");
                $stmt->bind_param("sssssssi", $nome_for, $cnpj, $rua, $numero, $bairro, $cidade, $email_for, $id_for);

                if ($stmt->execute()) {
                    $success = "Fornecedor atualizado com sucesso.";
                } else {
                    $erro = "Erro ao atualizar fornecedor: " . $stmt->error;
                }
            }
        }
    } else {
        $erro = "Todos os campos são obrigatórios.";
    }
}

// Deletar Fornecedor
if (isset($_GET["id_for"]) && is_numeric($_GET["id_for"]) && isset($_GET["del"])) {
    $id_for = (int) $_GET["id_for"];
    $stmt = $mysqli->prepare("DELETE FROM Fornecedor WHERE id_for = ?");
    $stmt->bind_param('i', $id_for);
    if ($stmt->execute()) {
        $success = "Fornecedor excluído com sucesso.";
    } else {
        $erro = "Erro ao excluir fornecedor: " . $stmt->error;
    }
}

// Buscar fornecedores para exibição
$fornecedores = $mysqli->query("SELECT * FROM Fornecedor ORDER BY id_for DESC");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Fornecedor</title>
</head>

<body>
    <h1>Cadastro de Fornecedores</h1>

    <?php if (!empty($erro)): ?>
        <p style="color: red;"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <p style="color: green;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <!-- Formulário para adicionar ou editar fornecedor -->
    <form action="fornecedor.php" method="POST">
        <input type="hidden" name="id_for" value="<?= isset($_POST['id_for']) ? $_POST['id_for'] : -1 ?>">

        <label for="nome_for">Nome do Fornecedor:</label><br>
        <input type="text" name="nome_for"
            value="<?= isset($_POST['nome_for']) ? htmlspecialchars($_POST['nome_for']) : '' ?>" required><br><br>

        <label for="cnpj">CNPJ:</label><br>
        <input type="text" name="cnpj" value="<?= isset($_POST['cnpj']) ? htmlspecialchars($_POST['cnpj']) : '' ?>"
            required><br><br>

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

        <label for="email_for">Email:</label><br>
        <input type="email" name="email_for"
            value="<?= isset($_POST['email_for']) ? htmlspecialchars($_POST['email_for']) : '' ?>" required><br><br>

        <button
            type="submit"><?= (isset($_POST['id_for']) && $_POST['id_for'] != -1) ? 'Salvar' : 'Cadastrar' ?></button>
    </form>

    <hr>

    <!-- Exibição dos fornecedores -->
    <h2>Lista de Fornecedores</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CNPJ</th>
                <th>Rua</th>
                <th>Número</th>
                <th>Bairro</th>
                <th>Cidade</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fornecedor = $fornecedores->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($fornecedor['id_for']) ?></td>
                    <td><?= htmlspecialchars($fornecedor['nome_for']) ?></td>
                    <td><?= htmlspecialchars($fornecedor['cnpj']) ?></td>
                    <td><?= htmlspecialchars($fornecedor['rua']) ?></td>
                    <td><?= htmlspecialchars($fornecedor['numero']) ?></td>
                    <td><?= htmlspecialchars($fornecedor['bairro']) ?></td>
                    <td><?= htmlspecialchars($fornecedor['cidade']) ?></td>
                    <td><?= htmlspecialchars($fornecedor['email_for']) ?></td>
                    <td>
                        <!-- Botão de editar -->
                        <form action="fornecedor.php" method="POST" style="display:inline-block;">
                            <input type="hidden" name="id_for" value="<?= $fornecedor['id_for'] ?>">
                            <input type="hidden" name="nome_for" value="<?= htmlspecialchars($fornecedor['nome_for']) ?>">
                            <input type="hidden" name="cnpj" value="<?= htmlspecialchars($fornecedor['cnpj']) ?>">
                            <input type="hidden" name="rua" value="<?= htmlspecialchars($fornecedor['rua']) ?>">
                            <input type="hidden" name="numero" value="<?= htmlspecialchars($fornecedor['numero']) ?>">
                            <input type="hidden" name="bairro" value="<?= htmlspecialchars($fornecedor['bairro']) ?>">
                            <input type="hidden" name="cidade" value="<?= htmlspecialchars($fornecedor['cidade']) ?>">
                            <input type="hidden" name="email_for" value="<?= htmlspecialchars($fornecedor['email_for']) ?>">
                            <button type="submit">Editar</button>
                        </form>
                        <!-- Botão de deletar -->
                        <a href="fornecedor.php?id_for=<?= $fornecedor['id_for'] ?>&del=1"
                            onclick="return confirm('Tem certeza que deseja desabilitar este fornecedor?')">Desabilitar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>