<?php
// ===============================================
// API que recebe dados do ESP32 e salva no banco
// ===============================================

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // permite acesso externo (ESP32)
header('Access-Control-Allow-Methods: POST');

// ---------------- Conexão com o banco ----------------
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../Models/Leitura/LeituraDAO.php';
require_once __DIR__ . '/../Models/Dispositivo/DispositivoDAO.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Método não suportado. Use POST.']);
    exit;
}

// ---------------- Lê dados enviados ----------------
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'JSON inválido.']);
    exit;
}

// Campos esperados
$codigoEsp = $data['codigo_esp'] ?? null;
$temperatura = $data['temperatura'] ?? null;
$umidade = $data['umidade'] ?? null;
$luz = $data['luz'] ?? null;
$ruido = $data['ruido'] ?? null;

if (!$codigoEsp || $temperatura === null || $umidade === null || $luz === null || $ruido === null) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Dados incompletos.']);
    exit;
}

// ---------------- Busca ID do dispositivo ----------------
$dispDAO = new DispositivoDAO();
$dispositivo = $dispDAO->buscarPorCodigo($codigoEsp);

if (!$dispositivo) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Dispositivo não encontrado no banco.']);
    exit;
}

// ---------------- Insere leitura ----------------
$leituraDAO = new LeituraDAO();
$resultado = $leituraDAO->inserir([
    'tbl_dispositivos_id' => $dispositivo['id'],
    'temperatura' => $temperatura,
    'umidade' => $umidade,
    'luz' => $luz,
    'ruido' => $ruido,
    'data_registro' => date('Y-m-d H:i:s')
]);

if ($resultado) {
    echo json_encode(['status' => 'ok', 'mensagem' => 'Leitura registrada com sucesso!']);
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Falha ao registrar leitura.']);
}
?>
