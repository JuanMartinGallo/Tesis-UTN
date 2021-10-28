CREATE DATABASE TPFinalLab4;

USE TPFinalLab4;

CREATE TABLE companies
(
    idCompany INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    cuit VARCHAR(20) NOT NULL,
    location VARCHAR(50) NOT NULL,
    phoneNumber VARCHAR(20) NOT NULL,

    CONSTRAINT pk_id_company PRIMARY KEY (idCompany)
);

INSERT INTO companies (name, cuit, location, phoneNumber) VALUES ('Globant', '30-458778-9', 'Mar del Plata', '223-636-2356'), ('Infosys', '30-666128-9', 'Mar del Plata', '223-636-9999'), ('Toledo', '32-258778-9', 'Mar del Plata', '223-625-2756');

CREATE TABLE students
(
    studentId INT NOT NULL AUTO_INCREMENT,
    careerId INT NOT NULL,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    dni VARCHAR(20) NOT NULL,
    fileNumber VARCHAR(20) NOT NULL,
    gender VARCHAR(20) NOT NULL,
    birthDate date NOT NULL,
    email VARCHAR(30) NOT NULL,
    phoneNumber VARCHAR(20),
    active boolean,

    CONSTRAINT pk_student_id PRIMARY KEY (studentId)
);