<?php

include_once '../conexion.php';

$sqlGuardar = '';

$sqlSeguimiento = pg_query('SELECT id_seguimiento,fecha_solicitud FROM seguimiento WHERE fecha_solicitud IS NOT NULL');
while($row = pg_fetch_array($sqlSeguimiento))
{
	$idSeguimiento = $row['id_seguimiento'];
	$fechaSolicitud = $row['fecha_solicitud'];

	$sqlGuardar .= "UPDATE seguimiento SET fecha_resp_alumno='$fechaSolicitud' WHERE id_seguimiento='$idSeguimiento';";
}


pg_query($sqlGuardar);


?>