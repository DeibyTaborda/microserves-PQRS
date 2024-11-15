CREATE DATABASE microservices_PQRS;

USE microservices_PQRS;

CREATE TABLE rol(
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    rol VARCHAR(20) NOT NULL,
    status_rol ENUM('ACTIVO', 'INACTIVO') DEFAULT 'ACTIVO',
    created_at_rol TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users(
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    name_user VARCHAR(60) NOT NULL,
    email_user VARCHAR(60) NOT NULL,
    address_user VARCHAR(30) NULL,
    phone_number_user VARCHAR(10) NULL,
    id_rol INT NOT NULL,
    status_user ENUM('ACTIVO', 'INACTIVO') DEFAULT 'ACTIVO',
    created_at_user TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_rol) REFERENCES rol(id_rol)
);

CREATE TABLE pqrs(
    id_pqrs INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    type_pqrs ENUM('PETICIÓN', 'QUEJA', 'RECLAMO', 'SUGERENCIA') NOT NULL,
    description_pqrs TEXT NOT NULL,
    status_pqrs ENUM('PENDIENTE', 'EN PROCESO', 'FINALIZADO') DEFAULT 'PENDIENTE',
    created_at_pqrs TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users(id_user)
);

CREATE TABLE logs(
    id_log INT AUTO_INCREMENT PRIMARY KEY,
    action_log VARCHAR(30) NOT NULL,
    id_user INT NOT NULL,
    created_at_log TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users(id_user) 
);