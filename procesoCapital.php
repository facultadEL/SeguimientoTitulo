<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php

include_once "conexion.php";

$sqlGuardar = "";

$sqlAlumnos = pg_query("SELECT id_alumno,nombre_alumno, apellido_alumno FROM alumno");
while($rowAlumno = pg_fetch_array($sqlAlumnos))
{
	$nombre = ucwords(strtolower($rowAlumno['nombre_alumno']));
	$apellido = ucwords(strtolower($rowAlumno['apellido_alumno']));
	$sqlGuardar .= "UPDATE alumno SET nombre_alumno='$nombre', apellido_alumno='$apellido' WHERE id_alumno=".$rowAlumno['id_alumno'].";";
}

//echo $sqlGuardar;

pg_query($sqlGuardar);
?>