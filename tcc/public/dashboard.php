<?php
require_once __DIR__ . '/../Models/Dispositivo/DispositivoDAO.php';
require_once __DIR__ . '/../Models/Leitura/LeituraDAO.php';

$dispositivoDAO = new DispositivoDAO();
$leituraDAO = new LeituraDAO();
$dispositivos = $dispositivoDAO->listarTodos();

// ===== INTERPRETAÇÃO =====
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
<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
  <script>
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            "primary": "#00e878",
            "background-light": "#f6f7f8",
            "background-dark": "#101c22",
          },
          fontFamily: {
            "display": ["Inter"]
          }
        },
      },
    }
  </script>
<style>
body {
  font-family: 'Inter', sans-serif;
  background-color: #f5f6fa;
  color: #1c1c1c;
}
main {
  padding: 2rem 1rem;
}
h1 {
  font-weight: 700;
  color: #0d1a17;
  text-align: center;
  margin-bottom: 2rem;
}
.card {
  border: none;
  border-radius: 14px;
  box-shadow: 0 3px 10px rgba(0,0,0,0.08);
  transition: all 0.3s ease;
}
.card:hover { transform: scale(1.02); }
.card-header {
  background-color: #00e878;
  color: #fff;
  font-weight: 600;
  text-align: center;
  padding: .8rem;
}
.card-body {
  background-color: #fff;
  padding: 1rem 1rem 1.2rem;
}
.sensor-box {
  text-align: center;
  padding: 0.8rem;
  border-radius: 10px;
  background: #f9fafb;
}
.sensor-icon {
  font-size: 1.7rem;
}
.sensor-value {
  font-size: 1.5rem;
  font-weight: 700;
  color: #0d1a17;
}
.sensor-label {
  font-size: 0.9rem;
  color: #555;
}
.badge {
  font-size: 0.8rem;
  padding: 6px 8px;
  border-radius: 8px;
}
.btn-historico {
  background-color: #0d1a17;
  color: #fff;
  font-weight: 500;
  font-size: 0.9rem;
  margin-top: 10px;
}
.btn-historico:hover {
  background-color: #00e878;
  color: #0d1a17;
}
footer {
  text-align: center;
  padding: 12px;
  background-color: #0d1a17;
  color: #aaa;
  font-size: 0.9rem;
  margin-top: 2rem;
}
footer span { color: #00e878; }
.modal-content {
  border-radius: 14px;
}
.modal-header {
  background-color: #00e878;
  color: white;
}
</style>
</head>

<body>
<header class="sticky top-0 z-20 bg-[#0d1a17]/95 backdrop-blur-sm border-b border-gray-700">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
          <!-- Logo -->
          <div class="flex items-center space-x-4">
            <a class="flex items-center space-x-2" href="../index.php">
              <img src="../images/WhatsApp_Image_2025-10-23_at_21.19.41-removebg-preview (1).png" width="200px" height="200px" alt="SAFELAB Logo"> 
            </a>
          </div>

          <!-- Botão voltar -->
          <a href="../index.php" 
             class="text-sm font-medium text-gray-300 hover:text-primary transition-colors flex items-center">
             ← Voltar
          </a>
        </div>
      </div>
    </header>

<!-- CONTEÚDO -->
<main class="container">
  <h1>Monitoramento em Tempo Real</h1>
<br>
  <div class="row g-4">
  <?php foreach ($dispositivos as $disp): 
      $leituras = $leituraDAO->listarPorDispositivo($disp['id'], 1);
      if (!empty($leituras)) {
          $l = $leituras[0];
          $temp = (float) $l['temperatura'];
          $umid = (float) $l['umidade'];
          $luz = (float) $l['luz'];
          $ruido = (float) $l['ruido'];
      } else {
          $temp = $umid = $luz = $ruido = null;
      }

      [$tempStatus, $tempColor] = interpretarTemperatura($temp);
      [$umidStatus, $umidColor] = interpretarUmidade($umid);
      [$luzStatus, $luzColor] = interpretarLuz($luz);
      [$ruidoStatus, $ruidoColor] = interpretarRuido($ruido);

      // Histórico (últimas 5 medições)
      $historico = $leituraDAO->listarPorDispositivo($disp['id'], 5);
  ?>
  <div class="col-md-6 col-lg-4">
    <div class="card">
      <div class="card-header"><?= htmlspecialchars($disp['nome']) ?><br><small>(ESP: <?= htmlspecialchars($disp['codigo_esp']) ?>)</small></div>
      <div class="card-body">
        <div class="row g-2">
          <div class="col-6">
            <div class="sensor-box">
              <div class="sensor-icon">🔥</div>
              <div class="sensor-value"><?= $temp !== null ? $temp . '°C' : '--' ?></div>
              <span class="badge bg-<?= $tempColor ?>"><?= $tempStatus ?></span>
            </div>
          </div>
          <div class="col-6">
            <div class="sensor-box">
              <div class="sensor-icon">💧</div>
              <div class="sensor-value"><?= $umid !== null ? $umid . '%' : '--' ?></div>
              <span class="badge bg-<?= $umidColor ?>"><?= $umidStatus ?></span>
            </div>
          </div>
          <div class="col-6">
            <div class="sensor-box">
              <div class="sensor-icon">💡</div>
              <div class="sensor-value"><?= $luz !== null ? $luz . ' lx' : '--' ?></div>
              <span class="badge bg-<?= $luzColor ?>"><?= $luzStatus ?></span>
            </div>
          </div>
          <div class="col-6">
            <div class="sensor-box">
              <div class="sensor-icon">🔊</div>
              <div class="sensor-value"><?= $ruido !== null ? $ruido . ' dB' : '--' ?></div>
              <span class="badge bg-<?= $ruidoColor ?>"><?= $ruidoStatus ?></span>
            </div>
          </div>
        </div>
        <button class="btn btn-historico w-100" data-bs-toggle="modal" data-bs-target="#historicoModal<?= $disp['id'] ?>">Ver Histórico</button>
      </div>
    </div>
  </div>

  <!-- MODAL HISTÓRICO -->
  <div class="modal fade" id="historicoModal<?= $disp['id'] ?>" tabindex="-1" aria-labelledby="historicoModalLabel<?= $disp['id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="historicoModalLabel<?= $disp['id'] ?>">Histórico de Dados - <?= htmlspecialchars($disp['nome']) ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          <?php if (empty($historico)): ?>
            <p class="text-muted text-center mb-0">Nenhuma medição anterior registrada.</p>
          <?php else: ?>
            <table class="table table-striped table-hover align-middle text-center">
              <thead class="table-success">
                <tr>
                  <th>Data</th>
                  <th>Temperatura</th>
                  <th>Umidade</th>
                  <th>Luz</th>
                  <th>Ruído</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($historico as $h): ?>
                  <tr>
                    <td><?= date('d/m/Y H:i', strtotime($h['data_registro'])) ?></td>
                    <td><?= htmlspecialchars($h['temperatura']) ?>°C</td>
                    <td><?= htmlspecialchars($h['umidade']) ?>%</td>
                    <td><?= htmlspecialchars($h['luz']) ?> lx</td>
                    <td><?= htmlspecialchars($h['ruido']) ?> dB</td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
  </div>
</main>

<footer>
  <p>© 2025 <span>SAFELAB</span>. Todos os direitos reservados.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
