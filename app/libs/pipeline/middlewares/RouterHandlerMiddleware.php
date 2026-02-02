<?php

namespace app\libs\pipeline\middlewares;

use app\libs\pipeline\middlewares\base\InterfaceMiddleware;
use app\libs\http\Request;
use app\libs\http\Response;
use app\libs\pipeline\middlewares\base\BaseMiddleware;
use app\libs\database\Connection;
use Exception;

/**
 * Este middleware es el encargado de traducir la URL que llega del a petición
 * para ejecutar el controlador y la acción correctas. Es la encargada de ejecutar el endpoint
 */
final class RouterHandlerMiddleware extends BaseMiddleware implements InterfaceMiddleware{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Resuelve y ejecuta el controlador y la acción solicitados en la petición.
     *
     * Este middleware actúa como el Router principal del sistema:
     * - Construye dinámicamente el nombre completo del controlador a partir
     *   del parámetro `controller` de la Request.
     * - Verifica que la clase del controlador exista.
     * - Verifica que la acción solicitada exista como método público.
     * - Preconfigura el objeto Response con el controlador y la acción.
     * - Invoca dinámicamente el método del controlador correspondiente,
     *   pasando Request y Response como parámetros.
     *
     * Ejemplo:
     *  - controller = "usuario"
     *  - action = "login"
     *  → app\core\controller\UsuarioController::login(Request, Response)
     *
     * @param Request  $request  Objeto que contiene la información de la petición HTTP.
     * @param Response $response Objeto que se utilizará para construir la respuesta HTTP.
     *
     * @throws \Exception Si el controlador o la acción solicitada no existen.
     */
    public function process(Request $request, Response $response): void
    {
        //Obtiene el nombre del controlador de la petición, lo concatena con controller y hace que empiece con mayuscula
        //ej: usuario -> usuarioController -> UsuarioController
        $controller = ucfirst($request->getController() . "Controller");
        
        //Arma la ruta dinamicamente: app\\core\\controller\\UsuarioController
        $controller = "app\\core\\controller" . $controller;

        //Validamos que el controlador y la acción existan
        if(!class_exists($controller) || !method_exists($controller, $request->getAction()))
        {
            throw new \Exception("Controlador o acción incorrectos ({$request->getController()} => {$request->getAction()})");
        }

        //Se preconfigura la respuesta
        $response->setController($request->getController());
        $response->setAction($request->getAction());

        //Invoca el endpoint de forma dinámica. Lo que hace es armar el controlador y ejecutar la acción.
        call_user_func_array(
            array(new $controller, $request->getAction()),
            array($request, $response)
        );


    }

}