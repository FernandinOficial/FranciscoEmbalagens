<?php
include_once 'auth.php';  // Verifica se está logado
include_once '../auth/includes/db_connect.php';

$erro = '';
$success = '';

// Inserir/Atualizar Fornecedor
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nome_for"], $_POST["email_for"], $_POST["documento_for"], $_POST["data_cadastro_for"], $_POST["bairro_for"], $_POST["cidade_for"], $_POST["cep_for"], $_POST["celular_for"], $_POST["uf_for"])) {
        if (empty($_POST["nome_for"]) || empty($_POST["email_for"]) || empty($_POST["documento_for"]) || empty($_POST["data_cadastro_for"]) || empty($_POST["bairro_for"]) || empty($_POST["cidade_for"]) || empty($_POST["cep_for"]) || empty($_POST["celular_for"]) || empty($_POST["uf_for"])) {
            $erro = "Todos os campos obrigatórios devem ser preenchidos.";
        } else {
            $id_for = isset($_POST["id_for"]) ? $_POST["id_for"] : -1;
            $nome_for = $_POST["nome_for"];
            $email_for = $_POST["email_for"];
            $documento_for = $_POST["documento_for"];
            $data_cadastro_for = $_POST["data_cadastro_for"];
            $bairro_for = $_POST["bairro_for"];
            $cidade_for = $_POST["cidade_for"];
            $cep_for = $_POST["cep_for"];
            $celular_for = $_POST["celular_for"];
            $uf_for = $_POST["uf_for"];
            $status_for = 'ativo';  //definir ativo sempre
            $telefone_for = isset($_POST["telefone_for"]) ? $_POST["telefone_for"] : null;

            if ($id_for == -1) { // Inserir novo fornecedor
                $stmt = $mysqli->prepare("INSERT INTO Fornecedor (nome_for, email_for, documento_for, data_cadastro_for, bairro, cidade, cep, celular_for, uf, telefone_for, status_for) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssssssss", $nome_for, $email_for, $documento_for, $data_cadastro_for, $bairro_for, $cidade_for, $cep_for, $celular_for, $uf_for, $telefone_for, $status_for);

                if ($stmt->execute()) {
                    $success = "Fornecedor cadastrado com sucesso.";
                } else {
                    $erro = "Erro ao cadastrar fornecedor: " . $stmt->error;
                }
            } else { // Atualizar fornecedor existente
                $stmt = $mysqli->prepare("UPDATE Fornecedor SET nome_for = ?, email_for = ?, documento_for = ?, data_cadastro_for = ?, bairro = ?, cidade = ?, cep = ?, celular_for = ?, uf = ?, telefone_for = ?, status_for = ? WHERE id_for = ?");
                $stmt->bind_param("sssssssssssi", $nome_for, $email_for, $documento_for, $data_cadastro_for, $bairro_for, $cidade_for, $cep_for, $celular_for, $uf_for, $telefone_for, $status_for, $id_for);

                if ($stmt->execute()) {
                    $success = "Fornecedor atualizado com sucesso.";
                } else {
                    $erro = "Erro ao atualizar fornecedor: " . $stmt->error;
                }
            }
        }
    } else {
        $erro = "Todos os campos obrigatórios devem ser preenchidos.";
    }
}

// Desabilitar Fornecedor
if (isset($_GET["id_for"]) && is_numeric($_GET["id_for"]) && isset($_GET["del"])) {
    $id_for = (int) $_GET["id_for"];
    $stmt = $mysqli->prepare("UPDATE Fornecedor SET status_for = 'desabilitado' WHERE id_for = ?");
    $stmt->bind_param('i', $id_for);
    if ($stmt->execute()) {
        $success = "Fornecedor desabilitado com sucesso.";
    } else {
        $erro = "Erro ao desabilitar fornecedor: " . $stmt->error;
    }
}

// Consulta para buscar todos os fornecedores ativos
$sql = "SELECT * FROM Fornecedor WHERE status_for = 'ativo'";
$fornecedores = $mysqli->query($sql);

