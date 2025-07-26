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
    <title>Área do Usuário</title>
    <style>
        /* Reset básico */
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            color: #333;
        }

        /* Header fixo topo */
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            background-color: #007bff;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
            z-index: 1000;
        }

        header h1 {
            font-size: 1.4rem;
            margin: 0;
            user-select: none;
        }

        /* Menu usuário no topo direito */
        .user-menu {
            position: relative;
            user-select: none;
        }

        .user-menu button {
            background: transparent;
            border: none;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background-color 0.25s;
        }

        .user-menu button:hover,
        .user-menu button:focus {
            background-color: rgba(255,255,255,0.2);
            outline: none;
        }

        /* Dropdown */
        .dropdown {
            position: absolute;
            right: 0;
            top: 110%;
            background-color: white;
            color: #333;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-radius: 6px;
            min-width: 180px;
            display: none;
            flex-direction: column;
            z-index: 1100;
        }

        .dropdown a {
            padding: 12px 16px;
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: background-color 0.2s;
            border-bottom: 1px solid #eee;
        }

        .dropdown a:last-child {
            border-bottom: none;
        }

        .dropdown a:hover {
            background-color: #f0f0f0;
        }

        /* Mostrar dropdown */
        .user-menu.open .dropdown {
            display: flex;
        }

        /* Conteúdo principal */
        main {
            max-width: 720px;
            margin: 100px auto 40px;
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 0 25px rgba(0,0,0,0.1);
        }

        main h2 {
            margin-top: 0;
            font-weight: 700;
            font-size: 2rem;
            color: #222;
        }

        main p {
            font-size: 1.1rem;
            margin: 20px 0;
            color: #444;
        }

        /* Botão de confirmação (excluir) em vermelho */
        .dropdown a.delete {
            color: #c0392b;
            font-weight: 700;
        }
        .dropdown a.delete:hover {
            background-color: #f8d7da;
        }

        /* Responsividade */
        @media (max-width: 480px) {
            main {
                margin: 100px 15px 30px;
                padding: 20px 25px;
            }
            header h1 {
                font-size: 1.1rem;
            }
            .user-menu button {
                font-size: 0.9rem;
                padding: 6px 10px;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>SafeLab</h1>
    <nav class="user-menu" id="userMenu">
        <button id="userMenuBtn" aria-haspopup="true" aria-expanded="false" aria-controls="userDropdown">
            <?= htmlspecialchars($usuario->getEmail()); ?> &#x25BC;
        </button>
        <div class="dropdown" id="userDropdown" role="menu" aria-label="Menu do usuário">
            <a href="editar-usuario.php" role="menuitem">Editar minha conta</a>
            <a href="excluir-usuario.php" class="delete" role="menuitem" onclick="return confirm('Tem certeza que deseja excluir sua conta?');">Excluir minha conta</a>
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
