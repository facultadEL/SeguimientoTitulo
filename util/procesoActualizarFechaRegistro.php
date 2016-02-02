<?php

include_once '../conexion.php';

$sqlGuardar = '';

$sqlSeguimiento = pg_query('SELECT id_seguimiento,fecha_solicitud,fecha_registro FROM seguimiento');
while($row = pg_fetch_array($sqlSeguimiento))
{
	$idSeguimiento = $row['id_seguimiento'];
	if(empty($row['fecha_registro']) && !empty($row['fecha_solicitud']))
	{
		$fechaSolicitud = $row['fecha_solicitud'];
		$sqlGuardar .= "UPDATE seguimiento SET fecha_registro='$fechaSolicitud' WHERE id_seguimiento='$idSeguimiento';";
	}
}

pg_query($sqlGuardar);


?>