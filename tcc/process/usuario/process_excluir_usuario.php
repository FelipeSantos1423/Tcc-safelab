<?php
session_start();

require_once(__DIR__ . '/../../Models/Usuario/UsuarioDAO.php');

if (!isset($_GET['id'])) {
    die("ID do usuário não informado.");
}

$id = intval($_GET['id']);

$usuarioDAO = new UsuarioDAO();
$excluiu = $usuarioDAO->excluir($id);

if ($excluiu) {
    header('Location: ../../adm/admins.php?msg=usuario_excluido'); //arrumar caminho
    exit;
} else {
    echo "Erro ao excluir usuário.";
}

