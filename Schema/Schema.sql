CREATE DATABASE TPFinalLab4;

USE TPFinalLab4;

#DROP DATABASE tpfinallab4;

CREATE TABLE users
(
    userId INT NOT NULL AUTO_INCREMENT,
    role VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    email VARCHAR(30) NOT NULL,

    CONSTRAINT pk_user_id PRIMARY KEY (userId)
);

#select * from users;
#truncate table users;

CREATE TABLE companies
(
    companyId INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    cuit VARCHAR(20) NOT NULL,
    location VARCHAR(50) NOT NULL,
    phoneNumber VARCHAR(20) NOT NULL,

    CONSTRAINT pk_company_id PRIMARY KEY (companyId)
);

#select * from companies;

INSERT INTO companies (name, cuit, location, phoneNumber) VALUES ('Globant', '30-458778-9', 'Mar del Plata', '223-636-2356'), ('Infosys', '30-666128-9', 'Mar del Plata', '223-636-9999'), ('Toledo', '32-258778-9', 'Mar del Plata', '223-625-2756');

CREATE TABLE students
(
    studentId INT NOT NULL AUTO_INCREMENT,
    UserId INT,
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

    CONSTRAINT pk_student_id PRIMARY KEY (studentId),
    CONSTRAINT fk_user_id FOREIGN KEY (UserId) REFERENCES users(userId) ON DELETE CASCADE
);

#select * from students;
#truncate table students;

CREATE TABLE admins
(
    adminId INT NOT NULL AUTO_INCREMENT,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    dni VARCHAR(20) NOT NULL,
    email VARCHAR(30) NOT NULL,

    CONSTRAINT pk_admin_id PRIMARY KEY (adminId)
);

#select * from admins;

INSERT INTO admins (firstName, lastName, dni, email) VALUES ('Martin', 'Gallo', '40-568-4785', 'martin833@gmail.com'), ('Yani', 'Pontoni', '87-548-4722', 'yani.pontoni@gmail.com'), ('Diego', 'Arzondo', '12-148-4757', 'eldiegote2021@gmail.com');

CREATE TABLE careers
(
    careerId INT NOT NULL AUTO_INCREMENT,
    description VARCHAR(100) NOT NULL,
    active boolean,

    CONSTRAINT pk_career_id PRIMARY KEY (careerId)
);

#select * from careers;