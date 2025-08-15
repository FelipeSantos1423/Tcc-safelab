<?php
session_start();
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Medicao.php';

if (empty($_SESSION['logado']) || empty($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$usuario = unserialize($_SESSION['usuario']);
$medicao = new Medicao();
$dados = $medicao->getTodasMedicoes(6);
$ultima = end($dados);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard - SafeLab</title>
    <link rel="stylesheet" href="../assets/exibe.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>

<header>
    <h1>SafeLab</h1>
    <nav class="user-menu" id="userMenu">
        <button id="userMenuBtn" aria-haspopup="true" aria-expanded="false" aria-controls="userDropdown">
            <span class="font-medium"><?= htmlspecialchars($usuario->getEmail()); ?></span> &#x25BC;
        </button>
        <div class="dropdown" id="userDropdown" role="menu" aria-label="Menu do usuário">
            <a href="editar-usuario.php" role="menuitem">Editar minha conta</a>
            <a href="logout.php" role="menuitem">Sair da conta</a>
        </div>
    </nav>
</header>

<main>
    <h2>Bem-vindo, <?= htmlspecialchars($usuario->getNomeC()); ?>!</h2>
    <p>Esta é sua área pessoal. Acompanhe os dados ambientais da estação:</p>

    <div id="relogio" aria-live="polite" aria-atomic="true" style="margin: 20px 0;"></div>

    <div class="dashboard-container">
        <?php
        function criarLinhaDashboard($idGrafico, $titulo, $valor, $unidade, $idStatus) {
            echo "
            <div class='linha-dashboard'>
                <div class='grafico-container' id='$idGrafico'></div>
                <div class='status-card' aria-live='polite' aria-atomic='true'>
                    <h3>$titulo</h3>
                    <div class='valor'>" . ($valor !== null ? number_format($valor, 2) . " $unidade" : '--') . "</div>
                    <div id='$idStatus'></div>
                </div>
            </div>";
        }

        criarLinhaDashboard('graficoTemperatura', 'Temperatura', $ultima['temperatura_medicao'] ?? null, '°C', 'status-temperatura');
        criarLinhaDashboard('graficoUmidade', 'Umidade', $ultima['umidade_medicao'] ?? null, '%', 'status-umidade');
        criarLinhaDashboard('graficoCO2', 'Gás Carbônico (CO₂)', $ultima['co2_medicao'] ?? null, 'ppm', 'status-co2');
        criarLinhaDashboard('graficoRuido', 'Ruído', $ultima['ruido_medicao'] ?? null, 'dB', 'status-ruido');
        criarLinhaDashboard('graficoLuz', 'Luz', $ultima['luz_medicao'] ?? null, 'lux', 'status-luz');
        ?>
    </div>
</main>

<script>
    // Menu usuário
    const userMenuBtn = document.getElementById('userMenuBtn');
    const userMenu = document.getElementById('userMenu');

    userMenuBtn.addEventListener('click', () => {
        const expanded = userMenuBtn.getAttribute('aria-expanded') === 'true';
        userMenuBtn.setAttribute('aria-expanded', String(!expanded));
        userMenu.classList.toggle('open');
    });

    document.addEventListener('click', (e) => {
        if (!userMenu.contains(e.target)) {
            userMenu.classList.remove('open');
            userMenuBtn.setAttribute('aria-expanded', 'false');
        }
    });

    // Relógio
    function atualizarRelogio() {
        const relogio = document.getElementById('relogio');
        const agora = new Date();
        const opcoesData = { weekday: 'long', day: '2-digit', month: '2-digit', year: 'numeric' };
        const dataFormatada = agora.toLocaleDateString('pt-BR', opcoesData);
        const hora = agora.toLocaleTimeString('pt-BR');
        const offset = -agora.getTimezoneOffset() / 60;
        const gmt = `GMT${offset >= 0 ? '+' : ''}${offset}`;
        relogio.textContent = `${dataFormatada} ${hora} (${gmt})`;
    }
    setInterval(atualizarRelogio, 1000);
    atualizarRelogio();
</script>

<script>
    // Carrega dados do PHP
    const dadosPHP = {
        horarios: [<?php foreach ($dados as $d) echo "'".date('d/m H:i', strtotime($d['data_hora'])) . "',"; ?>],
        temperatura: [<?php foreach ($dados as $d) echo $d['temperatura_medicao'] . ","; ?>],
        umidade: [<?php foreach ($dados as $d) echo $d['umidade_medicao'] . ","; ?>],
        co2: [<?php foreach ($dados as $d) echo $d['co2_medicao'] . ","; ?>],
        ruido: [<?php foreach ($dados as $d) echo $d['ruido_medicao'] . ","; ?>],
        luz: [<?php foreach ($dados as $d) echo $d['luz_medicao'] . ","; ?>]
    };

    google.charts.load('current', { packages: ['corechart'] });
    google.charts.setOnLoadCallback(desenharGraficos);

    function montarDataTable(labels, valores, labelSerie) {
        const data = new google.visualization.DataTable();
        data.addColumn('string', 'Horário');
        data.addColumn('number', labelSerie);
        for (let i = 0; i < labels.length; i++) {
            data.addRow([labels[i], valores[i]]);
        }
        return data;
    }

    function desenharGraficos() {
        const optionsBase = {
            height: 250,
            curveType: 'function',
            legend: { position: 'none' },
            hAxis: { title: 'Data/Hora' },
            vAxis: { baselineColor: '#ccc' }
        };

        const charts = [
            { id: 'graficoTemperatura', data: dadosPHP.temperatura, label: 'Temperatura (°C)', color: '#f39c12' },
            { id: 'graficoUmidade', data: dadosPHP.umidade, label: 'Umidade (%)', color: '#3498db' },
            { id: 'graficoCO2', data: dadosPHP.co2, label: 'Gás Carbônico (ppm)', color: '#2ecc71' },
            { id: 'graficoRuido', data: dadosPHP.ruido, label: 'Ruído (dB)', color: '#9b59b6' },
            { id: 'graficoLuz', data: dadosPHP.luz, label: 'Luz (lux)', color: '#f1c40f' }
        ];

        charts.forEach(chart => {
            const data = montarDataTable(dadosPHP.horarios, chart.data, chart.label);
            const options = {
                ...optionsBase,
                colors: [chart.color],
                vAxis: { ...optionsBase.vAxis, title: chart.label }
            };
            const grafico = new google.visualization.LineChart(document.getElementById(chart.id));
            grafico.draw(data, options);
        });

        atualizarStatusCards();
    }

    function atualizarStatusCards() {
        const status = {
            temperatura: v => v >= 18 && v <= 26 ? 'Bom' : (v >= 15 && v < 18 || v > 26 && v <= 30) ? 'Adequado' : 'Ruim',
            umidade: v => v >= 40 && v <= 60 ? 'Bom' : (v >= 30 && v < 40 || v > 60 && v <= 70) ? 'Adequado' : 'Ruim',
            co2: v => v <= 400 ? 'Bom' : (v <= 1000 ? 'Moderado' : 'Ruim'),
            ruido: v => v <= 55 ? 'Bom' : (v <= 70 ? 'Moderado' : 'Ruim'),
            luz: v => v >= 300 && v <= 500 ? 'Bom' : (v >= 200 && v < 300 || v > 500 && v <= 600) ? 'Moderado' : 'Ruim'
        };

        document.getElementById('status-temperatura').textContent = status.temperatura(dadosPHP.temperatura.at(-1));
        document.getElementById('status-umidade').textContent = status.umidade(dadosPHP.umidade.at(-1));
        document.getElementById('status-co2').textContent = status.co2(dadosPHP.co2.at(-1));
        document.getElementById('status-ruido').textContent = status.ruido(dadosPHP.ruido.at(-1));
        document.getElementById('status-luz').textContent = status.luz(dadosPHP.luz.at(-1));
    }

    window.addEventListener('resize', desenharGraficos);
</script>

</body>
</html>
