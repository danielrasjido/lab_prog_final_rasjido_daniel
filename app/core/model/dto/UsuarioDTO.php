<?php

use app\core\model\dto\base\InterfaceDto;
use DateTime;

final class UsuarioDTO implements InterfaceDto{
    private $idUsuario, $idPerfil, $apellido, $nombre, $cuenta, $password, $correo;


    // GETTERS

    public function getId():int{
        return $this->idUsuario;
    }

    public function getIdPerfil():int{
        return $this->idPerfil;
    }

    public function getApellido(): string{
        return $this->apellido;
    }

    public function getNombre(): string{
        return $this->nombre;
    }

    public function getCuenta(): string{
        return $this->cuenta;
    }

    public function getPassword(): string{
        return $this->password;
    }

    public function getCorreo(): string{
        return $this->correo;
    }

    // SETTERS

    public function setId(int $id){
        $this->idUsuario = ($id > 0) ? $id : 0;
    }

    public function setIdPerfil(int $id){
        $this->idPerfil = ($id > 0 && $id < 4) ? $id : 0;
    }

    public function setApellido(string $apellido): void{
        $this->apellido = trim($apellido);
    }

    public function setNombre(string $nombre): void{
        $this->nombre = trim($nombre);
    }

    public function setCuenta(string $cuenta): void{
        $this->cuenta = trim($cuenta);
    }

    public function setPassword(string $password): void{
        $this->password = $password;
    }

    public function setCorreo(string $correo): void{
        $this->correo = filter_var($correo, FILTER_VALIDATE_EMAIL) ? $correo : '';
    }

    // SERIALIZACIÓN

    public function toArray():array{
        return [
            'idUsuario' => $this->idUsuario,
            'idPerfil'  => $this->idPerfil,
            'apellido'  => $this->apellido,
            'nombre'    => $this->nombre,
            'cuenta'    => $this->cuenta,
            'password'  => $this->password,
            'correo'    => $this->correo
        ];
    }
}
