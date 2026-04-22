<?php

namespace app\core\controller;

use app\core\model\dto\LoginDTO;
use app\core\controller\base\BaseController;
use app\core\controller\base\InterfaceController;
use app\core\service\AuthenticationService;
use app\libs\http\Request;
use app\libs\http\Response;

final class AuthenticationController extends BaseController implements InterfaceController
{
    private $service;

    public function __construct($scripts = [])
    {
        parent::__construct($scripts);
        $this->service = new AuthenticationService();
    }

    public function index(Request $request, Response $response): void
    {
        if (isset($_SESSION["usuario"])) {
            header("Location: " . APP_URL . "/home/index");
            return;
        }
        array_push($this->scripts, "/app/js/authentication/index.js");
        $this->setCurrentView($request);
        require_once APP_FILE_TEMPLATE;
    }

    public function login(Request $request, Response $response): void
    {
        $dto = new LoginDTO($request->getDataFromInput());
        $this->service->login($dto);
        $response->setMessage("Inicio de sesión exitoso.");
        $response->send();
    }

    public function logout(Request $request, Response $response): void
    {
        $this->service->logout();
        $this->setCurrentView($request);
        header("refresh:3;url=" . APP_URL . "/authentication/index");
        require_once APP_FILE_LOGOUT;
    }

    public function registrarUsuario(Request $request, Response $response): void
    {
        if (isset($_SESSION["usuario"])) {
            header("Location: " . APP_URL . "/home/index");
            return;
        }

        if ($request->getMethod() === 'GET') {
            array_push($this->scripts, "/app/js/authentication/register.js");
            $this->view = 'authentication/registrar.php';
            require_once APP_FILE_TEMPLATE;
            return;
        }

        $this->service->registrarUsuarioExterno($request->getDataFromInput() ?? []);
        $response->setMessage("Registro exitoso.");
        $response->send();
    }

    public function create(Request $request, Response $response): void
    {
        throw new \Exception("Método no implementado.");
    }

    public function save(Request $request, Response $response): void
    {
        throw new \Exception("Método no implementado.");
    }

    public function edit(Request $request, Response $response): void
    {
        throw new \Exception("Método no implementado.");
    }

    public function update(Request $request, Response $response): void
    {
        throw new \Exception("Método no implementado.");
    }

    public function delete(Request $request, Response $response): void
    {
        throw new \Exception("Método no implementado.");
    }

    public function load(Request $request, Response $response): void
    {
        throw new \Exception("Método no implementado.");
    }

    public function list(Request $request, Response $response): void
    {
        throw new \Exception("Método no implementado.");
    }
}
