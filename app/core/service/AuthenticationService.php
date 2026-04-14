<?php

namespace app\core\service;


use app\core\model\dao\UsuarioDAO;
use app\core\model\dto\LoginDTO;
use app\libs\database\Connection;
use app\libs\http\Request;
use app\libs\http\Response;
use Exception;

final class AuthenticationService
{


    public function login(LoginDTO $login)
    {
        $conn = Connection::get();

        //autenticacion del usuario
        $usuarioDao = new UsuarioDAO($conn);
        $usuario = $usuarioDao->findByEmail($login->getEmail());

        if ($usuario === false) {
            throw new \Exception("Usuario no encontrado.");
        }

        if (!password_verify($login->getPassword(), $usuario["password"])) {
            throw new \Exception("El usuario o la clave es incorrecta.");
        }

        if ($usuario["estado"] != 1) {
            throw new \Exception("Su cuenta está inactiva");
        }

        if ($usuario["resetPassword"] !== 0) {
            throw new \Exception("Su clave ha caducado");
        }


        //se registran las variables de SESSION
        $_SESSION["token"] = APP_TOKEN;
        $_SESSION["usuarioId"] = (int)$usuario["idUsuario"];
        $_SESSION["usuario"] = $usuario["nombre"] . " " . $usuario["apellido"];
        $_SESSION["idPerfil"] = (int)$usuario["idPerfil"];
        $_SESSION["nombrePerfil"] = $usuario["nombrePerfil"];
        $_SESSION["cuenta"] = $usuario["cuenta"];
        $_SESSION["correo"] = $usuario["correo"];
    }

    public function logout()
    {
        session_unset();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        session_destroy();
    }
}
