<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="/styles/index.css">
</head>
<body>
    <?php include_once 'header_view.php'; ?>
    <?php 
        if (!empty($data['error'])){
            echo '<p style="color:red;">' . htmlspecialchars($data['error']) . '</p>';
        }
    ?>
    <form method="post" action="/login" class="login-form">
        <h2>Iniciar sesión</h2><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required><br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>

