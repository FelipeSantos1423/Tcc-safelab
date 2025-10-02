<?php

require_once(__DIR__ . '/../../models/UsuarioDAO.php');
require_once(__DIR__ . '/../../utils/Sanitizacao.php');

// Sanitiza entradas
$nomeC = Sanitizacao::sanitizar($_POST['nomeC']);
$email = Sanitizacao::sanitizar($_POST['email']);
$senha = Sanitizacao::sanitizar($_POST['senha']);

$usuarioDAO = new UsuarioDAO();
$sucesso = $usuarioDAO->cadastrar($nomeC, $email, $senha);

 // Verifica se usuario já existe
 if ($usuarioDAO->buscarPorEmail($email)) {
    echo 'Ir para página de <a href="../login.php">Login</a><br>';
    echo 'Ir para página de <a href="../cadastro.php">cadastro</a><br>';
    die('Usuário já cadastrado.');
}

if ($sucesso) {
    echo "Usuário cadastrado com sucesso! <br><br>";
    echo 'Ir para página de <a href="../login.php">Login</a>';
} else {
    echo "Erro: e-mail já cadastrado ou falha ao inserir no banco.";
}
?>
