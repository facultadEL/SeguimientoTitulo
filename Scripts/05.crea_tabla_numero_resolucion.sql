-- Table: numero_resolucion

-- DROP TABLE numero_resolucion;

CREATE TABLE numero_resolucion
(
  id_numero_resolucion serial NOT NULL primary key,
  numero_res character varying,
  direccion_res character varying
);
