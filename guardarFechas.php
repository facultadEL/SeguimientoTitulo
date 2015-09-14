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
		$controlArchivo = 1;
		
		if($controlArchivo==0){
			//$getDestinoPdf = loadFileToServer("SeguimientoTitulo");
			$getDestinoPdf = 'null';
		}
		
		//Traigo el numero de resolucion y busco si no esta guardado. En caso de que
		//este guardado, si esta guardado busco el id en la tabla de numero resolucion, si no lo creo.
		$numeroResolucion = $_REQUEST['nroNotORes'];
		$condicion = "numero_res ='rec-".$numeroResolucion."'";
		$cantidad = contarRegistro('id_numero_resolucion','numero_resolucion',$condicion);
		if($cantidad == 0){
			$idNumeroRes = traerId('numero_resolucion');
			$numeroResolucionGuardar = 'rec-'.$numeroResolucion;
			$sqlNuevoNroResolucion = "INSERT INTO numero_resolucion(id_numero_resolucion,numero_res,direccion_res) VALUES($idNumeroRes,'$numeroResolucionGuardar','$getDestinoPdf');";
		}else{
			$sqlNuevoNroResolucion = "";
			$rowIdNumeroRes = pg_fetch_array(traerSqlCondicion('id_numero_resolucion','numero_resolucion',$condicion));
			$idNumeroRes = $rowIdNumeroRes['id_numero_resolucion'];
		}

		for($i=0;$i<count($vAlumnosPasar) - 1;$i++)
		{
			$idAlumno = $vAlumnosPasar[$i];
			$sqlGuardar .= "UPDATE seguimiento SET fecha_rescd='$fecha',num_res_cd_fk='$idNumeroRes' WHERE id_seguimiento='$idAlumno';";
		}
		$sqlGuardar = $sqlNuevoNroResolucion.$sqlGuardar;
		$redireccion = 'resolucionCd.php?controlR=0';
		break;
	case 3:
		$controlArchivo = $_REQUEST['controlArchivo'];
		if($controlArchivo==0){
			
			//$getDestinoPdf = loadFileToServer("SeguimientoTitulo");
			$getDestinoPdf = 'null';
		}
		$numeroNota = $_REQUEST['nroNotORes'];		
		$condicion = "numero_nota ='".$numeroNota."'";
		$cantidad = contarRegistro('id_numero_nota_rectorado','numero_nota_rectorado',$condicion);
		if($cantidad == 0){
			$idNumeroNota = traerId('numero_nota_rectorado');
			$sqlNuevoNroNota = "INSERT INTO numero_nota_rectorado(id_numero_nota_rectorado,numero_nota,direccion_nota) VALUES($idNumeroNota,'$numeroNota','$getDestinoPdf');";
		}else{
			$sqlNuevoNroNota = "";
			$rowIdNumeroNota = pg_fetch_array(traerSqlCondicion('id_numero_nota_rectorado','numero_nota_rectorado',$condicion));
			$idNumeroNota = $rowIdNumeroNota['id_numero_nota_rectorado'];
		}
		for($i=0;$i<count($vAlumnosPasar) - 1;$i++)
		{
			$idAlumno = $vAlumnosPasar[$i];
			$sqlGuardar .= "UPDATE seguimiento SET fecha_nota_envio_rec='$fecha',num_nota_fk='$idNumeroNota' WHERE id_seguimiento='$idAlumno';";
		}
		$sqlGuardar = $sqlNuevoNroNota.$sqlGuardar;
		$redireccion = 'notaEnvioRectorado.php?controlR=0';
		
		break;
	case 4:
		$sqlSincronizacion = "";
		$controlArchivo = $_REQUEST['controlArchivo'];
		if($controlArchivo==0){
			
			//$getDestinoPdf = loadFileToServer("SeguimientoTitulo");
			$getDestinoPdf = 'null';
		}
		$numeroResolucion = $_REQUEST['nroNotORes'];
		$condicion = "numero_res ='res-".$numeroResolucion."'";
		$cantidad = contarRegistro('id_numero_resolucion','numero_resolucion',$condicion);
		if($cantidad == 0){
			$idNumeroRes = traerId('numero_resolucion');
			$numeroResolucionGuardar = 'res-'.$numeroResolucion;
			$sqlNuevoNroResolucion = "INSERT INTO numero_resolucion(id_numero_resolucion,numero_res,direccion_res) VALUES($idNumeroRes,'$numeroResolucionGuardar','$getDestinoPdf');";
		}else{
			$sqlNuevoNroResolucion = "";
			$rowIdNumeroRes = pg_fetch_array(traerSqlCondicion('id_numero_resolucion','numero_resolucion',$condicion));
			$idNumeroRes = $rowIdNumeroRes['id_numero_resolucion'];
		}

		for($i=0;$i<count($vAlumnosPasar) - 1;$i++)
		{
			$idAlumno = $vAlumnosPasar[$i];
			$sqlGuardar .= "UPDATE seguimiento SET fecha_rescs='$fecha',num_res_cs_fk='$idNumeroRes' WHERE id_seguimiento='$idAlumno';";
			
		}
		$sqlGuardar = $sqlNuevoNroResolucion.$sqlGuardar;
		$controlSincronizar = 1;
		$sqlSincronizar = getDataAlumno($idAlumno);
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
		if($controlArchivo==0){
			
			$getDestinoPdf = loadFileToServer("SeguimientoTitulo");
			
		}
		$numeroActa = $_REQUEST['nroNotORes'];
		$condicion = "numero_acta ='d-".$numeroActa."'";
		$cantidad = contarRegistro('id_numero_acta','numero_acta',$condicion);
		if($cantidad == 0){
			$idNumeroActa = traerId('numero_acta');
			$numeroActaGuardar = 'd-'.$numeroActa;
			$sqlNuevoNroActa = "INSERT INTO numero_acta(id_numero_acta,numero_acta,direccion_acta) VALUES($idNumeroActa,'$numeroActaGuardar','$getDestinoPdf');";
		}else{
			$sqlNuevoNroActa = "";
			$rowIdNumeroActa = pg_fetch_array(traerSqlCondicion('id_numero_acta','numero_acta',$condicion));
			$idNumeroActa = $rowIdNumeroActa['id_numero_acta'];
		}

		for($i=0;$i<count($vAlumnosPasar) - 1;$i++)
		{
			$idAlumno = $vAlumnosPasar[$i];
			$sqlGuardar .= "UPDATE seguimiento SET fecha_retiro_diploma='$fecha',num_acta_d_fk='$idNumeroActa' WHERE id_seguimiento='$idAlumno';";
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