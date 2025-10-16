<?php
session_start();

require_once(__DIR__ . '/../../Models/Local/LocalDAO.php');

if (!isset($_GET['id'])) {
    die("ID do usuário não informado.");
}

$id = intval($_GET['id']);

$localDAO = new LocalDAO();
$excluiu = $localDAO->excluir($id);

if ($excluiu) {
    header('Location: ../../local/locais.php?msg=local_excluido'); //arrumar caminho
    exit;
} else {
    echo "Erro ao excluir usuário.";
}

