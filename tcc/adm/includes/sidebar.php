<!-- includes/sidebar.php -->
<div class="sidebar">
  <h2>Admin Painel</h2>
  <a href="../index.php">🏠 Home</a>
  <a href="../public/dashboard.php">📊 Dashboard</a>
  <a href="adm.php">⚙️ Ações</a>
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

  /* Responsividade da sidebar */
  @media (max-width: 768px) {
    .sidebar {
      position: fixed;
      left: -250px;
      top: 0;
      height: 100%;
      z-index: 1000;
      transition: left 0.3s ease;
    }

    .sidebar.show {
      left: 0;
    }

    body.sidebar-open {
      overflow: hidden;
    }

    .toggle-sidebar-btn {
      display: inline-block;
      position: fixed;
      top: 15px;
      left: 15px;
      z-index: 1100;
      background: #00e878;
      color: #fff;
      border: none;
      padding: 8px 12px;
      border-radius: 8px;
      cursor: pointer;
    }
  }

  /* Ajuste simples dos botões no main content */
  .main-content .btn {
    margin-bottom: 5px;
    white-space: nowrap;
  }
</style>


<button class="toggle-sidebar-btn d-md-none">☰ Menu</button>

<script>
  const sidebar = document.querySelector('.sidebar');
  const toggleBtn = document.querySelector('.toggle-sidebar-btn');

  toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('show');
    document.body.classList.toggle('sidebar-open');
  });

  // Fecha a sidebar ao clicar em um link no mobile
  document.querySelectorAll('.sidebar a').forEach(link => {
    link.addEventListener('click', () => {
      if (window.innerWidth <= 768) {
        sidebar.classList.remove('show');
        document.body.classList.remove('sidebar-open');
      }
    });
  });
</script>
