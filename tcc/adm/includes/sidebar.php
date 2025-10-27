<div class="sidebar">
  <h2>Admin Painel</h2>
  <a href="../index.php">🏠 Home</a>
  <a href="../public/dashboard.php">📊 Dashboard</a>
  <a href="dispositivos.php">💡 Dispositivos</a>
  <a href="locais.php">📍 Locais</a>
  <a href="admins.php">👤 Administradores</a>
  <a href="logout.php">🚪 Logout</a>
</div>

<style>
    body {
      display: flex;
      min-height: 100vh;
      font-family: 'Poppins', sans-serif;
      background-color: #f5f7fa;
    }
    .sidebar {
      width: 250px;
      background: #00e878;
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