
Seg
  id_alumno serial NOT NULL, x
  nombre_alumno character varying, x
  apellido_alumno character varying, x
  mail_alumno character varying, x
  facebook_alumno character varying, x
  tipodni_alumno integer, x
  calle_alumno character varying, x
  foto_alumno character varying, x
  ancho_final character varying, x
  alto_final character varying, x
  numerocalle_alumno character varying, x
  mail_alumno2 character varying, x
  twitter_alumno character varying, x
  perfil_laboral_alumno character varying, x
  numerodni_alumno character varying, x
  fechanacimiento_alumno date, x
  dpto_alumno character varying, *
  caracteristicaf_alumno integer, *
  telefono_alumno integer, *
  caracteristicac_alumno integer, *
  celular_alumno integer, *
  piso_alumno character varying, *

  cp_alumno integer,
  provincia_trabajo_alumno character varying,
  localidad_trabajo_alumno character varying,
  provincia_viviendo_alumno character varying,
  localidad_viviendo_alumno character varying,
  nro_legajo integer,
  cp_alumno2 integer,
  empresa_trabaja_alumno character varying,
  localidad_nacimiento_alumno character varying,
  ultima_materia_alumno character varying,
  fecha_ultima_mat_alumno date,


Graduado
  perfilacademico_alumno character varying, -
  carrera_alumno integer, -
  gra_depto character varying(3), *
  gra_piso character varying(3), *
  localidad_nac_alumno integer DEFAULT 0, -
  localidad_trabajo_alumno integer DEFAULT 0, -
  localidad_viviendo_alumno integer DEFAULT 0, -
  gra_docente boolean DEFAULT false, -
  gra_especialidad character varying(40), -
