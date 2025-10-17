<?php
require_once __DIR__ . '/../Models/Dispositivo/DispositivoDAO.php';
require_once __DIR__ . '/../Models/Leitura/LeituraDAO.php';

$dispositivoDAO = new DispositivoDAO();
$leituraDAO = new LeituraDAO();

$dispositivos = $dispositivoDAO->listarTodos(); // Todos os dispositivos
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
    background-color: #0d6efd;
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
    background-color: #0d6efd;
    color: white;
    font-weight: bold;
}
.chart-footer {
    font-size: 0.85rem;
    color: #555;
    margin-top: 5px;
    text-align: center;
}
</style>
</head>
<body>
<div class="header-top">
    Bem-vindo, Admin! <span id="hora-atual"></span>
</div>

<div class="container mt-4">
    <h2 class="mb-4 text-center">Dashboard de Leituras</h2>

    <div class="row">
    <?php foreach ($dispositivos as $disp): 
        $leituras = $leituraDAO->listarPorDispositivo($disp['id'], 10); // últimas 10 leituras
        $labels = [];
        $temp = [];
        $umid = [];
        $luz = [];
        $ruido = [];
        foreach ($leituras as $l) {
            $labels[] = date('H:i', strtotime($l['data_registro']));
            $temp[] = $l['temperatura'];
            $umid[] = $l['umidade'];
            $luz[] = $l['luz'];
            $ruido[] = $l['ruido'];
        }
    ?>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header" data-bs-toggle="collapse" data-bs-target="#disp<?= $disp['id'] ?>" aria-expanded="false">
                Dispositivo: <?= htmlspecialchars($disp['nome']) ?> (Código: <?= htmlspecialchars($disp['codigo_esp']) ?>)
            </div>
            <div id="disp<?= $disp['id'] ?>" class="collapse">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <canvas id="temp<?= $disp['id'] ?>"></canvas>
                            <div class="chart-footer">Última medição: <?= end($labels) ?? 'N/A' ?></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <canvas id="umid<?= $disp['id'] ?>"></canvas>
                            <div class="chart-footer">Última medição: <?= end($labels) ?? 'N/A' ?></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <canvas id="luz<?= $disp['id'] ?>"></canvas>
                            <div class="chart-footer">Última medição: <?= end($labels) ?? 'N/A' ?></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <canvas id="ruido<?= $disp['id'] ?>"></canvas>
                            <div class="chart-footer">Última medição: <?= end($labels) ?? 'N/A' ?></div>
                        </div>
                    </div>
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

    new Chart(document.getElementById('temp<?= $disp['id'] ?>'), {
        type: 'line',
        data: { labels: labels<?= $disp['id'] ?>, datasets: [{ label: 'Temperatura (°C)', data: tempData<?= $disp['id'] ?>, borderColor: 'red', fill: false }] },
        options: { responsive: true }
    });
    new Chart(document.getElementById('umid<?= $disp['id'] ?>'), {
        type: 'line',
        data: { labels: labels<?= $disp['id'] ?>, datasets: [{ label: 'Umidade (%)', data: umidData<?= $disp['id'] ?>, borderColor: 'blue', fill: false }] },
        options: { responsive: true }
    });
    new Chart(document.getElementById('luz<?= $disp['id'] ?>'), {
        type: 'line',
        data: { labels: labels<?= $disp['id'] ?>, datasets: [{ label: 'Luz (lx)', data: luzData<?= $disp['id'] ?>, borderColor: 'orange', fill: false }] },
        options: { responsive: true }
    });
    new Chart(document.getElementById('ruido<?= $disp['id'] ?>'), {
        type: 'line',
        data: { labels: labels<?= $disp['id'] ?>, datasets: [{ label: 'Ruído (dB)', data: ruidoData<?= $disp['id'] ?>, borderColor: 'green', fill: false }] },
        options: { responsive: true }
    });
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
