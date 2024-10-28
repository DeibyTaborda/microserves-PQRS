<?php 
require_once '../db/conexion.php';

class User {
    private $pdo;  // Cambia la visibilidad a privada o pública según lo necesites

    public $nombre;
    public $correo;
    public $telefono;

    // Un único constructor que acepta la conexión a la base de datos y los parámetros de usuario
    public function __construct($db, $nombre, $correo, $telefono) {
        $this->pdo = $db;  // Asigna la conexión a la base de datos
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->telefono = $telefono;
    }

    public function registerUser() {
        $sql = 'INSERT INTO usuario (nombre_usuario, correo_usuario, telefono_usuario) VALUES (?, ?, ?)';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$this->nombre, $this->correo, $this->telefono]);  // Usa las propiedades de la instancia
    }

    public function mostrarPropiedades() {
        return 'Nombre: ' . $this->nombre . ' Correo: ' . $this->correo . ' Teléfono: ' . $this->telefono;
    }
}

// Asegúrate de crear un objeto de conexión de base de datos antes de crear el usuario
$usuario1 = new User($pdo, 'James Rodríguez', 'james@gmail.com', '3116554376');  // Suponiendo que $pdo ya está definido
$usuario1->registerUser();  // No necesitas pasar argumentos ya que usa las propiedades de la instancia
echo $usuario1->mostrarPropiedades();
