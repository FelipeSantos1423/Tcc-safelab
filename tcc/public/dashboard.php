<?php
require_once __DIR__ . '/../Models/Dispositivo/DispositivoDAO.php';
require_once __DIR__ . '/../Models/Leitura/LeituraDAO.php';

$dispositivoDAO = new DispositivoDAO();
$leituraDAO = new LeituraDAO();

$dispositivos = $dispositivoDAO->listarTodos();

// Funções de interpretação
function interpretarTemperatura($t) {
    if ($t === null) return ['Sem dados', 'secondary'];
    if ($t < 18) return ['Frio ❄️', 'info'];
    if ($t <= 27) return ['Agradável 🌤️', 'success'];
    return ['Calor 🔥', 'danger'];
}
function interpretarUmidade($u) {
    if ($u === null) return ['Sem dados', 'secondary'];
    if ($u < 40) return ['Seco 💨', 'info'];
    if ($u <= 70) return ['Confortável 💧', 'success'];
    return ['Úmido 💦', 'warning'];
}
function interpretarLuz($l) {
    if ($l === null) return ['Sem dados', 'secondary'];
    return $l < 100 ? ['Apagada 🌙', 'dark'] : ['Acesa 💡', 'warning'];
}
function interpretarRuido($r) {
    if ($r === null) return ['Sem dados', 'secondary'];
    if ($r < 40) return ['Silencioso 🤫', 'info'];
    if ($r <= 70) return ['Agradável 🔈', 'success'];
    return ['Alto 🔊', 'danger'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard - SAFELAB</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
body {
    font-family: 'Inter', sans-serif;
    background-color: #f3f4f6;
    color: #222;
    margin: 0;
    padding: 0;
}

/* ===== HEADER ===== */
header {
    background-color: #0d1a17;
    color: #fff;
    box-shadow: 0 4px 8px rgba(0,0,0,0.25);
    position: sticky;
    top: 0;
    z-index: 1000;
}
header .container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.7rem 1.5rem;
}
header img {
    height: 55px;
}
header a {
    text-decoration: none;
    color: #00e878;
    font-weight: 500;
    transition: color 0.3s;
}
header a:hover {
    color: #fff;
}

/* ===== CARDS ===== */
.card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    transition: all 0.2s ease;
    background: #fff;
}
.card:hover {
    transform: scale(1.02);
}
.card-header {
    background-color: #00e878;
    color: white;
    font-weight: 600;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
}
.chart-footer {
    font-size: 0.85rem;
    color: #555;
    margin-top: 5px;
    text-align: center;
}
canvas {
    max-height: 250px !important;
}
.badge {
    font-size: 0.9rem;
    padding: 8px 12px;
    display: inline-block;
    margin: 2px;
}

/* ===== CONTEÚDO ===== */
main {
    padding: 2rem 0;
}
h2 {
    font-weight: 700;
    color: #0d1a17;
    text-align: center;
    margin-bottom: 1.5rem;
}

/* ===== FOOTER ===== */
footer {
    text-align: center;
    padding: 10px;
    background-color: #0d1a17;
    color: #aaa;
    font-size: 0.85rem;
    margin-top: 30px;
}
footer span {
    color: #00e878;
}
</style>
</head>

<body>

<!-- HEADER -->
 <header class="sticky top-0 z-20 bg-[#0d1a17]/95 backdrop-blur-sm border-b border-gray-700">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
          <!-- Logo -->
          <div class="flex items-center space-x-4">
            <a class="flex items-center space-x-2" href="../adm.php">
              <img src="/../images/WhatsApp_Image_2025-10-23_at_21.19.41-removebg-preview (1).png" width="200px" height="200px" alt="SAFELAB Logo"> 
            </a>
          </div>

          <!-- Botão voltar -->
          <a href="../adm.php" 
             class="text-sm font-medium text-gray-300 hover:text-primary transition-colors flex items-center">
             ← Voltar
          </a>
        </div>
      </div>
    </header>

