<?php 
require_once '../db/conexion.php';

class User {
    private $pdo;  // Cambia la visibilidad a privada o pública según lo necesites

    public $name_user;
    public $email_user;
    public $address_user;
    public $phone_number_user;
    public $id_rol;
    public $status_user;


    // Un único constructor que acepta la conexión a la base de datos y los parámetros de usuario
    public function __construct($db) {
        $this->pdo = $db;  // Asigna la conexión a la base de datos
        // $this->name_user = $name_user;
        // $this->email_user = $email_user;
        // $this->address_user = $address_user;
        // $this->phone_number_user = $phone_number_user;
        // $this->id_rol = $id_rol;
        // $this->status_user = $status_user;
    }

    public function getUsers() {
        $sql = 'SELECT * FROM users';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function registerUser($name_user, $email_user, $address_user, $phone_number_user, $id_rol, $status_user) {
        $sql = 'INSERT INTO usuario (name_user, email_user, address_user, phone_number_user, id_rol, status_user) VALUES (?, ?, ?, ?, ?, ?)';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$name_user, $email_user, $address_user, $phone_number_user, $id_rol, $status_user]);
    }

    public function updateUser($id) {
        
    }
}

