<?php
include_once 'auth.php';  // Verificar se está logado
include_once '../auth/includes/db_connect.php';

$erro = '';
$success = '';

// Verificar a conexão com o banco de dados
if ($mysqli->connect_errno) {
    die("Falha ao conectar ao MySQL: " . $mysqli->connect_error);
}

// Inserir/Atualizar Pedido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["data_ped"], $_POST["endereco_entrega"], $_POST["data_entrega_ped"], $_POST["id_cli"], $_SESSION["id"])) {
        if (empty($_POST["data_ped"]) || empty($_POST["endereco_entrega"]) || empty($_POST["data_entrega_ped"]) || empty($_POST["id_cli"]) || empty($_SESSION["id"])) {
            $erro = "Todos os campos são obrigatórios.";
        } else {
            $data_ped = $_POST["data_ped"];
            $endereco_entrega = $_POST["endereco_entrega"];
            $data_entrega_ped = $_POST["data_entrega_ped"];
            $id_cli = $_POST["id_cli"];
            $id_usu = $_SESSION["id"];
            $id_ped = isset($_POST["id_ped"]) ? $_POST["id_ped"] : null;

            if ($id_ped === null) { // Inserir novo pedido
                $stmt = $mysqli->prepare("INSERT INTO Pedido (data_ped, endereco_entrega, data_entrega_ped, id_cli, id_usu) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("ssiii", $data_ped, $endereco_entrega, $data_entrega_ped, $id_cli, $id_usu);

                if ($stmt->execute()) {
                    $success = "Pedido registrado com sucesso.";
                } else {
                    $erro = "Erro ao registrar pedido: " . $stmt->error;
                }
            } else { // Atualizar pedido existente
                $stmt = $mysqli->prepare("UPDATE Pedido SET data_ped = ?, endereco_entrega = ?, data_entrega_ped = ?, id_cli = ?, id_usu = ? WHERE id_ped = ?");
                $stmt->bind_param("ssiiii", $data_ped, $endereco_entrega, $data_entrega_ped, $id_cli, $id_usu, $id_ped);

                if ($stmt->execute()) {
                    $success = "Pedido atualizado com sucesso.";
                } else {
                    $erro = "Erro ao atualizar pedido: " . $stmt->error;
                }
            }
        }
    } else {
        $erro = "Todos os campos são obrigatórios.";
    }
}

// Remover Pedido
if (isset($_GET["id_ped"]) && is_numeric($_GET["id_ped"])) {
    $id_ped = (int) $_GET["id_ped"];

    $stmt = $mysqli->prepare("DELETE FROM Pedido WHERE id_ped = ?");
    $stmt->bind_param('i', $id_ped);
    if ($stmt->execute()) {
        $success = "Pedido removido com sucesso.";
    } else {
        $erro = "Erro ao remover pedido: " . $stmt->error;
    }
}

// Listar Pedidos
$result = $mysqli->query("SELECT p.*, c.nome_cli, u.nome_usu FROM Pedido p LEFT JOIN Cliente c ON p.id_cli = c.id_cli LEFT JOIN Usuario u ON p.id_usu = u.id_usu");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="style/mainAdmin.css">
</head>

<body>
    <?php include_once 'includes/header.php'; ?>

    <h1>Cadastro de Pedidos</h1>

    <?php if (!empty($erro)): ?>
        <p style="color: red;"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <p style="color: green;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <!-- Formulário para adicionar ou editar pedido -->
    <form action="pedido.php" method="POST">
        <input type="hidden" name="id_ped" value="<?= isset($_POST['id_ped']) ? $_POST['id_ped'] : '' ?>">

        <input type="hidden" name="data_ped" value="<?= date('Y-m-d H:i:s') ?>" required>

        <label for="endereco_entrega">Endereço de Entrega:</label><br>
        <input type="text" name="endereco_entrega"
            value="<?= isset($_POST['endereco_entrega']) ? htmlspecialchars($_POST['endereco_entrega']) : '' ?>"
            required><br><br>

        <label for="data_entrega_ped">Data de Entrega:</label><br>
        <input type="date" name="data_entrega_ped"
            value="<?= isset($_POST['data_entrega_ped']) ? htmlspecialchars($_POST['data_entrega_ped']) : '' ?>"><br><br>

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
        <input name="id_usu" value="<?php echo $_SESSION['nome'] ?>" disabled><br><br>

        <button type="submit"><?= (isset($_POST['id_ped'])) ? 'Salvar' : 'Cadastrar' ?></button>
    </form>

    <hr>

    <!-- Exibição dos pedidos -->
    <h2>Lista de Pedidos</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Data do Pedido</th>
                <th>Endereço de Entrega</th>
                <th>Data de Entrega</th>
                <th>Cliente</th>
                <th>Usuário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($pedido = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($pedido['id_ped']) ?></td>
                        <td><?= htmlspecialchars($pedido['data_ped']) ?></td>
                        <td><?= htmlspecialchars($pedido['endereco_entrega']) ?></td>
                        <td><?= htmlspecialchars($pedido['data_entrega_ped']) ?></td>
                        <td><?= htmlspecialchars($pedido['nome_cli']) ?></td>
                        <td><?= htmlspecialchars($pedido['nome_usu']) ?></td>
                        <td>
                            <a href="pedido.php?id_ped=<?= $pedido['id_ped'] ?>" onclick="return confirm('Tem certeza que deseja remover este pedido?')">Remover</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Nenhum pedido encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>
