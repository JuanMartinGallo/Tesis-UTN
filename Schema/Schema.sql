CREATE DATABASE TPFinalLab4;

USE TPFinalLab4;

#DROP DATABASE tpfinallab4;

CREATE TABLE cities
(
    zipCode INT NOT NULL,
    cityName VARCHAR(50) NOT NULL,
    location VARCHAR(50) NOT NULL,

    CONSTRAINT pk_zip_code PRIMARY KEY (zipCode)
);

INSERT INTO cities (zipCode, cityName, location) VALUES 
(7600, 'Mar del Plata', 'Buenos Aires'), 
(2000, 'Rosario', 'Santa Fe'), 
(4000, 'San Miguel de Tucuman', 'Tucuman'), 
(1878, 'Quilmes', 'Buenos Aires'),
(1629, 'Pilar', 'Buenos Aires'),
(1708, 'Moron', 'Buenos Aires');

CREATE TABLE users
(
    userId INT NOT NULL AUTO_INCREMENT,
    role VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    email VARCHAR(30) NOT NULL,

    CONSTRAINT pk_user_id PRIMARY KEY (userId),
    CONSTRAINT unq_email UNIQUE (email)
);

INSERT INTO users (userId, role, password, email) VALUES ('1', 'company', 'coca', 'cocacola@gmail.com'), ('2', 'company', 'globo', 'globant@gmail.com');

#truncate table users;

CREATE TABLE admins
(
    adminId INT NOT NULL AUTO_INCREMENT,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    role VARCHAR(50) NOT NULL,
    dni VARCHAR(20) NOT NULL,
    email VARCHAR(30) NOT NULL,
    password VARCHAR(50) NOT NULL,

    CONSTRAINT pk_admin_id PRIMARY KEY (adminId),
    CONSTRAINT unq_email_admin UNIQUE (email),
    CONSTRAINT unq_dni_admin UNIQUE (dni)
);

INSERT INTO admins (firstName, lastName, role, dni, email, password) VALUES ('Martin', 'Gallo', 'admin', '40-568-4785', 'martin833@gmail.com', 'martin'), ('Yani', 'Pontoni', 'admin', '87-548-4722', 'yani.pontoni@gmail.com', 'yani'), ('Diego', 'Arzondo', 'admin', '12-148-4757', 'eldiegote2021@gmail.com', 'diego');

CREATE TABLE companies
(
    companyId INT NOT NULL AUTO_INCREMENT,
    userId INT,
    zipCode INT NOT NULL,
    name VARCHAR(50) NOT NULL,
    role VARCHAR(50) NOT NULL,
    cuit VARCHAR(20) NOT NULL,
    location VARCHAR(50) NOT NULL,
    phoneNumber VARCHAR(20) NOT NULL,

    CONSTRAINT pk_company_id PRIMARY KEY (companyId),
    CONSTRAINT fk_zip_code FOREIGN KEY (zipCode) REFERENCES cities (zipCode),
    CONSTRAINT unq_company_cuit UNIQUE (cuit),
    CONSTRAINT fk_id_user FOREIGN KEY (userId) REFERENCES users (userId)
);

INSERT INTO companies (userId, zipCode, name, role, cuit, location, phoneNumber) VALUES 
(1, 2000, 'Coca Cola', 'company', '20-12345678-9', 'Rosario', '15-12345678'),
(2, 4000, 'Globant', 'company', '20-54677657-9', 'San Miguel de Tucuman', '15-2138675');
#(3, 7650, 'Pepsico', 'company', '20-879879789-9', 'Mar del Plata', '15-4682245'),
#(4, 1878, 'Google', 'company', '20-12546457-9', 'Quilmes', '15-583236745'),
#(5, 1629, 'Mac Donald', 'company', '20-2784425-9', 'Pilar', '15-7186786'),
#(6, 1708, 'Pepsi', 'company', '20-4789203445-9', 'Moron', '15-26767876'); 

CREATE TABLE students
(
    studentId INT NOT NULL AUTO_INCREMENT,
    userId INT,
    careerId INT NOT NULL,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    role VARCHAR(50) NOT NULL,
    dni VARCHAR(20) NOT NULL,
    fileNumber VARCHAR(20) NOT NULL,
    gender VARCHAR(20) NOT NULL,
    birthDate date NOT NULL,
    email VARCHAR(30) NOT NULL, 
    phoneNumber VARCHAR(20),
    active boolean DEFAULT 1,

    CONSTRAINT unq_email_student UNIQUE (email),
    CONSTRAINT unq_dni_student UNIQUE (dni),
    CONSTRAINT unq_file_number_student UNIQUE (fileNumber),
    CONSTRAINT pk_student_id PRIMARY KEY (studentId),
    CONSTRAINT fk_user_id FOREIGN KEY (userId) REFERENCES users(userId) ON DELETE CASCADE
);

#truncate table students;

CREATE TABLE careers
(
    careerId INT NOT NULL AUTO_INCREMENT,
    description VARCHAR(100) NOT NULL,
    active boolean DEFAULT 1,

    CONSTRAINT pk_career_id PRIMARY KEY (careerId)
);

CREATE TABLE jobPositions
(
    jobPositionId INT NOT NULL AUTO_INCREMENT,
    careerId INT NOT NULL,
    description VARCHAR(100) NOT NULL,

    CONSTRAINT pk_jobPosition_id PRIMARY KEY (jobPositionId),
    CONSTRAINT fk_career_id FOREIGN KEY (careerId) REFERENCES careers (careerId) ON DELETE CASCADE
);

CREATE TABLE jobOffers
(
    jobOfferId INT NOT NULL AUTO_INCREMENT,
    jobPosition INT NOT NULL,
    careerId INT NOT NULL,
    companyId INT NOT NULL,
    salary FLOAT,
    isRemote BOOLEAN,
    description VARCHAR(200) NOT NULL,
    skills VARCHAR(100) NOT NULL,
    startingDate DATE NOT NULL,
    endingDate DATE NOT NULL,
    active BOOLEAN,

    CONSTRAINT pk_jobOffers_id PRIMARY KEY (jobOfferId),
    CONSTRAINT fk_jobPosition_id FOREIGN KEY (jobPosition) REFERENCES jobPositions (jobPositionId) ON DELETE CASCADE,
    CONSTRAINT fk_jobOffer_company_id FOREIGN KEY (companyId) REFERENCES companies (companyId)
);

CREATE TABLE students_x_jobOffers
(
    studentId INT NOT NULL,
    jobOfferId INT NOT NULL,

    CONSTRAINT pk_students_x_jobOffers_id PRIMARY KEY (studentId, jobOfferId),
    CONSTRAINT fk_students_id FOREIGN KEY (studentId) REFERENCES students (studentId) ON DELETE CASCADE,
    CONSTRAINT fk_jobOffers_id FOREIGN KEY (jobOfferId) REFERENCES jobOffers (jobOfferId) ON DELETE CASCADE
);
