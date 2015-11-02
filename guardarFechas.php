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

$fechaNoFormat = $_REQUEST['fecha'];
$vFechaNoFormat = explode('/',$fechaNoFormat);
$fecha = $vFechaNoFormat[2].'-'.$vFechaNoFormat[1].'-'.$vFechaNoFormat[0];

$vAlumnosPasar = explode('/--/', $alumnosPasar);

$sqlGuardar = "";
$controlSincronizar = 0;
$sqlSincronizar = "";
$errorPdf = 0;

switch ($etapa){
	case 1:
		$columna = "";
		$origen = empty($_REQUEST['origen']) ? '' : $_REQUEST['origen'];
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
		//$controlArchivo = 1;
		
		$numeroResolucion = $_REQUEST['nroNotORes'];
		if($controlArchivo==0){
			$controlAgregoArchivo = $_REQUEST['controlArchivoHidden'];
			if($controlAgregoArchivo == '1')
			{
				$getDestinoPdf = loadFileToServer('SeguimientoTitulo',('ConsejoDirectivo-'.$numeroResolucion));	

				$idNumeroRes = traerId('archivo');
				$numeroResolucionGuardar = $numeroResolucion;
				$sqlNuevoNroResolucion = "INSERT INTO archivo(id,nombre,url,tipo) VALUES($idNumeroRes,'$numeroResolucionGuardar','$getDestinoPdf',1);";
			}
			else
			{
				$idNumeroRes = 0;
			}
		}
		else
		{
			$condicion = "nombre='".$numeroResolucion."' AND tipo=1";
			
			$rowIdNumeroRes = pg_fetch_array(traerSqlCondicion('id','archivo',$condicion));
			$idNumeroRes = $rowIdNumeroRes['id'];

		}
		
		//Traigo el numero de resolucion y busco si no esta guardado. En caso de que
		//este guardado, si esta guardado busco el id en la tabla de numero resolucion, si no lo creo.
		

		for($i=0;$i<count($vAlumnosPasar) - 1;$i++)
		{
			$idAlumno = $vAlumnosPasar[$i];
			$condicionAlumno = "id_seguimiento='$idAlumno'";
			$sqlDatosAlumno = traerSqlCondicion('fecha_rescd,num_res_cd_fk','seguimiento',$condicionAlumno);
			$rowDatosAlumno = pg_fetch_array($sqlDatosAlumno);
			$sqlGuardar .= "UPDATE seguimiento SET";
			if(empty($rowDatosAlumno['fecha_rescd']))
			{
				$sqlGuardar .= " fecha_rescd='$fecha'";
				if(empty($rowDatosAlumno['num_res_cd_fk'] && $idNumeroRes != 0))
				{
					$sqlGuardar .= ", num_res_cd_fk='$idNumeroActa' ";
				}
			}
			else
			{
				$sqlGuardar .= " num_res_cd_fk='$idNumeroActa' ";
			}

			$sqlGuardar .= " WHERE id_seguimiento='$idAlumno';";
		}
		$sqlGuardar = $sqlNuevoNroResolucion.$sqlGuardar;
		$redireccion = 'resolucionCd.php?controlR=0';
		break;

	case 3:

		$controlArchivo = $_REQUEST['controlArchivo'];
		$numeroNota = $_REQUEST['nroNotORes'];
		if($controlArchivo==0){
			
			$getDestinoPdf = loadFileToServer('SeguimientoTitulo',('NotaRectorado-'.$numeroNota));
		}
		
		$condicion = "nombre='".$numeroNota."'";
		$cantidad = contarRegistro('id','archivo',$condicion);
		if($cantidad == 0){
			$idNumeroNota = traerId('archivo');
			$sqlNuevoNroNota = "INSERT INTO archivo(id,nombre,url,tipo) VALUES($idNumeroNota,'$numeroNota','$getDestinoPdf',2);";
		}else{
			$sqlNuevoNroNota = "";
			$rowIdNumeroNota = pg_fetch_array(traerSqlCondicion('id','archivo',$condicion));
			$idNumeroNota = $rowIdNumeroNota['id'];
		}
		for($i=0;$i<count($vAlumnosPasar) - 1;$i++)
		{
			$idAlumno = $vAlumnosPasar[$i];
			$condicionAlumno = "id_seguimiento='$idAlumno'";
			$sqlDatosAlumno = traerSqlCondicion('fecha_nota_envio_rec,num_nota_fk','seguimiento',$condicionAlumno);
			$rowDatosAlumno = pg_fetch_array($sqlDatosAlumno);
			$sqlGuardar .= "UPDATE seguimiento SET";
			if(empty($rowDatosAlumno['fecha_nota_envio_rec']))
			{
				$sqlGuardar .= " fecha_nota_envio_rec='$fecha'";
				if(empty($rowDatosAlumno['num_nota_fk']))
				{
					$sqlGuardar .= ", num_nota_fk='$idNumeroActa' ";
				}
			}
			else
			{
				$sqlGuardar .= " num_nota_fk='$idNumeroActa' ";
			}

			$sqlGuardar .= " WHERE id_seguimiento='$idAlumno';";
		}
		$sqlGuardar = $sqlNuevoNroNota.$sqlGuardar;
		$redireccion = 'notaEnvioRectorado.php?controlR=0';
		
		break;

	case 4:
		$sqlSincronizacion = "";
		$controlArchivo = $_REQUEST['controlArchivo'];
		$numeroResolucion = $_REQUEST['nroNotORes'];
		if($controlArchivo==0){
			
			$getDestinoPdf = loadFileToServer('SeguimientoTitulo',('ConsejoSuperior-'.$numeroResolucion));
		}
		
		$condicion = "nombre='".$numeroResolucion."'";
		$cantidad = contarRegistro('id','archivo',$condicion);
		if($cantidad == 0){
			$idNumeroRes = traerId('archivo');
			$numeroResolucionGuardar = $numeroResolucion;
			$sqlNuevoNroResolucion = "INSERT INTO archivo(id,nombre,url,tipo) VALUES($idNumeroRes,'$numeroResolucionGuardar','$getDestinoPdf',3);";
		}else{
			$sqlNuevoNroResolucion = "";
			$rowIdNumeroRes = pg_fetch_array(traerSqlCondicion('id','archivo',$condicion));
			$idNumeroRes = $rowIdNumeroRes['id'];
		}

		for($i=0;$i<count($vAlumnosPasar) - 1;$i++)
		{
			$idAlumno = $vAlumnosPasar[$i];
			$condicionAlumno = "id_seguimiento='$idAlumno'";
			$sqlDatosAlumno = traerSqlCondicion('fecha_rescs,num_res_cs_fk','seguimiento',$condicionAlumno);
			$rowDatosAlumno = pg_fetch_array($sqlDatosAlumno);
			$sqlGuardar .= "UPDATE seguimiento SET";
			if(empty($rowDatosAlumno['fecha_rescs']))
			{
				$sqlGuardar .= " fecha_rescs='$fecha'";
				if(empty($rowDatosAlumno['num_res_cs_fk']))
				{
					$sqlGuardar .= ", num_res_cs_fk='$idNumeroActa' ";
				}
			}
			else
			{
				$sqlGuardar .= " num_res_cs_fk='$idNumeroActa' ";
			}

			$sqlGuardar .= " WHERE id_seguimiento='$idAlumno';";
		}
		$sqlGuardar = $sqlNuevoNroResolucion.$sqlGuardar;
		//$controlSincronizar = 1;
		//$sqlSincronizar = getDataAlumno($idAlumno);
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
		$controlArchivo = $_REQUEST['controlArchivo'];
		$numeroActa = $_REQUEST['nroNotORes'];

		if($controlArchivo==0)
		{
			$getDestinoPdf = loadFileToServer('SeguimientoTitulo',('ActaDiploma-'.$numeroActa));
		}
		$condicion = "nombre='".$numeroActa."'";
		$cantidad = contarRegistro('id','archivo',$condicion);
		if($cantidad == 0){
			$idNumeroActa = traerId('archivo');
			$numeroActaGuardar = 'd-'.$numeroActa;
			$sqlNuevoNroActa = "INSERT INTO archivo(id,nombre,url,tipo) VALUES($idNumeroActa,'$numeroActaGuardar','$getDestinoPdf',4);";
		}else{
			$sqlNuevoNroActa = "";
			$rowIdNumeroActa = pg_fetch_array(traerSqlCondicion('id','archivo',$condicion));
			$idNumeroActa = $rowIdNumeroActa['id'];
		}

		for($i=0;$i<count($vAlumnosPasar) - 1;$i++)
		{
			$idAlumno = $vAlumnosPasar[$i];
			$condicionAlumno = "id_seguimiento='$idAlumno'";
			$sqlDatosAlumno = traerSqlCondicion('fecha_retiro_diploma,num_acta_d_fk','seguimiento',$condicionAlumno);
			$rowDatosAlumno = pg_fetch_array($sqlDatosAlumno);
			$sqlGuardar .= "UPDATE seguimiento SET";
			if(empty($rowDatosAlumno['fecha_retiro_diploma']))
			{
				$sqlGuardar .= " fecha_retiro_diploma='$fecha'";
				if(empty($rowDatosAlumno['num_acta_d_fk']))
				{
					$sqlGuardar .= ", num_acta_d_fk='$idNumeroActa' ";
				}
			}
			else
			{
				$sqlGuardar .= " num_acta_d_fk='$idNumeroActa' ";
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

//echo $sqlGuardar;

if($errorPdf == 0){
	$e = guardarSql($sqlGuardar);
	if($controlSincronizar == 1)
	{
		$conGraduados = pg_connect("host=localhost port=5432 user=extension password=newgenius dbname=graduados") or die("Error de conexion.".pg_last_error());
		if(!pg_query($conGraduados,$sqlSincronizar)){
        $termino = "ROLLBACK";
	        $error = 1;
	    }else{
	        $termino = "COMMIT";
	    }
    
    	pg_query($termino);
	}
	
	if($e==1){
		mostrarMensaje('Los datos no se pudieron guardar. Contactese con su administrador',$redireccion);
	}else{
		mostrarMensaje('Los datos se guardaron correctamente',$redireccion);
	}
}else{
	mostrarMensaje('El archivo subido no es valido. Suba un PDF, DOC o DOCX',$redireccionTmp);
}




?>