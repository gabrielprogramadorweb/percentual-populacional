<?php
include '../atividade-2/includes/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $cidade = $_POST['cidade'];
    $populacao = $_POST['populacao'];

    // Atualiza os dados no banco de dados
    $sql = "UPDATE dados SET cidade='$cidade', populacao='$populacao' WHERE id='$id'";
    $resultado = mysqli_query($conexao, $sql);

    // Verifique se a atualização foi bem-sucedida
    if ($resultado) {
        header("Location: index.php"); // Redireciona de volta para a página principal
        exit;
    } else {
        echo "Erro na atualização: " . mysqli_error($conexao);
        exit;
    }
} else {
    echo "Método de requisição inválido.";
    exit;
}
?>
