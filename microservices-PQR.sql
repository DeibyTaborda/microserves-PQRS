CREATE DATABASE microservices_PQRS;

USE microservices_PQRS;

CREATE TABLE usuario(
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(60) NOT NULL,
    correo_usuario VARCHAR(60) NOT NULL,
    telefono_usuario VARCHAR(10) NULL
);

CREATE TABLE pqrs(
    id_pqrs INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    tipo_pqrs ENUM('Petición', 'Queja', 'Reclamo', 'Sugerencia'),
    descripcion TEXT NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('Pendiente', 'En proceso', 'Finalizado') DEFAULT('Pendiente'),
    FOREIGN KEY (id_usuario) REFERENCES usuario('id_usuario');
);