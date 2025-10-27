<!-- admin_dashboard.php -->
 <?php
session_start();
require_once __DIR__ . '/../Models/Usuario/UsuarioDAO.php';

if (!isset($_SESSION['logado']) || !isset($_SESSION['usuario'])) {
    header('Location: /tcc-safelab/tcc/public/login.php');
    exit;
}

$usuarioLogado = unserialize($_SESSION['usuario']);

$usuarioDAO = new UsuarioDAO();
$usuarios = $usuarioDAO->listarTodos(); // Busca todos os usuários no banco
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel do Administrador</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include "includes/sidebar.php"; ?>

  <!-- Main Content -->
  <div class="main-content">
    <div class="welcome-card">
      <h1>Bem-vindo, Administrador!</h1>
      <p class="mt-2 text-muted">Escolha uma das ações abaixo para começar:</p>

      <div class="actions">
        <a href="dispositivo/cadastro-dispositivo.php" class="btn btn-primary">Adicionar Dispositivo</a>
        <a href="local/cadastro-local.php" class="btn btn-success">Adicionar Local</a>
        <a href="usuario/cadastro.php" class="btn btn-secondary">Novo Admin</a>
      </div>
    </div>
  </div>

</body>
</html>
