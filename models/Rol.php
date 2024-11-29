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

    public function getRol($id) {
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
    }

    public function deleteRol($id) {
        $sql = "DELETE FROM rol WHERE id_rol = ?";

        try {
            $stmt = $this->pdo->prepare($sql);
            $resultado = $stmt->execute([$id]);

            return [
                'sucess' => $resultado,
                'affected_rows' => $stmt->rowCount()
            ];
        } catch (PDOException $e) {
            return [
                'sucess' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function updateRol($table, $data, $conditions) {
        // Preparar la consulta de actualización
        $setClauses = [];
        $parameters = [];

        // Generar las cláusulas SET dinámicamente
        foreach ($data as $columna => $valor) {
            $setClauses[] = "$columna = :$columna";
            $parameters[":$columna"] = $valor;
        }

        // Generar las condiciones
        $whereClauses = [];
        foreach ($conditions as $columna => $valor) {
            $whereClauses[] = "$columna = :where_$columna";
            $parameters[":where_$columna"] = $valor;
        }

        // Construir la consulta SQL
        $query = "UPDATE $table SET " . implode(', ', $setClauses);

        // Agregar condiciones si existen
        if (!empty($whereClauses)) {
            $query .= " WHERE " . implode(' AND ', $whereClauses);
        }

        try {
            // Preparar y ejecutar la consulta
            $stmt = $this->pdo->prepare($query);
            
            // Vincular parámetros
            foreach ($parameters as $key => $value) {
                $stmt->bindValue($key, $value);
            }

            // Ejecutar la consulta
            $resultado = $stmt->execute();

            return [
                'success' => $resultado,
                'filas_afectadas' => $stmt->rowCount()
            ];

        } catch (PDOException $e) {
            // Manejo de errores
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }

    }
}