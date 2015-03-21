-- Table: carrera

-- DROP TABLE carrera;

CREATE TABLE carrera
(
  id_carrera serial NOT NULL primary key,
  nombre_carrera character varying,
  nivel_carrera_fk integer REFERENCES nivel_carrera (id_nivel_carrera)
);
