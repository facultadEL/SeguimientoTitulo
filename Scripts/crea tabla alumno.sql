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
