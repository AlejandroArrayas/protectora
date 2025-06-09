<?php
namespace App\Controllers;
use App\Models\Propietario;
use App\Models\Mascota;

class PropietarioController extends BaseController {
    public function indexAction($request) {
        $propietario = new Propietario();
        $data['propietario'] = $propietario->get();
        $data['mensaje'] = 'Listado de propietarios';
        $this->renderHTML('../app/views/propietario_view.php', $data);
    }

    public function showMascotasAction($request) {
        // Extraer el id del propietario de la URL
        $partes = explode('/', trim($request, '/'));
        if (isset($partes[2])) {
            $id = $partes[2];
        } else {
            $id = null;
        }
        $propietarioModel = new Propietario();
        $propietario = $propietarioModel->get($id);
        if ($propietario && count($propietario) > 0) {
            $propietarioData = $propietario[0]; // get() devuelve un array de resultados
            $data['nombre'] = $propietarioData['nombre'];
            $mascotaModel = new Mascota();
            $data['mascotas'] = $mascotaModel->getMascotasByPropietario($id);
            $data['mensaje'] = 'Mascotas de ' . $propietarioData['nombre'];
        } else {
            $data['mensaje'] = 'Propietario no encontrado';
            $data['mascotas'] = [];
        }
        $this->renderHTML('../app/views/mascotas_propietario_view.php', $data);
    }

}
?>