<?php
include_once '../auth/includes/db_connect.php';

$erro = '';
$success = '';

// Inserir/Atualizar Cliente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nome_cli"], $_POST["documento_cli"], $_POST["tipo_documento_cli"], $_POST["data_nascimento_cli"], $_POST["data_cadastro_cli"], $_POST["email_cli"], $_POST["rua_cli"], $_POST["bairro_cli"], $_POST["cidade_cli"], $_POST["cep_cli"], $_POST["telefone_cli"], $_POST["uf_cli"])) {
        if (empty($_POST["nome_cli"]) || empty($_POST["documento_cli"]) || empty($_POST["tipo_documento_cli"]) || empty($_POST["data_nascimento_cli"]) || empty($_POST["data_cadastro_cli"]) || empty($_POST["email_cli"]) || empty($_POST["rua_cli"]) || empty($_POST["bairro_cli"]) || empty($_POST["cidade_cli"]) || empty($_POST["cep_cli"]) || empty($_POST["telefone_cli"]) || empty($_POST["uf_cli"])) {
            $erro = "Todos os campos são obrigatórios.";
        } else {
            $id_cli = isset($_POST["id_cli"]) ? $_POST["id_cli"] : -1;
            $nome_cli = $_POST["nome_cli"];
            $documento_cli = $_POST["documento_cli"];
            $tipo_documento_cli = $_POST["tipo_documento_cli"];
            $data_nascimento_cli = $_POST["data_nascimento_cli"];
            $data_cadastro_cli = $_POST["data_cadastro_cli"];
            $email_cli = $_POST["email_cli"];
            $rua_cli = $_POST["rua_cli"];
            $bairro_cli = $_POST["bairro_cli"];
            $cidade_cli = $_POST["cidade_cli"];
            $cep_cli = $_POST["cep_cli"];
            $telefone_cli = $_POST["telefone_cli"];
            $uf_cli = $_POST["uf_cli"];

            if ($id_cli == -1) { // Inserir novo cliente
                $stmt = $mysqli->prepare("INSERT INTO Cliente (nome_cli, documento_cli, tipo_documento_cli, data_nascimento_cli, data_cadastro_cli, email_cli, rua_cli, bairro_cli, cidade_cli, cep_cli, telefone_cli, uf_cli) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssssssss", $nome_cli, $documento_cli, $tipo_documento_cli, $data_nascimento_cli, $data_cadastro_cli, $email_cli, $rua_cli, $bairro_cli, $cidade_cli, $cep_cli, $telefone_cli, $uf_cli);

                if ($stmt->execute()) {
                    $success = "Cliente cadastrado com sucesso.";
                } else {
                    $erro = "Erro ao cadastrar cliente: " . $stmt->error;
                }
            } else { // Atualizar cliente existente
                $stmt = $mysqli->prepare("UPDATE Cliente SET nome_cli = ?, documento_cli = ?, tipo_documento_cli = ?, data_nascimento_cli = ?, data_cadastro_cli = ?, email_cli = ?, rua_cli = ?, bairro_cli = ?, cidade_cli = ?, cep_cli = ?, telefone_cli = ?, uf_cli = ? WHERE id_cli = ?");
                $stmt->bind_param("ssssssssssssi", $nome_cli, $documento_cli, $tipo_documento_cli, $data_nascimento_cli, $data_cadastro_cli, $email_cli, $rua_cli, $bairro_cli, $cidade_cli, $cep_cli, $telefone_cli, $uf_cli, $id_cli);

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

// Desabilitar Cliente
if (isset($_GET["id_cli"]) && is_numeric($_GET["id_cli"]) && isset($_GET["del"])) {
    $id_cli = (int) $_GET["id_cli"];
    $stmt = $mysqli->prepare("UPDATE Cliente SET ativo = 0 WHERE id_cli = ?"); // Supondo que há uma coluna 'ativo' na tabela
    $stmt->bind_param('i', $id_cli);
    if ($stmt->execute()) {
        $success = "Cliente desabilitado com sucesso.";
    } else {
        $erro = "Erro ao desabilitar cliente: " . $stmt->error;
    }
}

// Listar Clientes
$result = $mysqli->query("SELECT * FROM Cliente WHERE ativo = 1"); // Apenas clientes ativos
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Clientes</title>
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

        <label for="documento_cli">Documento:</label><br>
        <input type="text" name="documento_cli"
            value="<?= isset($_POST['documento_cli']) ? htmlspecialchars($_POST['documento_cli']) : '' ?>"
            required><br><br>

        <label for="tipo_documento_cli">Tipo de Documento:</label><br>
        <input type="text" name="tipo_documento_cli"
            value="<?= isset($_POST['tipo_documento_cli']) ? htmlspecialchars($_POST['tipo_documento_cli']) : '' ?>"
            required><br><br>

        <label for="data_nascimento_cli">Data de Nascimento:</label><br>
        <input type="date" name="data_nascimento_cli"
            value="<?= isset($_POST['data_nascimento_cli']) ? htmlspecialchars($_POST['data_nascimento_cli']) : '' ?>"
            required><br><br>

        <label for="data_cadastro_cli">Data de Cadastro:</label><br>
        <input type="date" name="data_cadastro_cli"
            value="<?= isset($_POST['data_cadastro_cli']) ? htmlspecialchars($_POST['data_cadastro_cli']) : '' ?>"
            required><br><br>

        <label for="email_cli">Email:</label><br>
        <input type="email" name="email_cli"
            value="<?= isset($_POST['email_cli']) ? htmlspecialchars($_POST['email_cli']) : '' ?>" required><br><br>

        <label for="rua_cli">Rua:</label><br>
        <input type="text" name="rua_cli"
            value="<?= isset($_POST['rua_cli']) ? htmlspecialchars($_POST['rua_cli']) : '' ?>" required><br><br>

        <label for="bairro_cli">Bairro:</label><br>
        <input type="text" name="bairro_cli"
            value="<?= isset($_POST['bairro_cli']) ? htmlspecialchars($_POST['bairro_cli']) : '' ?>" required><br><br>

        <label for="cidade_cli">Cidade:</label><br>
        <input type="text" name="cidade_cli"
            value="<?= isset($_POST['cidade_cli']) ? htmlspecialchars($_POST['cidade_cli']) : '' ?>" required><br><br>

        <label for="cep_cli">CEP:</label><br>
        <input type="text" name="cep_cli"
            value="<?= isset($_POST['cep_cli']) ? htmlspecialchars($_POST['cep_cli']) : '' ?>" required><br><br>

        <label for="telefone_cli">Telefone:</label><br>
        <input type="text" name="telefone_cli"
            value="<?= isset($_POST['telefone_cli']) ? htmlspecialchars($_POST['telefone_cli']) : '' ?>"
            required><br><br>

        <label for="uf_cli">UF:</label><br>
        <input type="text" name="uf_cli"
            value="<?= isset($_POST['uf_cli']) ? htmlspecialchars($_POST['uf_cli']) : '' ?>" required><br><br>

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
                <th>Documento</th>
                <th>Tipo de Documento</th>
                <th>Data de Nascimento</th>
                <th>Data de Cadastro</th>
                <th>Email</th>
                <th>Rua</th>
                <th>Bairro</th>
                <th>Cidade</th>
                <th>CEP</th>
                <th>Telefone</th>
                <th>UF</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($cliente = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($cliente['id_cli']) ?></td>
                    <td><?= htmlspecialchars($cliente['nome_cli']) ?></td>
                    <td><?= htmlspecialchars($cliente['documento_cli']) ?></td>
                    <td><?= htmlspecialchars($cliente['tipo_documento_cli']) ?></td>
                    <td><?= htmlspecialchars($cliente['data_nascimento_cli']) ?></td>
                    <td><?= htmlspecialchars($cliente['data_cadastro_cli']) ?></td>
                    <td><?= htmlspecialchars($cliente['email_cli']) ?></td>
                    <td><?= htmlspecialchars($cliente['rua_cli']) ?></td>
                    <td><?= htmlspecialchars($cliente['bairro_cli']) ?></td>
                    <td><?= htmlspecialchars($cliente['cidade_cli']) ?></td>
                    <td><?= htmlspecialchars($cliente['cep_cli']) ?></td>
                    <td><?= htmlspecialchars($cliente['telefone_cli']) ?></td>
                    <td><?= htmlspecialchars($cliente['uf_cli']) ?></td>
                    <td>
                        <a href="cliente.php?id_cli=<?= $cliente['id_cli'] ?>&del=1"
                            onclick="return confirm('Tem certeza que deseja desabilitar este cliente?')">Desabilitar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>