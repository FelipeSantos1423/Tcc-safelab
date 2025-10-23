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
<title>Dashboard - Leituras</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f5f7fa;
}
.header-top {
    text-align: center;
    padding: 15px 0;
    background-color: #00e878;
    color: white;
    font-size: 1.2rem;
    font-weight: bold;
    margin-bottom: 20px;
}
.card {
    margin-bottom: 20px;
    cursor: pointer;
}
.card-header {
    background-color: #00e878;
    color: white;
    font-weight: bold;
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
</style>
</head>
<body>
<div class="header-top">
    Bem-vindo <span id="hora-atual"></span>
</div>

<div class="container mt-4">
    <h2 class="mb-4 text-center">Dashboard de Leituras</h2>

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

            // Última leitura para interpretação
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

        $ultimaMedicao = !empty($labels) ? end($labels) : 'N/A';
    ?>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header" data-bs-toggle="collapse" data-bs-target="#disp<?= $disp['id'] ?>" aria-expanded="false">
                Dispositivo: <?= htmlspecialchars($disp['nome']) ?> (Código: <?= htmlspecialchars($disp['codigo_esp']) ?>)
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
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Relógio em tempo real -->
<script>
function atualizarHora() {
    const agora = new Date();
    const horaBrasilia = agora.toLocaleString("pt-BR", { timeZone: "America/Sao_Paulo" });
    document.getElementById("hora-atual").innerText = horaBrasilia;
}
atualizarHora();
setInterval(atualizarHora, 1000);
</script>

</body>
</html>
