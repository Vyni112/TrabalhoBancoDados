<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['senha'];

    $conn = new mysqli('localhost', 'root', '', 'trabalho');

    if ($conn->connect_error) {
        die('Falha na conexão: ' . $conn->connect_error);
    }

    $stmt = $conn->prepare('SELECT * FROM usuario WHERE usuario = ? AND senha = ?');

    if ($stmt === false) {
        die('Erro na preparação da consulta: ' . $conn->error);
    }

    
    $stmt->bind_param('ss', $username, $password); 
    $stmt->execute();

    $result = $stmt->get_result();

    
    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header('Location: index.php'); 
        exit();
    } else {
        echo 'Usuário ou senha incorretos.';
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'Método inválido.';
}
?>
