<?php 
class Database {
    private $host = "localhost";
    private $db = "registro_alumnos";
    private $name = "root";
    private $pws = "mysql123";


    public function getConnection(){
        $conexion = null;
        try {
            $conexion = new PDO ("mysql:host=$this->host;dbname=$this->db;charset=utf8",$this->name,$this->pws);
        }
        catch(PDOException $e){
            die(json_encode(['error' => 'Conexión fallida: ' . $e->getMessage()]));
        }
        return $conexion;
    }
}
?>