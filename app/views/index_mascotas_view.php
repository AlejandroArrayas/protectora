<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mascotas</title>
    <link rel="stylesheet" href="/styles/index.css">
</head>

<body>
    <?php include_once 'header_view.php'; ?>
    <?php var_dump($data); ?>
    <div class="mascotasContainer">
        <?php foreach ($data['mascotasConPropietario'] as $mascota): ?>
            <a href="/mascotas/mostrar/<?php echo $mascota['id']; ?>" class="mascotaLink">
                <div class="mascotaCard">
                    <h2>
                        <?php if (isset($mascota['nombre'])) {
                                echo $mascota['nombre'];
                            }
                        ?>
                    </h2>
                    <p>
                        Color:
                        <?php
                            if (isset($mascota['color'])) {
                                echo $mascota['color'];
                            }
                        ?>
                    </p>
                    <p>
                        Habilidad:
                        <?php
                            if (isset($mascota['habilidad'])) {
                                echo $mascota['habilidad'];
                            }
                        ?>
                    </p>
                    <p>
                        Sociabilidad:
                        <?php
                            if (isset($mascota['sociabilidad'])) {
                                echo $mascota['sociabilidad'];
                            }
                        ?>
                    </p>
                </div>
            </a>
            
        <?php endforeach; ?>

    </div>
</body>

</html>