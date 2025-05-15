-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS barrientos_bartolome_martin_DWES05
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

-- Usar la base creada
USE barrientos_bartolome_martin_DWES05;

-- Crear la tabla usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE
);

-- Insertar 6 usuarios de prueba
INSERT INTO usuarios (nombre, email) VALUES
('Alicia Gómez', 'alicia@example.com'),
('Bruno Díaz', 'bruno@example.com'),
('Carla Pérez', 'carla@example.com'),
('David Sánchez', 'david@example.com'),
('Elena Ruiz', 'elena@example.com'),
('Fernando Torres', 'fernando@example.com');
