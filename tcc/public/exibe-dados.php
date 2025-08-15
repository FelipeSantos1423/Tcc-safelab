<?php
session_start();
require_once __DIR__ . '/../models/Usuario.php';

if (empty($_SESSION['logado']) || empty($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$usuario = unserialize($_SESSION['usuario']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../assets/exibe.css">
    <title>Área do Usuário</title>
    <style>
        /* Reset básico */
        
    </style>
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
    <p>Esta é a sua área pessoal onde você pode gerenciar suas informações.</p>
</main>

<script>
    const userMenuBtn = document.getElementById('userMenuBtn');
    const userMenu = document.getElementById('userMenu');

    userMenuBtn.addEventListener('click', () => {
        const expanded = userMenuBtn.getAttribute('aria-expanded') === 'true';
        userMenuBtn.setAttribute('aria-expanded', String(!expanded));
        userMenu.classList.toggle('open');
    });

    // Fecha o menu se clicar fora
    document.addEventListener('click', (e) => {
        if (!userMenu.contains(e.target)) {
            userMenu.classList.remove('open');
            userMenuBtn.setAttribute('aria-expanded', 'false');
        }
    });

    // Fecha com ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === "Escape") {
            userMenu.classList.remove('open');
            userMenuBtn.setAttribute('aria-expanded', 'false');
        }
    });
</script>

</body>
</html>
