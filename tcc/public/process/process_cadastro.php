<?php
    
require_once(__DIR__ . '/../../models/UsuarioDAO.php');
require_once(__DIR__ . '/../../utils/Sanitizacao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Sanitiza entradas
$nomeC = Sanitizacao::sanitizar($_POST['nomeC']);
$email = Sanitizacao::sanitizar($_POST['email']);
$senha = Sanitizacao::sanitizar($_POST['senha']);
$tipo_usuario_id = $_POST['tipo_usuario_id'] ?? '';

    // Validações simples
    if (empty($nomeC) || empty($email) || empty($senha) || empty($tipo_usuario_id)) {
        die('Preencha todos os campos.');
    }

    $usuarioDAO = new UsuarioDAO();

    // Verifica se email já existe
    if ($usuarioDAO->buscarPorEmail($email)) {
        die('Email já cadastrado.');
    }

    // Cria objeto usuário
    $usuario = new Usuario();
    $usuario->setNomeC($nomeC);
    $usuario->setEmail($email);
    $usuario->setSenhaHash(password_hash($senha, PASSWORD_DEFAULT));
    $usuario->setTipo((int)$tipo_usuario_id);

    try {
        $id = $usuarioDAO->criarUsuario($usuario);
        if ($id) {
            echo "Usuário cadastrado com sucesso! ID: $id";
        } else {
            echo "Erro ao cadastrar usuário. Tente novamente mais tarde.";
        }
    }catch (Exception $e) {
    error_log('Erro no cadastro de usuário: ' . $e->getMessage());
    // Mostra o erro detalhado (apenas para teste, remova depois)
    die("Erro no cadastro: " . $e->getMessage());
}

} else {
    echo "Método inválido.";
}

session_start(); // Inicia a sessão no começo do arquivo

// ... seu código de cadastro ...

if ($id) {  // Se cadastro deu certo
    $_SESSION['msg_sucesso'] = "Cadastro realizado com sucesso!";
    header("Location: ../index.php"); // Substitua pelo nome da página para onde quer ir
    exit;
} else {
    echo "Erro ao cadastrar usuário.";
}


?>
