<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/alumno.php';

class AlumnoController {
    private $alumno;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->alumno = new Alumno($db);
    }

    public function mostrarLista() {
        return $this->alumno->obtenerPrimeros10();
    }
}
