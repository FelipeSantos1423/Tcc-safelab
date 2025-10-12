<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Painel do Administrador</title>
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
      padding: 30px;
    }
    .device-section {
      background: white;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      margin-bottom: 25px;
    }
    .chart-container {
      background: #fff;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 20px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

  <?php include "includes/sidebar.php"; ?>

  <div class="main-content">
    <h2 class="mb-4">Dashboard de Monitoramento</h2>

    <!-- Lista de dispositivos -->
    <div id="devices">
      <!-- Exemplo de um dispositivo -->
      <div class="device-section">
        <div class="d-flex justify-content-between align-items-center">
          <h5>Dispositivo 1 - Cozinha</h5>
          <button class="btn btn-primary btn-sm toggle-btn" data-target="#device1">Abrir Dispositivo</button>
        </div>
        <div id="device1" class="device-graphs mt-3" style="display: none;">
          <div class="chart-container"><canvas id="temp1"></canvas></div>
          <div class="chart-container"><canvas id="umid1"></canvas></div>
          <div class="chart-container"><canvas id="luz1"></canvas></div>
          <div class="chart-container"><canvas id="ruido1"></canvas></div>
          <button class="btn btn-outline-danger btn-sm mt-2 close-btn" data-target="#device1">Fechar Dispositivo</button>
        </div>
      </div>

      <div class="device-section">
        <div class="d-flex justify-content-between align-items-center">
          <h5>Dispositivo 2 - Sala de Testes</h5>
          <button class="btn btn-primary btn-sm toggle-btn" data-target="#device2">Abrir Dispositivo</button>
        </div>
        <div id="device2" class="device-graphs mt-3" style="display: none;">
          <div class="chart-container"><canvas id="temp2"></canvas></div>
          <div class="chart-container"><canvas id="umid2"></canvas></div>
          <div class="chart-container"><canvas id="luz2"></canvas></div>
          <div class="chart-container"><canvas id="ruido2"></canvas></div>
          <button class="btn btn-outline-danger btn-sm mt-2 close-btn" data-target="#device2">Fechar Dispositivo</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Função genérica de gráfico
    function criarGrafico(id, label, data, color) {
      new Chart(document.getElementById(id), {
        type: 'line',
        data: {
          labels: ['08h', '09h', '10h', '11h', '12h', '13h', '14h'],
          datasets: [{
            label: label,
            data: data,
            borderColor: color,
            tension: 0.3,
            fill: false
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

    // Dados simulados para cada dispositivo
    const dispositivos = {
      1: {
        temp: [22, 23, 25, 26, 27, 28, 26],
        umid: [55, 53, 54, 56, 58, 59, 57],
        luz: [200, 230, 250, 270, 260, 280, 300],
        ruido: [40, 42, 41, 43, 44, 45, 42]
      },
      2: {
        temp: [21, 22, 23, 22, 24, 25, 26],
        umid: [60, 62, 61, 63, 65, 64, 66],
        luz: [150, 180, 200, 210, 220, 230, 250],
        ruido: [35, 37, 38, 36, 39, 40, 41]
      }
    };

    // Exibe/oculta os blocos de gráficos
    document.querySelectorAll(".toggle-btn").forEach(btn => {
      btn.addEventListener("click", () => {
        const target = document.querySelector(btn.dataset.target);
        target.style.display = "block";
        btn.style.display = "none"; // esconde botão de abrir

        // Cria gráficos apenas na primeira vez que abrir
        if (!target.dataset.loaded) {
          const id = btn.dataset.target.replace("#device", "");
          const d = dispositivos[id];
          criarGrafico(`temp${id}`, "Temperatura (°C)", d.temp, "red");
          criarGrafico(`umid${id}`, "Umidade (%)", d.umid, "blue");
          criarGrafico(`luz${id}`, "Luz (lx)", d.luz, "orange");
          criarGrafico(`ruido${id}`, "Ruído (dB)", d.ruido, "green");
          target.dataset.loaded = "true";
        }
      });
    });

    document.querySelectorAll(".close-btn").forEach(btn => {
      btn.addEventListener("click", () => {
        const target = document.querySelector(btn.dataset.target);
        target.style.display = "none";
        document.querySelector(`.toggle-btn[data-target="${btn.dataset.target}"]`).style.display = "inline-block";
      });
    });
  </script>

</body>
</html>
