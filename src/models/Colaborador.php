<?php
require_once __DIR__ . '/../Config/Database.php';

class Colaborador
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    // Buscar colaborador por correo
    public function buscarPorCorreo(string $correo)
    {
        $sql = "SELECT * FROM usuarios_colaboradores WHERE correo = :correo LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':correo' => $correo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
