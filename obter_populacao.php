<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtenha a cidade selecionada
    $cidadeSelecionada = $_POST['cidade'];

    // Consulta para obter a população correspondente
    $sql = "SELECT populacao FROM dados WHERE cidade = '$cidadeSelecionada'";
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado) {
        $dados = mysqli_fetch_assoc($resultado);
        $populacao = $dados['populacao'];
        echo $populacao;
    } else {
        echo "Erro na consulta: " . mysqli_error($conexao);
    }
} else {
    echo "Método inválido.";
}
?>
