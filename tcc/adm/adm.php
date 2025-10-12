<!-- admin_dashboard.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel do Administrador</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    .chart-container {
      background: white;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      margin-bottom: 25px;
    }
    .actions {
      margin-bottom: 25px;
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

  <!-- Sidebar -->
  <div class="sidebar">
    <h2>Admin Painel</h2>
    <a href="#">📊 Dashboard</a>
    <a href="#">💡 Dispositivos</a>
    <a href="#">📍 Locais</a>
    <a href="#">👤 Administradores</a>
    <a href="#">🚪 Logout</a>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <h2 class="mb-4">Dashboard de Monitoramento</h2>

    <div class="actions">
      <button class="btn btn-primary me-2">Adicionar Dispositivo</button>
      <button class="btn btn-success me-2">Adicionar Local</button>
      <button class="btn btn-secondary">Novo Admin</button>
    </div>

    <!-- Gráficos -->
    <div class="chart-container">
      <canvas id="graficoTemp"></canvas>
    </div>
    <div class="chart-container">
      <canvas id="graficoUmid"></canvas>
    </div>
    <div class="chart-container">
      <canvas id="graficoLuz"></canvas>
    </div>
    <div class="chart-container">
      <canvas id="graficoRuido"></canvas>
    </div>
  </div>

  <script>
    // Simulação de dados (depois conectamos ao banco)
    const labels = ['08:00','09:00','10:00','11:00','12:00','13:00','14:00'];
    const temp = [22,23,25,24,26,28,27];
    const umid = [50,52,55,53,57,59,60];
    const luz = [200,250,300,320,280,350,370];
    const ruido = [40,42,41,43,39,38,37];

    const criarGrafico = (id, label, data, color) => {
      new Chart(document.getElementById(id), {
        type: 'line',
        data: {
          labels,
          datasets: [{
            label,
            data,
            borderColor: color,
            fill: false,
            tension: 0.3
          }]
        },
        options: {
          responsive: true,
          scales: {
            x: { title: { display: true, text: 'Hora' } },
            y: { title: { display: true, text: label } }
          }
        }
      });
    }

    criarGrafico("graficoTemp", "Temperatura (°C)", temp, "red");
    criarGrafico("graficoUmid", "Umidade (%)", umid, "blue");
    criarGrafico("graficoLuz", "Luz (lx)", luz, "orange");
    criarGrafico("graficoRuido", "Ruído (dB)", ruido, "green");
  </script>

</body>
</html>
