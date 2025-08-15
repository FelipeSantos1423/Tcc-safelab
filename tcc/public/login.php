<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../assets/login_cadastro.css">
    <title>Login</title>
</head>
<body>
    <form action="process/process_login.php" method="POST">
        <h1>Login</h1>
        <label>Email:</label>
        <input type="email" name="email" required>
        <br>
        <label>Senha:</label>
        <input type="password" name="senha" required>
        <br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>