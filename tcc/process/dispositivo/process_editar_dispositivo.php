<?php
session_start();
require_once __DIR__ . '/../../Models/Dispositivo/DispositivoDAO.php';

// Verifica login
if (!isset($_SESSION['logado'])) {
    header('Location: ../../public/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $nome = trim($_POST['nome']);
    $codigo_esp = trim($_POST['codigo_esp']);
    $ativo = isset($_POST['ativo']) ? 1 : 0;
    $tbl_locais_id = (int)$_POST['tbl_locais_id'];

    $dispositivoDAO = new DispositivoDAO();
    $dispositivo = $dispositivoDAO->buscarPorId($id);

    if (!$dispositivo) {
        echo "Dispositivo não encontrado.";
        exit;
    }

    $atualizou = $dispositivoDAO->atualizar($id, $nome, $codigo_esp, $ativo, $tbl_locais_id);

    if ($atualizou) {
        header('Location: ../../views/dispositivo/dispositivos.php?msg=dispositivo_atualizado');
        exit;
    } else {
        echo "Erro ao atualizar dispositivo.";
    }
} else {
    header('Location: ../../views/dispositivo/dispositivos.php');
    exit;
}
?>
