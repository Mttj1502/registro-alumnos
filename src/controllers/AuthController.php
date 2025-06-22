<?php
require_once __DIR__ . '/../Models/Colaborador.php';
require_once __DIR__ . '/../Helpers/ResponseHelper.php';

class AuthController
{
    private $colaboradorModel;

    public function __construct()
    {
        $this->colaboradorModel = new Colaborador();
    }

    // Login de colaborador (POST /login)
    public function login()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input || empty($input['correo']) || empty($input['contrasena'])) {
            ResponseHelper::sendJson(['error' => 'Correo y contraseña son obligatorios'], 400);
            return;
        }

        $usuario = $this->colaboradorModel->buscarPorCorreo($input['correo']);

        if (!$usuario) {
            ResponseHelper::sendJson(['error' => 'Usuario no encontrado'], 401);
            return;
        }

        // Aquí asumimos que la contraseña está guardada en texto plano (no recomendable)
        // Lo ideal es usar password_hash y password_verify
        if ($usuario['contrasena'] !== $input['contrasena']) {
            ResponseHelper::sendJson(['error' => 'Contraseña incorrecta'], 401);
            return;
        }

        // Login exitoso (puedes generar token o sesión aquí)
        ResponseHelper::sendJson(['mensaje' => 'Login exitoso']);
    }
}
