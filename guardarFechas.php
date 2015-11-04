<?php
error_reporting(E_ALL);
include_once 'libreriaPhp.php';
include_once 'conexion.php';

function getDataAlumno($idSeguimiento)
{
	//Creo la conexion para usarla aca sola y para poder hacer consultas sobre esa
	/*
	$sqlAlumnoCarrera = traerSqlCondicion('alumno_fk,carrera_fk','seguimiento','id_seguimiento='.$idSeguimiento);
	$rowAlumnoCarrera = pg_fetch_array($sqlAlumnoCarrera);
	$idAlumno = $rowAlumnoCarrera['alumno_fk'];
	$idCarrera = $rowAlumnoCarrera['carrera_fk'];

	$conGraduados = pg_connect("host=localhost port=5432 user=extension password=newgenius dbname=graduados") or die("Error de conexion.".pg_last_error());
	//Busco el proximo id
	$sqlId = pg_query($conGraduados,'SELECT max(id_alumno) FROM alumno');
	$rowId = pg_fetch_array($sqlId);
	$maxId = $rowId['max'] + 1;
	//Carrera alumno, ver
	$sqlMandar = "";
	$sqlTelefonos = "";
	$sqlAlumnos = traerSqlCondicion('*','alumno','id_alumno='.$idAlumno);
	$rowAlumno = pg_fetch_array(traerSqlCondicion('*','alumno','id_alumno='.$idAlumno));
	$sqlMandar = "INSERT INTO alumno(id_alumno,nombre_alumno,apellido_alumno,mail_alumno,facebook_alumno,numerodni_alumno,tipodni_alumno,calle_alumno,perfilacademico_alumno,foto_alumno,carrera_alumno,ancho_final,alto_final,fechanacimiento_alumno,numerocalle_alumno, mail_alumno2,twitter_alumno, provincia_nac_alumno, localidad_nac_alumno,provincia_trabajo_alumno, localidad_trabajo_alumno,provincia_viviendo_alumno, localidad_viviendo_alumno,perfil_laboral_alumno) VALUES($maxId,'$rowAlumno['nombre_alumno']','$rowAlumno['apellido_alumno']','$rowAlumno['mail_alumno']','$rowAlumno['facebook_alumno']','$rowAlumno['numerodni_alumno']','$rowAlumno['tipodni_alumno']','$rowAlumno['calle_alumno']',null,'$rowAlumno['foto_alumno']',$idCarrera,'$rowAlumno['ancho_final']','$rowAlumno['alto_final']','$rowAlumno['fechanacimiento_alumno']','$rowAlumno['numerocalle_alumno']','$rowAlumno['mail_alumno2']','$rowAlumno['twitter_alumno']','$rowAlumno['provincia_nacimiento_alumno']','$rowAlumno['localidad_nacimiento_alumno']','$rowAlumno['provincia_trabajo_alumno']','$rowAlumno['localidad_trabajo_alumno']','$rowAlumno['provincia_viviendo_alumno']','$rowAlumno['localidad_viviendo_alumno']','$rowAlumno['perfil_laboral_alumno']');";
	
	while($rowTelefonos = pg_fetch_array(traerSqlCondicion('*','telefono_del_alumno','alumno_fk='.$idAlumno)))
	{
		$sqlTelefonos .= "INSERT INTO telefono_del_alumno(caracteristica_alumno, telefono_alumno, duenio_del_telefono, alumno_fk) VALUES('$rowTelefonos['caracteristica_alumno']','$rowTelefonos['telefono_alumno']','$rowTelefonos['duenio_del_telefono']',$maxId);";
	}

	$sqlMandar .= $sqlTelefonos;
	return $sqlMandar;
	*/
}

//El separador para el explode siempre es /--/
$etapa = $_REQUEST['etapa'];
$alumnosPasar = $_REQUEST['alumnosPasar'];

$fechaNoFormat = (empty($_REQUEST['fecha'])) ? '01/01/1900' : $_REQUEST['fecha'];
$vFechaNoFormat = explode('/',$fechaNoFormat);
$fecha = $vFechaNoFormat[2].'-'.$vFechaNoFormat[1].'-'.$vFechaNoFormat[0];

echo $fecha;

$vAlumnosPasar = explode('/--/', $alumnosPasar);