if (!$fornecedores) {
    $erro = "Erro ao buscar fornecedores: " . $mysqli->error;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fornecedor | Francisco Embalagens</title>
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

        <label for="email_for">Email:</label><br>
        <input type="email" name="email_for"
            value="<?= isset($_POST['email_for']) ? htmlspecialchars($_POST['email_for']) : '' ?>" required><br><br>

        <label for="documento_for">Documento:</label><br>
        <input type="text" name="documento_for" id="documento_for" placeholder="99.999.999/0001-99" maxlength="18"
            value="<?= isset($_POST['documento_for']) ? htmlspecialchars($_POST['documento_for']) : '' ?>"
            required><br><br>

        <script>
            document.getElementById('documento_for').addEventListener('input', function (event) {
                // Chama a função para formatar o CNPJ
                let valorFormatado = MascaraParaLabel(event.target.value);

                // Atualiza o campo com o valor formatado
                event.target.value = valorFormatado;
            });

            function MascaraParaLabel(valorDoTextBox) {
                // Remove caracteres não numéricos
                valorDoTextBox = valorDoTextBox.replace(/\D/g, '');

                // Aplica a máscara se o comprimento for menor ou igual a 14 caracteres
                if (valorDoTextBox.length <= 14) {
                    // Coloca ponto entre o segundo e o terceiro dígitos
                    valorDoTextBox = valorDoTextBox.replace(/^(\d{2})(\d)/, "$1.$2");

                    // Coloca ponto entre o quinto e o sexto dígitos
                    valorDoTextBox = valorDoTextBox.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");

                    // Coloca uma barra entre o oitavo e o nono dígitos
                    valorDoTextBox = valorDoTextBox.replace(/^(\d{2})\.(\d{3})\.(\d{3})(\d)/, "$1.$2.$3/$4");

                    // Coloca um hífen depois do bloco de quatro dígitos
                    valorDoTextBox = valorDoTextBox.replace(/^(\d{2})\.(\d{3})\.(\d{3})\/(\d{4})(\d)/, "$1.$2.$3/$4-$5");
                }

                return valorDoTextBox;
            }

        </script>




        <label for="data_cadastro_for">Data de Cadastro:</label><br>
        <input type="datetime-local" name="data_cadastro_for"
            value="<?= isset($_POST['data_cadastro_for']) ? htmlspecialchars($_POST['data_cadastro_for']) : '' ?>"
            required><br><br>

        <label for="cep_for">CEP:</label><br>
        <input type="text" name="cep_for"
            value="<?= isset($_POST['cep_for']) ? htmlspecialchars($_POST['cep_for']) : '' ?>" required><br><br>

        <label for="bairro_for">Bairro:</label><br>
        <input type="text" name="bairro_for"
            value="<?= isset($_POST['bairro_for']) ? htmlspecialchars($_POST['bairro_for']) : '' ?>" required><br><br>

        <label for="cidade_for">Cidade:</label><br>
        <input type="text" name="cidade_for"
            value="<?= isset($_POST['cidade_for']) ? htmlspecialchars($_POST['cidade_for']) : '' ?>" required><br><br>

        <label for="telefone_for">Telefone:</label><br>
        <input type="text" name="telefone_for" maxlength="8"
            value="<?= isset($_POST['telefone_for']) ? htmlspecialchars($_POST['telefone_for']) : '' ?>"><br><br>

        <label for="celular_for">Celular:</label><br>
        <input type="text" name="celular_for" maxlength="11"
            value="<?= isset($_POST['celular_for']) ? htmlspecialchars($_POST['celular_for']) : '' ?>" required><br><br>


        <!-- <label for="uf_for">UF:</label><br>
            <input type="text" name="uf_for"
            value="<?//= isset($_POST['uf_for']) ? htmlspecialchars($_POST['uf_for']) : '' ?>" required><br><br> -->

        <label for="uf_for">UF:</label><br>
        <select name="uf_for" required>
            <option value="">SELECIONE</option>
            <option value="AC">AC</option>
            <option value="AL">AL</option>
            <option value="AP">AP</option>
            <option value="AM">AM</option>
            <option value="BA">BA</option>
            <option value="CE">CE</option>
            <option value="DF">DF</option>
            <option value="ES">ES</option>
            <option value="GO">GO</option>
            <option value="MA">MA</option>
            <option value="MT">MT</option>
            <option value="MS">MS</option>
            <option value="MG">MG</option>
            <option value="PA">PA</option>
            <option value="PB">PB</option>
            <option value="PR">PR</option>
            <option value="PE">PE</option>
            <option value="PI">PI</option>
            <option value="RJ">RJ</option>
            <option value="RN">RN</option>
            <option value="RS">RS</option>
            <option value="RO">RO</option>
            <option value="RR">RR</option>
            <option value="SC">SC</option>
            <option value="SP">SP</option>
            <option value="SE">SE</option>
            <option value="TO">TO</option>
        </select><br><br>

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
                <th>Email</th>
                <th>Documento</th>
                <th>Data de Cadastro</th>
                <th>Bairro</th>
                <th>Cidade</th>
                <th>UF</th>
                <th>CEP</th>
                <th>Telefone</th>
                <th>Celular</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fornecedor = $fornecedores->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($fornecedor['id_for']) ?></td>
                    <td><?= htmlspecialchars($fornecedor['nome_for']) ?></td>
                    <td><?= htmlspecialchars($fornecedor['email_for']) ?></td>
                    <td><?= htmlspecialchars($fornecedor['documento_for']) ?></td>
                    <td><?= htmlspecialchars($fornecedor['data_cadastro_for']) ?></td>
                    <td><?= htmlspecialchars($fornecedor['bairro']) ?></td>
                    <td><?= htmlspecialchars($fornecedor['cidade']) ?></td>
                    <td><?= htmlspecialchars($fornecedor['uf']) ?></td>
                    <td><?= htmlspecialchars($fornecedor['cep']) ?></td>
                    <td><?= htmlspecialchars($fornecedor['telefone_for']) ?></td>
                    <td><?= htmlspecialchars($fornecedor['celular_for']) ?></td>
                    <td><?= htmlspecialchars($fornecedor['status_for']) ?></td>
                    <td>
                        <a href="fornecedor.php?id_for=<?= $fornecedor['id_for'] ?>&del=1"
                            onclick="return confirm('Tem certeza que deseja desabilitar este fornecedor?')">Desabilitar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>