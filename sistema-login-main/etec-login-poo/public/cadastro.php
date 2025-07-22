<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../assets/style.css">
    <title>Cadastro</title>
</head>
<body>
    <form action="process_cadastro.php" method="post">
        <h1>Cadastro</h1>
        <label for="nomeC">Nome Completo:</label>
        <input type="text" name="nomeC" id="nomeC" required>
        <br>
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        <br>
        <button type="submit">Cadastrar</button>
        <br>
        <p>já possui cadastro? <a href="login.php">Logar</a> </p>
    </form>
</body>
</html>
