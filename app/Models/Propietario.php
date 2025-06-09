<?php
namespace App\Models;

require_once "DBAbstractModel.php";

class Propietario extends DBAbstractModel {
    public $id;
    public $nombre;
    public $usuario_id;

    public function get($id = "") {
        if ($id != "") {
            $this->query = "SELECT * FROM propietarios WHERE id = :id";
            $this->parametros['id'] = $id;
            $this->get_results_from_query();
            if (count($this->rows) == 1) {
                foreach ($this->rows[0] as $prop => $val) {
                    $this->$prop = $val;
                }
                $this->mensaje = 'Propietario encontrado';
            } else {
                $this->mensaje = 'Propietario no encontrado';
            }
            return $this->rows;
        } else {
            $this->query = "SELECT * FROM propietarios";
            $this->get_results_from_query();
            return $this->rows;
        }
    }

    public function set($data = array()) {
        if (isset($data['nombre'])) {
            $this->query = "INSERT INTO propietarios (nombre, usuario_id) VALUES (:nombre, :usuario_id)";
            $this->parametros['nombre'] = $data['nombre'];
            $this->parametros['usuario_id'] = isset($data['usuario_id']) ? $data['usuario_id'] : null;
            $this->execute_single_query();
            $this->mensaje = 'Propietario agregado';
        } else {
            $this->mensaje = 'Datos insuficientes para agregar propietario';
        }
    }

    public function edit($data = array()) {
        if (isset($data['id']) && isset($data['nombre'])) {
            $this->query = "UPDATE propietarios SET nombre = :nombre, usuario_id = :usuario_id WHERE id = :id";
            $this->parametros['id'] = $data['id'];
            $this->parametros['nombre'] = $data['nombre'];
            $this->parametros['usuario_id'] = isset($data['usuario_id']) ? $data['usuario_id'] : null;
            $this->execute_single_query();
            $this->mensaje = 'Propietario actualizado';
        } else {
            $this->mensaje = 'Datos insuficientes para actualizar propietario';
        }
    }

    public function delete($id = "") {
        if ($id != "") {
            $this->query = "DELETE FROM propietarios WHERE id = :id";
            $this->parametros['id'] = $id;
            $this->execute_single_query();
            $this->mensaje = 'Propietario eliminado';
        } else {
            $this->mensaje = 'ID no proporcionado para eliminar propietario';
        }
    }
}
?>