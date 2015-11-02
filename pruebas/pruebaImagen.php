<?php

include_once '../conexion.php';

$sql  = pg_query("SELECT * FROM alumno WHERE nro_legajo=10388 LIMIT 1");

$row = pg_fetch_array($sql);
echo 'Imagen: '.$row['foto_alumno'];
echo 'Pass: '.$row['password_alumno'];
echo 'Nombre: '.$row['nombre_alumno'];
echo 'ID: '.$row['id_alumno'];

pg_query("UPDATE alumno SET foto_alumno='nofoto.png' WHERE id_alumno=52");

?>