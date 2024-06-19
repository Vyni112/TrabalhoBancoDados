<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["score"])) {
    

    if (isset($_SESSION["usuario_id"])) {
        $usuario_id = $_SESSION["usuario_id"];

        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "trabalho";
        $port = 3306; 

        $conn = new mysqli($host, $user, $password, $database, $port);

        if ($conn->connect_error) {
            die("Erro de conexão: " . $conn->connect_error);
        }

        $sql = "INSERT INTO score (resultado) 
                VALUES ('$resultado')";

        if ($conn->query($sql) === TRUE) {
            header("Location: ranking.html");
            exit();
        } else {
            echo "Erro ao registrar score: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Usuário não autenticado!";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["usuario"])) {

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "trabalho";
    $port = 3306; 

    $conn = new mysqli($host, $user, $password, $database, $port);

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    $sql_insert_user = "INSERT INTO usuario (usuario, senha) VALUES ('$usuario', '$senha')";

    if ($conn->query($sql_insert_user) === TRUE) {
        $usuario_id = $conn->insert_id;
    
        $_SESSION["usuario_id"] = $usuario_id;
   
        $conn->close();
    
        header("Location: inicial.php");
        exit();
    } else {
        echo "Erro ao cadastrar usuário: " . $conn->error;
    }
}
?>
