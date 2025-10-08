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
                        "primary": "#1193d4",
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
<header class="sticky top-0 z-20 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-sm border-b border-gray-200 dark:border-gray-800">
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
<div class="flex items-center justify-between h-16">
<div class="flex items-center space-x-4">
<a class="flex items-center space-x-2" href="#home">
<svg class="h-8 w-8 text-primary" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
<path d="M36.7273 44C33.9891 44 31.6043 39.8386 30.3636 33.69C29.123 39.8386 26.7382 44 24 44C21.2618 44 18.877 39.8386 17.6364 33.69C16.3957 39.8386 14.0109 44 11.2727 44C7.25611 44 4 35.0457 4 24C4 12.9543 7.25611 4 11.2727 4C14.0109 4 16.3957 8.16144 17.6364 14.31C18.877 8.16144 21.2618 4 24 4C26.7382 4 29.123 8.16144 30.3636 14.31C31.6043 8.16144 33.9891 4 36.7273 4C40.7439 4 44 12.9543 44 24C44 35.0457 40.7439 44 36.7273 44Z" fill="currentColor"></path>
</svg>
<h1 class="text-2xl font-bold text-gray-900 dark:text-white">SAFELAB</h1>
</a>
</div>
<nav class="hidden md:flex items-center space-x-8">
<a class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-primary transition-colors" href="#home">Home</a>
<a class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-primary transition-colors" href="#sobre">Sobre</a>
<a class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-primary transition-colors" href="public/login.php">Login</a>
</nav>
<button class="md:hidden rounded-md p-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800" id="menu-btn">
<span class="sr-only">Abrir menu</span>
<span class="material-symbols-outlined" id="menu-icon">menu</span>
</button>
</div>
</div>
<div class="md:hidden" id="mobile-menu">
<nav class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
<a class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-200 hover:text-white hover:bg-primary" href="#home">Home</a>
<a class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-200 hover:text-white hover:bg-primary" href="#sobre">Sobre</a>
<a class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-200 hover:text-white hover:bg-primary" href="public/login.php">Login</a>
</nav>
</div>
</header>
<main class="flex-grow">
<section class="bg-background-light dark:bg-background-dark py-20 md:py-32" id="home">
<div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
<h2 class="text-4xl md:text-6xl font-bold text-gray-900 dark:text-white">Bem-vindo ao SAFELAB</h2>
<p class="mt-4 text-lg md:text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">Monitorando laboratórios de informática para garantir um ambiente educacional saudável, seguro e produtivo.</p>
<div class="mt-8 flex justify-center gap-4">
<a class="inline-block bg-primary text-white font-bold py-3 px-8 rounded-lg hover:bg-primary/90 transition-colors" href="#sobre">Saiba Mais</a>
<a class="inline-block bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 font-bold py-3 px-8 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors" href="public/login.php" id="dashboard">Login</a>
</div>
</div>
</section>
<section class="py-16 md:py-24 bg-white dark:bg-gray-900/50" id="sobre">
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
<div class="max-w-4xl mx-auto">
<div class="text-center mb-12">
<h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">Sobre o Projeto</h2>
<p class="mt-4 text-lg text-gray-600 dark:text-gray-400">Entenda os objetivos, a relevância e a tecnologia por trás do SAFELAB.</p>
</div>
<div class="space-y-12">
<div>
<h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Objetivos e Relevância</h3>
<p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        O projeto SAFELAB visa monitorar as condições ambientais em laboratórios de informática para garantir um ambiente saudável e produtivo. A relevância está em criar um espaço que melhore a concentração e o bem-estar dos alunos, reduzindo riscos à saúde e potencializando a aprendizagem. Além disso, o projeto serve como uma ferramenta educacional prática em tecnologia, abordando desde a coleta de dados com sensores até a visualização em um dashboard interativo.
                    </p>
</div>
<div>
<h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Tecnologias Utilizadas</h3>
<p class="text-gray-600 dark:text-gray-400 leading-relaxed text-sm">
                        O sistema utiliza a placa de desenvolvimento ESP32 para coletar dados de sensores de temperatura, umidade, qualidade do ar e luminosidade. O software embarcado foi desenvolvido na IDE do Arduino com auxílio do VS Code. O backend e o banco de dados rodam em um servidor local com XAMPP, usando MySQL para armazenar os dados. A interface do usuário e o dashboard foram criados com HTML, CSS (Tailwind CSS) e JavaScript, garantindo uma experiência responsiva e intuitiva.
                    </p>
</div>
<div>
<h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Estrutura do Trabalho</h3>
<div class="relative pl-8 border-l-2 border-primary/30">
<div class="mb-8">
<div class="absolute w-4 h-4 bg-primary rounded-full -left-[9px] mt-1 border-4 border-white dark:border-gray-900/50"></div>
<h4 class="text-xl font-bold text-gray-900 dark:text-white">1. Pesquisa e Fundamentação</h4>
<p class="text-gray-600 dark:text-gray-400 mt-1">Levantamento de referencial teórico sobre o impacto ambiental no aprendizado e análise de soluções existentes.</p>
</div>
<div class="mb-8">
<div class="absolute w-4 h-4 bg-primary rounded-full -left-[9px] mt-1 border-4 border-white dark:border-gray-900/50"></div>
<h4 class="text-xl font-bold text-gray-900 dark:text-white">2. Desenvolvimento do Protótipo</h4>
<p class="text-gray-600 dark:text-gray-400 mt-1">Montagem do hardware com ESP32 e sensores, e desenvolvimento do software embarcado para coleta de dados.</p>
</div>
<div class="mb-8">
<div class="absolute w-4 h-4 bg-primary rounded-full -left-[9px] mt-1 border-4 border-white dark:border-gray-900/50"></div>
<h4 class="text-xl font-bold text-gray-900 dark:text-white">3. Implementação do Sistema</h4>
<p class="text-gray-600 dark:text-gray-400 mt-1">Criação do banco de dados, desenvolvimento do backend para processamento e da interface web para visualização dos dados.</p>
</div>
<div class="">
<div class="absolute w-4 h-4 bg-primary rounded-full -left-[9px] mt-1 border-4 border-white dark:border-gray-900/50"></div>
<h4 class="text-xl font-bold text-gray-900 dark:text-white">4. Testes e Validação</h4>
<p class="text-gray-600 dark:text-gray-400 mt-1">Realização de testes para garantir a precisão dos dados, a estabilidade do sistema e a usabilidade da interface.</p>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
</main>
<footer class="bg-gray-100 dark:bg-background-dark border-t border-gray-200 dark:border-gray-800">
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
<div class="text-center">
<p class="text-sm text-gray-500 dark:text-gray-400">© 2024 SAFELAB. Todos os direitos reservados.</p>
<a class="text-xs text-gray-500 dark:text-gray-400 hover:text-primary mt-2 inline-block" href="public/login.php">Login do Administrador</a> <!--Caminho login do adm -->
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