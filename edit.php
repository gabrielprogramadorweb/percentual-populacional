<?php
include 'conexao.php';

// Verifica se o formulário de edição foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cidade"])) {
    // Obtém os dados do formulário
    $cidadeEditar = $_POST["cidade"];
    $novaPopulacao = $_POST["novaPopulacao"];

    // Atualiza a população no banco de dados
    $sqlUpdate = "UPDATE dados SET populacao = $novaPopulacao WHERE cidade = '$cidadeEditar'";
    mysqli_query($conexao, $sqlUpdate);
}

// Verifica se o formulário de inserção foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["novaCidade"]) && isset($_POST["novaPopulacao"])) {
    // Obtém os dados do formulário de inserção
    $novaCidade = $_POST["novaCidade"];
    $novaPopulacao = $_POST["novaPopulacao"];

    // Insere a nova cidade e população no banco de dados
    $sqlInsert = "INSERT INTO dados (cidade, populacao) VALUES ('$novaCidade', $novaPopulacao)";
    mysqli_query($conexao, $sqlInsert);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
          crossorigin="anonymous">

    <title>Gráficos Ricardo Milbrath</title>
</head>
<body>
<div class="content">
    <!-- Barra de navegação aqui -->
    <?php
    include 'nav.php';
    ?>
    <div class="container mt-5 ">
        <div class="row">
            <!-- ... (código existente) ... -->
            <div class="col-md-6">
    <h2 class="mb-4">Tabela de Percentual de População</h2>
    <h6 class="mb-4 link">&nbsp; Atualizar dados conforme informações no portal <a href="https://cidades.ibge.gov.br/" target="_blank">IBGE</a></h6>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Cidade</th>
            <th scope="col">População</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM dados ORDER BY populacao DESC";
        $busca = mysqli_query($conexao, $sql);

        while ($dados = mysqli_fetch_array($busca)) {
            $cidade = $dados['cidade'];
            $populacao = number_format($dados['populacao'], 0, '', '.');

            // Adiciona um ícone de edição e um botão de exclusão para cada cidade
            echo "<tr>";
            echo "<td>$cidade</td>";
            echo "<td>$populacao</td>";
            echo "<td>";
            echo "<a href='edit.php?cidade=$cidade' class='btn btn-warning btn-sm'><i class='bi bi-pencil'></i> Editar</a>";
            echo " <a href='excluir.php?cidade=$cidade' class='btn btn-danger btn-sm'><i class='bi bi-trash'></i> Excluir</a>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
        </div>
    </div>

    <!-- Formulário de Edição -->
    <?php
    if (isset($_GET['cidade'])) {
        $cidadeEditar = $_GET['cidade'];
        $sqlCidade = "SELECT * FROM dados WHERE cidade = '$cidadeEditar'";
        $resultadoCidade = mysqli_query($conexao, $sqlCidade);
        $dadosCidade = mysqli_fetch_array($resultadoCidade);
        ?>
        <div class="container mt-3">
            <h2>Editar População de <?php echo $cidadeEditar; ?></h2>
            <form method="post" action="edit.php">
                <input type="hidden" name="cidade" value="<?php echo $cidadeEditar; ?>">
                <div class="mb-3">
                    <label for="novaPopulacao" class="form-label">Nova População:</label>
                    <input type="text" class="form-control" id="novaPopulacao" placeholder="Apenas números, remova os pontos" name="novaPopulacao"
                           value="<?php echo $dadosCidade['populacao']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </form>
        </div>
        <?php
    }
    ?>

    <!-- Formulário de Inserção -->
    <div class="container mt-3">
        <h2>Adicionar Nova Cidade</h2>
        <form method="post" action="edit.php">
            <div class="mb-3">
                <label for="novaCidade" class="form-label">Nova Cidade:</label>
                <input type="text" class="form-control" id="novaCidade" name="novaCidade" required>
            </div>
            <div class="mb-3">
                <label for="novaPopulacaoInserir" class="form-label">População:</label>
                <input type="text" class="form-control" id="novaPopulacaoInserir" placeholder="Apenas números, remova os pontos" name="novaPopulacao" required>
            </div>
            <button type="submit" class="btn btn-success">Adicionar Cidade</button>
        </form>
    </div>

</div>
<?php include 'footer.php'; ?>
</body>
</html>
