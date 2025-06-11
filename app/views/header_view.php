<header>
<div class='presentacion'>
    <h1>Protectora</h1>
    <h2>
        <?php 
            if (isset($_SESSION['usuario'])) {
                echo 'Bienvenido, ' . htmlspecialchars($_SESSION['usuario']);
            }
        ?>
    </h2>
</div>

<nav>
    <ul>
    <?php
        if(isset($_SESSION['id_usuario']) && $_SESSION['boolean_propietario'] == true && !isset($data['ubicacion']) || $data['ubicacion'] !== 'propietario') {
            echo '<li class="perfilPropietario"><a href="/propietario">Perfil de propietario</a></li>';
        }

        if (!isset($data['ubicacion']) || $data['ubicacion'] !== 'mascotas') {
            echo '<li><a href="/mascotas">Mascotas</a></li>';
        }
        if (!isset($data['ubicacion']) || $data['ubicacion'] !== 'propietarios') {
            echo '<li><a href="/propietarios">Propietarios</a></li>';
        }
        if (!isset($data['ubicacion']) || $data['ubicacion'] !== 'index') {
            echo '<li><a href="/">Inicio</a></li>';
        }
        if (!isset($data['ubicacion']) || $data['ubicacion'] !== 'login') {
            if (isset($_SESSION['usuario'])) {
                echo '<li class="cierreSesion"><a href="/logout">Cerrar sesión</a></li>';
            } else {
                echo '<li class="inicioSesion"><a href="/login">Iniciar sesión</a></li>';
            }
        }

        if (!isset($data['ubicacion']) || $data['ubicacion'] !== 'register') {
            if (!isset($_SESSION['usuario'])) {
                echo '<li class="register-nav"><a href="/register">Crea tu cuenta!</a></li>';
            }
        }

        if (!isset($data['ubicacion']) || $data['ubicacion'] !== 'crear_mascota') {
            if (isset($_SESSION['perfil_usuario']) && $_SESSION['perfil_usuario'] === 'admin') {
                echo '<li class="crearMascota"><a style="background-color: grey;" href="/crear_mascota">Crear mascota</a></li>';
            }
        }
 

        
    ?>
    </ul>
</nav>
</header>