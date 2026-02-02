<?php

namespace app\libs\pipeline\middlewares\base;

use app\libs\pipeline\middlewares\base\InterfaceMiddleware;
use app\libs\http\Request;
use app\libs\http\Response;

/**
 * Clase base para los middlwares. Es un nodo con puntero para una lista enlazada.
 */
class BaseMiddleware{
    protected ?InterfaceMiddleware $next;

    public function __construct()
    {
        $this->next = null;
    }

    /**
     * Asigna el puntero al siguiente middlware.
     */
    public function setNext(InterfaceMiddleware $middleware): void 
    {
        $this->next = $middleware;
    }

    /**
     * Si hay nodo siguiente, el mismo procesa la petición. Si no, se corta la cadena.
     */
    public function processNext(Request $request, Response $response): void
    {
        if($this->next != null){
            $this->next->process($request, $response);
        }
    }

}
