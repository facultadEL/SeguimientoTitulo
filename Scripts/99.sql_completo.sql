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

-- Table: carrera

-- DROP TABLE carrera;

CREATE TABLE carrera
(
  id_carrera serial NOT NULL primary key,
  nombre_carrera character varying,
  nivel_carrera_fk integer REFERENCES nivel_carrera (id_nivel_carrera)
);
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('1','Ing. en Sistemas de Información','1');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('2','Ing. Electrónica','1');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('3','Ing. Química','1');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('4','Ing. Mecánica','1');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('5','Lic. en Administración Rural','1');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('6','Mecatrónica','3');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('7','Analista en Sistemas de Información','3');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('8','Técnico en Administración Rural','3');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('9','Técnico Electrónico','3');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('10','Técnico Química','3');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('11','Licenciatura en Lengua Inglesa','1');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('12','Tecnico Sup. en Negociacion de Bienes','3');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('13','Especialista en Higiene y Seguridad','2');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('14','Lic. en Educación Física','1');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('15','Maestría en Ingeniería Gerencial','2');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('16','Licenciatura en Tecnologia Educativa','2');
INSERT INTO carrera(id_carrera,nombre_carrera,nivel_carrera_fk) VALUES('17','Especialista en Tecnologia de los Alimentos','2');

-- Table: numero_nota_rectorado

-- DROP TABLE numero_nota_rectorado;

CREATE TABLE numero_nota_rectorado
(
  id_numero_nota_rectorado serial NOT NULL primary key,
  numero_nota character varying,
  direccion_nota character varying
);

-- Table: numero_resolucion

-- DROP TABLE numero_resolucion;

CREATE TABLE numero_resolucion
(
  id_numero_resolucion serial NOT NULL primary key,
  numero_res character varying,
  direccion_res character varying
);

-- Table: alumno

-- DROP TABLE alumno;

CREATE TABLE alumno
(
  id_alumno serial NOT NULL primary key,
  nombre_alumno character varying,
  apellido_alumno character varying,
  mail_alumno character varying,
  facebook_alumno character varying,
  tipodni_alumno integer REFERENCES tipo_dni (id_tipo_dni),
  calle_alumno character varying,
  foto_alumno character varying,
  ancho_final character varying,
  alto_final character varying,
  numerocalle_alumno character varying,
  mail_alumno2 character varying,
  twitter_alumno character varying,
  provincia_trabajo_alumno character varying,
  localidad_trabajo_alumno character varying,
  provincia_viviendo_alumno character varying,
  localidad_viviendo_alumno character varying,
  perfil_laboral_alumno character varying,
  nro_legajo integer,
  password_alumno character varying,
  numerodni_alumno character varying,
  fechanacimiento_alumno date,
  cp_alumno integer,
  dpto_alumno character varying,
  caracteristicaf_alumno integer,
  telefono_alumno integer,
  caracteristicac_alumno integer,
  celular_alumno integer,
  cp_alumno2 integer,
  empresa_trabaja_alumno character varying,
  piso_alumno character varying,
  localidad_nacimiento_alumno character varying,
  ultima_materia_alumno character varying,
  fecha_ultima_mat_alumno date
);

-- Table: telefonos_del_alumno

-- DROP TABLE telefonos_del_alumno;

CREATE TABLE telefonos_del_alumno
(
  id_telefonos_del_alumno serial NOT NULL primary key,
  caracteristica_alumno character varying,
  telefono_alumno character varying,
  duenio_del_telefono character varying,
  alumno_fk integer REFERENCES alumno (id_alumno)
);

-- Table: numero_acta

-- DROP TABLE numero_acta;

CREATE TABLE numero_acta
(
  id_numero_acta serial NOT NULL primary key,
  numero_acta character varying,
  direccion_acta character varying
);

-- Table: seguimiento

-- DROP TABLE seguimiento;

CREATE TABLE seguimiento
(
  id_seguimiento serial NOT NULL primary key,
  fecha_solicitud date,
  fecha_rescd date,
  fecha_nota_envio_rec date,
  fecha_rescs date,
  anio integer,
  fecha_ingreso_diploma date,
  fecha_ingreso_analitico date,
  fecha_retiro_diploma date,
  fecha_retiro_analitico date,
  alumno_fk integer REFERENCES alumno (id_alumno),
  carrera_fk integer REFERENCES carrera (id_carrera),
  num_res_cd_fk integer REFERENCES numero_resolucion (id_numero_resolucion),
  num_nota_fk integer REFERENCES numero_nota_rectorado (id_numero_nota_rectorado),
  num_res_cs_fk integer REFERENCES numero_resolucion (id_numero_resolucion),
  num_acta_fk integer REFERENCES numero_acta (id_numero_acta)
);

ALTER TABLE seguimiento ADD column num_acta_fk integer references numero_acta(id_numero_acta);

ALTER TABLE seguimiento ADD column noresolucion_seguimiento boolean default false;

