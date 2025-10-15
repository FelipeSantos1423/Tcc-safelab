<?php
session_start();
require_once(__DIR__ . '/../../models/Usuario/Usuario.php');
require_once(__DIR__ . '/../../Models/Usuario/UsuarioDAO.php');

if (!isset($_SESSION['logado'])) {
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id']; // usuário a ser editado
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
        // Só atualiza a sessão se o usuário editado for ele mesmo
        if ($id === unserialize($_SESSION['usuario'])->getId()) {
            $usuarioAtualizado = $usuarioDAO->buscarPorId($id);
            $_SESSION['usuario'] = serialize($usuarioAtualizado);
        }

        header('Location: ../admin_usuarios.php?msg=usuario_atualizado');
        exit;
    } else {
        echo "Erro ao atualizar usuário.";
    }
} else {
    header('Location: ../admin_usuarios.php');
    exit;
}
?>
