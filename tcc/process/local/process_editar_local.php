<?php
session_start();
require_once(__DIR__ . '/../../Models/Local/Local.php');
require_once(__DIR__ . '/../../Models/Local/LocalDAO.php');

// Garante que o usuário está logado
if (!isset($_SESSION['logado'])) {
    header('Location: ../../public/login.php');
    exit;
}

// Verifica se veio por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $locais = trim($_POST['locais']);
    $descricao = trim($_POST['descricao']);

    // Validação básica
    if (empty($locais)) {
        echo "O campo 'locais' é obrigatório.";
        exit;
    }

    $localDAO = new LocalDAO();
    $local = $localDAO->buscarPorId($id);

    if (!$local) {
        echo "Local não encontrado.";
        exit;
    }

    // Atualiza o local
    $atualizou = $localDAO->atualizar($id, $locais, $descricao);

    if ($atualizou) {
        header('Location: ../../adm/local/locais.php?msg=local_atualizado');
        exit;
    } else {
        echo "Erro ao atualizar local.";
    }
} else {
    header('Location: ../../adm/local/locais.php');
    exit;
}
?>
