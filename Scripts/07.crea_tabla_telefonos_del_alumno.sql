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