<?php
require_once(__DIR__ . '/config/Database.php');

$result = $conn->query("SELECT * FROM sensores ORDER BY data_registro DESC LIMIT 10");

$dados = [];
while ($row = $result->fetch_assoc()) {
    $dados[] = $row;
}

echo json_encode($dados);

$conn->close();
?>
