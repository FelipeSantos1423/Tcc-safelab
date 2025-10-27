<?php
session_start();
require_once __DIR__ . '/../../Models/Local/Local.php';
require_once __DIR__ . '/../../Models/Local/LocalDAO.php';

// Garante que está logado
if (!isset($_SESSION['logado'])) {
    header('Location: ../../public/login.php');
    exit;
}

$localDAO = new LocalDAO();
$local = null;

// Verifica se veio um ID válido na URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
    $local = $localDAO->buscarPorId($id);

    if (!$local) {
        header('Location: locais.php?msg=local_nao_encontrado');
        exit;
    }
} else {
    header('Location: locais.php?msg=id_invalido');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Editar Local</title>
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
     <header class="sticky top-0 z-20 bg-[#0d1a17]/95 backdrop-blur-sm border-b border-gray-700">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
          <!-- Logo -->
          <div class="flex items-center space-x-4">
            <a class="flex items-center space-x-2" href="../adm.php">
              <img src="../../images/WhatsApp_Image_2025-10-23_at_21.19.41-removebg-preview (1).png" width="200px" height="200px" alt="SAFELAB Logo"> 
            </a>
          </div>

          <!-- Botão voltar -->
          <a href="../adm.php" 
             class="text-sm font-medium text-gray-300 hover:text-primary transition-colors flex items-center">
             ← Voltar
          </a>
        </div>
      </div>
    </header>

    <!-- Main -->
    <main class="flex-grow flex items-center justify-center px-4 sm:px-6 lg:px-8">
      <div class="max-w-md w-full bg-white dark:bg-background-dark rounded-xl shadow-lg p-8 space-y-6 border border-gray-200 dark:border-gray-700">
        <div class="text-center">
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Editar Local</h2>
          <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Atualize as informações abaixo</p>
        </div>

        <!-- Formulário -->
        <form method="post" action="../../process/local/process_editar_local.php" class="space-y-6">
          <input type="hidden" name="id" value="<?= htmlspecialchars($local['id']) ?>">

          <div>
            <label for="locais" class="text-sm font-medium text-gray-700 dark:text-gray-300">Nome do Local</label>
            <input type="text" name="locais" required 
              value="<?= htmlspecialchars($local['locais']) ?>"
              class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-primary focus:border-primary focus:outline-none">
          </div>

          <div>
            <label for="descricao" class="text-sm font-medium text-gray-700 dark:text-gray-300">Descrição</label>
            <textarea name="descricao" rows="4"
              class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-primary focus:border-primary focus:outline-none"><?= htmlspecialchars($local['descricao']) ?></textarea>
          </div>

          <div>
            <button type="submit"
              class="w-full flex justify-center py-3 px-4 rounded-lg shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
              Atualizar
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>
</body>
</html>
