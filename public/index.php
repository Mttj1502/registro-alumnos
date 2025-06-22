<?php
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../src/Controllers/AlumnoController.php';
require_once __DIR__ . '/../src/Controllers/CarreraController.php';
require_once __DIR__ . '/../src/Controllers/AuthController.php';

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

    default:
        header("Location: /public/registro.php");
        exit;
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);