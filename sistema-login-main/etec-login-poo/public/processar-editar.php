<?php
session_start();
require_once __DIR__ . '/../models/UsuarioDAO.php';
require_once __DIR__ . '/../models/Usuario.php';

if (!isset($_SESSION['logado'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $senha = trim($_POST['senha']);

    if (!$email) {
        echo "Email inválido.";
        exit;
    }

    $usuarioDAO = new UsuarioDAO();

    // Buscar o usuário para garantir que existe
    $usuario = $usuarioDAO->buscarPorId($id);
    if (!$usuario) {
        echo "Usuário não encontrado.";
        exit;
    }

    // Atualizar email e senha
    if ($senha === '') {
        // Senha vazia = não altera a senha
        $atualizou = $usuarioDAO->atualizarEmail($id, $email);
    } else {
        $atualizou = $usuarioDAO->atualizarEmailSenha($id, $email, $senha);
    }

    if ($atualizou) {
        // Atualiza o objeto na sessão
        $usuario = $usuarioDAO->buscarPorId($id);
        $_SESSION['usuario'] = serialize($usuario);

        header('Location: exibe-dados.php');
        exit;
    } else {
        echo "Erro ao atualizar usuário.";
    }
}
?>
