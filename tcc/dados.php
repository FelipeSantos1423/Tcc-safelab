<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "db_safelab";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM db_safelab.sensores ORDER BY data_registro DESC LIMIT 10");

$dados = [];
while ($row = $result->fetch_assoc()) {
    $dados[] = $row;
}

echo json_encode($dados);

$conn->close();
?>
