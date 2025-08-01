<?php
session_start();
require_once __DIR__ . '/../models/UsuarioDAO.php';

if (!isset($_SESSION['logado']) || !isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$usuario = unserialize($_SESSION['usuario']);
$id = $usuario->getId();

$usuarioDAO = new UsuarioDAO();
$excluiu = $usuarioDAO->excluir($id);

if ($excluiu) {
    session_destroy();
    header('Location: login.php?msg=conta_excluida');
    exit;
} else {
    echo "Erro ao excluir usuário.";
}
