<?php
var_dump($data); // Debugging line to check the data being passed to the view
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mascota</title>
    <link rel="stylesheet" href="/styles/index.css">
</head>
<body>
    <?php include_once 'header_view.php'; ?>
    <?php 
        if (!empty($data['error'])){
            echo '<p style="color:red; text-align:center; margin-top: 5px;">' . htmlspecialchars($data['error']) . '</p>';
        }
    ?>
    <form method="post" class="login-form">
        <h2>Introduce los datos de la Mascota</h2><br>
        <p><?php echo $data['mensaje'] ?></p>
        <!-- NOMBRE -->
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo isset($data) ? htmlspecialchars($data['nombre']) : ''; ?>" required>
        <span style="color: red;"><?php echo isset($data) ? $data['eNombre'] : ''; ?></span>
        <br>

        <!-- COLOR -->
        <label for="color">Color:</label>
        <input type="text" name="color" id="color" value="<?php echo isset($data) ? htmlspecialchars($data['color']) : ''; ?>" required>
        <span style="color: red;"><?php echo isset($data) ? $data['eColor'] : ''; ?></span>
        <br>

        <!-- HABILIDAD -->
        <label for="habilidad">Habilidad:</label>
        <input type="text" name="habilidad" id="habilidad" value="<?php echo isset($data) ? htmlspecialchars($data['habilidad']) : ''; ?>" required>
        <span style="color: red;"><?php echo isset($data) ? $data['eHabilidad'] : ''; ?></span>
        <br>

        <!-- SOCIABILIDAD -->
        <label for="sociabilidad">Sociabilidad:</label>
        <input type="text" name="sociabilidad" id="sociabilidad" value="<?php echo isset($data) ? htmlspecialchars($data['sociabilidad']) : ''; ?>" required>
        <span style="color: red;"><?php echo isset($data) ? $data['eSociabilidad'] : ''; ?></span>
        <br>

        <button type="submit">Guardar Mascota</button>
    </form>
</body>
</html>