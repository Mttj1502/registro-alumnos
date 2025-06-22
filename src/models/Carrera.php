<?php
require_once __DIR__ . '/../Config/Database.php';

class Carrera
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    // Obtener todas las carreras
    public function obtenerTodas()
    {
        $sql = "SELECT clave_carrera, nombre_carrera FROM carreras ORDER BY nombre_carrera ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
