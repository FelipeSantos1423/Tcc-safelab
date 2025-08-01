<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../assets/style.css">
    <title>Cadastro</title>
</head>
<body>
   <?php
require_once '../models/UsuarioDAO.php';
$usuarioDAO = new UsuarioDAO();
$tipos = $usuarioDAO->listarTiposUsuarios();
?>

<form action="process/process_cadastro.php" method="post">
    <label>Nome Completo:</label><br>
    <input type="text" name="nomeC" required><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br>

    <label>Senha:</label><br>
    <input type="password" name="senha" required><br>

    <label>Tipo de Usuário:</label><br>
    <select name="tipo_usuario_id" required>
        <option value="">Selecione</option>
        <?php foreach ($tipos as $tipo): ?>
            <option value="<?= htmlspecialchars($tipo['id']) ?>"><?= htmlspecialchars($tipo['tipo']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Cadastrar</button>
</form>

</body>
</html>
