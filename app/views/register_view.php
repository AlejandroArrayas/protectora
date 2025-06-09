<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="/styles/index.css">
</head>
<body>
    <?php include_once 'header_view.php'; ?>
    <?php 
        if (!empty($data['error'])){
            echo '<p style="color:red; text-align:center; margin-top:  5px;">' . htmlspecialchars($data['error']) . '</p>';
        }
    ?>
    <form method="post" class="login-form">
        <h2>Crea tu cuenta!</h2><br>

        <!-- APARTADO DE USUARIO -->
        <label for="user">Usuario:</label>
        <input type="text" name="user" id="user" value="<?php echo isset($data) ? htmlspecialchars($data['user']) : ''; ?>"  required>
        <span style="color: red;"><?php echo isset($data) ? $data['eUser'] : ''; ?></span>
        <br>

        <!-- APARTADO DE EMAIL -->
        <label for="user">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo isset($data) ? htmlspecialchars($data['email']) : ''; ?>" required>
        <span style="color: red;"><?php echo isset($data) ? $data['eEmail'] : ''; ?></span>
        <br>

        <!-- APARTADO DE CONTRASEÑA -->
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" value="<?php echo isset($data) ? htmlspecialchars($data['password']) : ''; ?>" required>
        <span style="color: red;"><?php echo isset($data) ? $data['ePassword'] : ''; ?></span>
        <br>

        <!-- APARTADO DE REPETIR CONTRASEÑA -->
        <label for="password">Repite la contraseña:</label>
        <input type="password" name="password2" id="password2" value="<?php echo isset($data) ? htmlspecialchars($data['password2']) : ''; ?>" required>
        <span style="color: red;"><?php echo isset($data) ? $data['ePassword2'] : ''; ?></span>
        <br>

        <button type="submit">Entrar</button>
    </form>
</body>
</html>