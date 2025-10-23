<?php
session_start();
require_once __DIR__ . '/../Models/Dispositivo/DispositivoDAO.php';

if (!isset($_SESSION['logado'])) {
    header('Location: ../public/login.php');
    exit;
}

$dispositivoDAO = new DispositivoDAO();
$dispositivos = $dispositivoDAO->listarTodos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dispositivos</title>
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
      <h2>Dispositivos Cadastrados</h2>
      <a href="dispositivo/cadastro-dispositivo.php" class="btn btn-primary">+ Novo Dispositivo</a>
    </div>

    <?php if (!empty($dispositivos)) : ?>
      <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm bg-white rounded">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Código Especial</th>
              <th>Ativo</th>
              <th>Local</th>
              <th>Criado Em</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($dispositivos as $d): ?>
              <tr>
                <td><?= htmlspecialchars($d['id']); ?></td>
                <td><?= htmlspecialchars($d['nome']); ?></td>
                <td><?= htmlspecialchars($d['codigo_esp']); ?></td>
                <td><?= $d['ativo'] ? 'Sim' : 'Não'; ?></td>
                <td><?= htmlspecialchars($d['nome_local']); ?></td>
                <td><?= date('d/m/Y H:i', strtotime($d['criado_em'])); ?></td>
                <td>
                  <a href="dispositivo/editar-dispositivo.php?id=<?= $d['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                  <a href="../process/dispositivo/process_excluir_dispositivo.php?id=<?= $d['id']; ?>" 
                     class="btn btn-sm btn-danger"
                     onclick="return confirm('Tem certeza que deseja excluir este dispositivo?');">
                     Excluir
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else : ?>
      <p class="text-muted">Nenhum dispositivo cadastrado ainda.</p>
    <?php endif; ?>
  </div>
</body>
</html>
