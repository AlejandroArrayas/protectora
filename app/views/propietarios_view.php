<?php
/**
 * Propietarios View
 * 
 * 
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propietarios</title>
    <link rel="stylesheet" href="/styles/index.css">
</head>
<body>
    <?php include_once '../app/views/header_view.php'; ?>
    <div class="title">
        <h1>¿Quieres ser propietario?</h1>
    </div>
    <div class="advise">
        <p>
            Ser propietario de una mascota implica asumir responsabilidades como su cuidado diario, alimentación adecuada, atención veterinaria y brindarles un entorno seguro y afectuoso. Antes de tomar esta decisión, asegúrate de estar comprometido con su bienestar durante toda su vida.
        </p>
    </div>
    <?php 
    if(isset($_SESSION['id_usuario'])){       
        if ($_SESSION['boolean_propietario'] == true) {
            echo "
            <div class='centrar'>
                <button class='boton-volver' onclick=\"location.href='/propietario'\">Ir a tu perfil de propietario</button>
            </div>";
        } else {
            echo "
            <div class='centrar'>
                <button class='boton-volver' onclick=\"location.href='/convertir_propietario'\">Conviertete en propietario!</button>
            </div>";
        }
    }else {
        echo "
        <div class='centrar'>
            <button class='boton-volver' onclick='location.href=\"/login\"'>Inicia sesión para convertirte en propietario!</button>
        </div>";
    }
    
    ?>
    
</body>
</html>