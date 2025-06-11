<?php
/**
 * Mostrar Mascota View
 * 
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['mascota'][0]['nombre']?></title>
    <link rel="stylesheet" href="/styles/index.css">
</head>
<body>
    <?php include_once '../app/views/header_view.php'; ?>
    <div class="mascotaView">
                    <h2>
                        <?php if (isset($data['mascota'][0]['nombre'])) {
                                echo $data['mascota'][0]['nombre'];
                            }
                        ?>
                    </h2>
                    <p>
                        Color:
                        <?php
                            if (isset($data['mascota'][0]['color'])) {
                                echo $data['mascota'][0]['color'];
                            }
                        ?>
                    </p>
                    <p>
                        Habilidad:
                        <?php
                            if (isset($data['mascota'][0]['habilidad'])) {
                                echo $data['mascota'][0]['habilidad'];
                            }
                        ?>
                    </p>
                    <p>
                        Sociabilidad:
                        <?php
                            if (isset($data['mascota'][0]['sociabilidad'])) {
                                echo $data['mascota'][0]['sociabilidad'];
                            }
                        ?>
                    </p>
    </div>
    <!-- EDITAR Y BORRAR MASCOTA -->
    <?php if (isset($_SESSION['perfil_usuario']) && $_SESSION['perfil_usuario'] == 'admin') {
            echo "<div class='centrar'>
                <button style='padding: 0.5rem; margin-right: 0.5rem;' class='boton-editar' onclick=\"location.href='/mascotas/editar/" . $data['mascota'][0]['id'] . "'\">Editar Mascota</button>
                <button style='padding: 0.5rem;' class='boton-borrar' onclick=\"confirmarBorrado(" . $data['mascota'][0]['id'] . ")\">Borrar Mascota</button>
            </div>";
        } ?>

    <div class="centrar">
        <button class="boton-volver" onclick="location.href='/mascotas'">Volver a Mascotas</button>
    </div>
    <script>
    function confirmarBorrado(id) {
        if (confirm('¿Estás seguro de que quieres borrar esta mascota? Esta acción no se puede deshacer.')) {
            window.location.href = '/mascotas/borrar/' + id;
        }
    }
    </script>
</body>
</html>