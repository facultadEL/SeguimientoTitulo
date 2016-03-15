<?php

include_once '../conexion.php';

$orden = $_REQUEST['orden'];
//$orden = 0;

$orderBy = '';

switch ($orden) {
	case 0:
		$orderBy = 'id_nivel_carrera ASC,id_carrera ASC,apellido_alumno ASC, nombre_alumno ASC';
		break;
	default:
		break;
}

$html = '';

$sqlSolicitud = pg_query('SELECT nro_expediente,apellido_alumno,nombre_alumno,mail_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_alumno,carrera_fk,caracteristicac_alumno,celular_alumno,fecha_registro FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_solicitud IS NULL ORDER BY '.$orderBy.';');
//Agregar en la consulta -fecha_registro
//Se hace una vez que se modifique el guardado.

//echo $sqlSolicitud;

while($rowSolicitud = pg_fetch_array($sqlSolicitud))
{

	$idAlumno = $rowSolicitud['id_alumno'];
	$idCarrera = $rowSolicitud['carrera_fk'];
	
	$html .= '<tr>';
	if($rowSolicitud['foto_alumno'] == '')
	{
		$html .= '<td>Sin Foto</td>';
	}
	else
	{
		$html .= '<td><img src="../SeguimientoTitulo/Graduado/'.$rowSolicitud['foto_alumno'].'" width="50px"/></td>'; //Comentar esta linea y descomentar la de abajo
		//$html .= '<td><img src="Graduado/'.$rowSolicitud['foto_alumno'].'" width="50px"/></td>';
	}
	//$html .= '<td>'.$rowSolicitud['nro_expediente'].'</td>';
	$html .= '<td><a href="Graduado/registrarGraduado.php?idAlumno='.$idAlumno.'&idCarrera='.$idCarrera.'&origen=listadoSinSolicitudTitulo" >'.$rowSolicitud['apellido_alumno'].', '.$rowSolicitud['nombre_alumno'].'</a></td>';
	$html .= '<td>'.$rowSolicitud['nombre_carrera'].'</td>';
	$html .= '<td>'.$rowSolicitud['nombre_nivel_carrera'].'</td>';
	$html .= '<td>'.$rowSolicitud['caracteristicac_alumno'].'-'.$rowSolicitud['celular_alumno'].'</td>';
	$html .= '<td>'.$rowSolicitud['mail_alumno'].'</td>';
	
	if(empty($rowSolicitud['fecha_registro']))
	{
		$html .= '<td class="text-center">Sin Fecha</td>';
	}
	else
	{
		$fecha = $rowSolicitud['fecha_registro'];
		$vFecha = explode('-', $fecha);
		$fechaSolicitud = $vFecha[2].'/'.$vFecha[1].'/'.$vFecha[0];

		$html .= '<td class="text-center">'.$fechaSolicitud.'</td>';
	}
	
	$html .= '</tr>';
}


pg_close($conn);

echo $html;

?>