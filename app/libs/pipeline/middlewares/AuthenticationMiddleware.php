<?php

namespace app\libs\pipeline\middlewares;

use app\libs\pipeline\middlewares\base\InterfaceMiddleware;
use app\libs\http\Request;
use app\libs\http\Response;
use app\libs\pipeline\middlewares\base\BaseMiddleware;

final class AuthenticationMiddleware extends BaseMiddleware implements InterfaceMiddleware
{
    public function __construct()
    {
        parent::__construct();
    }

    public function process(Request $request, Response $response): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $controlador = $request->getController();
        $accion = $request->getAction();

        if ($controlador === APP_AUTHENTICATION_CONTROLLER) {
            $this->processNext($request, $response);
            return;
        }

        if (!$this->estaAutenticado()) {
            $this->redirigirLogin();
        }


        $idPerfil = (int)$_SESSION["idPerfil"];
        if (!$this->estaAutorizado($idPerfil, $controlador, $accion)) {
            $this->redirigirHome();
        }

        $this->processNext($request, $response);
    }

    private function estaAutenticado(): bool
    {
        $autenticado = isset($_SESSION["token"], $_SESSION["usuarioId"], $_SESSION["idPerfil"]) && $_SESSION["token"] === APP_TOKEN;
        return $autenticado;
    }
    private function estaAutorizado(int $idPerfil, string $controlador, string $accion): bool
    {

        //caso admin, tiene todos los permisos
        if ($idPerfil === APP_PERFIL_ADMIN) {
            return true;
        }


        //caso operador, todos excepto el modulo usuario...
        if ($idPerfil === APP_PERFIL_OPERADOR) {
            //acá tengo que bloquear solamente le modulo de usuarios
            if ($controlador === 'usuario') {
                return false;
            }
            return true;
        }

        //caso externo, solamente el modulo catalogo...
        if ($idPerfil === APP_PERFIL_EXTERNO) {
            $controladoresPermitidos = ["home", "catalogo"];
            if (!in_array($controlador, $controladoresPermitidos)) {
                return false;
            }

            $accionesPermitidas = ["comentar", "comprar", "misEntradas"];
            if (!$this->esAccionLectura($accion) && !in_array($accion, $accionesPermitidas)) {
                return false;
            }
            return true;
        }


        return false;
    }
    private function esAccionLectura(string $accion): bool
    {
        if (in_array($accion, ["index", "load", "list"])) {
            return true;
        }
        return false;
    }
    private function redirigirLogin(): void
    {

        header("Location: " . APP_URL . "/authentication/index");
        exit();
    }
    private function redirigirHome(): void
    {
        header("Location: " . APP_URL . "/home/index");
        exit();
    }
}
