<?php
session_start();
require_once __DIR__ . '/../../Models/Usuario/Usuario.php';
if (!isset($_SESSION['logado']) || !isset($_SESSION['usuario'])) {
    header('Location: /tcc-safelab/tcc/public/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cadastro de Local</title>
  <link href="https://fonts.googleapis.com" rel="preconnect"/>
  <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet"/>
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
    }
  </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display">
  <div class="flex flex-col min-h-screen">
    <!-- Header -->
    <header class="w-full">
      <div class="container mx-auto px-6 py-4">
        <div class="flex items-center gap-3 text-gray-800 dark:text-white">
          <svg class="h-8 w-8 text-primary" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
            <path d="M39.5563 34.1455V13.8546C39.5563 15.708 36.8773 17.3437 32.7927 18.3189C30.2914 18.916 27.263 19.2655 24 19.2655C20.737 19.2655 17.7086 18.916 15.2073 18.3189C11.1227 17.3437 8.44365 15.708 8.44365 13.8546V34.1455C8.44365 35.9988 11.1227 37.6346 15.2073 38.6098C17.7086 39.2069 20.737 39.5564 24 39.5564C27.263 39.5564 30.2914 39.2069 32.7927 38.6098C36.8773 37.6346 39.5563 35.9988 39.5563 34.1455Z" fill="currentColor"></path>
          </svg>
          <h1 class="text-xl font-bold">SafeLab</h1>
        </div>
      </div>
    </header>

    <!-- Main -->
    <main class="flex-grow flex items-center justify-center px-4 sm:px-6 lg:px-8">
      <div class="max-w-md w-full bg-white dark:bg-background-dark rounded-xl shadow-lg p-8 space-y-6 border border-gray-200 dark:border-gray-700">
        <div class="text-center">
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Cadastro de Local</h2>
          <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Adicione um novo local ao sistema</p>
        </div>

        <!-- Formulário -->
        <form method="post" action="../../process/local/process_cadastro_local.php" class="space-y-6">
          
          <div>
            <label for="locais" class="text-sm font-medium text-gray-700 dark:text-gray-300">Nome do Local</label>
            <input type="text" name="locais" required
              class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-primary focus:border-primary focus:outline-none">
          </div>

          <div>
            <label for="descricao" class="text-sm font-medium text-gray-700 dark:text-gray-300">Descrição</label>
            <textarea name="descricao" required rows="3"
              class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-primary focus:border-primary focus:outline-none"></textarea>
          </div>

          <div>
            <button type="submit"
              class="w-full flex justify-center py-3 px-4 rounded-lg shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
              Cadastrar
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>
</body>
</html>

<main class="flex-grow">
<section class="px-4 py-10 @container" id="home">
<div class="flex flex-col gap-6 @[864px]:flex-row-reverse">
<div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg @[480px]:h-auto @[480px]:min-w-[400px] @[864px]:w-full" data-alt="An ESP32 microcontroller with connected wires on a breadboard." style="
                    background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBhJPI_r9j5z_XWYC_FRRGLP8egQn_OROJc-RSXQSqaGxu9PXavRpbAaRtsUZxrcBqwYcMjCMco_EOdTPhTwsq5MgOfauJxOpotmUpzgmLEHa-7BxhjWyoASfzGIAsJ3icxXjY3GqFKgzVC_6BNW5hBllpm62NbHjx6S5H0wmSoMbBT-c1XwzmLsSJ4yw4iLaXYatP14TLN-YitbiWIM-IYRbHW_OzmZ9WCQJ7EkV3VKpb3uDPmAaJ3O3_8wF1jA0rlQ4h3gBx2glQ');
                  "></div>
<div class="flex flex-col gap-6 @[480px]:min-w-[400px] @[480px]:gap-8 @[864px]:justify-center">
<div class="flex flex-col gap-2 text-left">
<h1 class="text-4xl font-black leading-tight tracking-[-0.033em] @[480px]:text-5xl @[480px]:font-black @[480px]:leading-tight @[480px]:tracking-[-0.033em] text-[#111815] dark:text-white"> SAFELAB Sistema de Coleta de Dados  </h1>
<h2 class="text-sm font-normal leading-normal @[480px]:text-base @[480px]:font-normal @[480px]:leading-normal text-[#608a7b] dark:text-[#a0c2b8]"> Um projeto de TCC para monitoramento de sensores em tempo real, oferecendo uma solução completa para coleta, visualização e análise de dados. </h2>
</div>
<a class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 @[480px]:h-12 @[480px]:px-5 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] @[480px]:text-base @[480px]:font-bold @[480px]:leading-normal @[480px]:tracking-[0.015em] hover:bg-primary/90" href="#about">
<span class="truncate">Saiba Mais</span>
</a>
</div>
</div>
</section>
<section class="px-4 py-10" id="features">
<div class="flex flex-col gap-10">
<div class="flex flex-col gap-4 text-center items-center">
<h2 class="text-3xl font-bold tracking-tight text-[#111815] dark:text-white">Funcionalidades do Sistema</h2>
<p class="text-lg leading-relaxed text-[#608a7b] dark:text-[#a0c2b8] max-w-3xl"> Nosso sistema foi projetado para ser robusto, flexível e fácil de usar, fornecendo todas as ferramentas necessárias para um monitoramento eficaz. </p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
<div class="flex flex-col items-center text-center p-6 rounded-lg border border-[#dbe6e2] dark:border-[#2a3f38] bg-white dark:bg-[#1a2e26]">
<div class="p-3 rounded-full bg-primary/10 text-primary mb-4">
<span class="material-symbols-outlined text-3xl">sensors</span>
</div>
<h3 class="text-xl font-bold text-[#111815] dark:text-white mb-2">Múltiplos Sensores</h3>
<p class="text-sm text-[#608a7b] dark:text-[#a0c2b8]">Suporte para uma variedade de sensores, incluindo temperatura, umidade, luminosidade e som, permitindo uma coleta de dados abrangente.</p>
</div>
<div class="flex flex-col items-center text-center p-6 rounded-lg border border-[#dbe6e2] dark:border-[#2a3f38] bg-white dark:bg-[#1a2e26]">
<div class="p-3 rounded-full bg-primary/10 text-primary mb-4">
<span class="material-symbols-outlined text-3xl">database</span>
</div>
<h3 class="text-xl font-bold text-[#111815] dark:text-white mb-2">Armazenamento de Dados</h3>
<p class="text-sm text-[#608a7b] dark:text-[#a0c2b8]">Os dados coletados são armazenados de forma segura em um banco de dados, permitindo análises históricas e geração de relatórios detalhados.</p>
</div>
<div class="flex flex-col items-center text-center p-6 rounded-lg border border-[#dbe6e2] dark:border-[#2a3f38] bg-white dark:bg-[#1a2e26]">
<div class="p-3 rounded-full bg-primary/10 text-primary mb-4">
<span class="material-symbols-outlined text-3xl">show_chart</span>
</div>
<h3 class="text-xl font-bold text-[#111815] dark:text-white mb-2">Visualização Intuitiva</h3>
<p class="text-sm text-[#608a7b] dark:text-[#a0c2b8]">Uma interface web amigável apresenta os dados em gráficos e dashboards interativos, facilitando a interpretação e o monitoramento.</p>
</div>
</div>
</div>
</section>
<section class="flex flex-col gap-10 px-4 py-10 @container" id="about">
<div class="flex flex-col gap-4">
<h1 class="tracking-light text-[32px] font-bold leading-tight @[480px]:text-4xl @[480px]:font-black @[480px]:leading-tight @[480px]:tracking-[-0.033em] max-w-[720px] text-[#111815] dark:text-white"> Sobre o Nosso Projeto </h1>
<p class="text-base font-normal leading-normal max-w-[720px] text-[#608a7b] dark:text-[#a0c2b8]"> Este projeto tem como objetivo fornecer uma plataforma fácil de usar para monitorar dados de sensores de dispositivos ESP32 e Arduino. Aproveitamos o poder desses microcontroladores para coletar dados em tempo real e apresentá-los em um painel intuitivo e visualmente atraente. </p>
</div>
<div class="grid grid-cols-[repeat(auto-fit,minmax(158px,1fr))] gap-3 p-0">
<div class="flex flex-1 gap-3 rounded-lg border border-[#dbe6e2] dark:border-[#2a3f38] bg-white dark:bg-[#1a2e26] p-4 flex-col">
<div class="text-primary">
<span class="material-symbols-outlined">memory</span>
</div>
<div class="flex flex-col gap-1">
<h2 class="text-base font-bold leading-tight text-[#111815] dark:text-white"> ESP32 &amp; Arduino </h2>
<p class="text-sm font-normal leading-normal text-[#608a7b] dark:text-[#a0c2b8]"> Usamos as populares plataformas ESP32 e Arduino por sua versatilidade e facilidade de uso. </p>
</div>
</div>
<div class="flex flex-1 gap-3 rounded-lg border border-[#dbe6e2] dark:border-[#2a3f38] bg-white dark:bg-[#1a2e26] p-4 flex-col">
<div class="text-primary">
<span class="material-symbols-outlined">monitoring</span>
</div>
<div class="flex flex-col gap-1">
<h2 class="text-base font-bold leading-tight text-[#111815] dark:text-white"> Dados em Tempo Real </h2>
<p class="text-sm font-normal leading-normal text-[#608a7b] dark:text-[#a0c2b8]"> Obtenha atualizações ao vivo de seus sensores e visualize os dados em tempo real. </p>
</div>
</div>
<div class="flex flex-1 gap-3 rounded-lg border border-[#dbe6e2] dark:border-[#2a3f38] bg-white dark:bg-[#1a2e26] p-4 flex-col">
<div class="text-primary">
<span class="material-symbols-outlined">code</span>
</div>
<div class="flex flex-col gap-1">
<h2 class="text-base font-bold leading-tight text-[#111815] dark:text-white"> Código Aberto </h2>
<p class="text-sm font-normal leading-normal text-[#608a7b] dark:text-[#a0c2b8]"> Nosso projeto é de código aberto e recebemos contribuições da comunidade. </p>
</div>
</div>
</div>
</section>
</main>