<?php

namespace app\core\service;


use app\core\model\dao\UsuarioDAO;
use app\core\model\dto\LoginDTO;
use app\core\model\dto\UsuarioDTO;
use app\libs\database\Connection;

final class AuthenticationService
{
    private UsuarioDAO $usuarioDao;

    public function __construct()
    {
        $this->usuarioDao = new UsuarioDAO(Connection::get());
    }


    public function login(LoginDTO $login)
    {
        //autenticacion del usuario
        $usuario = $this->usuarioDao->findByEmail($login->getEmail());

        if ($usuario === false) {
            throw new \Exception("Usuario no encontrado.");
        }

        if (!password_verify($login->getPassword(), $usuario["password"])) {
            throw new \Exception("El usuario o la clave es incorrecta.");
        }

        if ($usuario["estado"] != 1) {
            throw new \Exception("Su cuenta está inactiva");
        }

        if ($usuario["resetPassword"] !== 0) {
            throw new \Exception("Su clave ha caducado");
        }


        //se registran las variables de SESSION
        $_SESSION["token"] = APP_TOKEN;
        $_SESSION["usuarioId"] = (int)$usuario["idUsuario"];
        $_SESSION["usuario"] = $usuario["nombre"] . " " . $usuario["apellido"];
        $_SESSION["idPerfil"] = (int)$usuario["idPerfil"];
        $_SESSION["nombrePerfil"] = $usuario["nombrePerfil"];
        $_SESSION["cuenta"] = $usuario["cuenta"];
        $_SESSION["correo"] = $usuario["correo"];
    }

    public function logout()
    {
        session_unset();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        session_destroy();
    }

    public function registrarUsuarioExterno(array $data): void
    {
        $apellido = trim((string)($data['apellido'] ?? ''));
        $nombre = trim((string)($data['nombre'] ?? ''));
        $cuenta = trim((string)($data['cuenta'] ?? ''));
        $correo = trim((string)($data['correo'] ?? ''));
        $password = (string)($data['password'] ?? '');
        $confirmacionPassword = (string)($data['confirmacionPassword'] ?? '');

        if ($apellido === '' || $nombre === '' || $cuenta === '' || $correo === '' || $password === '') {
            throw new \Exception('Todos los campos son obligatorios.');
        }

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Debe ingresar un correo válido.');
        }

        if (mb_strlen($password) < 8) {
            throw new \Exception('La contraseña debe tener al menos 8 caracteres.');
        }

        if ($password !== $confirmacionPassword) {
            throw new \Exception('Las contraseñas no coinciden.');
        }

        $dto = new UsuarioDTO([
            'idPerfil' => APP_PERFIL_EXTERNO,
            'apellido' => $apellido,
            'nombre' => $nombre,
            'cuenta' => $cuenta,
            'estado' => 1,
            'password' => $password,
            'correo' => $correo,
            'resetPassword' => 0,
        ]);

        if ($dto->getIdPerfil() !== APP_PERFIL_EXTERNO) {
            throw new \Exception('No fue posible asignar el perfil externo.');
        }

        if ($dto->getCorreo() === '') {
            throw new \Exception('Debe ingresar un correo válido.');
        }

        if ($dto->getApellido() === '' || $dto->getNombre() === '' || $dto->getCuenta() === '') {
            throw new \Exception('Todos los campos son obligatorios.');
        }

