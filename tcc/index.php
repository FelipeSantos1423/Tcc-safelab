<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "db_safelab";

$conn = new mysqli($servername, $username, $password, $dbname);

// Último registro
$sql = "SELECT temperatura, umidade, luz, ruido FROM sensores ORDER BY data_registro DESC LIMIT 1";
$result = $conn->query($sql);
$ultimo = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html class="dark" lang="en">
<head>
<meta charset="utf-8"/>
<link crossorigin="" href="https://fonts.gstatic.com/" rel="preconnect"/>
<link as="style" href="https://fonts.googleapis.com/css2?display=swap&amp;family=Noto+Sans:wght@400;500;700;900&amp;family=Space+Grotesk:wght@400;500;700" onload="this.rel='stylesheet'" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script id="tailwind-config">
tailwind.config = {
  darkMode: "class",
  theme: { extend: { colors: { primary: "#1193d4", "background-light": "#f6f7f8", "background-dark": "#101c22" }, fontFamily: { display: ["Space Grotesk"] } } }
};
</script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
<title>Sensor Dashboard</title>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-800 dark:text-slate-200">
<div class="flex h-screen flex-col">
<header class="sticky top-0 z-10 flex h-14 items-center justify-between border-b border-slate-200/80 bg-background-light/80 px-4 backdrop-blur-sm dark:border-slate-800/80 dark:bg-background-dark/80">
<h1 class="text-lg font-bold text-slate-900 dark:text-white">Dashboard</h1>
</header>
<main class="flex-1 overflow-y-auto p-4">
<section class="mb-8">
<h2 class="mb-4 text-xl font-bold text-slate-900 dark:text-white">Current Status</h2>
<div class="grid grid-cols-2 gap-4">
<div class="rounded-lg border border-slate-200 bg-white p-4 dark:border-slate-800 dark:bg-slate-900/50">
<p class="text-sm font-medium text-slate-500 dark:text-slate-400">Temperature</p>
<p class="text-2xl font-bold text-slate-900 dark:text-white"><?= $ultimo['temperatura'] ?>°C</p>
</div>
<div class="rounded-lg border border-slate-200 bg-white p-4 dark:border-slate-800 dark:bg-slate-900/50">
<p class="text-sm font-medium text-slate-500 dark:text-slate-400">Humidity</p>
<p class="text-2xl font-bold text-slate-900 dark:text-white"><?= $ultimo['umidade'] ?>%</p>
</div>
<div class="rounded-lg border border-slate-200 bg-white p-4 dark:border-slate-800 dark:bg-slate-900/50">
<p class="text-sm font-medium text-slate-500 dark:text-slate-400">Light</p>
<p class="text-2xl font-bold text-slate-900 dark:text-white"><?= $ultimo['luz'] ?></p>
</div>
<div class="rounded-lg border border-slate-200 bg-white p-4 dark:border-slate-800 dark:bg-slate-900/50">
<p class="text-sm font-medium text-slate-500 dark:text-slate-400">Noise</p>
<p class="text-2xl font-bold text-slate-900 dark:text-white"><?= $ultimo['ruido'] ?></p>
</div>
</div>
</section>

<section>
<h2 class="mb-4 text-xl font-bold text-slate-900 dark:text-white">Sensor Data (Últimos 10 registros)</h2>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 justify-items-center">
<canvas id="graficoTemp" class="max-w-xl w-full"></canvas>
<canvas id="graficoUmid" class="max-w-xl w-full"></canvas>
<canvas id="graficoLuz" class="max-w-xl w-full"></canvas>
<canvas id="graficoRuido" class="max-w-xl w-full"></canvas>
</div>
</section>
</main>
</div>

<script>
async function carregarGrafico() {
  const resp = await fetch('dados.php');
  const dados = await resp.json();

  const ultimosDados = dados.slice(-10); // últimos 10 registros
  const labels = ultimosDados.map(d => {
    const hora = new Date(d.data_registro);
    return hora.getHours().toString().padStart(2,'0') + ':' + hora.getMinutes().toString().padStart(2,'0');
  });

  const temp = ultimosDados.map(d => d.temperatura);
  const umid = ultimosDados.map(d => d.umidade);
  const luz = ultimosDados.map(d => d.luz);
  const ruido = ultimosDados.map(d => d.ruido);

  const opcoes = {
    responsive: true,
    maintainAspectRatio: true, // mantém proporção para desktop
    plugins: { legend: { display: true } },
    scales: { x: { display: true }, y: { display: true } }
  };

  // Define altura fixa menor para ficar mais compacto
  document.getElementById("graficoTemp").height = 200;
  document.getElementById("graficoUmid").height = 200;
  document.getElementById("graficoLuz").height = 200;
  document.getElementById("graficoRuido").height = 200;

  new Chart(document.getElementById("graficoTemp"), {
    type: 'line',
    data: { labels, datasets: [{ label: "Temperatura (°C)", data: temp, borderColor: "red", fill: false, tension: 0.3 }] },
    options: opcoes
  });

  new Chart(document.getElementById("graficoUmid"), {
    type: 'line',
    data: { labels, datasets: [{ label: "Umidade (%)", data: umid, borderColor: "blue", fill: false, tension: 0.3 }] },
    options: opcoes
  });

  new Chart(document.getElementById("graficoLuz"), {
    type: 'line',
    data: { labels, datasets: [{ label: "Luz", data: luz, borderColor: "orange", fill: false, tension: 0.3 }] },
    options: opcoes
  });

  new Chart(document.getElementById("graficoRuido"), {
    type: 'line',
    data: { labels, datasets: [{ label: "Ruído", data: ruido, borderColor: "green", fill: false, tension: 0.3 }] },
    options: opcoes
  });
}

carregarGrafico();
</script>
</body>
</html>
