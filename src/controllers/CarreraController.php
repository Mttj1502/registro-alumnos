<?php
require_once __DIR__ . '/../Models/Carrera.php';
require_once __DIR__ . '/../Helpers/ResponseHelper.php';

class CarreraController
{
    private $carreraModel;

    public function __construct()
    {
        $this->carreraModel = new Carrera();
    }

    // Listar carreras (GET /carreras)
    public function listar()
    {
        $carreras = $this->carreraModel->obtenerTodas();
        ResponseHelper::sendJson($carreras);
    }
}
