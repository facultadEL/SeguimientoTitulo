<?php

include_once '../conexion.php';

$orden = $_REQUEST['orden'];

$orderBy = '';

switch ($orden) {
	default:
		break;
}

$html = '';

$sqlSolicitud = pg_query('SELECT nro_expediente,foto_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,fecha_solicitud,fecha_resp_alumno,
	fecha_rescd,fecha_nota_envio_rec,fecha_rescs,fecha_ingreso_diploma,fecha_ingreso_analitico,fecha_retiro_diploma,fecha_retiro_analitico,
	carrera_fk,id_alumno,caracteristicac_alumno,celular_alumno,id_seguimiento FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) 
	INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) 
	ORDER BY id_nivel_carrera,id_carrera,apellido_alumno asc, nombre_alumno asc;');

$outJson = '[';
while($rowSolicitud = pg_fetch_array($sqlSolicitud))
{
	if($outJson!= '[')
	{
		$outJson .= ',';
	}

	$idAlumno = $rowSolicitud['id_alumno'];
	$idSeg = $rowSolicitud['id_seguimiento'];
	$nroExp = $rowSolicitud['nro_expediente'];
	$nombre = $rowSolicitud['nombre_alumno'];
	$apellido = $rowSolicitud['apellido_alumno'];
	$carrera = $rowSolicitud['nombre_carrera'];
	$nivelCarrera = $rowSolicitud['nombre_nivel_carrera'];
	$telefono = $rowSolicitud['caracteristicac_alumno'].' - '.$rowSolicitud['celular_alumno'];
	$fechaS = $rowSolicitud['fecha_solicitud'];
	$fechaR = $rowSolicitud['fecha_resp_alumno'];
	$fechaCD = $rowSolicitud['fecha_rescd'];
	$fechaNR = $rowSolicitud['fecha_nota_envio_rec'];
	$fechaCS = $rowSolicitud['fecha_rescs'];
	$fechaID = $rowSolicitud['fecha_ingreso_diploma'];
	$fechaIA = $rowSolicitud['fecha_ingreso_analitico'];
	$fechaRD = $rowSolicitud['fecha_retiro_diploma'];
	$fechaRA = $rowSolicitud['fecha_retiro_analitico'];
	
	$outJson .= '{
		"id":'.$idAlumno.',
		"idSeguimiento":"'.$idSeg.'",
		"nroExpediente":"'.$nroExp.'",
		"nombre":"'.$nombre.'",
		"apellido":"'.$apellido.'",
		"telefono":"'.$telefono.'",
		"carrera":"'.$carrera.'",
		"nivelCarrera":"'.$nivelCarrera.'",
		"fechaSolicitud":"'.$fechaS.'",
		"fechaRespAlumno":"'.$fechaR.'",
		"fechaResCd":"'.$fechaCD.'",
		"fechaNotaRec":"'.$fechaNR.'",
		"fechaResCs":"'.$fechaCS.'",
		"fechaIngresoD":"'.$fechaID.'",
		"fechaIngresoA":"'.$fechaIA.'",
		"fechaRetiroD":"'.$fechaRD.'",
		"fechaRetiroA":"'.$fechaRA.'"
	}';
}

$outJson .= ']';


pg_close($conn);

echo $outJson;

?>