<?php

namespace app\core\model\dto;
use app\core\model\dto\base\InterfaceDto;

final class UsuarioDTO implements InterfaceDto{
    private $idUsuario, $idPerfil, $apellido, $nombre, $cuenta, $estado, $password, $correo, $resetPassword;

    public function __construct(array $data = []){
    if(!empty($data)){
        $this->setId($data['idUsuario'] ?? 0);
        $this->setIdPerfil($data['idPerfil'] ?? 0);
        $this->setApellido($data['apellido'] ?? '');
        $this->setNombre($data['nombre'] ?? '');
        $this->setCuenta($data['cuenta'] ?? '');
        $this->setEstado($data['estado'] ?? 1);
        $this->setPassword($data['password'] ?? '');
        $this->setCorreo($data['correo'] ?? '');
        $this->setResetPassword($data['resetPassword'] ?? 0);
    }
}


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

    public function getEstado(): int
    {
        return $this->estado;
    }

    public function getPassword(): string{
        return $this->password;
    }

    public function getCorreo(): string{
        return $this->correo;
    }

    public function getResetPassword(): int
    {
        return $this->resetPassword;
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

    public function setEstado(int $estado): void
    {
        $this->estado = $estado;
    }

    public function setPassword(string $password): void{
        $this->password = $password;
    }

    public function setCorreo(string $correo): void{
        $this->correo = filter_var($correo, FILTER_VALIDATE_EMAIL) ? $correo : '';
    }

    public function setResetPassword(Int $resetPassword): void
    {
        $this->resetPassword = $resetPassword;
    }

    // SERIALIZACIÓN

    public function toArray():array{
        return [
            'idUsuario' => $this->idUsuario,
            'idPerfil'  => $this->idPerfil,
            'apellido'  => $this->apellido,
            'nombre'    => $this->nombre,
            'cuenta'    => $this->cuenta,
            'estado'    => $this->estado,
            'password'  => $this->password,
            'correo'    => $this->correo,
            'resetPassword' => $this->resetPassword,
        ];
    }
}
