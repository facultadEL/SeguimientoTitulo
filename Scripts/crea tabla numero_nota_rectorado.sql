-- Table: numero_nota_rectorado

-- DROP TABLE numero_nota_rectorado;

CREATE TABLE numero_nota_rectorado
(
  id_numero_nota_rectorado serial NOT NULL primary key,
  numero_nota character varying,
  direccion_nota character varying
);