        $this->usuarioDao->save($dto->toArray());
    }

    public function solicitarRecuperacionPassword(string $correo): void
    {
        $correoLimpio = trim($correo);
        if ($correoLimpio === '') {
            throw new \Exception('Debe ingresar un correo electrónico.');
        }

        if (!filter_var($correoLimpio, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Debe ingresar un correo electrónico válido.');
        }

        $usuario = $this->usuarioDao->findByEmail($correoLimpio);

        // Respuesta neutra para no exponer qué correos existen.
        if ($usuario === false) {
            return;
        }

        $token = $this->generarTokenRecuperacion($usuario);
        $urlReset = APP_URL . '/authentication/restablecerPassword?token=' . urlencode($token);

        $asunto = 'Recuperacion de contrasena - Sistema de Cine';
        $mensaje = "Hola " . $usuario['nombre'] . ",\n\n"
            . "Recibimos una solicitud para restablecer tu contrasena.\n"
            . "Haz clic en el siguiente enlace para continuar:\n"
            . $urlReset . "\n\n"
            . "Este enlace vence en 30 minutos. Si no solicitaste este cambio, ignora este correo.\n\n"
            . "Sistema de Cine";

        $headers = [
            'MIME-Version: 1.0',
            'Content-Type: text/plain; charset=UTF-8',
            'From: no-reply@sistemacine.local'
        ];

        $enviado = @mail($correoLimpio, $asunto, $mensaje, implode("\r\n", $headers));

        if (!$enviado) {
            throw new \Exception('No se pudo enviar el correo de recuperacion. Verifique la configuracion SMTP/PHP mail.');
        }
    }

    public function restablecerPassword(string $token, string $password, string $confirmacionPassword): void
    {
        $token = trim($token);
        if ($token === '') {
            throw new \Exception('Token de recuperacion invalido.');
        }

        if (trim($password) === '' || trim($confirmacionPassword) === '') {
            throw new \Exception('Debe completar ambos campos de contrasena.');
        }

        if (mb_strlen($password) < 8) {
            throw new \Exception('La contrasena debe tener al menos 8 caracteres.');
        }

        if ($password !== $confirmacionPassword) {
            throw new \Exception('Las contrasenas no coinciden.');
        }

        $usuario = $this->validarTokenRecuperacion($token);
        $nuevoHash = password_hash($password, PASSWORD_DEFAULT);

        $this->usuarioDao->updatePasswordById((int)$usuario['idUsuario'], $nuevoHash);
    }

    private function generarTokenRecuperacion(array $usuario): string
    {
        $expiraEn = time() + (30 * 60);
        $payload = [
            'uid' => (int)$usuario['idUsuario'],
            'em' => (string)$usuario['correo'],
            'exp' => $expiraEn,
            'pv' => $this->fingerprintPasswordHash((string)$usuario['password'])
        ];

        $payloadJson = json_encode($payload, JSON_UNESCAPED_UNICODE);
        $payloadEncoded = $this->base64UrlEncode($payloadJson);
        $firma = hash_hmac('sha256', $payloadEncoded, APP_PASSWORD_RESET_SECRET);

        return $payloadEncoded . '.' . $firma;
    }

    private function validarTokenRecuperacion(string $token): array
    {
        $partes = explode('.', $token);
        if (count($partes) !== 2) {
            throw new \Exception('Token de recuperacion invalido.');
        }

        [$payloadEncoded, $firma] = $partes;
        $firmaEsperada = hash_hmac('sha256', $payloadEncoded, APP_PASSWORD_RESET_SECRET);

        if (!hash_equals($firmaEsperada, $firma)) {
            throw new \Exception('Token de recuperacion invalido.');
        }

        $payloadJson = $this->base64UrlDecode($payloadEncoded);
        $payload = json_decode($payloadJson, true);

        if (!is_array($payload) || !isset($payload['uid'], $payload['em'], $payload['exp'], $payload['pv'])) {
            throw new \Exception('Token de recuperacion invalido.');
        }

        if ((int)$payload['exp'] < time()) {
            throw new \Exception('El enlace de recuperacion ha vencido.');
        }

        $usuario = $this->usuarioDao->findById((int)$payload['uid']);
        if ($usuario === false) {
            throw new \Exception('El usuario de recuperacion no existe.');
        }

        if (strcasecmp((string)$usuario['correo'], (string)$payload['em']) !== 0) {
            throw new \Exception('Token de recuperacion invalido.');
        }

        $fingerprintActual = $this->fingerprintPasswordHash((string)$usuario['password']);
        if (!hash_equals((string)$payload['pv'], $fingerprintActual)) {
            throw new \Exception('Este enlace ya no es valido. Solicite uno nuevo.');
        }

        return $usuario;
    }

    private function fingerprintPasswordHash(string $passwordHash): string
    {
        return substr(hash('sha256', $passwordHash), 0, 20);
    }

    private function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private function base64UrlDecode(string $data): string
    {
        $padding = strlen($data) % 4;
        if ($padding > 0) {
            $data .= str_repeat('=', 4 - $padding);
        }

        $decoded = base64_decode(strtr($data, '-_', '+/'), true);
        if ($decoded === false) {
            throw new \Exception('Token de recuperacion invalido.');
        }

        return $decoded;
    }
}
