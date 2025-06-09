<?php
namespace App\Controllers;
use App\Models\Mascota;

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
        $data['ubicacion'] = 'index_mascotas';
        $data['mensaje'] = 'Listado de Mascotas';
        $data['error'] = '';
        $data['mascotas'] = [];

        // Creamos una instancia del modelo Mascota
        $oMascota = new Mascota();
        
        // Obtenemos todas las mascotas
        $data['mascotas'] = $oMascota->get();

        // Obtenemos las mascotas sin propietario
        $data['mascotasSinPropietario'] = $oMascota->getMascotasWithoutPropietario();

        //Obtenemos las mascotas con propietario
        $data['mascotasConPropietario'] = $oMascota->getMascotasWithPropietario();


        $this->renderHTML('../app/views/index_mascotas_view.php', $data);
    }
}
?>