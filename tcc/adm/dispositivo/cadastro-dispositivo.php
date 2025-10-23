<?php
session_start();
require_once __DIR__ . '/../../Models/Local/LocalDAO.php';

// Verifica login
if (!isset($_SESSION['logado']) || !isset($_SESSION['usuario'])) {
    header('Location: /tcc-safelab/tcc/public/login.php');
    exit;
}

$localDAO = new LocalDAO();
$locais = $localDAO->listarTodos(); // Para popular o dropdown
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cadastro de Dispositivo</title>
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
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Cadastro de Dispositivo</h2>
          <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Preencha as informações do dispositivo</p>
        </div>

        <!-- Formulário de cadastro -->
        <form method="post" action="../../process/dispositivo/process_cadastro_dispositivo.php" class="space-y-6">
          
          <div>
            <label for="nome" class="text-sm font-medium text-gray-700 dark:text-gray-300">Nome do Dispositivo</label>
            <input type="text" name="nome" required
              class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-primary focus:border-primary focus:outline-none">
          </div>

          <div>
            <label for="codigo_esp" class="text-sm font-medium text-gray-700 dark:text-gray-300">Código ESP</label>
            <input type="text" name="codigo_esp" required
              class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-primary focus:border-primary focus:outline-none">
          </div>

          <div>
            <label for="ativo" class="inline-flex items-center mt-2">
              <input type="checkbox" name="ativo" checked
                class="form-checkbox h-5 w-5 text-primary">
              <span class="ml-2 text-gray-700 dark:text-gray-300">Ativo</span>
            </label>
          </div>

          <div>
            <label for="tbl_locais_id" class="text-sm font-medium text-gray-700 dark:text-gray-300">Local</label>
            <select name="tbl_locais_id" required
              class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:ring-primary focus:border-primary focus:outline-none">
              <option value="">Selecione um local</option>
              <?php foreach ($locais as $local): ?>
                <option value="<?= $local['id'] ?>"><?= htmlspecialchars($local['locais']) ?></option>
              <?php endforeach; ?>
            </select>
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
