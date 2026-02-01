<?php

namespace app\libs\http;

/**
 * Clase Request
 *
 * Representa la petición HTTP entrante.
 * Centraliza el acceso a parámetros GET, POST y datos JSON.
 * Se utiliza como objeto de transporte entre Router y Controller.
 */
final class Request{

    // controlador + acción: UsuarioController / load 
    private $controller, $action;

    public function __construct(){
        
    }

    // getters
    
    public function getController(): ?string{
        return $this->controller;
        }
        
        public function getAction() :?string
        {
        return $this->action;
    }

    // setters

    public function setController(?string $controller):void
    {
        $this->controller = $controller;
    }

    public function setAction(?string $action):void
    {
        $this->action = $action;
    }
    
    // métodos importantes

    /**
     * Obtiene el método HTTP de la petición actual; ya sea GET, POST, etc.
     * 
     * @return string Método HTTP.
     */
    public function getMethod(): ?string{
        //$_SERVER es un array que tiene información del servidor web
        //REQUEST_METHOD es para acceder a la página a través de GET o POST
        return $_SERVER["REQUEST_METHOD"];
    }
    
    public function getId(): ?string
    {
        return $this->getParameterValue("id", null);
    }

    /**
     * Devuelve el valor del parámetro "extra" enviado por GET.
     *
     * Se utiliza para extender rutas o acciones sin modificar
     * la estructura principal de controller/action.
     *
     * @return string|null Valor del parámetro extra o null si no existe
     */
    public function getExtra(): ?string
    {
        return $_GET["extra"] ?? null;
    }

    /**
     * Obtiene el valor de un parametro HTTP según el método de la petición.
     * 
     * Si la petición es GET, busca el parametro usando $_GET.
     * Si la petición es POST, busca el parametro usando $_POST.
     * Si el parametro no existe, se retorna el valor por defecto
     * 
     * @param string $paramName Nombre del parámetro a buscar
     * @param string o null $defaultValue. Valor por defecto si el parámetro no existe
     * @return string o null. Valor del parámetro o el valor por defecto
     */
    public function getParameterValue(string $paramName, ?string $defaultValue): ?string
    {
        $value = null;

        switch($this->getMethod()){
            case "GET":
                $value = $_GET[$paramName] ?? $defaultValue;
                break;
            case "POST":
                $value = $_POST[$paramName] ?? $defaultValue;
                break;
        }
        return $value;
    }

}