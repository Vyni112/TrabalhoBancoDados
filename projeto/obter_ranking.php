<?php

session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.html");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$database = "trabalho";
$port = 3306; 

$conn = new mysqli($host, $user, $password, $database, $port);


if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$sql = "SELECT usuario.usuario, score.score FROM score
        INNER JOIN usuario ON score.id = usuario.id
        ORDER BY score.score DESC";


$result = $conn->query($sql);


if ($result === false) {
    echo "Erro na consulta: " . $conn->error;
} else {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Usuário: " . $row["usuario"] . " - Pontuação: " . $row["score"] . "<br>";
        }
    } else {
        echo "Nenhum resultado encontrado.";
    }
}

$conn->close();
?>