$sqlGuardar = "";
$controlSincronizar = 0;
$alumnosSincronizar = "";
$sqlSincronizar = "";
$errorPdf = 0;

switch ($etapa){
	case 1:
		$columna = "";
		$origen = (empty($_REQUEST['origen'])) ? '' : $_REQUEST['origen'];
		if($origen == "ra")
		{
			$columna = "fecha_resp_alumno";
		}
		else
		{
			$columna = "fecha_solicitud";
		}
		for($i=0;$i<count($vAlumnosPasar) - 1;$i++)
		{
			$idAlumno = $vAlumnosPasar[$i];
			$sqlGuardar .= "UPDATE seguimiento SET $columna='$fecha' WHERE id_seguimiento='$idAlumno';";
		}
		$redireccion = 'solicitudTitulo.php?controlR=0';
		break;

	case 2:
		//Traigo el control para ver si el archivo ya se encuentra en el sistema
		$controlArchivo = $_REQUEST['controlArchivo'];
		$numeroResolucion = (empty($_REQUEST['nroNotORes'])) ? 0 : $_REQUEST['nroNotORes'];
		$idNumeroRes = 0;

		echo $numeroResolucion;
		if($numeroResolucion != 0)
		{
			$controlAgregoArchivo = $_REQUEST['controlArchivoHidden'];
			if($controlArchivo == 0)
			{
				$condicionCantidad = "nombre='$numeroResolucion' AND tipo=1";
				$cantidad = contarRegistro('id','archivo',$condicionCantidad);
				if($cantidad == 0)
				{
					if($controlAgregoArchivo == 0)
					{
						$idNumeroRes = traerIdST('archivo');
						$numeroResolucionGuardar = $numeroResolucion;
						$sqlNuevoNroResolucion = "INSERT INTO archivo(id,nombre,tipo) VALUES($idNumeroRes,'$numeroResolucionGuardar',1);";
					}
					else
					{
						$getDestinoPdf = loadFileToServer('seguimientoPrueba',('ConsejoDirectivo-'.$numeroResolucion));

						$idNumeroRes = traerIdST('archivo');
						$numeroResolucionGuardar = $numeroResolucion;
						$sqlNuevoNroResolucion = "INSERT INTO archivo(id,nombre,url,tipo) VALUES($idNumeroRes,'$numeroResolucionGuardar','$getDestinoPdf',1);";
					}
				}
				else
				{
					if($controlAgregoArchivo == 1)
					{
						$getDestinoPdf = loadFileToServer('seguimientoPrueba',('ConsejoDirectivo-'.$numeroResolucion));

						$rowNroRes = pg_fetch_array(traerSqlCondicion('id','archivo',$condicionCantidad));
						$idNumeroRes = $rowNroRes['id'];
						$numeroResolucionGuardar = $numeroResolucion;
						$sqlNuevoNroResolucion = "UPDATE archivo SET url='$getDestinoPdf' WHERE id='$idNumeroRes';";
					}
					else
					{
						$rowNroRes = pg_fetch_array(traerSqlCondicion('id','archivo',$condicionCantidad));
						$idNumeroRes = $rowNroRes['id'];
					}
				}
			}
			else
			{
				$condicion = "nombre='".$numeroResolucion."' AND tipo=1";
			
				$rowIdNumeroRes = pg_fetch_array(traerSqlCondicion('id','archivo',$condicion));
				$idNumeroRes = $rowIdNumeroRes['id'];
			}
		}

		for($i = 0; $i < (count($vAlumnosPasar) - 1); $i++)
		{
			$idAlumno = $vAlumnosPasar[$i];
			$condicionAlumno = "id_seguimiento='$idAlumno'";

			$sqlDatosAlumno = traerSqlCondicion('fecha_rescd,num_res_cd_fk','seguimiento',$condicionAlumno);
			$rowDatosAlumno = pg_fetch_array($sqlDatosAlumno);

			$sqlGuardar .= "UPDATE seguimiento SET";

			if($fecha != '1900-01-01')
			{
				if(empty($rowDatosAlumno['fecha_rescd']))
				{
					$sqlGuardar .= " fecha_rescd='$fecha'";
					if($idNumeroRes != 0 && empty($rowDatosAlumno['num_res_cd_fk']))
					{
						$sqlGuardar .= ", num_res_cd_fk='$idNumeroRes' ";
					}
				}
			}
			else
			{
				$sqlGuardar .= " num_res_cd_fk='$idNumeroRes'";
			}

			$sqlGuardar .= " WHERE id_seguimiento='$idAlumno';";
		}
		$sqlGuardar = $sqlNuevoNroResolucion.$sqlGuardar;
		$redireccion = 'resolucionCd.php?controlR=0';

		break;
		
	case 3:

		$controlArchivo = $_REQUEST['controlArchivo'];
		$numeroNota = (empty($_REQUEST['nroNotORes'])) ? 0 : $_REQUEST['nroNotORes'];
		$idNumeroNota = 0;

		echo $numeroNota;
		if($numeroNota != 0)
		{
			$controlAgregoArchivo = $_REQUEST['controlArchivoHidden'];
			if($controlArchivo == 0)
			{
				$condicionCantidad = "nombre='$numeroNota' AND tipo=2";
				$cantidad = contarRegistro('id','archivo',$condicionCantidad);
				if($cantidad == 0)
				{
					if($controlAgregoArchivo == 0)
					{
						$idNumeroNota = traerIdST('archivo');
						$numeroNotaGuardar = $numeroNota;
						$sqlNuevoNroNota = "INSERT INTO archivo(id,nombre,tipo) VALUES($idNumeroNota,'$numeroNotaGuardar',2);";
					}
					else
					{
						$getDestinoPdf = loadFileToServer('seguimientoPrueba',('NotaRectorado-'.$numeroNota));	

						$idNumeroNota = traerIdST('archivo');
						$numeroNotaGuardar = $numeroNota;
						$sqlNuevoNroNota = "INSERT INTO archivo(id,nombre,url,tipo) VALUES($idNumeroNota,'$numeroNotaGuardar','$getDestinoPdf',2);";
					}
				}
				else
				{
					if($controlAgregoArchivo == 1)
					{
						$getDestinoPdf = loadFileToServer('seguimientoPrueba',('NotaRectorado-'.$numeroNota));

						$rowNroNota = pg_fetch_array(traerSqlCondicion('id','archivo',$condicionCantidad));
						$idNumeroNota = $rowNroNota['id'];
						$numeroNotaGuardar = $numeroNota;
						$sqlNuevoNroNota = "UPDATE archivo SET url='$getDestinoPdf' WHERE id='$idNumeroNota';";
					}
					else
					{
						$rowNroNota = pg_fetch_array(traerSqlCondicion('id','archivo',$condicionCantidad));
						$idNumeroNota = $rowNroNota['id'];
					}
				}
			}
			else
			{
				$condicion = "nombre='".$numeroNota."' AND tipo=2";
			
				$rowIdNumeroNota = pg_fetch_array(traerSqlCondicion('id','archivo',$condicion));
				$idNumeroNota = $rowIdNumeroNota['id'];
			}
		}

		for($i = 0; $i < (count($vAlumnosPasar) - 1); $i++)
		{
			$idAlumno = $vAlumnosPasar[$i];
			$condicionAlumno = "id_seguimiento='$idAlumno'";

			$sqlDatosAlumno = traerSqlCondicion('fecha_nota_envio_rec,num_nota_fk','seguimiento',$condicionAlumno);
			$rowDatosAlumno = pg_fetch_array($sqlDatosAlumno);

			$sqlGuardar .= "UPDATE seguimiento SET";

			if($fecha != '1900-01-01')
			{
				if(empty($rowDatosAlumno['fecha_nota_envio_rec']))
				{
					$sqlGuardar .= " fecha_nota_envio_rec='$fecha'";
					if($idNumeroNota != 0 && empty($rowDatosAlumno['num_nota_fk']))
					{
						$sqlGuardar .= ", num_nota_fk='$idNumeroNota' ";
					}
				}
			}
			else
			{
				$sqlGuardar .= " num_nota_fk='$idNumeroNota'";
			}

			$sqlGuardar .= " WHERE id_seguimiento='$idAlumno';";
		}
		$sqlGuardar = $sqlNuevoNroNota.$sqlGuardar;

		$redireccion = 'notaEnvioRectorado.php?controlR=0';
		break;

	case 4:
		//Traigo el control para ver si el archivo ya se encuentra en el sistema
		$controlArchivo = $_REQUEST['controlArchivo'];
		$numeroResolucion = (empty($_REQUEST['nroNotORes'])) ? 0 : $_REQUEST['nroNotORes'];
		$idNumeroRes = 0;

		//echo $numeroResolucion;
		if($numeroResolucion != 0)
		{
			$controlAgregoArchivo = $_REQUEST['controlArchivoHidden'];
			if($controlArchivo == 0)
			{
				$condicionCantidad = "nombre='$numeroResolucion' AND tipo=3";
				$cantidad = contarRegistro('id','archivo',$condicionCantidad);
				if($cantidad == 0)
				{
					if($controlAgregoArchivo == 0)
					{
						$idNumeroRes = traerIdST('archivo');
						$numeroResolucionGuardar = $numeroResolucion;
						$sqlNuevoNroResolucion = "INSERT INTO archivo(id,nombre,tipo) VALUES($idNumeroRes,'$numeroResolucionGuardar',3);";
					}
					else
					{
						$getDestinoPdf = loadFileToServer('seguimientoPrueba',('ConsejoSuperior-'.$numeroResolucion));

						$idNumeroRes = traerIdST('archivo');
						$numeroResolucionGuardar = $numeroResolucion;
						$sqlNuevoNroResolucion = "INSERT INTO archivo(id,nombre,url,tipo) VALUES($idNumeroRes,'$numeroResolucionGuardar','$getDestinoPdf',3);";
					}
				}
				else
				{
					if($controlAgregoArchivo == 1)
					{
						$getDestinoPdf = loadFileToServer('seguimientoPrueba',('ConsejoSuperior-'.$numeroResolucion));

						$rowNroRes = pg_fetch_array(traerSqlCondicion('id','archivo',$condicionCantidad));
						$idNumeroRes = $rowNroRes['id'];
						$numeroResolucionGuardar = $numeroResolucion;
						$sqlNuevoNroResolucion = "UPDATE archivo SET url='$getDestinoPdf' WHERE id='$idNumeroRes';";
					}
					else
					{
						$rowNroRes = pg_fetch_array(traerSqlCondicion('id','archivo',$condicionCantidad));
						$idNumeroRes = $rowNroRes['id'];
					}
				}
				
			}
			else
			{
				$condicion = "nombre='".$numeroResolucion."' AND tipo=3";
			
				$rowIdNumeroRes = pg_fetch_array(traerSqlCondicion('id','archivo',$condicion));
				$idNumeroRes = $rowIdNumeroRes['id'];
			}
		}

		for($i = 0; $i < (count($vAlumnosPasar) - 1); $i++)
		{
			$idAlumno = $vAlumnosPasar[$i];
			$condicionAlumno = "id_seguimiento='$idAlumno'";

			$sqlDatosAlumno = traerSqlCondicion('fecha_rescs,num_res_cs_fk','seguimiento',$condicionAlumno);
			$rowDatosAlumno = pg_fetch_array($sqlDatosAlumno);

			$sqlGuardar .= "UPDATE seguimiento SET";

			if($fecha != '1900-01-01')
			{
				if(empty($rowDatosAlumno['fecha_rescs']))
				{
					$sqlGuardar .= " fecha_rescs='$fecha'";
					if($idNumeroRes != 0 && empty($rowDatosAlumno['num_res_cs_fk']))
					{
						$sqlGuardar .= ", num_res_cs_fk='$idNumeroRes' ";
					}
				}
			}
			else
			{
				$sqlGuardar .= " num_res_cs_fk='$idNumeroRes'";
			}

			$controlSincronizar = 1;
			$alumnosSincronizar .= $idAlumno;
			if(!$i < (count($vAlumnosPasar) - 2))
			{
				$alumnosSincronizar .= $separador;
			}

			$sqlGuardar .= " WHERE id_seguimiento='$idAlumno';";
		}
		$sqlGuardar = $sqlNuevoNroResolucion.$sqlGuardar;
		$redireccion = 'resolucionCs.php?controlR=0';
		break;

	case 5:
		for($i=0;$i<count($vAlumnosPasar) - 1;$i++)
		{
			$idAlumno = $vAlumnosPasar[$i];
			$sqlGuardar .= "UPDATE seguimiento SET fecha_ingreso_diploma='$fecha' WHERE id_seguimiento='$idAlumno';";
		}
		$redireccion = 'ingresoDiploma.php?controlR=0';
		break;
	case 6:
	
		for($i=0;$i<count($vAlumnosPasar) - 1;$i++)
		{
			$idAlumno = $vAlumnosPasar[$i];
			$sqlGuardar .= "UPDATE seguimiento SET fecha_ingreso_analitico='$fecha' WHERE id_seguimiento='$idAlumno';";
		}
		$redireccion = 'ingresoAnalitico.php?controlR=0';
		break;

	case 7:
		//Traigo el control para ver si el archivo ya se encuentra en el sistema
		$controlArchivo = $_REQUEST['controlArchivo'];
		$numeroActa = (empty($_REQUEST['nroNotORes'])) ? 0 : $_REQUEST['nroNotORes'];
		$idNumeroActa = 0;

		//echo $numeroResolucion;
		if($numeroActa != 0)
		{
			$controlAgregoArchivo = $_REQUEST['controlArchivoHidden'];
			if($controlArchivo == 0)
			{
				$condicionCantidad = "nombre='$numeroActa' AND tipo=4";
				$cantidad = contarRegistro('id','archivo',$condicionCantidad);
				if($cantidad == 0)
				{
					if($controlAgregoArchivo == 0)
					{
						$idNumeroActa = traerIdST('archivo');
						$numeroActaGuardar = $numeroActa;
						$sqlNuevoNroActa = "INSERT INTO archivo(id,nombre,tipo) VALUES($idNumeroActa,'$numeroActaGuardar',4);";
					}
					else
					{
						$getDestinoPdf = loadFileToServer('seguimientoPrueba',('ActaDiploma-'.$numeroActa));

						$idNumeroActa = traerIdST('archivo');
						$numeroActaGuardar = $numeroActa;
						$sqlNuevoNroActa = "INSERT INTO archivo(id,nombre,url,tipo) VALUES($idNumeroActa,'$numeroActaGuardar','$getDestinoPdf',4);";
					}
				}
				else
				{
					if($controlAgregoArchivo == 1)
					{
						$getDestinoPdf = loadFileToServer('seguimientoPrueba',('ActaDiploma-'.$numeroActa));

						$rowNroActa = pg_fetch_array(traerSqlCondicion('id','archivo',$condicionCantidad));
						$idNumeroActa = $rowNroActa['id'];
						$numeroActaGuardar = $numeroActa;
						$sqlNuevoNroActa = "UPDATE archivo SET url='$getDestinoPdf' WHERE id='$idNumeroActa';";
					}
					else
					{
						$rowNroActa = pg_fetch_array(traerSqlCondicion('id','archivo',$condicionCantidad));
						$idNumeroActa = $rowNroActa['id'];
					}
				}
				
			}
			else
			{
				$condicion = "nombre='".$numeroActa."' AND tipo=4";
			
				$rowIdNumeroActa = pg_fetch_array(traerSqlCondicion('id','archivo',$condicion));
				$idNumeroActa = $rowIdNumeroActa['id'];
			}
		}

		for($i = 0; $i < (count($vAlumnosPasar) - 1); $i++)
		{
			$idAlumno = $vAlumnosPasar[$i];
			$condicionAlumno = "id_seguimiento='$idAlumno'";

			$sqlDatosAlumno = traerSqlCondicion('fecha_retiro_diploma,num_acta_d_fk','seguimiento',$condicionAlumno);
			$rowDatosAlumno = pg_fetch_array($sqlDatosAlumno);

			$sqlGuardar .= "UPDATE seguimiento SET";

			if($fecha != '1900-01-01')
			{
				if(empty($rowDatosAlumno['fecha_retiro_diploma']))
				{
					$sqlGuardar .= " fecha_retiro_diploma='$fecha'";
					if($idNumeroActa != 0 && empty($rowDatosAlumno['num_acta_d_fk']))
					{
						$sqlGuardar .= ", num_acta_d_fk='$idNumeroActa' ";
						$controlSincronizar = 1;
						$alumnosSincronizar .= $idAlumno;
						if(!$i < (count($vAlumnosPasar) - 2))
						{
							$alumnosSincronizar .= $separador;
						}
					}
				}
			}
			else
			{
				$sqlGuardar .= " num_acta_d_fk='$idNumeroActa'";
			}

			$sqlGuardar .= " WHERE id_seguimiento='$idAlumno';";
		}
		$sqlGuardar = $sqlNuevoNroActa.$sqlGuardar;
		$redireccion = 'entregaDiploma.php?controlR=0';
		break;

	case 8:
		for($i=0;$i<count($vAlumnosPasar) - 1;$i++)
		{
			$idAlumno = $vAlumnosPasar[$i];
			$sqlGuardar = $sqlGuardar."UPDATE seguimiento SET fecha_retiro_analitico='$fecha' WHERE id_seguimiento='$idAlumno';";
		}
		$redireccion = 'entregaDiploma.php?controlR=0';
		break;
}

