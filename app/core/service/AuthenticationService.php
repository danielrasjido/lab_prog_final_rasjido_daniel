<?php

namespace app\core\service;


use app\core\model\dao\UsuarioDAO;
use app\core\model\dto\LoginDTO;
use app\core\model\dto\UsuarioDTO;
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

    public function registrarUsuarioExterno(array $data): void
    {
        $apellido = trim((string)($data['apellido'] ?? ''));
        $nombre = trim((string)($data['nombre'] ?? ''));
        $cuenta = trim((string)($data['cuenta'] ?? ''));
        $correo = trim((string)($data['correo'] ?? ''));
        $password = (string)($data['password'] ?? '');
        $confirmacionPassword = (string)($data['confirmacionPassword'] ?? '');

        if ($apellido === '' || $nombre === '' || $cuenta === '' || $correo === '' || $password === '') {
            throw new \Exception('Todos los campos son obligatorios.');
        }

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Debe ingresar un correo válido.');
        }

        if (mb_strlen($password) < 8) {
            throw new \Exception('La contraseña debe tener al menos 8 caracteres.');
        }

        if ($password !== $confirmacionPassword) {
            throw new \Exception('Las contraseñas no coinciden.');
        }

        $dto = new UsuarioDTO([
            'idPerfil' => APP_PERFIL_EXTERNO,
            'apellido' => $apellido,
            'nombre' => $nombre,
            'cuenta' => $cuenta,
            'estado' => 1,
            'password' => $password,
            'correo' => $correo,
            'resetPassword' => 0,
        ]);

        if ($dto->getIdPerfil() !== APP_PERFIL_EXTERNO) {
            throw new \Exception('No fue posible asignar el perfil externo.');
        }

        if ($dto->getCorreo() === '') {
            throw new \Exception('Debe ingresar un correo válido.');
        }

        if ($dto->getApellido() === '' || $dto->getNombre() === '' || $dto->getCuenta() === '') {
            throw new \Exception('Todos los campos son obligatorios.');
        }

        $usuarioDao = new UsuarioDAO(Connection::get());
        $usuarioDao->save($dto->toArray());
    }
}
