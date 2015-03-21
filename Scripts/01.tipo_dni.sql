-- Table: tipo_dni

-- DROP TABLE tipo_dni;

CREATE TABLE tipo_dni
(
  id_tipo_dni serial NOT NULL primary key,
  nombre_tipo_dni character varying,
  descripcion_tipo_dni character varying
);
INSERT INTO tipo_dni(id_tipo_dni,nombre_tipo_dni,descripcion_tipo_dni)VALUES(1,'DNI','Documento Nacional de Identidad');
INSERT INTO tipo_dni(id_tipo_dni,nombre_tipo_dni,descripcion_tipo_dni)VALUES(2,'LC','Libreta Cívica');
INSERT INTO tipo_dni(id_tipo_dni,nombre_tipo_dni,descripcion_tipo_dni)VALUES(3,'Le','Libreta Enrolamiento');


