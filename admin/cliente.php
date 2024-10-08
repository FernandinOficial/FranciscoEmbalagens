<?php
include_once 'auth.php';  //verificar se esta logado
include_once '../auth/includes/db_connect.php';

date_default_timezone_set('America/Sao_Paulo');

$erro = '';
$success = '';

// Inserir/Atualizar Cliente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nome_cli"], $_POST["documento_cli"], $_POST["tipo_do_documento_cli"], $_POST["data_nascimento"], $_POST["email_cli"], $_POST["rua"], $_POST["bairro"], $_POST["cidade"], $_POST["cep"], $_POST["telefone_cli"], $_POST["uf"])) {
        if (empty($_POST["nome_cli"]) || empty($_POST["documento_cli"]) || empty($_POST["tipo_do_documento_cli"]) || empty($_POST["data_nascimento"]) || empty($_POST["email_cli"]) || empty($_POST["rua"]) || empty($_POST["bairro"]) || empty($_POST["cidade"]) || empty($_POST["cep"]) || empty($_POST["telefone_cli"]) || empty($_POST["uf"])) {
            $erro = "Todos os campos obrigatórios devem ser preenchidos.";
        } else {
            $id_cli = isset($_POST["id_cli"]) ? $_POST["id_cli"] : -1;
            $nome_cli = $_POST["nome_cli"];
            $documento_cli = $_POST["documento_cli"];
            $tipo_do_documento_cli = $_POST["tipo_do_documento_cli"];
            $data_nascimento = $_POST["data_nascimento"];
            $data_cadastro_cli = date('Y-m-d H:i:s'); // Setando a data e hora atual
            $email_cli = $_POST["email_cli"];
            $rua = $_POST["rua"];
            $bairro = $_POST["bairro"];
            $cidade = $_POST["cidade"];
            $numero = $_POST["numero"];
            $cep = $_POST["cep"];
            $telefone_cli = $_POST["telefone_cli"];
            $uf = $_POST["uf"];
            $status_cli = "ativo"; // Definindo status inicial como 'ativo'

            if ($id_cli == -1) { // Inserir novo cliente
                $stmt = $mysqli->prepare("INSERT INTO Cliente (data_cadastro_cli, nome_cli, documento_cli, tipo_do_documento_cli, data_nascimento, email_cli, rua, bairro, cidade, cep, telefone_cli, numero, uf, status_cli) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                
                $stmt->bind_param("ssssssssssssss", $data_cadastro_cli, $nome_cli, $documento_cli, $tipo_do_documento_cli, $data_nascimento, $email_cli, $rua, $bairro, $cidade, $cep, $telefone_cli, $numero, $uf, $status_cli);
            
                if ($stmt->execute()) {
                    $success = "Cliente cadastrado com sucesso.";
                } else {
                    $erro = "Erro ao cadastrar cliente: " . $stmt->error;
                }
            }
            
        }
    } else {
        $erro = "Todos os campos obrigatórios devem ser preenchidos.";
    }
}

// Desabilitar Cliente
if (isset($_GET["id_cli"]) && is_numeric($_GET["id_cli"]) && isset($_GET["del"])) {
    $id_cli = (int) $_GET["id_cli"];
    $stmt = $mysqli->prepare("UPDATE Cliente SET status_cli = 'desabilitado' WHERE id_cli = ?");
    $stmt->bind_param('i', $id_cli);
    if ($stmt->execute()) {
        $success = "Cliente desabilitado com sucesso.";
    } else {
        $erro = "Erro ao desabilitar cliente: " . $stmt->error;
    }
}

