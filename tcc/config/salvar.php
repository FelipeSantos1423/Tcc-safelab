<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "db_safelab";

// Conectar
$conn = new mysqli($servername, $username, $password, $dbname);

// Checar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Pegar dados do ESP32 (JSON)
$data = json_decode(file_get_contents("php://input"), true);

$temp = $data["temperatura"];
$umid = $data["umidade"];
$luz = $data["luz"];
$ruido = $data["ruido"];

$sql = "INSERT INTO db_safelab.sensores (temperatura, umidade, luz, ruido)
        VALUES ('$temp', '$umid', '$luz', '$ruido')";

if ($conn->query($sql) === TRUE) {
    echo "OK";
} else {
    echo "Erro: " . $conn->error;
}

$conn->close();
?>
