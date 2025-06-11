<?php
namespace App\Controllers;
use App\Models\Propietario;
use App\Models\Mascota;

class PropietarioController extends BaseController {
    public function indexAction($request) {
        $data['ubicacion'] = 'propietarios';
        $data['mensaje'] = 'Listado de propietarios';
        $this->renderHTML('../app/views/propietarios_view.php', $data);
    }


    public function convertirPropietarioAction($request) {
        if (!isset($_SESSION['id_usuario'])) {
            header('Location: /login');
            exit();
        }
        $usuario_id = $_SESSION['id_usuario'];
        $nombre = $_SESSION['usuario'] ?? '';
        $propietario = new \App\Models\Propietario();
        if ($propietario->crearPropietario($usuario_id, $nombre)) {
            $mensaje = '¡Ahora eres propietario!';
        } else {
            $mensaje = $propietario->mensaje;
        }
        header('Location: /propietarios');
        exit();
    }

}
?>