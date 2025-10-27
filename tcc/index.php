<!DOCTYPE html>
<html lang="pt-br"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>SAFELAB - Monitoramento Ambiental</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
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
                        "display": ["Space Grotesk"]
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>
<style>
        .material-symbols-outlined {
          font-variation-settings:
          'FILL' 0,
          'wght' 400,
          'GRAD' 0,
          'opsz' 24
        }
        #mobile-menu {
            display: none;
        }
        #mobile-menu.show {
            display: block;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-gray-800 dark:text-gray-200">
<div class="flex flex-col min-h-screen">

<!-- ======= NAVBAR ESCURA ======= -->
<header class="sticky top-0 z-20 bg-[#0d1a17]/95 backdrop-blur-sm border-b border-gray-700">
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
<div class="flex items-center justify-between h-16">
<div class="flex items-center space-x-4">
<a class="flex items-center space-x-2" href="#home">
<img src="images/WhatsApp_Image_2025-10-23_at_21.19.41-removebg-preview (1).png" width="250px" height="250px"> 
</a>
</div>
<nav class="hidden md:flex items-center space-x-8">
<a class="text-sm font-medium text-gray-300 hover:text-primary transition-colors" href="#home">Home</a>
<a class="text-sm font-medium text-gray-300 hover:text-primary transition-colors" href="#sobre">Sobre</a>
<a class="text-sm font-medium text-gray-300 hover:text-primary transition-colors" href="public/dashboard.php">Dashboard</a>
</nav>
<button class="md:hidden rounded-md p-2 text-gray-300 hover:bg-gray-800" id="menu-btn">
<span class="sr-only">Abrir menu</span>
<span class="material-symbols-outlined" id="menu-icon">menu</span>
</button>
</div>
</div>

<!-- Menu Mobile -->
<div class="md:hidden bg-[#0d1a17] border-t border-gray-700" id="mobile-menu">
<nav class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
<a class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-primary/20" href="#home">Home</a>
<a class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-primary/20" href="#sobre">Sobre</a>
<a class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-primary/20" href="public/dashboard.php">Dashboard</a>
</nav>
</div>
</header>
<!-- ======= FIM NAVBAR ======= -->

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
<a class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 @[480px]:h-12 @[480px]:px-5 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] @[480px]:text-base @[480px]:font-bold @[480px]:leading-normal @[480px]:tracking-[0.015em] hover:bg-primary/90" href="#sobre">
<span class="truncate">Saiba Mais</span>
</a>
</div>
</div>
</section>

<section class="px-4 py-10" id="sobre">
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

<footer class="bg-gray-100 dark:bg-background-dark border-t border-gray-200 dark:border-gray-800">
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
<div class="text-center">
<p class="text-sm text-gray-500 dark:text-gray-400">© 2024 SAFELAB. Todos os direitos reservados.</p>
<a class="text-xs text-gray-500 dark:text-gray-400 hover:text-primary mt-2 inline-block" href="public/login.php">Login do Administrador</a>
</div>
</div>
</footer>
</div>

<script>
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('show');
        if (mobileMenu.classList.contains('show')) {
            menuIcon.textContent = 'close';
        } else {
            menuIcon.textContent = 'menu';
        }
    });
    document.querySelectorAll('#mobile-menu a, header nav a').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            if (this.getAttribute('href').startsWith('#')) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
                if (mobileMenu.classList.contains('show')) {
                    mobileMenu.classList.remove('show');
                    menuIcon.textContent = 'menu';
                }
            }
        });
    });
</script>

</body></html>
