<?php 

namespace app\libs\pipeline;

use app\libs\pipeline\middlewares\base\InterfaceMiddleware;
use app\libs\http\Request;
use app\libs\http\Response;

/**
 * Encadena los middlewares, añadiendolos al final de la cadena. Funciona como una LinkedList; 
 * cada nodo conoce solo al siguiente, la ejecución del pipeline es unidireccional,
 * aunque tenga un $last, este es solo para agregar middlewares más fácil.
 */
final class Pipeline{
    private ?InterfaceMiddleware $first, $last;

    public function __construct()
    {
        $this->first = $this->last = null;
    }

    /**
     * Agrega un middleware al final del pipeline.
     */
    public function pipe(InterfaceMiddleware $middleware){
        if($this->first == null){
            
            //Si el pipeline está vacío, se asignan los punteros al middlw.
            $this->first = $this->last = $middleware;
            
        }else{
            
            //Si no,
            $this->last->setNext($middleware);
            $this->last = $middleware;
        
        }

        //esto es para el encadenamiento
        return $this;
    }

    /**
     * Ejecuta el middleware que está al inicio del pipeline.
     */
    public function process(Request $request, Response $response){
        if($this->first != null){
            $this->first->process($request, $response);
        }
    }

    //IMPORTANTEEEEEEEEEEE: El pipeline no ejecuta processNext().
    //Las unicas responsabilidades del pipeline son inicar la cadena y añadir nuevos mws.

}