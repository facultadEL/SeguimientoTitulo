<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<?php
include_once "conexion.php";

$esp = '&nbsp;&nbsp;';

$id_Alumno = $_REQUEST['idAlumno'];
	if ($id_Alumno == NULL){
		//$id_Alumno = $_REQUEST['id_alumno'];
		$nombre_alumno = ucwords($_REQUEST['nombre_alumno']);
		$apellido_alumno = ucwords($_REQUEST['apellido_alumno']);
		$nro_legajo = $_REQUEST['nro_legajo'];
		$tipodni_alumno = $_REQUEST['tipodni_alumno'];
		$numerodni_alumno = $_REQUEST['numerodni_alumno'];
		$fechanacimiento_alumno = $_REQUEST['fechanacimiento_alumno'];
		$localidad_nacimiento_alumno = ucwords($_REQUEST['localidad_nacimiento_alumno']);
		$provincia_viviendo_alumno = ucwords($_REQUEST['provincia_viviendo_alumno']);
		$localidad_viviendo_alumno = ucwords($_REQUEST['localidad_viviendo_alumno']);
		$cp_alumno = $_REQUEST['cp_alumno'];
		$calle_alumno = ucwords($_REQUEST['calle_alumno']);
		$numerocalle_alumno = $_REQUEST['numerocalle_alumno'];
		$piso_alumno = $_REQUEST['piso_alumno'];
		$dpto_alumno = ucwords($_REQUEST['dpto_alumno']);
		$carrera_alumno = $_REQUEST['carrera_alumno'];
		$caracteristicaF_alumno = $_REQUEST['caracteristicaF_alumno'];
		$telefono_alumno = $_REQUEST['telefono_alumno'];
		$caracteristicaC_alumno = $_REQUEST['caracteristicaC_alumno'];
		$celular_alumno = $_REQUEST['celular_alumno'];
		$mail_alumno = $_REQUEST['mail_alumno'];
		$mail_alumno2 = $_REQUEST['mail_alumno2'];
		$facebook_alumno = ucwords($_REQUEST['facebook_alumno']);
		$twitter_alumno = ucwords($_REQUEST['twitter_alumno']);
		$password_alumno = $_REQUEST['password_alumno'];
		$provincia_trabajo_alumno = ucwords($_REQUEST['provincia_trabajo_alumno']);
		$localidad_trabajo_alumno = ucwords($_REQUEST['localidad_trabajo_alumno']);
		$cp_alumno2 = $_REQUEST['cp_alumno2'];
		$empresa_trabaja_alumno = ucwords($_REQUEST['empresa_trabaja_alumno']);
		$perfil_laboral_alumno = ucfirst($_REQUEST['perfil_laboral_alumno']);
		$destinoImagen = $_REQUEST['foto_alumno'];
		$ultima_materia_alumno = ucwords($_REQUEST['ultima_materia_alumno']);
		$fecha_ultima_mat_alumno = $_REQUEST['fecha_ultima_mat_alumno'];
		// $ancho_final = $_REQUEST['ancho_final'];
		// $alto_final = $_REQUEST['alto_final'];
		$hidden1 = $_REQUEST['hidden1'];
		$hidden2 = $_REQUEST['hidden2'];
		$fecreg = date('Y-m-d');
		
		$sep = '/-/';
		$datosPasar = $nombre_alumno.$sep.$apellido_alumno.$sep.$nro_legajo.$sep.$tipodni_alumno.$sep.$numerodni_alumno.$sep.$fecha_nacimiento_alumno.$sep.$provincia_viviendo_alumno.$sep.$localidad_viviendo_alumno.$sep.$cp_alumno.$sep.$calle_alumno.$sep.$numerocalle_alumno.$sep.$piso_alumno.$sep.$dpto_alumno.$sep.$carrera_alumno.$sep.$caracteristicaF_alumno.$sep.$telefono_alumno.$sep.$caracteristicaC_alumno.$sep.$celular_alumno.$sep.$mail_alumno.$sep.$mail_alumno2.$sep.$facebook_alumno.$sep.$twitter_alumno.$sep.$password_alumno.$sep.$provincia_trabajo_alumno.$sep.$localidad_trabajo_alumno.$sep.$cp_alumno2.$sep.$empresa_trabaja_alumno.$sep.$perfil_laboral_alumno.$sep.$destinoImagen.$sep.$localidad_nacimiento_alumno.$sep.$ultima_materia_alumno.$sep.$fecha_ultima_mat_alumno.$sep.$hidden1.$sep.$hidden2.$sep.$fecreg;
		
		//$nombre_foto = $_FILES['fotoAlumno']['name'];
		$nombreFoto = $_FILES['fotoAlumno']['name'];
		$tipo_archivo = $_FILES['fotoAlumno']['type'];	
		$tamano_archivo = $_FILES['fotoAlumno']['size'];
		$archivo_foto = $_FILES['fotoAlumno']['tmp_name'];
		
		//en el siguiente paso le quito los espacios al nombre de la foto para evitar problemas.
		$nombre_foto = str_replace(" ", "-", $nombreFoto);

		$ftp_server = "190.114.198.126";
		$ftp_user_name = "fernandoserassioextension";
		$ftp_user_pass = "fernando2013";
		$destino_Imagen = "web/SeguimientoTitulo/Graduado/fotos/".$nombre_foto;
		$destinoImagen = "fotos/".$nombre_foto;
				
		//conexión
		$conn_id = ftp_connect($ftp_server); 
		// logeo
		$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

		$imagen = explode(".", $nombre_foto);
		$totalImagen=count($imagen);
		$formato = $totalImagen - 1;
		if ($nombre_foto != ""){
			if ($imagen[$formato] == "jpeg" || $imagen[$formato] == "jpg" || $imagen[$formato] == "png") {
			// archivo a copiar/subir
				$upload = ftp_put($conn_id, $destino_Imagen, $archivo_foto, FTP_BINARY);
			}else{
				echo '<script type="text/javascript">alert("El archivo subido no es válido. Suba algunos de estos formatos: - jpg - jpeg - png");
													window.location="registrarGraduado.php?volver=1&verDatos='.$datosPasar.'";	
					  </script>';
			}
		}else{
			$destinoImagen = NULL;
		}
		// cerramos
		ftp_close($conn_id);
		
		if ($imagen[$formato] == "jpeg" || $imagen[$formato] == "jpg"){

		$imagen_origen = imagecreatefromjpeg($destinoImagen);
		//obtengo el ancho de la imagen original
		$ancho_origen = imagesx($imagen_origen);
		//obtengo el alto de la imagen original
		$alto_origen = imagesy($imagen_origen);
		
		$ancho=600;
		$alto=400;
		
		if($ancho_origen>$alto_origen){
		//foto horizontal
			$ancho_final=$ancho;
			$alto_final=$alto_origen*$ancho_final/$ancho_origen;    
		}else{
		//fotos verticales
			$alto_final=$alto;
			$ancho_final=$ancho_origen*$alto_final/$alto_origen;
		}
		// creo la imagen con el tamaño que le pase
		$imagen_destino = imagecreatetruecolor($ancho_final ,$alto_final );

		imagecopyresized( $imagen_destino, $imagen_origen, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho_origen, $alto_origen);
		
		//guardo la nueva foto (nuevaFoto, destino, calidad)
		imagejpeg( $imagen_destino,$destinoImagen,100 );
		}
		
		if ($imagen[$formato] == "png") {
		$imagen_origen = imagecreatefrompng($destinoImagen);
		//obtengo el ancho de la imagen original
		$ancho_origen = imagesx($imagen_origen);
		//obtengo el alto de la imagen original
		$alto_origen = imagesy($imagen_origen);
		
		$ancho=600;
		$alto=400;
		
		if($ancho_origen>$alto_origen){
		//foto horizontal
			$ancho_final=$ancho;
			$alto_final=$alto_origen*$ancho_final/$ancho_origen;    
		}else{
		//fotos verticales
			$alto_final=$alto;
			$ancho_final=$ancho_origen*$alto_final/$alto_origen;
		}
		// creo la imagen con el tamaño que le pase
		$imagen_destino = imagecreatetruecolor($ancho_final ,$alto_final );
		
		//Copio y cambio el tamaño de la imagen
		imagecopyresized( $imagen_destino, $imagen_origen, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho_origen, $alto_origen);
		
		//guardo la nueva foto (nuevaFoto, destino, calidad)
		imagepng( $imagen_destino,$destinoImagen,9 );
		}

		$consultaNivel = pg_query("SELECT nivel_carrera_fk FROM carrera WHERE id_carrera = $carrera_alumno");
		$rowNivCar = pg_fetch_array($consultaNivel);
		$nivel_carrera_fk = $rowNivCar['nivel_carrera_fk'];

		$consultaMax = pg_query("SELECT max(id_alumno) FROM alumno");
		$rowMax = pg_fetch_array($consultaMax);
		$maximoAlumno = $rowMax['max'];
		$maximoAlumno = $maximoAlumno + 1;
		$id_Alumno = $maximoAlumno;
		
		$sqlMaxId = pg_query("SELECT max(id_seguimiento) FROM seguimiento");
		$rowMaxId = pg_fetch_array($sqlMaxId);
			$maxId = $rowMaxId['max'] + 1;
			$fechaSolicitud = date('Y').'-'.date('m').'-'.date('d');

		$codigo_impresion = $hidden1.'.'.$nro_legajo.$hidden2;
		$newAlumno="INSERT INTO alumno(id_alumno, nombre_alumno, apellido_alumno, nro_legajo, tipodni_alumno, numerodni_alumno, fechanacimiento_alumno,localidad_nacimiento_alumno, localidad_viviendo_alumno, provincia_viviendo_alumno, cp_alumno, calle_alumno, numerocalle_alumno, piso_alumno, dpto_alumno, foto_alumno, caracteristicaf_alumno, telefono_alumno, caracteristicac_alumno, celular_alumno, mail_alumno, mail_alumno2, facebook_alumno, twitter_alumno, password_alumno, localidad_trabajo_alumno, provincia_trabajo_alumno, cp_alumno2, empresa_trabaja_alumno, perfil_laboral_alumno, ancho_final, alto_final, ultima_materia_alumno, fecha_ultima_mat_alumno,codigo_impresion,fecreg)VALUES('$id_Alumno','$nombre_alumno','$apellido_alumno','$nro_legajo','$tipodni_alumno','$numerodni_alumno','$fechanacimiento_alumno','$localidad_nacimiento_alumno','$localidad_viviendo_alumno','$provincia_viviendo_alumno','$cp_alumno','$calle_alumno','$numerocalle_alumno','$piso_alumno','$dpto_alumno','$destinoImagen','$caracteristicaF_alumno','$telefono_alumno','$caracteristicaC_alumno','$celular_alumno','$mail_alumno','$mail_alumno2','$facebook_alumno','$twitter_alumno','$password_alumno','$localidad_trabajo_alumno','$provincia_trabajo_alumno','$cp_alumno2','$empresa_trabaja_alumno','$perfil_laboral_alumno','$ancho_final','$alto_final','$ultima_materia_alumno','$fecha_ultima_mat_alumno','$codigo_impresion','$fecreg');";
		$nuevoSeguimiento = "INSERT INTO seguimiento(id_seguimiento, alumno_fk, carrera_fk, num_res_cd_fk, num_nota_fk, num_res_cs_fk) VALUES('$maxId','$id_Alumno','$carrera_alumno',NULL,NULL,NULL);";
							 
		$sql = $newAlumno.$nuevoSeguimiento;
		//echo $sql;
			$error=0;
			if (!pg_query($conn, $sql)){
				$errorpg = pg_last_error($conn);
				$termino = "ROLLBACK";
				$error=1;
			}else{
				$termino = "COMMIT";
			}
		   	pg_query($termino);
				
		if ($error==1){
			echo '<script language="JavaScript"> 			alert("Los datos no se guardaron correctamente. Pongase en contacto con el administrador");</script>';
			//echo $errorpg;
		}else{
			// if ($nivel_carrera_fk == 1) {//carrera de grado
			// 	echo '<script language="JavaScript"> alert("Los datos se guardaron correctamente."); window.location = "imprimirGraduado1.php?idAlumno='.$id_Alumno.'";</script>';
			// }
			// if ($nivel_carrera_fk == 2) {//carrera de posgrado
			// 	echo '<script language="JavaScript"> alert("Los datos se guardaron correctamente."); window.location = "imprimirGraduado2.php?idAlumno='.$id_Alumno.'";</script>';
			// }
			// if ($nivel_carrera_fk == 3) {//carrera de pregrado
			// 	echo '<script language="JavaScript"> alert("Los datos se guardaron correctamente."); window.location = "imprimirGraduado3.php?idAlumno='.$id_Alumno.'";</script>';
			// }
			echo '<script language="JavaScript"> alert("Los datos se guardaron correctamente."); window.location = "verAlumno.php?idAlumno='.$id_Alumno.'&titulo_alumno='.$carrera_alumno.'";</script>';
		}
	}else{
		//aca va el update


		//$id_Alumno = $_REQUEST['idAlumno'];
		$nombre_alumno = ucwords($_REQUEST['nombre_alumno']);
		$apellido_alumno = ucwords($_REQUEST['apellido_alumno']);
		$nro_legajo = $_REQUEST['nro_legajo'];
		$tipodni_alumno = $_REQUEST['tipodni_alumno'];
		$numerodni_alumno = $_REQUEST['numerodni_alumno'];
		$fechanacimiento_alumno = $_REQUEST['fechanacimiento_alumno'];
		$localidad_nacimiento_alumno = ucwords($_REQUEST['localidad_nacimiento_alumno']);
		$provincia_viviendo_alumno = ucwords($_REQUEST['provincia_viviendo_alumno']);
		$localidad_viviendo_alumno = ucwords($_REQUEST['localidad_viviendo_alumno']);
		$cp_alumno = $_REQUEST['cp_alumno'];
		$calle_alumno = ucwords($_REQUEST['calle_alumno']);
		$numerocalle_alumno = $_REQUEST['numerocalle_alumno'];
		$piso_alumno = $_REQUEST['piso_alumno'];
		$dpto_alumno = ucwords($_REQUEST['dpto_alumno']);
		$carrera_alumno = $_REQUEST['carrera_alumno'];
		$caracteristicaF_alumno = $_REQUEST['caracteristicaF_alumno'];
		$telefono_alumno = $_REQUEST['telefono_alumno'];
		$caracteristicaC_alumno = $_REQUEST['caracteristicaC_alumno'];
		$celular_alumno = $_REQUEST['celular_alumno'];
		$mail_alumno = $_REQUEST['mail_alumno'];
		$mail_alumno2 = $_REQUEST['mail_alumno2'];
		$facebook_alumno = ucwords($_REQUEST['facebook_alumno']);
		$twitter_alumno = ucwords($_REQUEST['twitter_alumno']);
		$password_alumno = $_REQUEST['password_alumno'];
		$provincia_trabajo_alumno = ucwords($_REQUEST['provincia_trabajo_alumno']);
		$localidad_trabajo_alumno = ucwords($_REQUEST['localidad_trabajo_alumno']);
		$cp_alumno2 = $_REQUEST['cp_alumno2'];
		$empresa_trabaja_alumno = ucwords($_REQUEST['empresa_trabaja_alumno']);
		$perfil_laboral_alumno = ucfirst($_REQUEST['perfil_laboral_alumno']);
		$destinoImagen = $_REQUEST['foto_alumno'];
		$ultima_materia_alumno = ucwords($_REQUEST['ultima_materia_alumno']);
		$fecha_ultima_mat_alumno = $_REQUEST['fecha_ultima_mat_alumno'];
		// $ancho_final = $_REQUEST['ancho_final'];
		// $alto_final = $_REQUEST['alto_final'];
		
		$sep = '/-/';
		$datosPasar = $nombre_alumno.$sep.$apellido_alumno.$sep.$nro_legajo.$sep.$tipodni_alumno.$sep.$numerodni_alumno.$sep.$fecha_nacimiento_alumno.$sep.$provincia_viviendo_alumno.$sep.$localidad_viviendo_alumno.$sep.$cp_alumno.$sep.$calle_alumno.$sep.$numerocalle_alumno.$sep.$piso_alumno.$sep.$dpto_alumno.$sep.$carrera_alumno.$sep.$caracteristicaF_alumno.$sep.$telefono_alumno.$sep.$caracteristicaC_alumno.$sep.$celular_alumno.$sep.$mail_alumno.$sep.$mail_alumno2.$sep.$facebook_alumno.$sep.$twitter_alumno.$sep.$password_alumno.$sep.$provincia_trabajo_alumno.$sep.$localidad_trabajo_alumno.$sep.$cp_alumno2.$sep.$empresa_trabaja_alumno.$sep.$perfil_laboral_alumno.$sep.$destinoImagen.$sep.$localidad_nacimiento_alumno.$sep.$ultima_materia_alumno.$sep.$fecha_ultima_mat_alumno;

		$nombreFoto = $_FILES['fotoAlumno']['name'];
		$tipo_archivo = $_FILES['fotoAlumno']['type'];	
		$tamano_archivo = $_FILES['fotoAlumno']['size'];
		$archivo_foto = $_FILES['fotoAlumno']['tmp_name'];
		
		
		//en el siguiente paso le quito los espacios al nombre de la foto para evitar problemas.
		$nombre_foto = str_replace(" ", "-", $nombreFoto);
		
		if($nombre_foto == NULL){
			$sqlFoto = pg_query("SELECT foto_alumno,ancho_final,alto_final FROM alumno WHERE id_alumno = $id_Alumno");
			$rowFoto = pg_fetch_array($sqlFoto);
			
			$destinoImagen = $rowFoto['foto_alumno'];
			$ancho_final = $rowFoto['ancho_final'];
			$alto_final = $rowFoto['alto_final'];
			
			
			
		}else{
			
			$ftp_server = "190.114.198.126";
			$ftp_user_name = "fernandoserassioextension";
			$ftp_user_pass = "fernando2013";
			$destino_Imagen = "web/SeguimientoTitulo/Graduado/fotos/".$nombre_foto;
			$destinoImagen = "fotos/".$nombre_foto;
					
			//conexión
			$conn_id = ftp_connect($ftp_server); 
			// logeo
			$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

			$imagen = explode(".", $nombre_foto);
			$totalImagen=count($imagen);
			$formato = $totalImagen - 1;
			
				if ($imagen[$formato] == "jpeg" || $imagen[$formato] == "jpg" || $imagen[$formato] == "png") {
				// archivo a copiar/subir
					$upload = ftp_put($conn_id, $destino_Imagen, $archivo_foto, FTP_BINARY);
				}else{
					echo '<script type="text/javascript">alert("El archivo subido no es válido. Suba algunos de estos formatos: - jpg - jpeg - png");
														window.location="registrarGraduado.php?volver=1&verDatos='.$datosPasar.'";	
						  </script>';
				}
			
			// cerramos
			ftp_close($conn_id);
			
			if ($imagen[$formato] == "jpeg" || $imagen[$formato] == "jpg"){

			$imagen_origen = imagecreatefromjpeg($destinoImagen);
			//obtengo el ancho de la imagen original
			$ancho_origen = imagesx($imagen_origen);
			//obtengo el alto de la imagen original
			$alto_origen = imagesy($imagen_origen);
			
			$ancho=600;
			$alto=400;
			
			if($ancho_origen>$alto_origen){
			//foto horizontal
				$ancho_final=$ancho;
				$alto_final=$alto_origen*$ancho_final/$ancho_origen;    
			}else{
			//fotos verticales
				$alto_final=$alto;
				$ancho_final=$ancho_origen*$alto_final/$alto_origen;
			}
			// creo la imagen con el tamaño que le pase
			$imagen_destino = imagecreatetruecolor($ancho_final ,$alto_final );

			imagecopyresized( $imagen_destino, $imagen_origen, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho_origen, $alto_origen);
			
			//guardo la nueva foto (nuevaFoto, destino, calidad)
			imagejpeg( $imagen_destino,$destinoImagen,100 );
			}
			
			if ($imagen[$formato] == "png") {
			$imagen_origen = imagecreatefrompng($destinoImagen);
			//obtengo el ancho de la imagen original
			$ancho_origen = imagesx($imagen_origen);
			//obtengo el alto de la imagen original
			$alto_origen = imagesy($imagen_origen);
			
			$ancho=600;
			$alto=400;
			
			if($ancho_origen>$alto_origen){
			//foto horizontal
				$ancho_final=$ancho;
				$alto_final=$alto_origen*$ancho_final/$ancho_origen;    
			}else{
			//fotos verticales
				$alto_final=$alto;
				$ancho_final=$ancho_origen*$alto_final/$alto_origen;
			}
			// creo la imagen con el tamaño que le pase
			$imagen_destino = imagecreatetruecolor($ancho_final ,$alto_final );
			
			//Copio y cambio el tamaño de la imagen
			imagecopyresized( $imagen_destino, $imagen_origen, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho_origen, $alto_origen);
			
			//guardo la nueva foto (nuevaFoto, destino, calidad)
			imagepng( $imagen_destino,$destinoImagen,9 );
			}
		
		}
		//update
		$consultaNivel = pg_query("SELECT nivel_carrera_fk FROM carrera WHERE id_carrera = $carrera_alumno");
		$rowNivCar = pg_fetch_array($consultaNivel);
		$nivel_carrera_fk = $rowNivCar['nivel_carrera_fk'];


		$sqlMaxId = pg_query("SELECT max(id_seguimiento) FROM seguimiento");
		$rowMaxId = pg_fetch_array($sqlMaxId);
			$maxId = $rowMaxId['max'] + 1;

		
		$cont = 0;
		$sqlCarrera = pg_query("SELECT carrera_fk FROM seguimiento WHERE alumno_fk = '$id_Alumno'");
		//$rowCarrera = pg_fetch_array($sqlCarrera);
		while($rowCarrera = pg_fetch_array($sqlCarrera)){
			if($carrera_alumno == $rowCarrera['carrera_fk']){
				$cont++;
			}
		}
		$modAlumno="UPDATE alumno SET nombre_alumno='$nombre_alumno', apellido_alumno='$apellido_alumno', nro_legajo='$nro_legajo', tipodni_alumno='$tipodni_alumno', numerodni_alumno='$numerodni_alumno', fechanacimiento_alumno='$fechanacimiento_alumno',localidad_nacimiento_alumno='$localidad_nacimiento_alumno', localidad_viviendo_alumno='$localidad_viviendo_alumno', provincia_viviendo_alumno='$provincia_viviendo_alumno', cp_alumno='$cp_alumno', calle_alumno='$calle_alumno', numerocalle_alumno='$numerocalle_alumno', piso_alumno='$piso_alumno', dpto_alumno='$dpto_alumno', foto_alumno='$destinoImagen', caracteristicaf_alumno='$caracteristicaF_alumno', telefono_alumno='$telefono_alumno', caracteristicac_alumno='$caracteristicaC_alumno', celular_alumno='$celular_alumno', mail_alumno='$mail_alumno', mail_alumno2='$mail_alumno2', facebook_alumno='$facebook_alumno', twitter_alumno='$twitter_alumno', password_alumno='$password_alumno', localidad_trabajo_alumno='$localidad_trabajo_alumno', provincia_trabajo_alumno='$provincia_trabajo_alumno', cp_alumno2='$cp_alumno2', empresa_trabaja_alumno='$empresa_trabaja_alumno', perfil_laboral_alumno='$perfil_laboral_alumno', ancho_final='$ancho_final', alto_final='$alto_final', ultima_materia_alumno='$ultima_materia_alumno', fecha_ultima_mat_alumno='$fecha_ultima_mat_alumno' WHERE id_alumno = $id_Alumno;";
		if($cont == 0){
			$nuevoSeguimiento = "INSERT INTO seguimiento(id_seguimiento, alumno_fk, carrera_fk, num_res_cd_fk, num_nota_fk, num_res_cs_fk) VALUES('$maxId','$id_Alumno','$carrera_alumno',NULL,NULL,NULL);";
			$sql = $modAlumno.$nuevoSeguimiento;
		}else{
			$sql= $modAlumno;
		}
			$error=0;
		echo $sql;
			if (!pg_query($conn, $sql)){
				$errorpg = pg_last_error($conn);
				$termino = "ROLLBACK";
				$error=1;
			}else{
				$termino = "COMMIT";
			}
		   pg_query($termino);
				
		if ($error==1){
			echo '<script language="JavaScript"> alert("Los datos no se modificaron correctamente. Pongase en contacto con el administrador");</script>';
		}else{
			// if ($nivel_carrera_fk == 1) {//carrera de grado
			// 	echo '<script language="JavaScript"> alert("Los datos se actualizaron correctamente."); window.location = "imprimirGraduado1.php?idAlumno='.$id_Alumno.'";</script>';
			// }
			// if ($nivel_carrera_fk == 2) {//carrera de posgrado
			// 	echo '<script language="JavaScript"> alert("Los datos se actualizaron correctamente."); window.location = "imprimirGraduado2.php?idAlumno='.$id_Alumno.'";</script>';
			// }
			// if ($nivel_carrera_fk == 3) {//carrera de pregrado
			// 	echo '<script language="JavaScript"> alert("Los datos se actualizaron correctamente."); window.location = "imprimirGraduado3.php?idAlumno='.$id_Alumno.'";</script>';
			// }
			echo '<script language="JavaScript"> alert("Los datos se actualizaron correctamente."); window.location = "verAlumno.php?idAlumno='.$id_Alumno.'&titulo_alumno='.$carrera_alumno.'";</script>';
		}
}
?>
</body>
</html>