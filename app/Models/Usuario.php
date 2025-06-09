<?php
namespace App\Models;

class Usuario extends DBAbstractModel {

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

    public $id;
    public $user;
    public $email;
    public $password;
    public $created_at;
    public $updated_at;
    public $mensaje = '';
    public $administrador = false;

    public function setUser($user) {
        $this->user = $user;
    }
    public function getUser() {
        return $this->user;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function getEmail() {
        return $this->email;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    public function getPassword() {
        return $this->password;
    }
    
    public function set(){
        //Primero comprobamos que el email no exista ya dentro de la base de datos
        $this->query = "SELECT * FROM usuarios WHERE email = :email";
        $this->parametros['email'] = $this->email;
        $this->get_results_from_query();
        if (count($this->rows) > 0) {
            $this->mensaje = 'El email ya está registrado';
            return false;
        }
        // Si no existe, procedemos a insertar el nuevo usuario
        $this->query = "INSERT INTO usuarios (user,email,password) VALUES (:user,:email,:password)";
        $this->parametros['user'] = $this->user;
        $this->parametros['email'] = $this->email;
        $this->parametros['password'] = $this->password; // Aquí se guarda la contraseña en texto plano
        $this->get_results_from_query();
        $this->mensaje = 'Usuario registrado correctamente';
        return true;
    }

    // Método para comprobar login
    public function login($email, $password) {
        $this->query = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
        $this->parametros['email'] = $email;
        $this->get_results_from_query();
        if (count($this->rows) == 1) {
            $usuario = $this->rows[0];
            //Comprobamos que la contraseña introducida coincide con la de la base de datos
            if ($password === $usuario['password']) {
                $this->id = $usuario['id'];
                $this->user = $usuario['user'];
                $this->email = $usuario['email'];
                $this->password = $usuario['password'];
                $this->created_at = $usuario['created_at'];
                $this->updated_at = $usuario['updated_at'];
                return true;
            }
        }
        return false;
    }

    public function perfilUsuario() {
        //ID's de administradores
        $adminIds = [4,1,2,3];

        //Si el usuario es un administrador, devolvemos el perfil de administrador
        if (in_array($this->id, $adminIds)) {
            return 'admin';
        }else {
            //Si no, devolvemos el perfil de usuario normal
            return 'user';
        }
    }

    

    protected function get() {}
    protected function edit() {}
    protected function delete() {}
}
?>
