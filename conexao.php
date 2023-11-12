<?php

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "dados";

// Create connection
$conexao = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conexao->connect_error) {
    die("Connection failed: " . $conexao->connect_error);
}

// Set character set to UTF-8 (opcional, ajuste conforme necessário)
$conexao->set_charset("utf8");

?>
