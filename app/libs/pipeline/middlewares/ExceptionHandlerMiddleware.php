<?php

namespace app\libs\pipeline\middlewares;

use app\libs\pipeline\middlewares\base\InterfaceMiddleware;
use app\libs\http\Request;
use app\libs\http\Response;
use app\libs\pipeline\middlewares\base\BaseMiddleware;
use app\libs\database\Connection;

    /**
     * Middleware encargado de capturar y manejar excepciones durante
     * la ejecución del pipeline.
     *
     * Actúa como un wrapper del resto de los middlewares:
     * - Ejecuta el siguiente middleware dentro de un bloque try/catch.
     * - Intercepta excepciones de base de datos (PDOException) y devuelve
     *   un error genérico al cliente.
     * - Intercepta excepciones generales (Exception) y devuelve el mensaje
     *   de error correspondiente.
     *
     * Este middleware debe ubicarse al inicio del Pipeline para asegurar
     * que cualquier error producido en middlewares posteriores o en los
     * controladores sea manejado correctamente.
     *
     * La respuesta se envía en formato JSON mediante el objeto Response,
     * garantizando una salida consistente incluso ante errores.
     */
    final class ExceptionHandlerMiddleware extends BaseMiddleware implements InterfaceMiddleware{
        
        public function __construct()
        {
            parent::__construct();
        }

        /**
         * Ejecuta el siguiente middleware del pipeline dentro de un bloque
         * de control de excepciones.
         *
         * - Si ocurre una PDOException, se devuelve un mensaje genérico
         *   para evitar exponer detalles internos de la base de datos.
         * - Si ocurre una Exception genérica, se devuelve el mensaje de error.
         *
         * En ambos casos se construye y envía la respuesta
         *
         * @param Request  $request  Objeto que contiene la información de la petición HTTP.
         * @param Response $response Objeto que se utiliza para construir la respuesta HTTP.
         */
        public function process(Request $request, Response $response): void
        {
            try
            {
                $this->processNext($request, $response);
            }
            catch(\PDOException $ex)
            {
                $conn = Connection::get();
                $response->setMessage("");
                $response->setError("Error interno del servidor.");
                $response->send();
            }
            catch(\Exception $ex)
            {
                $conn = Connection::get();
                $response->setMessage("");
                $response->setError("{$ex->getMessage()}");
                $response->send();
            }
        }

    }