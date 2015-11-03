<?php

include_once "../conexion.php";

$sql = pg_query("SELECT fecha_solicitud,fecha_resp_alumno FROM seguimiento WHERE id_seguimiento=84");
while($row = pg_fetch_array($sql))
{
	echo $row['fecha_solicitud'].'<br>';
	$fecha = (empty($row['fecha_resp_alumno'])) ? '0' : $row['fecha_resp_alumno'];
	echo $fecha.'<br>';
}

?>