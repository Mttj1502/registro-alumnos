<?php
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../src/controllers/AlumnoController.php';
require_once __DIR__ . '/../src/controllers/CarreraController.php';
require_once __DIR__ . '/../src/controllers/AuthController.php';

// Activar reporte de errores (útil en desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

switch ($uri) {
    case '/login':
        if ($method === 'POST') {
            (new AuthController())->login();
            exit;
        }
        break;

    case '/carreras':
        if ($method === 'GET') {
            (new CarreraController())->listar();
            exit;
        }
        break;

    case '/alumnos':
        $controller = new AlumnoController();
        if ($method === 'GET') {
            // Si quieres devolver JSON de alumnos sin filtro (opcional)
            // $controller->listar();
            http_response_code(405);
            echo json_encode(['error' => 'Método GET no permitido aquí. Usa lista_alumnos.php para la vista.']);
            exit;
        } elseif ($method === 'POST') {
            $controller->registrar();
            exit;
        }
        break;

    // Puedes agregar aquí más rutas API

    default:
        // Redirige a la página principal de tu app (archivo PHP en public)
        header("Location: /registro.php");
        exit;
}
