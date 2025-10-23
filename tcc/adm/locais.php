<?php
session_start();
require_once __DIR__ . '/../Models/Local/LocalDAO.php';

if (!isset($_SESSION['logado']) || !isset($_SESSION['usuario'])) {
    header('Location: /tcc-safelab/tcc/public/login.php');
    exit;
}

$usuarioLogado = unserialize($_SESSION['usuario']);
$localDAO = new LocalDAO();
$locais = $localDAO->listarTodos(); // Busca todos os locais
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Locais</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      min-height: 100vh;
      font-family: 'Poppins', sans-serif;
      background-color: #f5f7fa;
    }
    .sidebar {
      width: 250px;
      background: #0d6efd;
      color: white;
      display: flex;
      flex-direction: column;
      padding: 20px;
    }
    .sidebar a {
      color: white;
      text-decoration: none;
      padding: 10px;
      margin: 5px 0;
      border-radius: 8px;
      transition: background 0.3s;
    }
    .sidebar a:hover {
      background: rgba(255,255,255,0.2);
    }
    .main-content {
      flex-grow: 1;
      padding: 40px;
    }
    .table th {
      background-color: #0d6efd;
      color: white;
      text-align: center;
    }
    .table td {
      vertical-align: middle;
      text-align: center;
    }
  </style>
</head>
<body>
  <?php include "includes/sidebar.php"; ?>

  <div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Locais Cadastrados</h2>
      <a href="local/cadastro-local.php" class="btn btn-primary">+ Novo Local</a>
    </div>

    <?php if (!empty($locais)) : ?>
      <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm bg-white rounded">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome do Local</th>
              <th>Descrição</th>
              <th>Ações</th>
            </tr>
          </thead>
<tbody>
            <?php foreach ($locais as $l): ?>
              <tr>
                <td><?= htmlspecialchars($l['id']); ?></td>
                <td><?= htmlspecialchars($l['locais']); ?></td>
                <td><?= htmlspecialchars($l['descricao']); ?></td>
                <td>
                  <a href="local/editar-local.php?id=<?= $l['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                  <a href="../process/local/process_excluir_local.php?id=<?= $l['id']; ?>" 
                    class="btn btn-sm btn-danger"
                    onclick="return confirm('Tem certeza que deseja excluir este usuário?');">
                    Excluir
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else : ?>
      <p class="text-muted">Nenhum administrador cadastrado ainda.</p>
    <?php endif; ?>
  </div>
</body>
</html>