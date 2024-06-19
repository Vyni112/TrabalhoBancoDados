<?php
// Configurações do banco de dados
$host = "localhost";
$user = "root";
$password = "";
$database = "trabalho";
$port = 3306; // Porta padrão do MySQL

// Cria a conexão
$conn = new mysqli($host, $user, $password, $database, $port);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Query SQL para obter o ranking de scores
$sql = "SELECT * FROM score";

// Executa a consulta SQL
$result = $conn->query($sql);

// Verifica se a consulta foi bem-sucedida
if ($result === false) {
    echo "Erro na consulta: " . $conn->error;
} else {
    // Verifica se há resultados
    if ($result->num_rows > 0) {
        // Monta a tabela de ranking em HTML
        echo "<table>";
        echo "<tr><th>Posição</th><th>Nome do Jogador</th><th>Score</th></tr>";
        $posicao = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $posicao . "</td><td>" . $row[""] . "</td><td>" . $row["score"] . "</td></tr>";
            $posicao++;
        }
        echo "</table>";
    } else {
        echo "Nenhum resultado encontrado.";
    }
}

// Fecha a conexão
$conn->close();
?>
