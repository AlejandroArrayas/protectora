<?php
/**
 * Propietario Profile View
 */
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="/styles/index.css">
</head>
<body>
    <?php include_once '../app/views/header_view.php'; ?>
    <div class="title">
        <h1>Perfil de Propietario</h1>
    </div>
    <div class="profile-info" style="align-items: center; justify-content: center; text-align: center;">
        <h4></h4>Nombre: <strong><?php echo $data['propietario']; ?></strong></h4>
    </div>
    
    <div class="mascotas-list" style="align-items: center; justify-content: center; text-align: center;">
        <h2>Mis Mascotas</h2>
        <div class="mascotasContainer">
            <?php 
                if (!empty($data['mascotas'])) {
                    foreach ($data['mascotas'] as $mascota) {
                        echo '<div class="mascotaCard">';
                        echo '<h3>Nombre: ' . $mascota['nombre'] . '</h3>';
                        echo '<p>Color: ' . $mascota['color'] . '</p>';
                        echo '<p>Habilidad: ' . $mascota['habilidad'] . '</p>';
                        echo '<p>Sociabilidad: ' . $mascota['sociabilidad'] . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No tienes mascotas registradas.</p>';
                }
            ?>
        </div>
        
    </div>

    <div class="centrar">
        <button class="boton-volver" onclick="location.href='/propietarios'">Volver a Propietarios</button>
    </div>
</body>
</html>