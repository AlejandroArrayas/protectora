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
    public function edit(){}
    public function delete(){}

    public function getMascotasWithPropietario() {
        $this->query = "SELECT * FROM mascotas WHERE propietario_id IS NULL";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getMascotasWithoutPropietario() {
        $this->query = "SELECT * FROM mascotas WHERE propietario_id IS NOT NULL";
        $this->get_results_from_query();
        return $this->rows;
    }
}
?>