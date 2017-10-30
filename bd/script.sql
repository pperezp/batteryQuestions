CREATE DATABASE batteryQuestions;

USE batteryQuestions;

CREATE TABLE pregunta(
    id INT AUTO_INCREMENT,
    valor VARCHAR(5000),
    tags VARCHAR(5000),
    PRIMARY KEY(id)
);

/*
A BLOB can be 65535 bytes (64 KB) maximum.
If you need more consider using:

a MEDIUMBLOB for 16777215 bytes (16 MB)
a LONGBLOB for 4294967295 bytes (4 GB).*/

CREATE TABLE infoExtra(
    id INT AUTO_INCREMENT,
    archivo MEDIUMBLOB, /*16 mb como máximo*/
    nombre VARCHAR(1000),
    peso BIGINT,
    tipo VARCHAR(100),
    pregunta INT,
    PRIMARY KEY(id),
    FOREIGN KEY(pregunta) REFERENCES pregunta(id)
);

CREATE TABLE respuesta(
    id INT AUTO_INCREMENT,
    valor VARCHAR(1000),
    pregunta INT,
    correcta BOOLEAN,
    PRIMARY KEY(id),
    FOREIGN KEY(pregunta) REFERENCES pregunta(id)
);

SELECT * FROM pregunta;
SELECT * FROM infoExtra;
SELECT * FROM respuesta;

DELETE FROM respuesta;
DELETE FROM infoExtra;
DELETE FROM pregunta;

DROP DATABASE batteryQuestions;

/*Para subir archivos (test)*/
CREATE TABLE test(
    id INT AUTO_INCREMENT,
    archivo BLOB,
    nombre VARCHAR(1000),
    peso BIGINT,
    tipo VARCHAR(100),
    PRIMARY KEY(id)
);
/*Para subir archivos (test)*/
