-- Table: carrera

-- DROP TABLE carrera;

CREATE TABLE nombre_titulo
(
  id serial NOT NULL primary key,
  nombre character varying,
  carrera integer REFERENCES carrera (id_carrera)
);
INSERT INTO nombre_titulo(id,nombre,carrera) VALUES('1','Ingeniero/a en Sistemas de Información',1);
INSERT INTO nombre_titulo(id,nombre,carrera) VALUES('2','Ingeniero/a Electrónica',2);
INSERT INTO nombre_titulo(id,nombre,carrera) VALUES('3','Ingeniero/a Química',3);
INSERT INTO nombre_titulo(id,nombre,carrera) VALUES('4','Ingeniero/a Mecánica',4);
INSERT INTO nombre_titulo(id,nombre,carrera) VALUES('5','Licenciado/a en Administración Rural',5);
INSERT INTO nombre_titulo(id,nombre,carrera) VALUES('6','Mecatrónica',6);
INSERT INTO nombre_titulo(id,nombre,carrera) VALUES('7','Analista en Sistemas de Información',7);
INSERT INTO nombre_titulo(id,nombre,carrera) VALUES('8','Técnico/a en Administración Rural',8);
INSERT INTO nombre_titulo(id,nombre,carrera) VALUES('9','Técnico/a Electrónico',9);
INSERT INTO nombre_titulo(id,nombre,carrera) VALUES('10','Técnico/a Química',10);
INSERT INTO nombre_titulo(id,nombre,carrera) VALUES('11','Licenciado/a en Lengua Inglesa',11);
INSERT INTO nombre_titulo(id,nombre,carrera) VALUES('12','Técnico/a Superior en Negociación de Bienes',12);
INSERT INTO nombre_titulo(id,nombre,carrera) VALUES('13','Especialista en Higiene y Seguridad',13);
INSERT INTO nombre_titulo(id,nombre,carrera) VALUES('14','Licenciado/a en Educación Física',14);
INSERT INTO nombre_titulo(id,nombre,carrera) VALUES('15','Maestría en Ingeniería Gerencial',15);
INSERT INTO nombre_titulo(id,nombre,carrera) VALUES('16','Licenciado/a en Tecnologia Educativa',16);
INSERT INTO nombre_titulo(id,nombre,carrera) VALUES('17','Especialista en Tecnologia de los Alimentos',17);
INSERT INTO nombre_titulo(id,nombre,carrera) VALUES('18','Licenciado/a en Ciencias Aplicadas',18);
INSERT INTO nombre_titulo(id,nombre,carrera) VALUES('19','Especialista en Soldadura',19);
