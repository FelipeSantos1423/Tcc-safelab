<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dispositivos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { display: flex; min-height: 100vh; font-family: 'Poppins', sans-serif; background-color: #f5f7fa; }
    .sidebar { width: 250px; background: #0d6efd; color: white; display: flex; flex-direction: column; padding: 20px; }
    .sidebar a { color: white; text-decoration: none; padding: 10px; margin: 5px 0; border-radius: 8px; transition: background 0.3s; }
    .sidebar a:hover { background: rgba(255,255,255,0.2); }
    .main-content { flex-grow: 1; padding: 30px; }
  </style>
</head>
<body>
  <?php include "../includes/sidebar.php"; ?>

  <div class="main-content">
    <h2>Dispositivos</h2>
    <button class="btn btn-primary mb-3">+ Adicionar Dispositivo</button>

    <table class="table table-bordered table-hover">
      <thead class="table-primary">
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Local</th>
          <th>Status</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td><td>ESP32 - Cozinha</td><td>Setor A</td><td><span class="badge bg-success">Ativo</span></td>
          <td><button class="btn btn-warning btn-sm">Editar</button> <button class="btn btn-danger btn-sm">Excluir</button></td>
        </tr>
        <tr>
          <td>2</td><td>ESP32 - Sala</td><td>Setor B</td><td><span class="badge bg-secondary">Inativo</span></td>
          <td><button class="btn btn-warning btn-sm">Editar</button> <button class="btn btn-danger btn-sm">Excluir</button></td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>
