<?php
session_start();
require_once __DIR__ . '/../../Models/Local/LocalDAO.php';
if (!isset($_SESSION['logado'])) {
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $locais = trim($_POST['locais']);
    $descricao = trim($_POST['descricao']);

    $localDAO = new LocalDAO();
    $inseriu = $localDAO->adicionar($locais, $descricao);

    if ($inseriu) {
        header('Location: ../../views/local/admin_locais.php?msg=local_cadastrado');
        exit;
    } else {
        echo "Erro ao cadastrar local.";
    }
} else {
    header('Location: ../../views/local/admin_locais.php');
    exit;
}
?>
