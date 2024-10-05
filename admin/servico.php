<?php
include_once 'auth.php';  //verificar se esta logado
include_once '../auth/includes/db_connect.php';

$erro = '';
$success = '';

// Inserir/Atualizar Serviço
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nome_serv"], $_POST["preco_serv"], $_POST["prazo_serv"])) {
        if (empty($_POST["nome_serv"]) || empty($_POST["preco_serv"]) || empty($_POST["prazo_serv"])) {
            $erro = "Todos os campos são obrigatórios.";
        } else {
            $id_serv = isset($_POST["id_serv"]) ? $_POST["id_serv"] : -1;
            $nome_serv = $_POST["nome_serv"];
            $descricao_serv = $_POST["descricao_serv"];
            $preco_serv = $_POST["preco_serv"];
            $prazo_serv = $_POST["prazo_serv"];

            if ($id_serv == -1) { // Inserir novo serviço
                $stmt = $mysqli->prepare("INSERT INTO Servico (nome_serv, descricao_serv, preco_serv, prazo_serv) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssdi", $nome_serv, $descricao_serv, $preco_serv, $prazo_serv);

                if ($stmt->execute()) {
                    $success = "Serviço cadastrado com sucesso.";
                } else {
                    $erro = "Erro ao cadastrar serviço: " . $stmt->error;
                }
            } else { // Atualizar serviço existente
                $stmt = $mysqli->prepare("UPDATE Servico SET nome_serv = ?, descricao_serv = ?, preco_serv = ?, prazo_serv = ? WHERE id_serv = ?");
                $stmt->bind_param("ssdii", $nome_serv, $descricao_serv, $preco_serv, $prazo_serv, $id_serv);

                if ($stmt->execute()) {
                    $success = "Serviço atualizado com sucesso.";
                } else {
                    $erro = "Erro ao atualizar serviço: " . $stmt->error;
                }
            }
        }
    } else {
        $erro = "Todos os campos são obrigatórios.";
    }
}

// Desabilitar Serviço
if (isset($_GET["id_serv"]) && is_numeric($_GET["id_serv"]) && isset($_GET["del"])) {
    $id_serv = (int) $_GET["id_serv"];
    $stmt = $mysqli->prepare("UPDATE Servico SET ativo = 0 WHERE id_serv = ?"); // Supondo que há uma coluna 'ativo' na tabela
    $stmt->bind_param('i', $id_serv);
    if ($stmt->execute()) {
        $success = "Serviço desabilitado com sucesso.";
    } else {
        $erro = "Erro ao desabilitar serviço: " . $stmt->error;
    }
}

// Listar Serviços
$result = $mysqli->query("SELECT * FROM Servico"); // Todos os serviços
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Serviços</title>
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
    <h1>Cadastro de Serviços</h1>

    <?php if (!empty($erro)): ?>
        <p style="color: red;"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <p style="color: green;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <!-- Formulário para adicionar ou editar serviço -->
    <form action="servico.php" method="POST">
        <input type="hidden" name="id_serv" value="<?= isset($_POST['id_serv']) ? $_POST['id_serv'] : -1 ?>">

        <label for="nome_serv">Nome do Serviço:</label><br>
        <input type="text" name="nome_serv"
            value="<?= isset($_POST['nome_serv']) ? htmlspecialchars($_POST['nome_serv']) : '' ?>" required><br><br>

        <label for="descricao_serv">Descrição:</label><br>
        <input type="text" name="descricao_serv"
            value="<?= isset($_POST['descricao_serv']) ? htmlspecialchars($_POST['descricao_serv']) : '' ?>"><br><br>

        <label for="preco_serv">Preço:</label><br>
        <input type="number" step="0.01" name="preco_serv"
            value="<?= isset($_POST['preco_serv']) ? htmlspecialchars($_POST['preco_serv']) : '' ?>" required><br><br>

        <label for="prazo_serv">Prazo (dias):</label><br>
        <input type="number" name="prazo_serv"
            value="<?= isset($_POST['prazo_serv']) ? htmlspecialchars($_POST['prazo_serv']) : '' ?>" required><br><br>

        <button
            type="submit"><?= (isset($_POST['id_serv']) && $_POST['id_serv'] != -1) ? 'Salvar' : 'Cadastrar' ?></button>
    </form>

    <hr>

    <!-- Exibição dos serviços -->
    <h2>Lista de Serviços</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Prazo (dias)</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($servico = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($servico['id_serv']) ?></td>
                    <td><?= htmlspecialchars($servico['nome_serv']) ?></td>
                    <td><?= htmlspecialchars($servico['descricao_serv']) ?></td>
                    <td><?= htmlspecialchars($servico['preco_serv']) ?></td>
                    <td><?= htmlspecialchars($servico['prazo_serv']) ?></td>
                    <td>
                        <a href="servico.php?id_serv=<?= $servico['id_serv'] ?>&del=1"onclick="return confirm('Tem certeza que deseja desabilitar este serviço?')">Desabilitar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>