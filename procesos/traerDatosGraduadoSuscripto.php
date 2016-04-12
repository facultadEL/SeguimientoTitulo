<?php

include_once '../conexion.php';

$c = "SELECT * FROM alumno WHERE suscrito IS FALSE;";

$s = pg_query($c);
$outJson = '[';
while($r = pg_fetch_array($s))
{
	if($outJson != '[')
	{
		$outJson .= ',';
	}

	$id = $r['id_alumno'];
	$nombre = ucwords(strtolower($r['nombre_alumno']));
	$apellido = ucwords(strtolower($r['apellido_alumno']));
	$mail = $r['mail_alumno'];
	$suscrito = $r['suscrito'];
	$fechaDesuscripto = $r['fecha_desuscripto'];
	$motivo = empty($r['motivo_desuscripto']) ? '' : $r['motivo_desuscripto'];

	$telefono = '';

	$cFijo = empty($r['caracteristicaf_alumno']) ? '' : $r['caracteristicaf_alumno'];
	$tFijo = empty($r['telefono_alumno']) ? '' : $r['telefono_alumno'];
	$cCel = empty($r['caracteristicac_alumno']) ? '' : $r['caracteristicac_alumno'];
	$tCel = empty($r['celular_alumno']) ? '' : $r['celular_alumno'];

	if($cFijo == '' && $tFijo == '')
	{
		$telefono = "$cCel - $tCel";
	}
	else
	{
		$telefono = "$cFijo - $tFijo<br/>$cCel - $tCel";	
	}

	$outJson .= '{
		"id":"'.$id.'",
		"nombre":"'.$nombre.'",
		"apellido":"'.$apellido.'",
		"mail":"'.$mail.'",
		"telefono":"'.$telefono.'",
		"suscrito":"'.$suscrito.'",
		"motivo":"'.$motivo.'",
		"fechaDesuscripto":"'.$fechaDesuscripto.'"
	}';
}
$outJson .= ']';

pg_close($conn);

echo $outJson;
?>