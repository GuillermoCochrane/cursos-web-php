/* Curso PHP Básico - Jonathan Mircha
  Proyecto: Mis Contactos
*/

-- 1. Crear la base de datos [00:17:15]
CREATE DATABASE mis_contactos;

-- 2. Seleccionar la base de datos para usarla 
USE mis_contactos;

-- 3. Crear tabla de contactos 
-- Usamos VARCHAR para optimizar espacio (como en tus normalizaciones de JSON)
CREATE TABLE contactos (
    email VARCHAR(50) NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    sexo CHAR(1),
    nacimiento DATE,
    telefono VARCHAR(13),
    pais VARCHAR(50) NOT NULL,
    imagen VARCHAR(50),
    PRIMARY KEY (email),
    -- Llave para búsquedas tipo Google que veremos más adelante
    FULLTEXT KEY buscador (email, nombre, sexo, telefono, pais)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 4. Crear tabla de países (Catálogo) 
CREATE TABLE pais (
    id_pais INT NOT NULL AUTO_INCREMENT,
    pais VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_pais)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 5. Inserción de datos en el catálogo de países 
INSERT INTO pais (id_pais, pais) VALUES 
(1, 'Mexico'), (2, 'Colombia'), (3, 'Guatemala'), (4, 'Espania'), (5, 'Brasil'),
(6, 'Uruguay'), (7, 'Peru'), (8, 'Argentina'), (9, 'Chile'), (10, 'Paraguay'),
(11, 'Honduras'), (12, 'El Salvador'), (13, 'Nicaragua'), (14, 'Costa Rica'), (15, 'Panamá'),
(16, 'Venezuela'), (17, 'Ecuador'), (18, 'Bolivia'), (19, 'Canada'), (20, 'Estados Unidos'),
(21, 'Groenlandia'), (22, 'República Dominicana'), (23, 'Haiti'), (24, 'Cuba'), (25, 'Belice'),
(26, 'Inglaterra'), (27, 'Francia'), (28, 'Alemania'), (29, 'Italia'), (30, 'Japon'),
(31, 'China'), (32, 'Egipto'), (33, 'Sudafrica'), (34, 'Australia'), (35, 'Nueva Zelanda');