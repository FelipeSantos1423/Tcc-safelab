<?php
session_start();
require_once __DIR__ . '/../../Models/Dispositivo/DispositivoDAO.php';

if (!isset($_SESSION['logado'])) {
    header('Location: ../../public/login.php');
    exit;
}

if (!isset($_GET['id'])) {
    die("ID do dispositivo não informado.");
}

$id = intval($_GET['id']);
$dao = new DispositivoDAO();
$excluiu = $dao->excluir($id);

if ($excluiu) {
    header('Location: ../../adm/dispositivos.php?msg=dispositivo_excluido');
    exit;
} else {
    echo "Erro ao excluir dispositivo.";
}
?>
