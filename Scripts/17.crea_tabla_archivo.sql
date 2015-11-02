create table archivo
(id serial primary key,
nombre character varying,
url character varying,
tipo integer references tipo_archivo(id))