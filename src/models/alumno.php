<?php
class Alumno {
    private $conn;
    private $table = "alumnos";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function registrar($data) {
        $sql = "INSERT INTO $this->table (nombre, matricula, grupo, correo, clave_carrera)
                VALUES (:nombre, :matricula, :grupo, :correo, :clave_carrera)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':nombre' => $data['nombre'],
            ':matricula' => $data['matricula'],
            ':grupo' => $data['grupo'],
            ':correo' => $data['correo'],
            ':clave_carrera' => $data['clave_carrera']
        ]);
    }

    public function obtenerPrimeros10() {
        $query = "
            SELECT a.nombre, a.matricula, a.grupo, a.correo, c.nombre_carrera
            FROM alumnos a
            JOIN carreras c ON a.clave_carrera = c.clave_carrera
            LIMIT 25
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarConCarrera() {
        $sql = "SELECT a.id_alumno, a.nombre, a.matricula, a.grupo, a.correo, 
                       c.nombre_carrera 
                  FROM alumnos a 
                  LEFT JOIN carreras c ON a.clave_carrera = c.clave_carrera
              ORDER BY a.nombre ASC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
