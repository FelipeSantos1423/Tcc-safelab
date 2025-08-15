<?php 
session_start();
require_once(__DIR__ . '/../../models/Usuario.php');
require_once(__DIR__ . '/../../models/UsuarioDAO.php');

// Verifica se está logado antes de processar
if (!isset($_SESSION['logado'])) {
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];
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

    if ($senha === '') {
        $atualizou = $usuarioDAO->atualizarNomeEmail($id, $nomeC, $email);
    } else {
        $atualizou = $usuarioDAO->atualizarEmailSenha($id, $nomeC, $email, $senha);
    }

    if ($atualizou) {
        $usuarioAtualizado = $usuarioDAO->buscarPorId($id);
        $_SESSION['usuario'] = serialize($usuarioAtualizado);

        header('Location: ../exibe-dados.php');
        exit;
    } else {
        echo "Erro ao atualizar usuário.";
    }
} else {
    // Se o método não for POST, pode redirecionar para a página de edição ou login
    header('Location: ../editar-usuario.php');
    exit;
}
