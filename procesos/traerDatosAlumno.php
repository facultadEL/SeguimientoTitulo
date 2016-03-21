<?php

include_once '../conexion.php';

$html = '';

$sqlSolicitud = pg_query('SELECT alumno.*,nro_expediente,nombre_carrera,nombre_nivel_carrera,
	carrera_fk,id_seguimiento FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) 
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
	$mail = $rowSolicitud['mail_alumno'];
	//$mail = (!empty($mail)) ? ((empty($rowSolicitud['mail_alumno2'])) ? $mail : $mail.'</br>'.$rowSolicitud['mail_alumno2']) : ()
	$mail2 = $rowSolicitud['mail_alumno2'];
	$direccion = $rowSolicitud['calle_alumno'].' '.$rowSolicitud['numerocalle_alumno'];
	$foto = (!empty($rowSolicitud['foto_alumno'])) ? "../SeguimientoTitulo/Graduado/".$rowSolicitud['foto_alumno'] : '0';
	$nroLegajo = $rowSolicitud['nro_legajo'];
	$fechaNac = $rowSolicitud['fechanacimiento_alumno'];
	$dni = $rowSolicitud['numerodni_alumno'];
	$ultMat = $rowSolicitud['ultima_materia_alumno'];
	$fechaUltMat = $rowSolicitud['fecha_ultima_mat_alumno'];
	$fechaReg = $rowSolicitud['fecreg'];
		
	$outJson .= '{
		"id":'.$idAlumno.',
		"idSeguimiento":"'.$idSeg.'",
		"nroExpediente":"'.$nroExp.'",
		"nombre":"'.$nombre.'",
		"apellido":"'.$apellido.'",
		"telefono":"'.$telefono.'",
		"carrera":"'.$carrera.'",
		"nivelCarrera":"'.$nivelCarrera.'",
		"mail":"'.$mail.'",
		"mail2":"'.$mail2.'",
		"direccion":"'.$direccion.'",
		"foto":"'.$foto.'",
		"nroLegajo":"'.$nroLegajo.'",
		"fechaNac":"'.$fechaNac.'",
		"dni":"'.$dni.'",
		"ultimaMateria":"'.$ultMat.'",
		"fechaUltMat":"'.$fechaUltMat.'",
		"fechaReg":"'.$fechaReg.'"
	}';
}

$outJson .= ']';

pg_close($conn);

echo $outJson;

?>