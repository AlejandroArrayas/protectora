<?php
//Iniciamos la sesion y configuramos la sesion por defecto en invitado
session_start();

if (!isset($_SESSION['perfil_usuario'])) {
    $_SESSION['perfil_usuario'] = 'invitado';
}

require_once "../vendor/autoload.php";
require_once "../app/conf/conf.php";

use App\Core\Router;
use App\Controllers\BasicController;
use App\Controllers\MascotaController;
use App\Controllers\PropietarioController;

$router = new Router();
// $router->add([
//     'name'=>'mostrar_mascota',
//     'path'=>'/^\/mascotas\/mostrar\/[a-zA-Z0-9]+$/',
//     'action'=>[MascotaController::class, 'showAction']]);

// $router->add([
//     'name'=>'listado_mascotas',
//     'path'=> '/^\/mascotas\/$/',
//     'action'=>[MascotaController::class, 'indexAction']]);

// $router->add([
//     'name'=>'mostrar_mascotas_propietario',
//     'path'=>'/^\/propietario\/mascotas\/[0-9]+$/',
//     'action'=>[PropietarioController::class, 'showMascotasAction']]);

$router->add([
    'name'=>'index',
    'path'=> '/^\/$/',
    'action'=>[BasicController::class, 'indexAction']
]);

$router->add([
    'name'=>'register',
    'path'=> '/^\/register$/',
    'action'=>[BasicController::class, 'registerAction'],
    'perfil' => ['invitado'],
]);

$router->add([
    'name'=>'login',
    'path'=> '/^\/login$/',
    'action'=>[BasicController::class, 'loginAction'],
    'perfil' => ['invitado'],
]);


$router->add([
    'name'=>'logout',
    'path'=> '/^\/logout$/',
    'action'=>[BasicController::class, 'logoutAction'],
    'perfil' => ['user', 'admin']
]);

$router->add([
    'name'=>'crear_mascota',
    'path'=> '/^\/crear_mascota$/',
    'action'=>[MascotaController::class, 'crearAction'],
    'perfil' => ['admin']
]);

$router->add([
    'name'=>'mascotas',
    'path'=>'/^\/mascotas$/',
    'action'=>[MascotaController::class, 'indexAction'],
    'perfil'=> ['user', 'admin', 'invitado']
]);

$router->add([
    'name'=>'mostrar_mascota',
    'path'=>'/^\/mascotas\/mostrar\/[0-9]+$/',
    'action'=>[MascotaController::class, 'mascotaAction'],
    'perfil'=> ['user', 'admin', 'invitado']
]);

$router->add([
    'name'=>'editar_mascota',
    'path'=>'/^\/mascotas\/editar\/[0-9]+$/',
    'action'=>[MascotaController::class, 'editarAction'],
    'perfil'=> ['admin']
]);

$router->add([
    'name'=>'borrar_mascota',
    'path'=>'/^\/mascotas\/borrar\/[0-9]+$/',
    'action'=>[MascotaController::class, 'borrarAction'],
    'perfil'=> ['admin']
]);

$router->add([
    'name'=>'propietarios',
    'path'=>'/^\/propietarios$/',
    'action'=>[PropietarioController::class, 'indexAction'],
    'perfil'=> ['user', 'admin', 'invitado']
]);

$router->add([
    'name'=>'convertir_propietario',
    'path'=> '/^\/convertir_propietario$/',
    'action'=>[PropietarioController::class, 'convertirPropietarioAction'],
    'perfil' => ['user', 'admin']
]);

$router->add([
    'name'=>'propietario',
    'path'=>'/^\/propietario$/',
    'action'=>[PropietarioController::class, 'showAction'],
    'perfil'=> ['user', 'admin']
]);

$router->add([
    'name'=>'adoptar_mascota',
    'path'=>'/^\/mascotas\/adoptar\/[0-9]+$/',
    'action'=>[MascotaController::class, 'adoptarAction'],
    'perfil'=> ['user', 'admin']
]);

$request = $_SERVER['REQUEST_URI'];
$route = $router->match($request);

if ($route) {
    if(isset($route['perfil']) && !in_array($_SESSION['perfil_usuario'], $route['perfil'])){
        header('Location: /');
    }else{
        $controllerName = $route['action'][0];
        $actionName = $route['action'][1];
        $controller = new $controllerName;
        $controller->$actionName($request);
    }
} else {
    echo "No route";
}

?>