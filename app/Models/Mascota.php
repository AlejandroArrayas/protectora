<?php
namespace App\Models;

require_once "DBAbstractModel.php";

class Mascota extends DBAbstractModel {
    public $id;
    public $nombre;
    public $color;
    public $habilidad;
    public $sociabilidad;
    public $propietario_id = null;
    public $mensaje = '';

    //Modelo Singleton
    private static $instancia;
    public static function getInstancia(){
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }
    public function __clone(){
        trigger_error('La clonación no es permitida!.', E_USER_ERROR);
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function getNombre() {
        return $this->nombre;
    }

    public function setColor($color) {
        $this->color = $color;
    }
    public function getColor() {
        return $this->color;
    }

    public function setHabilidad($habilidad) {
        $this->habilidad = $habilidad;
    }
    public function getHabilidad() {
        return $this->habilidad;
    }

    public function setSociabilidad($sociabilidad) {
        $this->sociabilidad = $sociabilidad;
    }
    public function getSociabilidad() {
        return $this->sociabilidad;
    }

    public function setPropietarioId($propietario_id) {
        $this->propietario_id = $propietario_id;
    }
    public function getPropietarioId() {
        return $this->propietario_id;
    }


    public function get($id = ""){
        if($id != ''){
            $this->query = "SELECT * FROM mascotas WHERE id = :id";
            $this->parametros['id'] = $id;
            $this->get_results_from_query();
            if (count($this->rows) == 1) {
                foreach ($this->rows[0] as $prop => $val) {
                    $this->$prop = $val;
                }
                $this->mensaje = 'Mascota encontrada';
            } else {
                $this->mensaje = 'Mascota no encontrada';
            }
            return $this->rows;
        } else {
            $this->query = "SELECT * FROM mascotas";
            $this->get_results_from_query();
            return $this->rows;
        }
    }

    public function set(){
        $this->query = "INSERT INTO mascotas(nombre, color, habilidad, sociabilidad, propietario_id) 
                        VALUES (:nombre, :color, :habilidad, :sociabilidad, :propietario_id)";
        $this->parametros['nombre'] = $this->nombre;
        $this->parametros['color'] = $this->color;
        $this->parametros['habilidad'] = $this->habilidad;
        $this->parametros['sociabilidad'] = $this->sociabilidad;
        $this->parametros['propietario_id'] = $this->propietario_id;
        $this->get_results_from_query();
        $this->mensaje = 'Mascota creada correctamente';
        return true;
    }
    public function edit(){
        $this->query = "UPDATE mascotas SET nombre = :nombre, color = :color, habilidad = :habilidad, sociabilidad = :sociabilidad, propietario_id = :propietario_id WHERE id = :id";
        $this->parametros['id'] = $this->id;
        $this->parametros['nombre'] = $this->nombre;
        $this->parametros['color'] = $this->color;
        $this->parametros['habilidad'] = $this->habilidad;
        $this->parametros['sociabilidad'] = $this->sociabilidad;
        $this->parametros['propietario_id'] = $this->propietario_id;
        $this->get_results_from_query();
        if ($this->rows > 0) {
            $this->mensaje = 'Mascota actualizada';
            return true;
        } else {
            $this->mensaje = 'Error';
            return false;
        }
    }
    public function delete($id = ''){
        $this->query = "DELETE FROM mascotas WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        if ($this->rows > 0) {
            $this->mensaje = 'Mascota eliminada correctamente';
            return true;
        } else {
            $this->mensaje = 'Error al eliminar la mascota';
            return false;
        }
    }

    public function getMascotasWithPropietario() {
        $this->query = "SELECT * FROM mascotas WHERE propietario_id IS NOT NULL";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getMascotasWithoutPropietario() {
        $this->query = "SELECT * FROM mascotas WHERE propietario_id IS NULL";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getMascotasByPropietarioId($propietario_id) {
        $this->query = "SELECT * FROM mascotas WHERE propietario_id = :propietario_id";
        $this->parametros['propietario_id'] = $propietario_id;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function adoptar($id, $propietario_id){
        $this->query = "UPDATE mascotas SET propietario_id = :propietario_id WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->parametros['propietario_id'] = $propietario_id;
        $this->get_results_from_query();
        if ($this->rows > 0) {
            $this->mensaje = 'Mascota adoptada correctamente';
            return true;
        } else {
            $this->mensaje = 'Error al adoptar la mascota';
            return false;
        }
    }
}
?>