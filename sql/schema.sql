CREATE DATABASE IF NOT EXISTS pet_adoption_db;
USE pet_adoption_db;

DROP TABLE IF EXISTS applications;
DROP TABLE IF EXISTS adopters;
DROP TABLE IF EXISTS pets;

-- Pets Table
CREATE TABLE pets (
  pet_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  species VARCHAR(30) NOT NULL,
  breed VARCHAR(50),
  age INT NOT NULL,
  Gender VARCHAR(10) NOT NULL
) ENGINE=InnoDB;

-- Adopters Table
CREATE TABLE adopters (
  adopter_id INT AUTO_INCREMENT PRIMARY KEY,
  Name VARCHAR(100) NOT NULL,
  Email VARCHAR(120) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- Applications Table
CREATE TABLE applications (
  application_id INT AUTO_INCREMENT PRIMARY KEY,
  adopter_id INT NOT NULL,
  pet_id INT NOT NULL,
  application_date DATE NOT NULL DEFAULT CURDATE(),
  status ENUM('Pending','Approved','Denied') NOT NULL DEFAULT 'Pending',

  CONSTRAINT fk_adopter FOREIGN KEY (adopter_id) REFERENCES adopters(adopter_id),
  CONSTRAINT fk_pet FOREIGN KEY (pet_id) REFERENCES pets(pet_id),
  CONSTRAINT uq_adopter_pet UNIQUE (adopter_id, pet_id)
) ENGINE=InnoDB;