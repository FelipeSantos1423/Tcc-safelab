<?php
session_start();

require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/UsuarioDAO.php';
require_once __DIR__ .  '/../utils/Sanitizacao.php';

// Sanitiza as entradas
$nomeC = Sanitizacao::sanitizar($_POST['nomeC']);
$email = Sanitizacao::sanitizar($_POST['email']);
$senha = Sanitizacao::sanitizar($_POST['senha']);

//Cria classe usuário
$usuario = new Usuario();
$usuario->setNomeC($nomeC);
$usuario->setEmail($email);
$usuario->setSenhaHash(password_hash($senha, PASSWORD_DEFAULT));

// Insere no banco
$usuarioDAO = new UsuarioDAO();
$newUser = $usuarioDAO->criarUsuario($usuario);

if ($newUser) {
    $_SESSION['usuario_id'] = $newUser;
    $_SESSION['mensagem'] = "Usuário cadastrado com ID: " . $newUser;
    header("Location: login.php");
    exit();
} else {
    echo "Erro ao cadastrar usuário!";
}

?>