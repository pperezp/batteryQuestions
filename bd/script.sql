CREATE DATABASE batteryQuestions;

USE batteryQuestions;

/*Para subir archivos (test)*/
CREATE TABLE test(
    id INT AUTO_INCREMENT,
    archivo BLOB,
    nombre VARCHAR(1000),
    peso BIGINT,
    tipo VARCHAR(100),
    PRIMARY KEY(id)
);

CREATE TABLE pregunta(
    id INT AUTO_INCREMENT,
    valor VARCHAR(5000),
    tags VARCHAR(5000),
    PRIMARY KEY(id)
);

CREATE TABLE infoExtra(
    id INT AUTO_INCREMENT,
    valor VARCHAR(5000),
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

DROP DATABASE batteryQuestions;