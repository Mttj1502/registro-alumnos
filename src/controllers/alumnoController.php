<?php
require_once __DIR__ . '/../Models/Alumno.php';
require_once __DIR__ . '/../Models/Carrera.php';
require_once __DIR__ . '/../Helpers/ResponseHelper.php';

class AlumnoController
{
    private $alumnoModel;
    private $carreraModel;

    public function __construct()
    {
        $this->alumnoModel = new Alumno();
        $this->carreraModel = new Carrera();
    }

    public function registrar()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input) {
            ResponseHelper::sendJson(['error' => 'JSON inválido'], 400);
            return;
        }

        $campos = ['nombre', 'matricula', 'grupo', 'correo', 'clave_carrera'];
        foreach ($campos as $campo) {
            if (empty($input[$campo])) {
                ResponseHelper::sendJson(['error' => "El campo '$campo' es obligatorio."], 400);
                return;
            }
        }

        try {
            $this->alumnoModel->insertar($input);
            ResponseHelper::sendJson(['mensaje' => 'Alumno registrado correctamente'], 201);
        } catch (Exception $e) {
            ResponseHelper::sendJson(['error' => $e->getMessage()], 500);
        }
    }

    public function mostrarListaFiltrada(array $filtros, int $pagina = 1)
    {
        // Aquí simplemente pasamos los filtros tal cual, el modelo procesa el filtro cuatrimestre con la lógica del grupo
        return $this->alumnoModel->buscarConFiltros($filtros, $pagina);
    }

    public function obtenerCarreras()
    {
        return $this->carreraModel->obtenerTodas();
    }

    public function obtenerGrupos()
    {
        return $this->alumnoModel->obtenerGruposUnicos();
    }
}
