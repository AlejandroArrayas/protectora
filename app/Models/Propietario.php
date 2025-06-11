<?php
namespace App\Models;

require_once "DBAbstractModel.php";

class Propietario extends DBAbstractModel {
    public $id;
    public $nombre;
    public $usuario_id;
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


    public function getNombre() {
        return $this->nombre;
    }

    public function getNombreById($id_propietario){
        $this->query = "SELECT nombre FROM propietarios WHERE id = :id";
        $this->parametros['id'] = $id_propietario;
        $this->get_results_from_query();
        $resultados = $this->rows;
        if (isset($resultados[0]['nombre'])) {
            return $resultados[0]['nombre'];
        }
        return null;
    }

    public function getNombreByIdUsuario($usuario_id){
        $this->query = "SELECT nombre FROM propietarios WHERE usuario_id = :usuario_id";
        $this->parametros['usuario_id'] = $usuario_id;
        $this->get_results_from_query();
        $resultados = $this->rows;
        if (isset($resultados[0]['nombre'])) {
            return $resultados[0]['nombre'];
        }
        return null;
    }

    public function getIdByUsuarioId($usuario_id){
        $this->query = "SELECT id FROM propietarios WHERE usuario_id = :usuario_id";
        $this->parametros['usuario_id'] = $usuario_id;
        $this->get_results_from_query();
        $resultados = $this->rows;
        if (isset($resultados[0]['id'])) {
            return $resultados[0]['id'];
        }
        return null;
    }

    public function get($id = ""){

    }
    protected function set() {
        
    }

    // Nuevo método específico para crear propietario
    public function crearPropietario($usuario_id, $nombre){
        // Insertar nuevo propietario
        $this->query = "INSERT INTO propietarios (nombre, usuario_id) VALUES (:nombre, :usuario_id)";
        $this->parametros['nombre'] = $nombre;
        $this->parametros['usuario_id'] = $usuario_id;
        $this->get_results_from_query();
        $this->mensaje = '¡Ahora eres propietario!';
        return true;
    }
    public function delete(){

    }
    public function edit(){
        
    }

    public function isPropietario($usuario_id) {
        $this->query = "SELECT * FROM propietarios WHERE usuario_id = :usuario_id";
        $this->parametros['usuario_id'] = $usuario_id;
        $this->get_results_from_query();
        if (count($this->rows) > 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>