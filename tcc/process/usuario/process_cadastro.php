<?php

require_once(__DIR__ . '/../../Models/Usuario/UsuarioDAO.php');
require_once(__DIR__ . '/../../utils/Sanitizacao.php');

// Sanitiza entradas
$nomeC = Sanitizacao::sanitizar($_POST['nomeC']);
$email = Sanitizacao::sanitizar($_POST['email']);
$senha = Sanitizacao::sanitizar($_POST['senha']);

$usuarioDAO = new UsuarioDAO();
$sucesso = $usuarioDAO->cadastrar($nomeC, $email, $senha);

 // Verifica se usuario já existe
 if ($usuarioDAO->buscarPorEmail($email)) {
    header('Location: ../../adm/admins.php?msg=usuario_ja_cadastrado');
        exit;
    die('Usuário já cadastrado.');
}

if ($sucesso) {
    header('Location: ../../adm/admins.php?msg=usuario_cadastrado');
} else {
    echo "Erro: e-mail já cadastrado ou falha ao inserir no banco.";
}
?>
