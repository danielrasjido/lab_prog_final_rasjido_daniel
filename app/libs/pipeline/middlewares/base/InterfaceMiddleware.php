<?php

namespace app\libs\pipeline\middlewares\base;

use app\libs\http\Request;
use app\libs\http\Response;

Interface InterfaceMiddleware{

    /**
     * Procesa una petición del clientey ejecuta su lógica específica. También llamado Handler, es el método principal del middlware.
     * @return Request $request
     */
    public function process(Request $request, Response $response):void;

    /**
     * Define quién es el siguiente middleware.
     */
    public function setNext(InterfaceMiddleware $middleware):void;

    /**
     * LLama al siguiente Middleware.
     */
    public function processNext(Request $request, Response $response):void;

}