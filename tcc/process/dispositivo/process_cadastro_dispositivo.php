<?php
session_start();
require_once __DIR__ . '/../../Models/Dispositivo/DispositivoDAO.php';

// Verifica login
if (!isset($_SESSION['logado'])) {
    header('Location: ../../public/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $codigo_esp = trim($_POST['codigo_esp']);
    $ativo = isset($_POST['ativo']) ? 1 : 0;
    $tbl_locais_id = (int)$_POST['tbl_locais_id'];

    $dispositivoDAO = new DispositivoDAO();
    $adicionou = $dispositivoDAO->adicionar($nome, $codigo_esp, $ativo, $tbl_locais_id);

    if ($adicionou) {
        header('Location: ../../views/dispositivo/dispositivos.php?msg=dispositivo_adicionado');
        exit;
    } else {
        echo "Erro ao adicionar dispositivo.";
    }
} else {
    header('Location: ../../views/dispositivo/dispositivos.php');
    exit;
}
?>
