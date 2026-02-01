<?php

namespace app\libs\http;

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
        
    }
    
    // métodos importantes
    public function getMethod(): ?string{
        //$_SERVER es un array que tiene información del servidor web
        //REQUEST_METHOD es para acceder a la página a través de GET o POST
        return $_SERVER["REQUEST_METHOD"];
    }
    
    public function getId(): ?string
    {
        return $this->getParameterValue("id", null);
    }

    public function getExtra(): ?string
    {
        return $_GET["extra"] ?? null;
    }

    public function

}