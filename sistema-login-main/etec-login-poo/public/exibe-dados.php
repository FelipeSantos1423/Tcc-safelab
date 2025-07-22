<?php
session_start();
require_once __DIR__ . '/../models/Usuario.php';

if (!isset($_SESSION['logado']) || !isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$usuario = unserialize($_SESSION['usuario']);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../assets/exibe.css">
    <title>Dados do Usuário</title>
</head>
<body>
    <div class="dados">
    <h1>Dados do Usuário:</h1>
    <h3>Nome Completo:  <?= htmlspecialchars($usuario->getNomeC()); ?></h3>
    <h3>Email: <?= htmlspecialchars($usuario->getEmail()); ?></h3>
   <h3>Voltar para o Login:  <a href="login.php">Login</a>
   </div>
</body>
</html>
