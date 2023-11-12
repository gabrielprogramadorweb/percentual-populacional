<?php

// Credenciais do banco de dados
$servername = 'localhost'; // Nome do servidor
$username = 'root'; // Nome de usuário
$password = ''; // Senha
$database = 'dados'; // Nome do banco de dados

// Criação da conexão
$conexao = new mysqli($servername, $username, $password, $database);

// Verifica a conexão
if ($conexao->connect_error) {
    exit('Falha na conexão: '.$conexao->connect_error);
}

// Define o conjunto de caracteres para UTF-8 (opcional, ajuste conforme necessário)
$conexao->set_charset('utf8');
