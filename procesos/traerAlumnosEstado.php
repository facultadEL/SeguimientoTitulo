<?php

include_once '../conexion.php';

$orden = $_REQUEST['orden'];
//$orden = 0;

$orderBy = '';

switch ($orden) {
	default:
		break;
}

$html = '';

$sqlSolicitud = pg_query('SELECT nro_expediente,foto_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,fecha_solicitud,fecha_resp_alumno,
	fecha_rescd,fecha_nota_envio_rec,fecha_rescs,fecha_ingreso_diploma,fecha_ingreso_analitico,fecha_retiro_diploma,fecha_retiro_analitico,
	carrera_fk,id_alumno,caracteristicac_alumno,celular_alumno FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) 
	INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) 
	ORDER BY fecha_retiro_analitico desc,fecha_retiro_diploma desc, fecha_ingreso_analitico desc, fecha_ingreso_diploma desc, fecha_rescs desc, fecha_nota_envio_rec desc,
	fecha_rescd desc, fecha_resp_alumno desc, fecha_solicitud desc, apellido_alumno asc, nombre_alumno asc;');

//echo $sqlSolicitud;

while($rowSolicitud = pg_fetch_array($sqlSolicitud))
{
	
	$idAlumno = $rowSolicitud['id_alumno'];
	$bg = '';
	$estado = '';

	if(empty($rowSolicitud['fecha_solicitud']))
	{
		$estado = 'Traer Solicitud';
	}
	else
	{
		if(empty($rowSolicitud['fecha_resp_alumno']))
		{
			$estado = 'Responsable de Alumnos';
		}
		else
		{
			if(empty($rowSolicitud['fecha_rescd']))
			{
				$estado = 'Consejo Directivo';
			}
			else
			{
				if(empty($rowSolicitud['fecha_nota_envio_rec']))
				{
					$estado = 'Nota a Rectorado';
				}
				else
				{
					if(empty($rowSolicitud['fecha_rescs']))
					{
						$estado = 'Consejo Superior';
					}
					else
					{
						if(empty($rowSolicitud['fecha_ingreso_diploma']))
						{
							$estado = 'Ingreso Diploma';
						}
						else
						{
							if(empty($rowSolicitud['fecha_ingreso_analitico']))
							{
								$estado = 'Ingreso Analítico';
							}
							else
							{
								if(empty($rowSolicitud['fecha_retiro_diploma']))
								{
									$estado = 'Retiro Diploma';
								}
								else
								{
									if(empty($rowSolicitud['fecha_retiro_analitico']))
									{
										$estado = 'Retiro Analítico';
									}
									else
									{
										$estado = 'Completado';
										$bg = ' style="background-color:lightgreen;"';
									}
								}
							}
						}
					}
				}
			}
		}
	}
	
	$html .= '<tr'.$bg.'>';
	
	if($rowSolicitud['foto_alumno'] == '')
	{
		$html .= '<td>Sin Foto</td>';
	}
	else
	{
		$html .= '<td><img src="../SeguimientoTitulo/Graduado/'.$rowSolicitud['foto_alumno'].'" width="50px"/></td>'; //Comentar esta linea y descomentar la de abajo
		//$html .= '<td><img src="Graduado/'.$rowSolicitud['foto_alumno'].'" width="50px"/></td>';
	}
	
	$nExp = (empty($rowSolicitud['nro_expediente'])) ? 'Sin Expediente' : $rowSolicitud['nro_expediente'];
	$html .= '<td>'.$nExp.'</td>';
	//$html .= '<td><a href="mostrarAlumno.php?idAlumno='.$idAlumno.'&idCarrera='.$idCarrera.'&origen=listadoSolicitudTitulo" >'.$rowSolicitud['apellido_alumno'].', '.$rowSolicitud['nombre_alumno'].'</a></td>';
	$html .= '<td>'.$rowSolicitud['apellido_alumno'].', '.$rowSolicitud['nombre_alumno'].'</td>';
	$html .= '<td>'.$rowSolicitud['nombre_carrera'].'</td>';
	$html .= '<td>'.$rowSolicitud['nombre_nivel_carrera'].'</td>';
	$html .= '<td>'.$rowSolicitud['caracteristicac_alumno'].'-'.$rowSolicitud['celular_alumno'].'</td>';
	$html .= '<td class="text-center">'.$estado.'</td>';

	$html .= '</tr>';
}


pg_close($conn);

echo $html;

?>