<?php
namespace App\Controllers;
use App\Models\Usuario;

class BasicController extends BaseController {
    public function indexAction($request) {
        $data['ubicacion'] = 'index';
        $data['mensaje'] = 'Indice de la protectora';
        $this->renderHTML('../app/views/index_view.php', $data);
    }

    public function registerAction($request) {
        $data['ubicacion'] = 'register';
        $data['mensaje'] = 'Registro de usuario';
        $data['error'] = '';

        $lProcesaFormulario = false;
        $data['user'] = $data['email'] = $data['password'] = $data['password2'] = '';
        $data['eUser'] = $data['eEmail'] = $data['ePassword'] = $data['ePassword2'] = '';

        //Creamos una instancia del modelo Usuario
        $oUsuario = new Usuario();

        if(!empty($_POST)){
            $data['user'] = $_POST['user'];
            $data['email'] = $_POST['email'];
            $data['password'] = $_POST['password'];
            $data['password2'] = $_POST['password2'];

            $lProcesaFormulario = true;

            // Validar los datos del formulario
            if (empty($data['user'])) {
                $lprocesaFormulario = false;

                $data['eUser'] = "* El usuario no puede estar vacío";
            }
            
            //Validar que el campo email no esté vacío
            if (empty($data['email'])) {
                $lprocesaFormulario = false;

                $data['eEmail'] = "* El email no puede estar vacío";
            }

            //Validar que el campo password no esté vacío
            if (empty($data['password'])) {
                $lProcesaFormulario = false;

                $data['ePassword'] = "* La contraseña no puede estar vacía";
            }

            //Validar que el campo password2 no esté vacío
            if (empty($data['password2'])) {
                $lProcesaFormulario = false;

                $data['ePassword2'] = "* La contraseña de confirmación no puede estar vacía";
            }

            // Validar que las contraseñas coincidan
            if ($data['password'] !== $data['password2']) {
                $lProcesaFormulario = false;

                $data['ePassword'] = "* Las contraseñas no coinciden";
            }
        }

        // Procesar el formulario de registro
        if ($lProcesaFormulario) {
            // Asignar los valores al modelo
            $oUsuario->setUser($data['user']);
            $oUsuario->setEmail($data['email']);
            $oUsuario->setPassword($data['password']);

            // Intentar registrar el usuario
            if ($oUsuario->set()) {
                $data['mensaje'] = 'Usuario registrado correctamente';
                header('Location: /login');
            } else {
                $data['error'] = $oUsuario->mensaje;
            }
        }

        // Si el usuario ya está logueado, redirigir al índice
        if (isset($_SESSION['usuario'])) {
            header('Location: /');
            exit();
        }
        


        $this->renderHTML('../app/views/register_view.php', $data);
    }

    public function loginAction($request) {
        $data['ubicacion'] = 'login';
        $data['mensaje'] = 'Iniciar sesión';
        $data['email'] = $data['password'] = '';
        $data['error'] = '';
        $data['eEmail'] = $data['ePassword'] = '';

        $lProcesaFormulario = true;

        // Si el usuario ya está logueado, redirigir al índice
        if (isset($_SESSION['usuario'])) {
            header('Location: /');
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data['email'] = $_POST['email'];
            $data['password'] = $_POST['password'];

            $oUsuario = Usuario::getInstancia();

            // Validar que el campo email no esté vacío
            if (empty($data['email'])) {
                $lProcesaFormulario = false;
                $data['eEmail'] = "* El email no puede estar vacío";
            }

            // Validar que el campo password no esté vacío
            if (empty($data['password'])) {
                $lProcesaFormulario = false;
                $data['ePassword'] = "* La contraseña no puede estar vacía";
            }

            // Procesar el formulario de inicio de sesión
            if ($lProcesaFormulario) {
                // Intentar iniciar sesión
                if ($oUsuario->login($data['email'], $data['password'])) {
                    $_SESSION['usuario'] = $oUsuario->getUser();
                    $_SESSION['perfil_usuario'] = $oUsuario->perfilUsuario();
                    header('Location: /');
                    exit();
                } else {
                    $data['error'] = 'Email o contraseña incorrectos';
                }
            }


            // Validar los datos del formulario
        }
        $this->renderHTML('../app/views/login_view.php', $data);
    }
    public function logoutAction($request) {
        session_destroy();
        header('Location: /');
        exit();
    }

}
?>