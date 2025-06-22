<?php
require_once __DIR__ . '/../Config/Database.php';

class Alumno
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function insertar(array $datos)
    {
        $sql = "INSERT INTO alumnos (nombre, matricula, grupo, correo, clave_carrera)
                VALUES (:nombre, :matricula, :grupo, :correo, :clave_carrera)";

        $stmt = $this->pdo->prepare($sql);

        if (!$stmt->execute([
            ':nombre' => $datos['nombre'],
            ':matricula' => $datos['matricula'],
            ':grupo' => $datos['grupo'],
            ':correo' => $datos['correo'],
            ':clave_carrera' => $datos['clave_carrera']
        ])) {
            throw new Exception("Error al insertar alumno. Puede que la matrícula o correo ya existan.");
        }
    }

    // Filtrar alumnos con paginación, filtrando por cuatrimestre basado en primer dígito de grupo
    public function buscarConFiltros(array $filtros, int $pagina = 1, int $porPagina = 25)
    {
        $params = [];
        $where = [];

        if (!empty($filtros['clave_carrera'])) {
            $where[] = 'a.clave_carrera = :clave_carrera';
            $params[':clave_carrera'] = $filtros['clave_carrera'];
        }

        if (!empty($filtros['grupo'])) {
            $where[] = 'a.grupo = :grupo';
            $params[':grupo'] = $filtros['grupo'];
        }

        if (!empty($filtros['cuatrimestre'])) {
            // Filtrar por primer dígito de grupo igual a cuatrimestre
            $where[] = 'LEFT(a.grupo, 1) = :cuatrimestre';
            $params[':cuatrimestre'] = $filtros['cuatrimestre'];
        }

        $whereSQL = count($where) ? 'WHERE ' . implode(' AND ', $where) : '';

        // Conteo total
        $countSql = "SELECT COUNT(*) FROM alumnos a $whereSQL";
        $stmtCount = $this->pdo->prepare($countSql);
        $stmtCount->execute($params);
        $total = $stmtCount->fetchColumn();

        $totalPaginas = ceil($total / $porPagina);
        $offset = ($pagina - 1) * $porPagina;

        $sql = "SELECT a.*, c.nombre_carrera 
                FROM alumnos a
                LEFT JOIN carreras c ON a.clave_carrera = c.clave_carrera
                $whereSQL
                ORDER BY a.nombre ASC
                LIMIT :limit OFFSET :offset";

        $stmt = $this->pdo->prepare($sql);

        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }

        $stmt->bindValue(':limit', $porPagina, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        $alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'alumnos' => $alumnos,
            'total' => $total,
            'total_paginas' => $totalPaginas,
            'pagina_actual' => $pagina,
        ];
    }

    public function obtenerGruposUnicos()
    {
        $sql = "SELECT DISTINCT grupo FROM alumnos ORDER BY grupo ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
