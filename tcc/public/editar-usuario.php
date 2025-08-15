<?php
session_start();
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/UsuarioDAO.php';

if (!isset($_SESSION['logado']) || !isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$usuario = unserialize($_SESSION['usuario']);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../assets/login_cadastro.css">
    <title>Editar Usuário</title>
</head>
<body>
    <form method="post" action="process/process_editar.php">
        <h2>Editar Usuário</h2>
        <br>
        <input type="hidden" name="id" value="<?= $usuario->getId() ?>">

        <label>Nome completo:</label>
        <input type="text" name="nomeC" required value="<?= htmlspecialchars($usuario->getNomeC()) ?>"><br>

        <label>Email:</label>
        <input type="email" name="email" required value="<?= htmlspecialchars($usuario->getEmail()) ?>"><br>

        <label>Nova Senha (deixe vazio para manter a atual):</label>
        <input type="password" name="senha"><br>

        <button type="submit">Salvar Alterações</button>
    </form>
    
</body>
</html>
