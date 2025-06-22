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

    public function filtrarYPaginar($filtros, $limite, $offset) {
    $sql = "SELECT a.nombre, a.matricula, a.grupo, a.correo, c.nombre_carrera
            FROM alumnos a
            LEFT JOIN carreras c ON a.clave_carrera = c.clave_carrera
            WHERE 1=1";

    $params = [];

    if (!empty($filtros['clave_carrera'])) {
        $sql .= " AND a.clave_carrera = :carrera";
        $params[':carrera'] = $filtros['clave_carrera'];
    }
    if (!empty($filtros['grupo'])) {
        $sql .= " AND a.grupo = :grupo";
        $params[':grupo'] = $filtros['grupo'];
    }
    if (!empty($filtros['cuatrimestre'])) {
        $grupoInicio = ((int)$filtros['cuatrimestre']) * 100;
        $grupoFin = $grupoInicio + 99;
        $sql .= " AND a.grupo BETWEEN :grupoInicio AND :grupoFin";
        $params[':grupoInicio'] = $grupoInicio;
        $params[':grupoFin'] = $grupoFin;
    }

    $sql .= " ORDER BY a.nombre ASC LIMIT :limite OFFSET :offset";
    $stmt = $this->conn->prepare($sql);

    foreach ($params as $key => $val) {
        $stmt->bindValue($key, $val);
    }
    $stmt->bindValue(':limite', (int)$limite, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function contarFiltrados($filtros) {
    $sql = "SELECT COUNT(*) as total FROM alumnos a WHERE 1=1";
    $params = [];

    if (!empty($filtros['clave_carrera'])) {
        $sql .= " AND a.clave_carrera = :carrera";
        $params[':carrera'] = $filtros['clave_carrera'];
    }
    if (!empty($filtros['grupo'])) {
        $sql .= " AND a.grupo = :grupo";
        $params[':grupo'] = $filtros['grupo'];
    }
    if (!empty($filtros['cuatrimestre'])) {
        $grupoInicio = ((int)$filtros['cuatrimestre']) * 100;
        $grupoFin = $grupoInicio + 99;
        $sql .= " AND a.grupo BETWEEN :grupoInicio AND :grupoFin";
        $params[':grupoInicio'] = $grupoInicio;
        $params[':grupoFin'] = $grupoFin;
    }

    $stmt = $this->conn->prepare($sql);
    foreach ($params as $key => $val) {
        $stmt->bindValue($key, $val);
    }

    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
}
}
