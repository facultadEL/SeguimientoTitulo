<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<?php
include_once "conexion.php";

$esp = '&nbsp;&nbsp;';

$id_Alumno = (empty($_REQUEST['idAlumno'])) ? 0 : $_REQUEST['idAlumno'];
	if ($id_Alumno == 0){
		//$id_Alumno = $_REQUEST['id_alumno'];
		$nombre_alumno = ucwords(strtolower(trim($_REQUEST['nombre_alumno'])));
		$apellido_alumno = ucwords(strtolower(trim($_REQUEST['apellido_alumno'])));
		$nro_legajo = trim($_REQUEST['nro_legajo']);
		$tipodni_alumno = trim($_REQUEST['tipodni_alumno']);
		$numerodni_alumno = trim($_REQUEST['numerodni_alumno']);
		$fechanacimiento_alumno = trim($_REQUEST['fechanacimiento_alumno']);
		$localidad_nacimiento_alumno = ucwords(trim($_REQUEST['localidad_nacimiento_alumno']));
		$provincia_viviendo_alumno = ucwords(trim($_REQUEST['provincia_viviendo_alumno']));
		$localidad_viviendo_alumno = ucwords(trim($_REQUEST['localidad_viviendo_alumno']));
		$cp_alumno = trim($_REQUEST['cp_alumno']);
		$calle_alumno = ucwords(trim($_REQUEST['calle_alumno']));
		$numerocalle_alumno = trim($_REQUEST['numerocalle_alumno']);
		$piso_alumno = trim($_REQUEST['piso_alumno']);
		$dpto_alumno = ucwords(trim($_REQUEST['dpto_alumno']));
		$carrera_alumno = trim($_REQUEST['carrera_alumno']);
		$caracteristicaF_alumno = empty($_REQUEST['caracteristicaF_alumno']) ? '0' : trim($_REQUEST['caracteristicaF_alumno']);
		$telefono_alumno = empty($_REQUEST['telefono_alumno']) ? '0' : trim($_REQUEST['telefono_alumno']);
		$caracteristicaC_alumno = trim($_REQUEST['caracteristicaC_alumno']);
		$celular_alumno = trim($_REQUEST['celular_alumno']);
		$mail_alumno = trim($_REQUEST['mail_alumno']);
		$mail_alumno2 = trim($_REQUEST['mail_alumno2']);
		$facebook_alumno = ucwords(trim($_REQUEST['facebook_alumno']));
		$twitter_alumno = ucwords(trim($_REQUEST['twitter_alumno']));
		$password_alumno = trim($_REQUEST['password_alumno']);
		$provincia_trabajo_alumno = ucwords(trim($_REQUEST['provincia_trabajo_alumno']));
		$localidad_trabajo_alumno = ucwords(trim($_REQUEST['localidad_trabajo_alumno']));
		//$cp_alumno2 = trim($_REQUEST['cp_alumno2']);
		$cp_alumno2 = empty($_REQUEST['cp_alumno2']) ? '0' : trim($_REQUEST['cp_alumno2']);
		$empresa_trabaja_alumno = ucwords(trim($_REQUEST['empresa_trabaja_alumno']));
		$perfil_laboral_alumno = ucfirst(trim($_REQUEST['perfil_laboral_alumno']));
		$destinoImagen = trim($_REQUEST['foto_alumno']);
		$ultima_materia_alumno = ucwords(trim($_REQUEST['ultima_materia_alumno']));
		$fecha_ultima_mat_alumno = trim($_REQUEST['fecha_ultima_mat_alumno']);
		// $ancho_final = trim($_REQUEST['ancho_final']);
		// $alto_final = trim($_REQUEST['alto_final']);
		$hidden1 = trim($_REQUEST['hidden1']);
		$hidden2 = trim($_REQUEST['hidden2']);
		$fecreg = date('Y-m-d');
		
		$sep = '/-/';
		$datosPasar = $nombre_alumno.$sep.$apellido_alumno.$sep.$nro_legajo.$sep.$tipodni_alumno.$sep.$numerodni_alumno.$sep.$fecha_nacimiento_alumno.$sep.$provincia_viviendo_alumno.$sep.$localidad_viviendo_alumno.$sep.$cp_alumno.$sep.$calle_alumno.$sep.$numerocalle_alumno.$sep.$piso_alumno.$sep.$dpto_alumno.$sep.$carrera_alumno.$sep.$caracteristicaF_alumno.$sep.$telefono_alumno.$sep.$caracteristicaC_alumno.$sep.$celular_alumno.$sep.$mail_alumno.$sep.$mail_alumno2.$sep.$facebook_alumno.$sep.$twitter_alumno.$sep.$password_alumno.$sep.$provincia_trabajo_alumno.$sep.$localidad_trabajo_alumno.$sep.$cp_alumno2.$sep.$empresa_trabaja_alumno.$sep.$perfil_laboral_alumno.$sep.$destinoImagen.$sep.$localidad_nacimiento_alumno.$sep.$ultima_materia_alumno.$sep.$fecha_ultima_mat_alumno.$sep.$hidden1.$sep.$hidden2.$sep.$fecreg;
		
		$nombreFoto = $_FILES['fotoAlumno']['name'];
		$tipo_archivo = $_FILES['fotoAlumno']['type'];	
		$tamano_archivo = $_FILES['fotoAlumno']['size'];
		$archivo_foto = $_FILES['fotoAlumno']['tmp_name'];
		
		$randNumbers = '';
		for($i = 0; $i < 10; $i++)
		{
			$randNumbers .= rand(0,9);
		}

		//Le agrego estas dos lineas para crear un nombre de foto unico conformado por el legajo y el apellido
		$vNombreFoto = explode('.', $nombreFoto);
		$nombre_foto = $apellido_alumno.$nro_legajo.$randNumbers.$vNombreFoto[1];

		//en el siguiente paso le quito los espacios al nombre de la foto para evitar problemas.
		$nombre_foto = str_replace(" ", "-", $nombre_foto);

		$ftp_server = "190.114.198.126";
		$ftp_user_name = "fernandoserassioextension";
		$ftp_user_pass = "fernando2013";
		$destino_Imagen = "web/SeguimientoTitulo/Graduado/fotos/".$nombre_foto;
		$destinoImagen = "fotos/".$nombre_foto;
				
		//conexi�n
		$conn_id = ftp_connect($ftp_server); 
		// logeo
		$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

		$imagen = explode(".", $nombreFoto);
		$totalImagen=count($imagen);
		$formato = $totalImagen - 1;
		if ($nombre_foto != ""){
			if ($imagen[$formato] == "jpeg" || $imagen[$formato] == "jpg" || $imagen[$formato] == "png") {
			// archivo a copiar/subir
				$upload = ftp_put($conn_id, $destino_Imagen, $archivo_foto, FTP_BINARY);
			}else{
				echo '<script type="text/javascript">alert("El archivo subido no es v�lido. Suba algunos de estos formatos: - jpg - jpeg - png");
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
		// creo la imagen con el tama�o que le pase
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
		// creo la imagen con el tama�o que le pase
		$imagen_destino = imagecreatetruecolor($ancho_final ,$alto_final );
		
		//Copio y cambio el tama�o de la imagen
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

		$codigo_impresion = $hidden1.'.'.$maxId.$hidden2;

		$today = date('Y-m-d');

		$newAlumno="INSERT INTO alumno(id_alumno, nombre_alumno, apellido_alumno, nro_legajo, tipodni_alumno, numerodni_alumno, fechanacimiento_alumno,localidad_nacimiento_alumno, localidad_viviendo_alumno, provincia_viviendo_alumno, cp_alumno, calle_alumno, numerocalle_alumno, piso_alumno, dpto_alumno, foto_alumno, caracteristicaf_alumno, telefono_alumno, caracteristicac_alumno, celular_alumno, mail_alumno, mail_alumno2, facebook_alumno, twitter_alumno, password_alumno, localidad_trabajo_alumno, provincia_trabajo_alumno, cp_alumno2, empresa_trabaja_alumno, perfil_laboral_alumno, ancho_final, alto_final, ultima_materia_alumno, fecha_ultima_mat_alumno,codigo_impresion,fecreg)VALUES('$id_Alumno','$nombre_alumno','$apellido_alumno','$nro_legajo','$tipodni_alumno','$numerodni_alumno','$fechanacimiento_alumno','$localidad_nacimiento_alumno','$localidad_viviendo_alumno','$provincia_viviendo_alumno','$cp_alumno','$calle_alumno','$numerocalle_alumno','$piso_alumno','$dpto_alumno','$destinoImagen','$caracteristicaF_alumno','$telefono_alumno','$caracteristicaC_alumno','$celular_alumno','$mail_alumno','$mail_alumno2','$facebook_alumno','$twitter_alumno','$password_alumno','$localidad_trabajo_alumno','$provincia_trabajo_alumno','$cp_alumno2','$empresa_trabaja_alumno','$perfil_laboral_alumno','$ancho_final','$alto_final','$ultima_materia_alumno','$fecha_ultima_mat_alumno','$codigo_impresion','$fecreg');";
		$nuevoSeguimiento = "INSERT INTO seguimiento(id_seguimiento, alumno_fk, carrera_fk, num_res_cd_fk, num_nota_fk, num_res_cs_fk, fecha_registro) VALUES('$maxId','$id_Alumno','$carrera_alumno',NULL,NULL,NULL,'$today');";
							 
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


		//$id_Alumno = trim($_REQUEST['idAlumno']);
		$nombre_alumno = ucwords(trim($_REQUEST['nombre_alumno']));
		$apellido_alumno = ucwords(trim($_REQUEST['apellido_alumno']));
		$nro_legajo = trim($_REQUEST['nro_legajo']);
		$tipodni_alumno = trim($_REQUEST['tipodni_alumno']);
		$numerodni_alumno = trim($_REQUEST['numerodni_alumno']);
		$fechanacimiento_alumno = trim($_REQUEST['fechanacimiento_alumno']);
		$localidad_nacimiento_alumno = ucwords(trim($_REQUEST['localidad_nacimiento_alumno']));
		$provincia_viviendo_alumno = ucwords(trim($_REQUEST['provincia_viviendo_alumno']));
		$localidad_viviendo_alumno = ucwords(trim($_REQUEST['localidad_viviendo_alumno']));
		$cp_alumno = trim($_REQUEST['cp_alumno']);
		$calle_alumno = ucwords(trim($_REQUEST['calle_alumno']));
		$numerocalle_alumno = trim($_REQUEST['numerocalle_alumno']);
		$piso_alumno = trim($_REQUEST['piso_alumno']);
		$dpto_alumno = ucwords(trim($_REQUEST['dpto_alumno']));
		$carrera_alumno = trim($_REQUEST['carrera_alumno']);
		$caracteristicaF_alumno = trim($_REQUEST['caracteristicaF_alumno']);
		$telefono_alumno = trim($_REQUEST['telefono_alumno']);
		$caracteristicaC_alumno = trim($_REQUEST['caracteristicaC_alumno']);
		$celular_alumno = trim($_REQUEST['celular_alumno']);
		$mail_alumno = trim($_REQUEST['mail_alumno']);
		$mail_alumno2 = trim($_REQUEST['mail_alumno2']);
		$facebook_alumno = ucwords(trim($_REQUEST['facebook_alumno']));
		$twitter_alumno = ucwords(trim($_REQUEST['twitter_alumno']));
		$password_alumno = trim($_REQUEST['password_alumno']);
		$provincia_trabajo_alumno = ucwords(trim($_REQUEST['provincia_trabajo_alumno']));
		$localidad_trabajo_alumno = ucwords(trim($_REQUEST['localidad_trabajo_alumno']));
		//$cp_alumno2 = trim($_REQUEST['cp_alumno2']);
		$cp_alumno2 = (empty($_REQUEST['cp_alumno2'])) ? '0' : trim($_REQUEST['cp_alumno2']);
		$empresa_trabaja_alumno = ucwords(trim($_REQUEST['empresa_trabaja_alumno']));
		$perfil_laboral_alumno = ucfirst(trim($_REQUEST['perfil_laboral_alumno']));
		$destinoImagen = trim($_REQUEST['foto_alumno']);
		$ultima_materia_alumno = ucwords(trim($_REQUEST['ultima_materia_alumno']));
		$fecha_ultima_mat_alumno = trim($_REQUEST['fecha_ultima_mat_alumno']);
		// $ancho_final = trim($_REQUEST['ancho_final']);
		// $alto_final = trim($_REQUEST['alto_final']);
		
		$sep = '/-/';
		$datosPasar = $nombre_alumno.$sep.$apellido_alumno.$sep.$nro_legajo.$sep.$tipodni_alumno.$sep.$numerodni_alumno.$sep.$fecha_nacimiento_alumno.$sep.$provincia_viviendo_alumno.$sep.$localidad_viviendo_alumno.$sep.$cp_alumno.$sep.$calle_alumno.$sep.$numerocalle_alumno.$sep.$piso_alumno.$sep.$dpto_alumno.$sep.$carrera_alumno.$sep.$caracteristicaF_alumno.$sep.$telefono_alumno.$sep.$caracteristicaC_alumno.$sep.$celular_alumno.$sep.$mail_alumno.$sep.$mail_alumno2.$sep.$facebook_alumno.$sep.$twitter_alumno.$sep.$password_alumno.$sep.$provincia_trabajo_alumno.$sep.$localidad_trabajo_alumno.$sep.$cp_alumno2.$sep.$empresa_trabaja_alumno.$sep.$perfil_laboral_alumno.$sep.$destinoImagen.$sep.$localidad_nacimiento_alumno.$sep.$ultima_materia_alumno.$sep.$fecha_ultima_mat_alumno;

		$nombreFoto = $_FILES['fotoAlumno']['name'];
		$tipo_archivo = $_FILES['fotoAlumno']['type'];	
		$tamano_archivo = $_FILES['fotoAlumno']['size'];
		$archivo_foto = $_FILES['fotoAlumno']['tmp_name'];
	
		//echo 'N:'.$nombreFoto.'<br>';

		if($nombreFoto == NULL){
			$sqlFoto = pg_query("SELECT foto_alumno,ancho_final,alto_final FROM alumno WHERE id_alumno = $id_Alumno");
			$rowFoto = pg_fetch_array($sqlFoto);
			
			$destinoImagen = $rowFoto['foto_alumno'];
			$ancho_final = $rowFoto['ancho_final'];
			$alto_final = $rowFoto['alto_final'];
			
			
			
		}else{
			//echo 'Entre';
			$randNumbers = '';
			for($i = 0; $i < 10; $i++)
			{
				$randNumbers .= rand(0,9);
			}

			//Le agrego estas dos lineas para crear un nombre de foto unico conformado por el legajo y el apellido
			$vNombreFoto = explode('.', $nombreFoto);
			$nombre_foto = $apellido_alumno.$nro_legajo.$randNumbers.'.'.$vNombreFoto[1];

			//en el siguiente paso le quito los espacios al nombre de la foto para evitar problemas.
			$nombre_foto = str_replace(" ", "-", $nombre_foto);

			$ftp_server = "190.114.198.126";
			$ftp_user_name = "fernandoserassioextension";
			$ftp_user_pass = "fernando2013";
			$destino_Imagen = "web/SeguimientoTitulo/Graduado/fotos/".$nombre_foto;
			$destinoImagen = "fotos/".$nombre_foto;
			echo 'N:'.$nombre_foto;
			//conexi�n
			$conn_id = ftp_connect($ftp_server); 
			// logeo
			$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

			$imagen = explode(".", $nombreFoto);
			$totalImagen=count($imagen);
			$formato = $totalImagen - 1;
			
				if ($imagen[$formato] == "jpeg" || $imagen[$formato] == "jpg" || $imagen[$formato] == "png") {
				// archivo a copiar/subir
					$upload = ftp_put($conn_id, $destino_Imagen, $archivo_foto, FTP_BINARY);
				}else{
					echo '<script type="text/javascript">alert("El archivo subido no es v�lido. Suba algunos de estos formatos: - jpg - jpeg - png");
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
			// creo la imagen con el tama�o que le pase
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
			// creo la imagen con el tama�o que le pase
			$imagen_destino = imagecreatetruecolor($ancho_final ,$alto_final );
			
			//Copio y cambio el tama�o de la imagen
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
			$today = date('Y-m-d');
			$nuevoSeguimiento = "INSERT INTO seguimiento(id_seguimiento, alumno_fk, carrera_fk, num_res_cd_fk, num_nota_fk, num_res_cs_fk, fecha_registro) VALUES('$maxId','$id_Alumno','$carrera_alumno',NULL,NULL,NULL,'$today');";
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