<!-- CONTEÚDO -->
<main class="container">
  <h2>Monitoramento em Tempo Real</h2>

  <div class="row">
  <?php foreach ($dispositivos as $disp): 
      $leituras = $leituraDAO->listarPorDispositivo($disp['id'], 10);
      $labels = $temp = $umid = $luz = $ruido = [];

      if (!empty($leituras)) {
          foreach ($leituras as $l) {
              $labels[] = date('H:i', strtotime($l['data_registro']));
              $temp[] = (float) $l['temperatura'];
              $umid[] = (float) $l['umidade'];
              $luz[] = (float) $l['luz'];
              $ruido[] = (float) $l['ruido'];
          }

          $ultimaTemp = end($temp);
          $ultimaUmid = end($umid);
          $ultimaLuz = end($luz);
          $ultimaRuido = end($ruido);
      } else {
          $ultimaTemp = $ultimaUmid = $ultimaLuz = $ultimaRuido = null;
      }

      [$tempStatus, $tempColor] = interpretarTemperatura($ultimaTemp);
      [$umidStatus, $umidColor] = interpretarUmidade($ultimaUmid);
      [$luzStatus, $luzColor] = interpretarLuz($ultimaLuz);
      [$ruidoStatus, $ruidoColor] = interpretarRuido($ultimaRuido);
  ?>
  <div class="col-md-6">
      <div class="card mb-4">
          <div class="card-header" data-bs-toggle="collapse" data-bs-target="#disp<?= $disp['id'] ?>" aria-expanded="false">
              Dispositivo: <?= htmlspecialchars($disp['nome']) ?> 
              <small>(Código: <?= htmlspecialchars($disp['codigo_esp']) ?>)</small>
          </div>
          <div id="disp<?= $disp['id'] ?>" class="collapse">
              <div class="card-body">
                  <?php if (empty($leituras)): ?>
                      <p class="text-center text-muted">Sem dados de leitura disponíveis.</p>
                  <?php else: ?>
                  <div class="row">
                      <div class="col-md-6 mb-3 text-center">
                          <canvas id="temp<?= $disp['id'] ?>"></canvas>
                          <div class="chart-footer">
                              <span class="badge bg-<?= $tempColor ?>">Temperatura: <?= $tempStatus ?></span>
                          </div>
                      </div>
                      <div class="col-md-6 mb-3 text-center">
                          <canvas id="umid<?= $disp['id'] ?>"></canvas>
                          <div class="chart-footer">
                              <span class="badge bg-<?= $umidColor ?>">Umidade: <?= $umidStatus ?></span>
                          </div>
                      </div>
                      <div class="col-md-6 mb-3 text-center">
                          <canvas id="luz<?= $disp['id'] ?>"></canvas>
                          <div class="chart-footer">
                              <span class="badge bg-<?= $luzColor ?>">Luz: <?= $luzStatus ?></span>
                          </div>
                      </div>
                      <div class="col-md-6 mb-3 text-center">
                          <canvas id="ruido<?= $disp['id'] ?>"></canvas>
                          <div class="chart-footer">
                              <span class="badge bg-<?= $ruidoColor ?>">Ruído: <?= $ruidoStatus ?></span>
                          </div>
                      </div>
                  </div>
                  <?php endif; ?>
              </div>
          </div>
      </div>
  </div>

  <script>
  const labels<?= $disp['id'] ?> = <?= json_encode($labels) ?>;
  const tempData<?= $disp['id'] ?> = <?= json_encode($temp) ?>;
  const umidData<?= $disp['id'] ?> = <?= json_encode($umid) ?>;
  const luzData<?= $disp['id'] ?> = <?= json_encode($luz) ?>;
  const ruidoData<?= $disp['id'] ?> = <?= json_encode($ruido) ?>;

  if (labels<?= $disp['id'] ?>.length > 0) {
      const opts = { responsive: true, maintainAspectRatio: true, tension: 0.3 };
      new Chart(document.getElementById('temp<?= $disp['id'] ?>'), {
          type: 'line',
          data: { labels: labels<?= $disp['id'] ?>, datasets: [{ label: 'Temperatura (°C)', data: tempData<?= $disp['id'] ?>, borderColor: 'red', fill: false }] },
          options: opts
      });
      new Chart(document.getElementById('umid<?= $disp['id'] ?>'), {
          type: 'line',
          data: { labels: labels<?= $disp['id'] ?>, datasets: [{ label: 'Umidade (%)', data: umidData<?= $disp['id'] ?>, borderColor: 'blue', fill: false }] },
          options: opts
      });
      new Chart(document.getElementById('luz<?= $disp['id'] ?>'), {
          type: 'line',
          data: { labels: labels<?= $disp['id'] ?>, datasets: [{ label: 'Luz (lx)', data: luzData<?= $disp['id'] ?>, borderColor: 'orange', fill: false }] },
          options: opts
      });
      new Chart(document.getElementById('ruido<?= $disp['id'] ?>'), {
          type: 'line',
          data: { labels: labels<?= $disp['id'] ?>, datasets: [{ label: 'Ruído (dB)', data: ruidoData<?= $disp['id'] ?>, borderColor: 'green', fill: false }] },
          options: opts
      });
  }
  </script>
  <?php endforeach; ?>
  </div>
</main>

<!-- FOOTER -->
<footer>
  <p>© 2024 <span>SAFELAB</span>. Todos os direitos reservados.</p>
  <a href="public/login.php">Login do Administrador</a>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
