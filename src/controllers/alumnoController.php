<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/alumno.php';

class AlumnoController {
    private $alumno;
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->alumno = new Alumno($this->db);
    }

    public function obtenerCarreras() {
        $stmt = $this->db->query("SELECT clave_carrera, nombre_carrera FROM carreras");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function mostrarListaFiltrada($filtros, $pagina = 1, $porPagina = 10) {
        $offset = ($pagina - 1) * $porPagina;
        $alumnos = $this->alumno->filtrarYPaginar($filtros, $porPagina, $offset);
        $total = $this->alumno->contarFiltrados($filtros);
        $totalPaginas = ceil($total / $porPagina);

        return [
            'alumnos' => $alumnos,
            'total' => $total,
            'pagina_actual' => $pagina,
            'total_paginas' => $totalPaginas
        ];
    }

    public function obtenerGrupos() {
    $stmt = $this->db->query("SELECT DISTINCT grupo FROM alumnos ORDER BY grupo ASC");
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

}
