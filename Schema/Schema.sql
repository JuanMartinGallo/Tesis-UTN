CREATE DATABASE University;

USE University;

CREATE TABLE companies
(
	idCompany INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    cuit VARCHAR(100) NOT NULL,
    location VARCHAR(100) NOT NULL,
    phoneNumber int(100) NOT NULL,

    CONSTRAINT pk_id_company PRIMARY KEY (idCompany)
);