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