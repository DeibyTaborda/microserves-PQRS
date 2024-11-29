<?php
$host = 'localhost';
$dbname = 'microservices_pqrs';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Opcional: Configuración adicional para manejo de errores
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa";
} catch (PDOException $e) {
    echo "Ocurrió un error: " . $e->getMessage();
}
?>