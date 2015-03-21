-- Table: nivel_carrera

-- DROP TABLE nivel_carrera;

CREATE TABLE nivel_carrera
(
  id_nivel_carrera serial NOT NULL primary key,
  nombre_nivel_carrera character varying
);
INSERT INTO nivel_carrera(id_nivel_carrera,nombre_nivel_carrera)VALUES(1,'Grado');
INSERT INTO nivel_carrera(id_nivel_carrera,nombre_nivel_carrera)VALUES(2,'Posgrado');
INSERT INTO nivel_carrera(id_nivel_carrera,nombre_nivel_carrera)VALUES(3,'Pregrado');

