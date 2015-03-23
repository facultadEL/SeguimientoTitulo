<?php
error_reporting(E_ALL);
include_once 'libreriaPhp.php';
include_once 'conexion.php';

function getDataAlumno($idAlumno)
{
	//Carrera alumno, ver
	$sqlMandar = "";
	$sqlAlumnos = traerSqlCondicion('*','alumno','id_alumno='.$idAlumno);
	$rowAlumno = pg_fetch_array(traerSqlCondicion('*','alumno','id_alumno='.$idAlumno));
	//Nombre_alumno, apellido_alumno, mail_alumno, facebook_alumno, numerodni_alumno, tipodni_alumno
	//calle_alumno, perfilacademico_alumno, foto_alumno, carrera_alumno, ancho_final, alto_final
	//fechanacimiento_alumno,numerocalle_alumno, mail_alumno2,twitter_alumno,provincia_nac_alumno,localidad_nac_alumno,
	//provincia_trabajo_alumno,localidad_trabajo_alumno,provincia_viviendo_alumno,localidad_viviendo_alumno, perfil_laboral_alumno
	$sqlMandar "INSERT INTO alumno(nombre_alumno,apellido_alumno,mail_alumno,facebook_alumno,numerodni_alumno,
		tipodni_alumno,calle_alumno,foto_alumno,aca carrera,ancho_final,alto_final,numerocalle_alumno, mail_alumno2,
		twitter_alumno, provincia_trabajo_alumno, localidad_trabajo_alumno, provincia_viviendo_alumno, localidad_viviendo_alumno,
		perfil_laboral_alumno, 
		) VALUES('$rowAlumno['nombre_alumno']','$rowAlumno['apellido_alumno']','$rowAlumno['mail_alumno']','$rowAlumno['facebook_alumno']',
		'$rowAlumno['numerodni_alumno']','$rowAlumno['tipodni_alumno']','$rowAlumno['calle_alumno']',null,
		'$rowAlumno['foto_alumno']',carrera,'$rowAlumno['ancho_final']','$rowAlumno['alto_final']','$rowAlumno['fechanacimiento_alumno']',
		'$rowAlumno['numerocalle_alumno']','$rowAlumno['mail_alumno2']','$rowAlumno['twitter_alumno']','$rowAlumno['provincia_trabajo_alumno']',
		'$rowAlumno['localidad_trabajo_alumno']','$rowAlumno['provincia_viviendo_alumno']','$rowAlumno['localidad_viviendo_alumno']',
		'$rowAlumno['perfil_laboral_alumno']','$rowAlumno['nro_legajo']','$rowAlumno['password_alumno']',
		'$rowAlumno['numerodni_alumno']','$rowAlumno['fechanacimiento_alumno']','$rowAlumno['cp_alumno']',
		'$rowAlumno['dpto_alumno']','$rowAlumno['caracteristicaf_alumno']','$rowAlumno['telefono_alumno']',
		'$rowAlumno['caracteristicac_alumno']','$rowAlumno['celular_alumno']','$rowAlumno['cp_alumno2']',
		'$rowAlumno['empresa_trabaja_alumno']','$rowAlumno['piso_alumno']','$rowAlumno['localidad_nacimiento_alumno']',
		'$rowAlumno['ultima_materia_alumno']','$rowAlumno['fecha_ultima_mat_alumno']);";
}

//El separador para el explode siempre es /--/
$etapa = $_REQUEST['etapa'];
$alumnosPasar = $_REQUEST['alumnosPasar'];

$fechaNoFormat = $_REQUEST['fecha'];
$vFechaNoFormat = explode('/',$fechaNoFormat);
$fecha = $vFechaNoFormat[2].'-'.$vFechaNoFormat[1].'-'.$vFechaNoFormat[0];

$vAlumnosPasar = explode('/--/', $alumnosPasar);

$sqlGuardar = "";
$errorPdf = 0;

switch ($etapa){
	case 1:
		for($i=0;$i<count($vAlumnosPasar) - 1;$i++)
		{
			$idAlumno = $vAlumnosPasar[$i];
			$sqlGuardar .= "UPDATE seguimiento SET fecha_solicitud='$fecha' WHERE id_seguimiento='$idAlumno';";
		}
		$redireccion = 'solicitudTitulo.php';
		break;
	case 2:
		//Traigo el control para ver si el archivo ya se encuentra en el sistema
		$controlArchivo = $_REQUEST['controlArchivo'];
		
		if($controlArchivo==0){
			$getDestinoPdf = loadFileToServer("SeguimientoTitulo");
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
		$redireccion = 'resolucionCd.php';
		break;
	case 3:
		$controlArchivo = $_REQUEST['controlArchivo'];
		if($controlArchivo==0){
			
			$getDestinoPdf = loadFileToServer("SeguimientoTitulo");
			
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
		$redireccion = 'notaEnvioRectorado.php';
		
		break;
	case 4:
		$sqlSincronizacion = "";
		$controlArchivo = $_REQUEST['controlArchivo'];
		if($controlArchivo==0){
			
			$getDestinoPdf = loadFileToServer("SeguimientoTitulo");
			
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
		$redireccion = 'resolucionCs.php?';
		break;
	case 5:
		for($i=0;$i<count($vAlumnosPasar) - 1;$i++)
		{
			$idAlumno = $vAlumnosPasar[$i];
			$sqlGuardar .= "UPDATE seguimiento SET fecha_ingreso_diploma='$fecha' WHERE id_seguimiento='$idAlumno';";
		}
		$redireccion = 'ingresoDiploma.php';
		break;
	case 6:
	
		for($i=0;$i<count($vAlumnosPasar) - 1;$i++)
		{
			$idAlumno = $vAlumnosPasar[$i];
			$sqlGuardar .= "UPDATE seguimiento SET fecha_ingreso_analitico='$fecha' WHERE id_seguimiento='$idAlumno';";
		}
		$redireccion = 'ingresoAnalitico.php';
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
		$redireccion = 'entregaDiploma.php';
		break;
	case 8:
		for($i=0;$i<count($vAlumnosPasar) - 1;$i++)
		{
			$idAlumno = $vAlumnosPasar[$i];
			$sqlGuardar = $sqlGuardar."UPDATE seguimiento SET fecha_retiro_analitico='$fecha' WHERE id_seguimiento='$idAlumno';";
		}
		$redireccion = 'entregaDiploma.php';
		break;
}

//echo $sqlGuardar;

if($errorPdf == 0){
	$e = guardarSql($sqlGuardar);
	if($e==1){
		mostrarMensaje('Los datos no se pudieron guardar. Contactese con su administrador',$redireccion);
	}else{
		mostrarMensaje('Los datos se guardaron correctamente',$redireccion);
	}
}else{
	mostrarMensaje('El archivo subido no es valido. Suba un PDF, DOC o DOCX',$redireccionTmp);
}




?>