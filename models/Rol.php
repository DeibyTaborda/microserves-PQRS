<?php
require_once  __DIR__ . '/../db/conexion.php';

class Rol {
    private $pdo;
    private $table = 'rol';

    public $rol;
    public $status_rol;

    public function __construct($db) {
        $this->pdo = $db;
    }

    public function getRol() {
        $sql = 'SELECT * FROM  rol';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $roles;
    }

    public function registerRol($rol, $status_rol) {
        $sql = 'INSERT INTO rol(rol, status_rol) VALUES(?, ?)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$rol, $status_rol]);
        echo 'Rol creado con exito';
    }
}

$rol = new Rol($pdo);
$respuesta = $rol->getRol($pdo);
echo json_encode($respuesta);