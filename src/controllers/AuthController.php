<?php
require_once __DIR__ . '/../Models/Colaborador.php';

class AuthController
{
    private $colaboradorModel;

    public function __construct()
    {
        $this->colaboradorModel = new Colaborador();
    }

    public function iniciarSesion(string $correo, string $password): bool
{
    $colaborador = $this->colaboradorModel->obtenerPorCorreo($correo);

    if ($colaborador && $colaborador['contrasena'] === $password) {
        session_start();
        $_SESSION['colaborador'] = $colaborador['nombre'];
        return true;
    }

    return false;
}


    public function cerrarSesion()
    {
        session_start();
        session_destroy();
        header("Location: login.php");
        exit;
    }

    public function login()
{
    session_start();

    $input = json_decode(file_get_contents("php://input"), true);

    if (!$input || empty($input['correo']) || empty($input['password'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Correo y contraseña requeridos']);
        return;
    }

    $correo = $input['correo'];
    $password = $input['password'];

    $colaborador = $this->colaboradorModel->obtenerPorCorreo($correo);

    if ($colaborador && $colaborador['contrasena'] === $password) {
        $_SESSION['colaborador'] = $colaborador['nombre'];
        echo json_encode(['mensaje' => 'Inicio de sesión exitoso']);
    } else {
        http_response_code(401);
        echo json_encode(['error' => 'Credenciales inválidas']);
    }
}

}
