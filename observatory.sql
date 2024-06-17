SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS Observatory;
CREATE DATABASE Observatory;

USE Observatory;

-- Таблица Sector
CREATE TABLE Sector (
    id INT AUTO_INCREMENT PRIMARY KEY,
    coordinates VARCHAR(255) NOT NULL,
    light_intensity FLOAT NOT NULL,
    foreign_objects INT NOT NULL,
    star_objects INT NOT NULL,
    unknown_objects INT NOT NULL,
    defined_objects INT NOT NULL,
    note TEXT
);

-- Таблица Objects
CREATE TABLE Objects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type VARCHAR(255) NOT NULL,
    accuracy FLOAT NOT NULL,
    quantity INT NOT NULL,
    time TIME NOT NULL,
    date DATE NOT NULL,
    note TEXT
);

-- Таблица NaturalObjects
CREATE TABLE NaturalObjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type VARCHAR(255) NOT NULL,
    galaxy VARCHAR(255),
    accuracy FLOAT NOT NULL,
    light_flux FLOAT NOT NULL,
    related_objects VARCHAR(255),
    note TEXT
);

-- Таблица Positions
CREATE TABLE Positions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    earth_position VARCHAR(255) NOT NULL,
    sun_position VARCHAR(255) NOT NULL,
    moon_position VARCHAR(255) NOT NULL
);

-- Таблица Relations
CREATE TABLE Relations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sector_id INT,
    object_id INT,
    natural_object_id INT,
    position_id INT,
    FOREIGN KEY (sector_id) REFERENCES Sector(id),
    FOREIGN KEY (object_id) REFERENCES Objects(id),
    FOREIGN KEY (natural_object_id) REFERENCES NaturalObjects(id),
    FOREIGN KEY (position_id) REFERENCES Positions(id)
);

-- Вставка начальных данных в таблицу Sector
INSERT INTO Sector (coordinates, light_intensity, foreign_objects, star_objects, unknown_objects, defined_objects, note) VALUES
('12.34,45.67,78.90', 0.7, 4, 7, 2, 5, 'Primary sector for observation'),
('23.45,56.78,89.01', 1.0, 3, 10, 1, 9, 'Secondary sector for observation');

-- Вставка начальных данных в таблицу Objects
INSERT INTO Objects (type, accuracy, quantity, time, date, note) VALUES
('Star', 0.99, 5, '12:34:56', '2023-10-01', 'Observation during clear sky'),
('Planet', 0.95, 3, '13:45:56', '2023-10-02', 'Observation during clear sky');

-- Вставка начальных данных в таблицу NaturalObjects
INSERT INTO NaturalObjects (type, galaxy, accuracy, light_flux, related_objects, note) VALUES
('Galaxy', 'Milky Way', 0.98, 1.2, 'Andromeda', 'Main galaxy for observation'),
('Nebula', 'Orion', 0.93, 0.8, 'None', 'Large nebula observed');

-- Вставка начальных данных в таблицу Positions
INSERT INTO Positions (earth_position, sun_position, moon_position) VALUES
('North Hemisphere', 'Mid Sky', 'Low Horizon'),
('South Hemisphere', 'High Sky', 'High Horizon');

-- Вставка начальных данных в таблицу Relations
INSERT INTO Relations (sector_id, object_id, natural_object_id, position_id) VALUES
(1, 1, 1, 1),
(2, 2, 2, 2);

COMMIT;

DELIMITER //

CREATE PROCEDURE joinTables(IN table1 VARCHAR(255), IN table2 VARCHAR(255))
BEGIN
    SET @query = CONCAT('SELECT * FROM ', table1, ' t1 JOIN ', table2, ' t2 ON t1.id = t2.id');
    PREPARE stmt FROM @query;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END //

DELIMITER ;