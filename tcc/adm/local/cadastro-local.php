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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cadastrar Local</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
</head>
<body class="bg-gray-100 font-sans">
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Cadastrar Local</h2>
    <form method="post" action="../../process/local/process_cadastro_local.php" class="space-y-4">
        <div>
            <label class="block text-sm font-medium">Nome do Local</label>
            <input type="text" name="locais" required class="w-full px-3 py-2 border rounded"/>
        </div>
        <div>
            <label class="block text-sm font-medium">Descrição</label>
            <textarea name="descricao" required class="w-full px-3 py-2 border rounded"></textarea>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Cadastrar</button>
    </form>
</div>
</body>
</html>
