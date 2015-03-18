<?php
error_reporting(E_ALL);
include_once 'libreriaPhp.php';
include_once 'conexion.php';

//No tengo consultas, con el longVector y el textPasar traigo todos los id de los alumnos a confirmar
//El separador para el explode siempre es /--/
$etapa = $_REQUEST['etapa'];
$longVector = $_REQUEST['longVector'];
$textPasar = $_REQUEST['textPasar'];
$vPasar = explode('/--/', $textPasar);
$sqlGuardar = "";
$fechaActual = date('Y').'-'.date('m').'-'.date('d');
$errorPdf = 0;
switch ($etapa){
	case 1:
		
		//echo $consulta;
		for($i=0;$i<$longVector;$i++){
			$idAlumno = $vPasar[$i];
			if($idAlumno!=''){
				$sqlGuardar = $sqlGuardar."UPDATE seguimiento SET fecha_solicitud='$fechaActual' WHERE id_seguimiento='$idAlumno';";
			}
		}
		$redireccion = 'solicitudTitulo.php';
		break;
	case 2:
		//Traigo el control para ver si el archivo ya se encuentra en el sistema
		$controlArchivo = $_REQUEST['controlArchivo'];
		if($controlArchivo==0){
			//Traigo los datos del archivo de la resolucion para despues agregar la direccion en la tabla numero de resolucion
			$nombre_archivoPdf = $_FILES['archivoPdf']['name'];
			$tipo_archivo = $_FILES['archivoPdf']['type'];	
			$tamano_archivo = $_FILES['archivoPdf']['size'];
			$filePdf = $_FILES['archivoPdf']['tmp_name'];

			$ftp_server = "190.114.198.126";
			$ftp_user_name = "fernandoserassioextension";
			$ftp_user_pass = "fernando2013";
			$destino_Pdf = "web/SeguimientoTitulo/archivos/".$nombre_archivoPdf;
			$destinoPdf = "archivos/".$nombre_archivoPdf;
			$vacio = "archivos/";



			//conexión
			$conn_id = ftp_connect($ftp_server); 
			// logeo
			$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass); 


			//probando conexion
			//if ((!$conn_id) || (!$login_result)){ 
			//       echo "Conexión al FTP con errores!";
			//       echo "Intentando conectar a $ftp_server for user $ftp_user_name"; 
			//       exit; 
			//   }else{
			//       echo "Conectado a $ftp_server, for user $ftp_user_name";
			//   }

			$resultadoPdf = explode(".", $nombre_archivoPdf);
			$totalPdf=count($resultadoPdf);
			$ip = $totalPdf - 1;
			if ($nombre_archivoPdf <> NULL){
				if ($resultadoPdf[$ip] == "pdf" || $resultadoPdf[$ip] == "doc" || $resultadoPdf[$ip] == "docx") {
					// archivo a copiar/subir
							$uploadPdf = ftp_put($conn_id, $destino_Pdf, $filePdf, FTP_BINARY);
						}else{
							//mostrarMensaje('El archivo subido no es valido. Suba un PDF, DOC o DOCX',$redireccionTmp);
							$errorPdf = 1;
				}
			}
		}
		//Traigo el numero de resolucion y busco si no esta guardado. En caso de que
		//este guardado, si esta guardado busco el id en la tabla de numero resolucion, si no lo creo.
		$numeroResolucion = $_REQUEST['nroResolucion'];
		$fechaResolucion = $_REQUEST['fechaResolucion'];
		$condicion = "numero_res ='rec-".$numeroResolucion."'";
		$cantidad = contarRegistro('id_numero_resolucion','numero_resolucion',$condicion);
		if($cantidad == 0){
			$idNumeroRes = traerId('numero_resolucion');
			$numeroResolucionGuardar = 'rec-'.$numeroResolucion;
			$sqlNuevoNroResolucion = "INSERT INTO numero_resolucion(id_numero_resolucion,numero_res,direccion_res) VALUES($idNumeroRes,'$numeroResolucionGuardar','$destinoPdf');";
		}else{
			$sqlNuevoNroResolucion = "";
			$rowIdNumeroRes = pg_fetch_array(traerSqlCondicion('id_numero_resolucion','numero_resolucion',$condicion));
			$idNumeroRes = $rowIdNumeroRes['id_numero_resolucion'];
		}

		for($i=0;$i<$longVector;$i++){
			$idAlumno = $vPasar[$i];
			if($idAlumno!=''){
				$sqlGuardar = $sqlGuardar."UPDATE seguimiento SET fecha_rescd='$fechaResolucion',num_res_cd_fk='$idNumeroRes' WHERE id_seguimiento='$idAlumno';";
			}
		}
		$sqlGuardar = $sqlNuevoNroResolucion.$sqlGuardar;
		$redireccion = 'resolucionCd.php';
		$redireccionTmp = "confirmarSeleccion.php?etapa=$etapa&longVector=$longVector&textPasar=$textPasar&nroResolucion=$numeroResolucion&fechaResolucion=$fechaResolucion";
		break;
	case 3:
		//Traigo el control para ver si el archivo ya se encuentra en el sistema
		$controlArchivo = $_REQUEST['controlArchivo'];
		if($controlArchivo==0){
			//Traigo los datos del archivo de la resolucion para despues agregar la direccion en la tabla numero de resolucion
			$nombre_archivoPdf = $_FILES['archivoPdf']['name'];
			$tipo_archivo = $_FILES['archivoPdf']['type'];	
			$tamano_archivo = $_FILES['archivoPdf']['size'];
			$filePdf = $_FILES['archivoPdf']['tmp_name'];

			$ftp_server = "190.114.198.126";
			$ftp_user_name = "fernandoserassioextension";
			$ftp_user_pass = "fernando2013";
			$destino_Pdf = "web/SeguimientoTitulo/archivos/".$nombre_archivoPdf;
			$destinoPdf = "archivos/".$nombre_archivoPdf;
			$vacio = "archivos/";



			//conexión
			$conn_id = ftp_connect($ftp_server); 
			// logeo
			$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass); 


			//probando conexion
			//if ((!$conn_id) || (!$login_result)){ 
			//       echo "Conexión al FTP con errores!";
			//       echo "Intentando conectar a $ftp_server for user $ftp_user_name"; 
			//       exit; 
			//   }else{
			//       echo "Conectado a $ftp_server, for user $ftp_user_name";
			//   }

			$resultadoPdf = explode(".", $nombre_archivoPdf);
			$totalPdf=count($resultadoPdf);
			$ip = $totalPdf - 1;
			if ($nombre_archivoPdf <> NULL){
				if ($resultadoPdf[$ip] == "pdf" || $resultadoPdf[$ip] == "doc" || $resultadoPdf[$ip] == "docx") {
					// archivo a copiar/subir
							$uploadPdf = ftp_put($conn_id, $destino_Pdf, $filePdf, FTP_BINARY);
						}else{
							//mostrarMensaje('El archivo subido no es valido. Suba un PDF, DOC o DOCX',$redireccionTmp);
							$errorPdf = 1;
				}
			}
		}
		$numeroNota = $_REQUEST['nroNota'];
		$fechaNota = $_REQUEST['fechaNota'];
		$condicion = "numero_nota ='".$numeroNota."'";
		$cantidad = contarRegistro('id_numero_nota_rectorado','numero_nota_rectorado',$condicion);
		if($cantidad == 0){
			$idNumeroNota = traerId('numero_nota_rectorado');
			$sqlNuevoNroNota = "INSERT INTO numero_nota_rectorado(id_numero_nota_rectorado,numero_nota,direccion_nota) VALUES($idNumeroNota,'$numeroNota','$destinoPdf');";
		}else{
			$sqlNuevoNroNota = "";
			$rowIdNumeroNota = pg_fetch_array(traerSqlCondicion('id_numero_nota_rectorado','numero_nota_rectorado',$condicion));
			$idNumeroNota = $rowIdNumeroNota['id_numero_nota_rectorado'];
		}
		for($i=0;$i<$longVector;$i++){
			$idAlumno = $vPasar[$i];
			if($idAlumno!=''){
				$sqlGuardar = $sqlGuardar."UPDATE seguimiento SET fecha_nota_envio_rec='$fechaNota',num_nota_fk='$idNumeroNota' WHERE id_seguimiento='$idAlumno';";
			}
		}
		$sqlGuardar = $sqlNuevoNroNota.$sqlGuardar;
		$redireccion = 'notaEnvioRectorado.php?nroNota='.$numeroNota.'&fechaNota='.$fechaNota;
		$redireccionTmp = "confirmarSeleccion.php?etapa=$etapa&longVector=$longVector&textPasar=$textPasar&nroNota=$numeroNota&fechaNota=$fechaNota";
		break;
	case 4:
		//Traigo el control para ver si el archivo ya se encuentra en el sistema
		$controlArchivo = $_REQUEST['controlArchivo'];
		if($controlArchivo==0){
			//Traigo los datos del archivo de la resolucion para despues agregar la direccion en la tabla numero de resolucion
			$nombre_archivoPdf = $_FILES['archivoPdf']['name'];
			$tipo_archivo = $_FILES['archivoPdf']['type'];	
			$tamano_archivo = $_FILES['archivoPdf']['size'];
			$filePdf = $_FILES['archivoPdf']['tmp_name'];

			$ftp_server = "190.114.198.126";
			$ftp_user_name = "fernandoserassioextension";
			$ftp_user_pass = "fernando2013";
			$destino_Pdf = "web/SeguimientoTitulo/archivos/".$nombre_archivoPdf;
			$destinoPdf = "archivos/".$nombre_archivoPdf;
			$vacio = "archivos/";



			//conexión
			$conn_id = ftp_connect($ftp_server); 
			// logeo
			$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass); 


			//probando conexion
			//if ((!$conn_id) || (!$login_result)){ 
			//       echo "Conexión al FTP con errores!";
			//       echo "Intentando conectar a $ftp_server for user $ftp_user_name"; 
			//       exit; 
			//   }else{
			//       echo "Conectado a $ftp_server, for user $ftp_user_name";
			//   }

			$resultadoPdf = explode(".", $nombre_archivoPdf);
			$totalPdf=count($resultadoPdf);
			$ip = $totalPdf - 1;
			if ($nombre_archivoPdf <> NULL){
				if ($resultadoPdf[$ip] == "pdf" || $resultadoPdf[$ip] == "doc" || $resultadoPdf[$ip] == "docx") {
					// archivo a copiar/subir
							$uploadPdf = ftp_put($conn_id, $destino_Pdf, $filePdf, FTP_BINARY);
						}else{
							$errorPdf = 1;
				}
			}
		}
		$numeroResolucion = $_REQUEST['nroResolucion'];
		$fechaResolucion = $_REQUEST['fechaResolucion'];
		$condicion = "numero_res ='res-".$numeroResolucion."'";
		$cantidad = contarRegistro('id_numero_resolucion','numero_resolucion',$condicion);
		if($cantidad == 0){
			$idNumeroRes = traerId('numero_resolucion');
			$numeroResolucionGuardar = 'res-'.$numeroResolucion;
			$sqlNuevoNroResolucion = "INSERT INTO numero_resolucion(id_numero_resolucion,numero_res,direccion_res) VALUES($idNumeroRes,'$numeroResolucionGuardar','$destinoPdf');";
		}else{
			$sqlNuevoNroResolucion = "";
			$rowIdNumeroRes = pg_fetch_array(traerSqlCondicion('id_numero_resolucion','numero_resolucion',$condicion));
			$idNumeroRes = $rowIdNumeroRes['id_numero_resolucion'];
		}

		for($i=0;$i<$longVector;$i++){
			$idAlumno = $vPasar[$i];
			if($idAlumno!=''){
				$sqlGuardar = $sqlGuardar."UPDATE seguimiento SET fecha_rescs='$fechaResolucion',num_res_cs_fk='$idNumeroRes' WHERE id_seguimiento='$idAlumno';";
			}
		}
		$sqlGuardar = $sqlNuevoNroResolucion.$sqlGuardar;
		$redireccion = 'resolucionCs.php?nroResolucion='.$numeroResolucion.'&fechaResolucion='.$fechaResolucion;
		$redireccionTmp = "confirmarSeleccion.php?etapa=$etapa&longVector=$longVector&textPasar=$textPasar&nroResolucion=$numeroResolucion&fechaResolucion=$fechaResolucion";		
		break;
	case 5:
		$fechaIngreso = $_REQUEST['fechaIngreso'];
		for($i=0;$i<$longVector;$i++){
			$idAlumno = $vPasar[$i];
			if($idAlumno!=''){
				$sqlGuardar = $sqlGuardar."UPDATE seguimiento SET fecha_ingreso_diploma='$fechaIngreso' WHERE id_seguimiento='$idAlumno';";
			}
		}
		$redireccion = 'ingresoDiploma.php';
		break;
	case 6:
		$fechaIngreso = $_REQUEST['fechaIngreso'];
		for($i=0;$i<$longVector;$i++){
			$idAlumno = $vPasar[$i];
			if($idAlumno!=''){
				$sqlGuardar = $sqlGuardar."UPDATE seguimiento SET fecha_ingreso_analitico='$fechaIngreso' WHERE id_seguimiento='$idAlumno';";
			}
		}
		$redireccion = 'ingresoAnalitico.php';
		break;
	case 7:
		for($i=0;$i<$longVector;$i++){
			$idAlumno = $vPasar[$i];
			if($idAlumno!=''){
				$sqlGuardar = $sqlGuardar."UPDATE seguimiento SET fecha_retiro_diploma='$fechaActual' WHERE id_seguimiento='$idAlumno';";
			}
		}
		$redireccion = 'entregaDiploma.php';
		break;
	case 8:
		for($i=0;$i<$longVector;$i++){
			$idAlumno = $vPasar[$i];
			if($idAlumno!=''){
				$sqlGuardar = $sqlGuardar."UPDATE seguimiento SET fecha_retiro_analitico='$fechaActual' WHERE id_seguimiento='$idAlumno';";
			}
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