echo $sqlGuardar;

if($errorPdf == 0){
	$e = guardarSql($sqlGuardar);
	if($controlSincronizar == 1)
	{
		sincronizarAlumnos($alumnosSincronizar);
	}
	
	if($e==1){
		mostrarMensaje('Los datos no se pudieron guardar. Contactese con su administrador',$redireccion);
	}else{
		mostrarMensaje('Los datos se guardaron correctamente',$redireccion);
	}
}else{
	mostrarMensaje('El archivo subido no es valido. Suba un PDF, DOC o DOCX',$redireccionTmp);
}

function sincronizarAlumnos($alumnos)
{
	$vAlumnos = explode('/--/', $alumnos);
	//Aca se va a hacer la sincronizacion de este sistema con el de graduados.
	
	for ($i=0; $i < (count($vAlumnos)); $i++)
	{
		$idAlumno = $vAlumnos[$i];
		$condicionAlumno = "id_seguimiento='$idAlumno' AND fecha_rescs IS NOT NULL AND num_res_cs_fk IS NOT NULL";
		$sqlAlumno = traerSqlCondicion('*','seguimiento s INNER JOIN alumno a ON(s.alumno_fk = a.id_alumno) INNER JOIN carrera c ON(s.carrera_fk = c.id_carrera)',$condicion);
		$rowAlumno = pg_fetch_array($sqlAlumno);

		//El id lo busco en la otra base
		$nombre = $rowAlumno['nombre_alumno'];
		$apellido = $rowAlumno['apellido_alumno'];
		$mail = $rowAlumno['mail_alumno'];
		$facebook = $rowAlumno['facebook_alumno'];
		$tipoDni = $rowAlumno['tipodni_alumno'];
		$calle = $rowAlumno['calle_alumno'];
		$foto = $rowAlumno['foto_alumno'];
		$anchoFoto = $rowAlumno['ancho_final'];
		$altoFoto = $rowAlumno['alto_final'];
		$numeroCalle = $rowAlumno['numerocalle_alumno'];
		$mail2 = $rowAlumno['mail_alumno2'];
		$twitter = $rowAlumno['twitter_alumno'];
		$provinciaTrabajo = $rowAlumno['provincia_trabajo_alumno'];
		$localidadTrabajo = $rowAlumno['localidad_trabajo_alumno'];
		$provinciaViviendo = $rowAlumno['provincia_viviendo_alumno'];
		$localidadViviendo = $rowAlumno['localidad_viviendo_alumno'];
		$perfilLaboral = $rowAlumno['perfil_laboral_alumno'];
		

		//sqlGraduado es el query que se va a ejecutar en la base de datos de graduados
		$sqlGraduado = "INSERT INTO alumno(id_alumno,nombre_alumno,apellido_alumno,mail_alumno,
			facebook_alumno,numerodni_alumno,tipodni_alumno,perfilacademico_alumno,foto_alumno,
			carrera_alumno,ancho_final,alto_final,fechanacimiento_alumno,calle_alumno,numerocalle_alumno,
			gra_depto,gra_piso,mail_alumno2,twitter_alumno,provincia_nac_alumno,localidad_nac_alumno,provincia_trabajo_alumno,localidad_trabajo_alumno,provincia_viviendo_alumno,localidad_viviendo_alumno,perfil_laboral_alumno) 
			VALUES()"

		
	}
	

}

?>