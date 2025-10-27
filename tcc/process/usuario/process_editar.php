<?php
session_start();
require_once(__DIR__ . '/../../Models/Usuario/Usuario.php');
require_once(__DIR__ . '/../../Models/Usuario/UsuarioDAO.php');

// Garante que o usuário está logado
if (!isset($_SESSION['logado'])) {
    header('Location: ../login.php');
    exit;
}

// Verifica se veio por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $nomeC = trim($_POST['nomeC']);
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $senha = trim($_POST['senha']);

    if (!$email) {
        echo "Email inválido.";
        exit;
    }

    $usuarioDAO = new UsuarioDAO();
    $usuario = $usuarioDAO->buscarPorId($id);

    if (!$usuario) {
        echo "Usuário não encontrado.";
        exit;
    }

    // Atualiza com ou sem senha
    if ($senha === '') {
        $atualizou = $usuarioDAO->atualizarNomeEmail($id, $nomeC, $email);
    } else {
        $atualizou = $usuarioDAO->atualizarEmailSenha($id, $nomeC, $email, $senha);
    }

    if ($atualizou) {
        // Se o usuário editado for o próprio logado, atualiza a sessão
        $usuarioLogado = unserialize($_SESSION['usuario']);
        if ($id === $usuarioLogado->getId()) {
            $usuarioAtualizado = $usuarioDAO->buscarPorId($id);
            $_SESSION['usuario'] = serialize($usuarioAtualizado);
        }

        header('Location: ../../adm/admins.php?msg=usuario_atualizado');
        exit;
    } else {
        echo "Erro ao atualizar usuário.";
    }
} else {
    header('Location: ../../adm/admins.php');
    exit;
}
?>
