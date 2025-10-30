
CREATE DATABASE IF NOT EXISTS sgh
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE sgh;


CREATE TABLE habitaciones (
  id INT AUTO_INCREMENT PRIMARY KEY,
  numero VARCHAR(10) UNIQUE NOT NULL,
  tipo ENUM('Sencilla', 'Doble', 'Suite') NOT NULL,
  precio_base DECIMAL(10,2) NOT NULL,
  estado_limpieza ENUM('Limpia', 'Sucia', 'En Limpieza') DEFAULT 'Limpia',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE huespedes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(150) NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  documento_identidad VARCHAR(50) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE reservas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  huesped_id INT NOT NULL,
  habitacion_id INT NOT NULL,
  fecha_llegada DATE NOT NULL,
  fecha_salida DATE NOT NULL,
  precio_total DECIMAL(10,2) NOT NULL,
  estado ENUM('Pendiente', 'Confirmada', 'Cancelada') DEFAULT 'Pendiente',
  fecha_reserva TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (huesped_id) REFERENCES huespedes(id) ON DELETE CASCADE,
  FOREIGN KEY (habitacion_id) REFERENCES habitaciones(id) ON DELETE CASCADE,
  CHECK (fecha_llegada < fecha_salida)
);

CREATE TABLE tareas_mantenimiento (
  id INT AUTO_INCREMENT PRIMARY KEY,
  habitacion_id INT NOT NULL,
  descripcion TEXT NOT NULL,
  fecha_inicio DATE NOT NULL,
  fecha_fin DATE NOT NULL,
  estado ENUM('Pendiente', 'En Proceso', 'Finalizada') DEFAULT 'Pendiente',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (habitacion_id) REFERENCES habitaciones(id) ON DELETE CASCADE,
  CHECK (fecha_inicio <= fecha_fin)
);


INSERT INTO habitaciones (numero, tipo, precio_base, estado_limpieza) VALUES
('101', 'Sencilla', 45.00, 'Limpia'),
('102', 'Doble', 60.00, 'Sucia'),
('201', 'Suite', 120.00, 'Limpia');

INSERT INTO huespedes (nombre, email, documento_identidad) VALUES
('Juan Pérez', 'juanperez@gmail.com', '12345678A'),
('Ana Gómez', 'anagomez@gmail.com', '87654321B');
