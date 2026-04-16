<?php

namespace app\libs\pipeline\middlewares;

use app\libs\pipeline\middlewares\base\InterfaceMiddleware;
use app\libs\http\Request;
use app\libs\http\Response;
use app\libs\pipeline\middlewares\base\BaseMiddleware;

final class AuthenticationMiddleware extends BaseMiddleware implements InterfaceMiddleware {
    public function __construct() { parent::__construct(); }

    public function process(Request $request, Response $response): void {
        session_start();
        
        // 1. Si el controlador es "authentication" → ruta pública, pasar
        // 2. Si $_SESSION["token"] === APP_TOKEN → autenticado, pasar
        // 3. Si no → redirect al login y exit()

        $controlador = $request->getController();

        if($controlador === APP_AUTHENTICATION_CONTROLLER){
            $this->processNext($request, $response);
            return;
        }

        if(isset($_SESSION["token"]) && $_SESSION["token"] === APP_TOKEN){
            $this->processNext($request, $response);
            return;
        }


        header("Location: " . APP_URL . "?controller=authentication&action=index");
        exit();
    }
}