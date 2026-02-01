<?php

namespace app\libs\http;

/**
 * Clase Response
 * 
 * Representa la respuesta a una petición
 */
final class Response{
    private $controller, $action, $error, $message, $result;

    public function __construct()
    {
        $this->setController("");
        $this->setAction("");
        $this->setError("");
        $this->setMessage("");
        #el resultado siempre es un array
        $this->setResult([]);
    }

    // GETTERS

    public function getController(): string{
        return $this->controller;
    }
    public function getAction(): string{
        return $this->action;
    }

    public function getError(): string{
        return $this->error;
    }

    public function getMessage(): string{
        return $this->message;
    }

    public function getResult(): array{
        return $this->result;
    }

    // SETTERS

    public function setController($controller): void{
        $this->controller = $controller;
    }
    public function setAction($action): void{
        $this->action = $action;
    }
    public function setError($error): void{
        $this->error = $error;
    }
    public function setMessage($message): void{
        $this->message = $message;
    }
    public function setResult(array $result): void{
        $this->result = $result;
    }

    // Métodos importantes

    /**
     * Envía un paquete que está conformado por una cabecera y un JSON como cuerpo.
     */
    public function send(): void
    {
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode([
            "controller" => $this->controller,
            "action" => $this->action,
            "error" => $this->error,
            "message" => $this->message,
            "result" => $this->result
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

}