CREATE TABLE tipo_dni(
	id_tipo_dni serial,
	nombre_tipo_dni character varying,
	descripcion_tipo_dni character varying,
	PRIMARY KEY (id_tipo_dni)
);
INSERT INTO tipo_dni (id_tipo_dni, nombre_tipo_dni, descripcion_tipo_dni) VALUES (1,'DNI','Documento Nacional de Identidad');
INSERT INTO tipo_dni (id_tipo_dni, nombre_tipo_dni, descripcion_tipo_dni) VALUES (2,'LC','Libreta Cívica');
INSERT INTO tipo_dni (id_tipo_dni, nombre_tipo_dni, descripcion_tipo_dni) VALUES (3,'LE','Libreta Enrolamiento');

CREATE TABLE numero_nota_rectorado
(id_numero_nota_rectorado serial,
	numero_nota character varying,
	primary key(id_numero_nota_rectorado)
)
INSERT INTO numero_nota_rectorado(id_numero_nota_rectorado,numero_nota) VALUES(1,'Sin Numero Nota')


CREATE TABLE numero_resolucion
(
	id_numero_resolucion serial NOT NULL,
	numero_res character varying,
	PRIMARY KEY (id_numero_resolucion)
);
INSERT INTO numero_resolucion (id_numero_resolucion,numero_res) VALUES (1, 'Sin número de resolución');

CREATE TABLE nivel_carrera(
	id_nivel_carrera serial,
	nombre_nivel_carrera character varying,
	PRIMARY KEY (id_nivel_carrera)
);
INSERT INTO nivel_carrera (id_nivel_carrera, nombre_nivel_carrera) VALUES (1,'Grado');
INSERT INTO nivel_carrera (id_nivel_carrera, nombre_nivel_carrera) VALUES (2,'Posgrado');
INSERT INTO nivel_carrera (id_nivel_carrera, nombre_nivel_carrera) VALUES (3,'Pregrado');

CREATE TABLE carrera(
	id_carrera serial,
	nombre_carrera character varying,
	nivel_carrera_fk integer references nivel_carrera(id_nivel_carrera),
	PRIMARY KEY (id_carrera)
);
INSERT INTO carrera (id_carrera, nombre_carrera, nivel_carrera_fk) VALUES (1,'Ing. en Sistemas de Información',1);
INSERT INTO carrera (id_carrera, nombre_carrera, nivel_carrera_fk) VALUES (2,'Ing. Electrónica',1);
INSERT INTO carrera (id_carrera, nombre_carrera, nivel_carrera_fk) VALUES (3,'Ing. Química',1);
INSERT INTO carrera (id_carrera, nombre_carrera, nivel_carrera_fk) VALUES (4,'Ing. Mecánica',1);
INSERT INTO carrera (id_carrera, nombre_carrera, nivel_carrera_fk) VALUES (5,'Lic. en Administración Rural',1);
INSERT INTO carrera (id_carrera, nombre_carrera, nivel_carrera_fk) VALUES (6,'Mecatrónica',3);
INSERT INTO carrera (id_carrera, nombre_carrera, nivel_carrera_fk) VALUES (7,'Analista en Sistemas de Información',3);
INSERT INTO carrera (id_carrera, nombre_carrera, nivel_carrera_fk) VALUES (8,'Técnico en Administración Rural',3);
INSERT INTO carrera (id_carrera, nombre_carrera, nivel_carrera_fk) VALUES (9,'Técnico Electrónico',3);
INSERT INTO carrera (id_carrera, nombre_carrera, nivel_carrera_fk) VALUES (10,'Técnico Química',3);
INSERT INTO carrera (id_carrera, nombre_carrera, nivel_carrera_fk) VALUES (11,'Licenciatura en Lengua Inglesa',1);
INSERT INTO carrera (id_carrera, nombre_carrera, nivel_carrera_fk) VALUES (12,'Tecnico Sup. en Negociacion de Bienes',3);
INSERT INTO carrera (id_carrera, nombre_carrera, nivel_carrera_fk) VALUES (13,'Especialista en Higiene y Seguridad',2);

CREATE TABLE alumno(
	id_alumno serial NOT NULL,
	nombre_alumno character varying,
	apellido_alumno character varying,
	mail_alumno character varying,
	facebook_alumno character varying,
	numerodni_alumno character varying,
	tipodni_alumno integer references tipo_dni(id_tipo_dni),
	calle_alumno character varying,
	perfilacademico_alumno character varying,
	foto_alumno character varying,
	carrera_alumno integer references carrera(id_carrera),
	ancho_final character varying,
	alto_final character varying,
	fechanacimiento_alumno character varying,
	numerocalle_alumno character varying,
	mail_alumno2 character varying,
	twitter_alumno character varying,
	provincia_nac_alumno character varying,
	localidad_nac_alumno character varying,
	provincia_trabajo_alumno character varying,
	localidad_trabajo_alumno character varying,
	provincia_viviendo_alumno character varying,
	localidad_viviendo_alumno character varying,
	perfil_laboral_alumno character varying,
	num_res_fk integer references numero_resolucion(id_numero_resolucion),
	nro_legajo integer,
	PRIMARY KEY (id_alumno)
);

CREATE TABLE telefonos_del_alumno
(
	id_telefonos_del_alumno serial NOT NULL,
	caracteristica_alumno character varying,
	telefono_alumno character varying,
	duenio_del_telefono character varying,
	alumno_fk integer references alumno(id_alumno),
	PRIMARY KEY (id_telefonos_del_alumno)
);

CREATE TABLE seguimiento
(
	id_seguimiento serial NOT NULL,
	fecha_solicitud date,
	fecha_resCD date,
	fecha_nota_envio_rec date,
	fecha_resCS date,
	anio integer,
	fecha_ingreso_diploma date,
	fecha_ingreso_analitico date,
	fecha_ingreso_titulo date,
	fecha_retiro_titulo date,
	alumno_fk integer references alumno(id_alumno),
	PRIMARY KEY (id_seguimiento)
);