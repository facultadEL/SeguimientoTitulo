-- Table: carrera

-- DROP TABLE carrera;

CREATE TABLE carrera
(
  id_carrera serial NOT NULL primary key,
  nombre_carrera character varying,
  nivel_carrera_fk integer REFERENCES nivel_carrera (id_nivel_carrera)
);
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('1','Ingeniero/a en Sistemas de Información','1');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('2','Ingeniero/a Electrónica','1');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('3','Ingeniero/a Química','1');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('4','Ingeniero/a Mecánica','1');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('5','Licenciado/a en Administración Rural','1');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('6','Mecatrónica','3');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('7','Analista en Sistemas de Información','3');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('8','Técnico/a en Administración Rural','3');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('9','Técnico/a Electrónico','3');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('10','Técnico/a Química','3');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('11','Licenciado/a en Lengua Inglesa','1');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('12','Técnico/a Superior en Negociación de Bienes','3');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('13','Especialista en Higiene y Seguridad','2');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('14','Licenciado/a en Educación Física','1');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('15','Maestría en Ingeniería Gerencial','2');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('16','Licenciado/a en Tecnologia Educativa','2');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('17','Especialista en Tecnologia de los Alimentos','2');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('18','Licenciado/a en Ciencias Aplicadas','1');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('19','Especialista en Soldadura','3');