// Listar Clientes
$result = $mysqli->query("SELECT * FROM Cliente WHERE status_cli = 'ativo'");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes | Francisco Embalagens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <?php include_once 'includes/header.php'; ?>
    <h1>Cadastro de Clientes</h1>

    <?php if (!empty($erro)): ?>
        <p style="color: red;"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <p style="color: green;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <!-- Formulário para adicionar ou editar cliente -->
    <form action="cliente.php" method="POST">
        <input type="hidden" name="id_cli" value="<?= isset($_POST['id_cli']) ? (int) $_POST['id_cli'] : -1 ?>">

        <label for="nome_cli">Nome do Cliente:</label><br>
        <input type="text" name="nome_cli"
            value="<?= isset($_POST['nome_cli']) ? htmlspecialchars($_POST['nome_cli']) : '' ?>" required><br><br>

        <label for="tipo_do_documento_cli">Tipo de Documento:</label><br>
        <select name="tipo_do_documento_cli" required>
            <optgroup label="Documento">
                <option value="invalido">SELECIONE</option>
                <option value="cpf" <?= (isset($_POST['tipo_do_documento_cli']) && $_POST['tipo_do_documento_cli'] === 'cpf') ? 'selected' : '' ?>>CPF</option>
                <option value="rg" <?= (isset($_POST['tipo_do_documento_cli']) && $_POST['tipo_do_documento_cli'] === 'rg') ? 'selected' : '' ?>>RG</option>
                <option value="cnpj" <?= (isset($_POST['tipo_do_documento_cli']) && $_POST['tipo_do_documento_cli'] === 'cnpj') ? 'selected' : '' ?>>CNPJ</option>
            </optgroup>
        </select><br><br>

        <label for="documento_cli">Documento:</label><br>
        <input type="text" name="documento_cli"
            value="<?= isset($_POST['documento_cli']) ? htmlspecialchars($_POST['documento_cli']) : '' ?>"
            required><br><br>

        <label for="data_nascimento">Data de Nascimento:</label><br>
        <input type="date" name="data_nascimento"
            value="<?= isset($_POST['data_nascimento']) ? htmlspecialchars($_POST['data_nascimento']) : '' ?>"
            required><br><br>

        <label for="email_cli">Email:</label><br>
        <input type="email" name="email_cli"
            value="<?= isset($_POST['email_cli']) ? htmlspecialchars($_POST['email_cli']) : '' ?>" required><br><br>

        <label for="cep">CEP:</label><br>
        <input type="text" name="cep" value="<?= isset($_POST['cep']) ? htmlspecialchars($_POST['cep']) : '' ?>"
            required><br><br>

        <label for="rua">Rua:</label><br>
        <input type="text" name="rua" value="<?= isset($_POST['rua']) ? htmlspecialchars($_POST['rua']) : '' ?>"
            required><br><br>

        <label for="bairro">Bairro:</label><br>
        <input type="text" name="bairro"
            value="<?= isset($_POST['bairro']) ? htmlspecialchars($_POST['bairro']) : '' ?>" required><br><br>

        <label for="cidade">Cidade:</label><br>
        <input type="text" name="cidade"
            value="<?= isset($_POST['cidade']) ? htmlspecialchars($_POST['cidade']) : '' ?>" required><br><br>

        <label for="numero">Numero:</label><br>
        <input type="number" name="numero" min="0"
            value="<?= isset($_POST['numero']) ? htmlspecialchars($_POST['numero']) : '' ?>" required><br><br>

        <label for="telefone_cli">Telefone:</label><br>
        <input type="text" name="telefone_cli"
            value="<?= isset($_POST['telefone_cli']) ? htmlspecialchars($_POST['telefone_cli']) : '' ?>"
            required><br><br>

        <label for="uf">UF:</label><br>
        <select name="uf" required>
            <option value="invalido">SELECIONE</option>
            <?php
            $ufs = ['AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO'];
            foreach ($ufs as $uf) {
                echo '<option value="' . $uf . '" ' . (isset($_POST['uf']) && $_POST['uf'] === $uf ? 'selected' : '') . '>' . $uf . '</option>';
            }
            ?>
        </select><br><br>

        <input type="submit" value="Salvar"><br><br>
    </form>

    <!-- Listar clientes -->
    <h2>Clientes Ativos</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Documento</th>
                <th>Email</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row["id_cli"] ?></td>
                    <td><?= $row["nome_cli"] ?></td>
                    <td><?= $row["documento_cli"] ?></td>
                    <td><?= $row["email_cli"] ?></td>
                    <td>
                        <a href="editar_cliente.php?id_cli=<?= $row["id_cli"] ?>">Editar</a>
                        <a href="cliente.php?id_cli=<?= $row["id_cli"] ?>&del=true"
                            onclick="return confirm('Tem certeza que deseja desabilitar este cliente?')">Desabilitar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>
