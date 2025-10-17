<!-- admin_dashboard.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel do Administrador</title>
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
    .sidebar h2 {
      font-size: 1.4rem;
      text-align: center;
      margin-bottom: 20px;
    }
    .sidebar a {
      color: white;
      text-decoration: none;
      padding: 10px;
      margin: 5px 0;
      border-radius: 8px;
      display: block;
      transition: background 0.3s;
    }
    .sidebar a:hover {
      background: rgba(255,255,255,0.2);
    }
    .main-content {
      flex-grow: 1;
      padding: 30px;
    }
    .welcome-card {
      background: white;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      text-align: center;
    }
    .actions {
      margin-top: 20px;
      display: flex;
      justify-content: center;
      gap: 15px;
      flex-wrap: wrap;
    }
    @media(max-width: 768px) {
      .sidebar {
        display: none;
      }
      body {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>
    <?php include "includes/sidebar.php"; ?>

  <!-- Main Content -->
  <div class="main-content">
    <div class="welcome-card">
      <h1>Bem-vindo, Administrador!</h1>
      <p class="mt-2 text-muted">Escolha uma das ações abaixo para começar:</p>

      <div class="actions">
        <a href="dispositivos/cadastro_dispositivo.php" class="btn btn-primary">Adicionar Dispositivo</a>
        <a href="locais/cadastro_local.php" class="btn btn-success">Adicionar Local</a>
        <a href="admins/cadastro.php" class="btn btn-secondary">Novo Admin</a>
      </div>
    </div>
  </div>

</body>
</html>
