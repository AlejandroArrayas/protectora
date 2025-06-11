<?php
namespace App\Controllers;
use App\Models\Propietario;
use App\Models\Mascota;

class PropietarioController extends BaseController {
    public function indexAction() {
        $data['ubicacion'] = 'propietarios';
        $data['mensaje'] = 'Listado de propietarios';
        $this->renderHTML('../app/views/propietarios_view.php', $data);
    }


    public function convertirPropietarioAction() {
        if (!isset($_SESSION['id_usuario'])) {
            header('Location: /login');
        }
        $usuario_id = $_SESSION['id_usuario'];
        $nombre = $_SESSION['usuario'];
        $oPropietario = Propietario::getInstancia();
        if ($oPropietario->crearPropietario($usuario_id, $nombre)) {
            $_SESSION['boolean_propietario'] = true;
        } else {
            $_SESSION['boolean_propietario'] = false;
        }
        header('Location: /propietarios');
    }

    public function showAction(){
        if (!isset($_SESSION['id_usuario']) &&  !$_SESSION['boolean_propietario']) {
            header('Location: /login');
        }
        $data['ubicacion'] = 'propietario';
        $data['mensaje'] = 'Perfil de propietario';
        $oPropietario = Propietario::getInstancia();
        $data['propietario'] = $oPropietario->getNombreByIdUsuario($_SESSION['id_usuario']);
        
        // Obtener las mascotas del propietario
        $oMascota = Mascota::getInstancia();
        $data['mascotas'] = $oMascota->getMascotasByPropietarioId($_SESSION['id_propietario']);
        
        $this->renderHTML('../app/views/propietario_profile_view.php', $data);
    }

}
?>