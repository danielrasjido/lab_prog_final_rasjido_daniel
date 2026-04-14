<?php

namespace app\core\model\dto;

use app\core\model\dto\base\InterfaceDto;

final class LoginDTO implements InterfaceDto
{
    private $email;
    private $password;

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->setEmail($data['email'] ?? '');
            $this->setPassword($data['password'] ?? '');
        }
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function toArray(): array
    {
        return [
            'email' => $this->getEmail(),
            'password' => $this->getPassword()
        ];
    }
}
