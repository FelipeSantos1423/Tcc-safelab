<?php
session_start();
$msg = $_SESSION['msg_sucesso'] ?? null;
unset($_SESSION['msg_sucesso']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafeLab - Portal de Segurança Laboratorial</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');
        
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8fafc;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }
        
        .sticky {
            position: sticky;
        }
        
        .card-shadow {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .input-focus:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">

<?php if ($msg): ?>
<script>
    alert("<?= addslashes($msg) ?>");
</script>
<?php endif; ?>

    <!-- Header -->
    <header class="bg-blue-700 text-white sticky top-0 z-50">
        <div class="container mx-auto px-4 py-6">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-shield-alt text-3xl"></i>
                    <h1 class="text-2xl font-bold">SafeLab</h1>
                </div>
                <nav class="hidden md:block">
                    <ul class="flex space-x-6">
                        <li><a href="#about" class="hover:underline">Sobre</a></li>
                        <li><a href="#contact" class="hover:underline">Contato</a></li>
                        <li><a href="login.php" class="hover:underline">Login</a></li>
                    </ul>
                </nav>
                <button id="mobile-menu-button" class="md:hidden text-xl focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-blue-800 pb-4 px-4">
            <ul class="flex flex-col space-y-3">
                <li><a href="#about" class="block py-2 hover:bg-blue-700 px-4 rounded">Sobre</a></li>
                <li><a href="login.php" class="block py-2 hover:bg-blue-700 px-4 rounded">Login</a></li>
                <li><a href="#contact" class="block py-2 hover:bg-blue-700 px-4 rounded">Contato</a></li>
            </ul>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        <!-- Hero Section -->
        <section class="gradient-bg text-white py-12 md:py-20">
            <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h2 class="text-4xl md:text-5xl font-bold mb-4">Bem-vindo ao SafeLab</h2>
                    <p class="text-xl mb-8">Sistema de gestão de segurança laboratorial</p>
                    <a href="login.php" class="bg-white text-blue-600 font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 transition duration-300 inline-block">
                        Acessar o sistema
                    </a>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/3069/3069172.png" alt="Laboratory Safety" class="w-64 h-64 floating">
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="py-12 bg-white">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Sobre o projeto</h2>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-gray-50 p-6 rounded-lg card-shadow">
                        <div class="text-blue-600 mb-4">
                            <i class="fas fa-flask text-4xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">Missão</h3>
                        <p class="text-gray-600">Garantir a segurança em ambientes laboratoriais através de um sistema integrado de gestão de protocolos, equipamentos e treinamentos.</p>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-lg card-shadow">
                        <div class="text-blue-600 mb-4">
                            <i class="fas fa-cogs text-4xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">Funcionalidades</h3>
                        <p class="text-gray-600">Controle de acesso, gestão de equipamentos de proteção, registro de incidentes, treinamentos online e monitoramento em tempo real.</p>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-lg card-shadow">
                        <div class="text-blue-600 mb-4">
                            <i class="fas fa-users text-4xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">Público</h3>
                        <p class="text-gray-600">Pesquisadores, técnicos de laboratório, estudantes e profissionais da área de saúde e ciências que necessitam de um ambiente seguro para trabalhar.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="py-12 bg-white">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Contato</h2>
                <div class="max-w-4xl mx-auto grid md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-xl font-semibold mb-4 text-gray-800">Informações de contato</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <i class="fas fa-map-marker-alt text-blue-600 mt-1 mr-3"></i>
                                <span class="text-gray-600">Av. Universitária, 123 - Campus Universitário</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-phone-alt text-blue-600 mt-1 mr-3"></i>
                                <span class="text-gray-600">(00) 1234-5678</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-envelope text-blue-600 mt-1 mr-3"></i>
                                <span class="text-gray-600">contato@safelab.edu.br</span>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-4 text-gray-800">Envie uma mensagem</h3>
                        <form class="space-y-4">
                            <div>
                                <input type="text" placeholder="Seu nome" 
                                       class="w-full px-4 py-2 border rounded-lg input-focus focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <input type="email" placeholder="Seu e-mail" 
                                       class="w-full px-4 py-2 border rounded-lg input-focus focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <textarea rows="4" placeholder="Sua mensagem" 
                                          class="w-full px-4 py-2 border rounded-lg input-focus focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                            </div>
                            <button type="submit" 
                                    class="bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Enviar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-6 md:mb-0">
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-shield-alt text-2xl"></i>
                        <h2 class="text-xl font-bold">SafeLab</h2>
                    </div>
                    <p class="text-gray-400">Sistema de gestão de segurança laboratorial</p>
                </div>
                <div class="text-center md:text-right">
                    <h3 class="text-lg font-semibold mb-2">Créditos</h3>
                    <p class="text-gray-400">Projeto desenvolvido por:</p>
                    <p class="text-gray-400">Equipe SafeLab</p>
                    <p class="text-gray-400">Alunos: Dayana Oliveira, Felipe dos Santos, Henrique dos Santos, Matheus Silva</p>
                    <p class="text-gray-400">Técnicos em Desenvolvimento de Sistemas</p>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
                <p>&copy; 2023 SafeLab. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <script>
        // Simple form validation
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            // Simple validation
            if(email && password) {
                // Here you would typically send the data to a server
                alert('Login realizado com sucesso! Redirecionando...');
                // window.location.href = 'dashboard.html';
            } else {
                alert('Por favor, preencha todos os campos.');
            }
        });

        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            // Change icon based on menu state
            const icon = mobileMenuButton.querySelector('i');
            if (mobileMenu.classList.contains('hidden')) {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            } else {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            }
        });
    </script>
</body>
</html>