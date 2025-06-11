<?php
namespace App\Controllers;
use App\Models\Mascota;
use App\Models\Propietario;

class MascotaController extends BaseController {
    public function crearAction(){
        $data['ubicacion'] = 'crear_mascota';
        $data['mensaje'] = '';
        $data['error'] = '';
        $data['nombre'] = $data['color'] = $data['habilidad'] = $data['sociabilidad'] = '';
        $data['eNombre'] = $data['eColor'] = $data['eHabilidad'] = $data['eSociabilidad'] = '';

        $lProcesaFormulario = false;

        $oMascota = new Mascota();

        if(!empty($_POST)){
            $data['nombre'] = $_POST['nombre'];
            $data['color'] = $_POST['color'];
            $data['habilidad'] = $_POST['habilidad'];
            $data['sociabilidad'] = $_POST['sociabilidad'];
            $lProcesaFormulario = true;

            // Validar los datos del formulario

            if (empty($data['nombre'])) {
                $lProcesaFormulario = false;
                $data['eNombre'] = "* El nombre no puede estar vacío";
            }

            if (empty($data['color'])) {
                $lProcesaFormulario = false;
                $data['eColor'] = "* El color no puede estar vacío";
            }

            if (empty($data['habilidad'])) {
                $lProcesaFormulario = false;
                $data['eHabilidad'] = "* La habilidad no puede estar vacía";
            }

            if (empty($data['sociabilidad'])) {
                $lProcesaFormulario = false;
                $data['eSociabilidad'] = "* La sociabilidad no puede estar vacía";
            }

            // Si es valido guardamos la mascota
            if($lProcesaFormulario){
                $oMascota->setNombre($data['nombre']);
                $oMascota->setColor($data['color']);
                $oMascota->setHabilidad($data['habilidad']);
                $oMascota->setSociabilidad($data['sociabilidad']);

                if ($oMascota->set()) {
                    $data['mensaje'] = 'Mascota creada correctamente';
                    $data['error'] = '';
                    $data['nombre'] = $data['color'] = $data['habilidad'] = $data['sociabilidad'] = '';
                    $data['eNombre'] = $data['eColor'] = $data['eHabilidad'] = $data['eSociabilidad'] = '';
                } else {
                    $data['error'] = 'Error al crear la mascota: ' . $oMascota->mensaje;
                }
            }
        }

        $this->renderHTML('../app/views/crear_mascotas_view.php', $data);
    }

    public function indexAction(){
        $data['ubicacion'] = 'mascotas';
        $data['mensaje'] = 'Listado de Mascotas';
        $data['error'] = '';
        $data['mascotas'] = [];

        // Creamos una instancia del modelo Mascota
        $oMascota = new Mascota();
        
        // Obtenemos todas las mascotas
        $data['mascotas'] = $oMascota->get();

        // Obtenemos las mascotas sin propietario
        $data['mascotasSinPropietario'] = $oMascota->getMascotasWithoutPropietario();

        // Obtenemos las mascotas con propietario
        $data['mascotasConPropietario'] = $oMascota->getMascotasWithPropietario();

        // Añadir nombre del propietario a cada mascota con propietario
        $oPropietario = Propietario::getInstancia();
        foreach ($data['mascotasConPropietario'] as &$mascota) {
            if (!empty($mascota['propietario_id'])) {
                $mascota['nombre_propietario'] = $oPropietario->getNombreById($mascota['propietario_id']);
            } else {
                $mascota['nombre_propietario'] = '';
            }
        }

        $this->renderHTML('../app/views/index_mascotas_view.php', $data);
    }

    public function mascotaAction(){
        $data['ubicacion'] = 'mostrar_mascota';
        $data['mensaje'] = '';
        $data['error'] = '';
        $data['mascota'] = [];

        // Obtener el id desde la URL 
        $uri = $_SERVER['REQUEST_URI'];
        $segmentos = explode('/', trim($uri, '/'));
        $id = end($segmentos);

        $oMascota = Mascota::getInstancia();

        // Obtenemos la mascota por ID
        $data['mascota'] = $oMascota->get($id); 


        $this->renderHTML('../app/views/mostrar_mascota_view.php', $data);
    }

    public function editarAction(){
        $data['ubicacion'] = 'editar_mascota';
        $data['mensaje'] = '';
        $data['error'] = '';
        $data['nombre'] = $data['color'] = $data['habilidad'] = $data['sociabilidad'] = '';
        $data['eNombre'] = $data['eColor'] = $data['eHabilidad'] = $data['eSociabilidad'] = '';

        // Obtener el id desde la URL
        $uri = $_SERVER['REQUEST_URI'];
        $segmentos = explode('/', trim($uri, '/'));
        $id = end($segmentos);

        $oMascota = Mascota::getInstancia();

        // Obtenemos la mascota por ID
        $mascota = $oMascota->get($id);

        if(!empty($_POST)){
            $data['nombre'] = $_POST['nombre'];
            $data['color'] = $_POST['color'];
            $data['habilidad'] = $_POST['habilidad'];
            $data['sociabilidad'] = $_POST['sociabilidad'];

            // Validar los datos del formulario
            $lProcesaFormulario = true;

            if (empty($data['nombre'])) {
                $lProcesaFormulario = false;
                $data['eNombre'] = "* El nombre no puede estar vacío";
            }

            if (empty($data['color'])) {
                $lProcesaFormulario = false;
                $data['eColor'] = "* El color no puede estar vacío";
            }

            if (empty($data['habilidad'])) {
                $lProcesaFormulario = false;
                $data['eHabilidad'] = "* La habilidad no puede estar vacía";
            }

            if (empty($data['sociabilidad'])) {
                $lProcesaFormulario = false;
                $data['eSociabilidad'] = "* La sociabilidad no puede estar vacía";
            }

            // Si es valido actualizamos la mascota
            if($lProcesaFormulario){
                $oMascota->setNombre($data['nombre']);
                $oMascota->setColor($data['color']);
                $oMascota->setHabilidad($data['habilidad']);
                $oMascota->setSociabilidad($data['sociabilidad']);

                if ($oMascota->edit()) {
                    $data['mensaje'] = 'Mascota actualizada correctamente';
                    //Redirigir a mascotas
                    header('Location: /mascotas');
                } else {
                    $data['error'] = 'Error al actualizar la mascota: ' . $oMascota->mensaje;
                }
            }
        }

        if($mascota){
            $data['nombre'] = $mascota[0]['nombre'];
            $data['color'] = $mascota[0]['color'];
            $data['habilidad'] = $mascota[0]['habilidad'];
            $data['sociabilidad'] = $mascota[0]['sociabilidad'];
            $data['id'] = $id;
        } else {
            $data['error'] = 'Mascota no encontrada';
            $this->renderHTML('../app/views/editar_mascotas_view.php', $data);
        }

        $this->renderHTML('../app/views/crear_mascotas_view.php', $data);
    }

    public function borrarAction(){
        // Obtener el id desde la URL
        $uri = $_SERVER['REQUEST_URI'];
        $segmentos = explode('/', trim($uri, '/'));
        $id = end($segmentos);

        $oMascota = Mascota::getInstancia();

        // Borrar la mascota por ID
        if ($oMascota->delete($id)) {
            header('Location: /mascotas');
        } else {
            echo 'Error al borrar la mascota: ' . $oMascota->mensaje;
        }
    }
}
?>