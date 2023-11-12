<?php
include '../../atividade-2/includes/conexao.php';

// Verifica se a conexão foi bem-sucedida
if ($conexao->connect_error) {
    die("Connection failed: " . $conexao->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["cidade"])) {
    $cidadeExcluir = $_GET["cidade"];

    // Executa a exclusão no banco de dados
    $sqlExcluir = "DELETE FROM dados WHERE cidade = '$cidadeExcluir'";
    mysqli_query($conexao, $sqlExcluir);

    // Redireciona de volta para a página principal após excluir
    header("Location: ../index.php?exclusao=sucesso");
    exit();
} else {
    // Se não foi fornecido um parâmetro válido, redireciona para a página principal
    header("Location: ../index.php?exclusao=erro");
    exit();
}
?>
