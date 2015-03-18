<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<script src="jquery-latest.js"></script>
	<script type="text/javascript" src="jquery.validate.js"></script>
	<title>Graduado</title>
	<style type="text/css">
		{font-family: Cambria }
			#tabla {background: #F2F2F2;}
			form {background: #F2F2F2;}
			#tabla1 {background: #F2F2F2; align: center;}
			#tablaGeneral {padding: 20px; border: 1px Solid #D8D8D8;background: #F2F2F2;}
			#tablaGeneral1 {padding: 10px; background: #F2F2F2;}
			#tablaTitulo {padding: 20px; border: 1px Solid #D8D8D8;background: #F2F2F2;}
			label {width: 13em; float: left; font-family: Cambria; text-decoration: underline; text-transform: capitalize; color: #0B3861; font-weight:bold; padding-left: .5em;}
			l1 {font-family: Cambria; color: #424242; text-transform: capitalize; padding: .12em;}
			l2 {font-family: Cambria; color: #424242; padding: .12em;}
			l3 {font-family: Cambria; color: #424242; text-transform: capitalize; width: 13em;}
			l4 {font-family: Cambria; color: #0040FF; text-transform: capitalize; font-size: 1.5em;}
			a { text-decoration:none }
    </style>
		<script>
			$(document).ready(function(){
			$('form').validate();
			$("#FormVerAlumno").validate();
			$("#formSeleccionTitulo").validate();
		});

		function evaluaring(academico){
			document.f1.submit(); 
		}
		
		</script>
</head>
<body>
<?php
$titulo = $_REQUEST['titulo_alumno'];
$id_Alumno = $_REQUEST['idAlumno'];
?>
<table align="center" id="tablaGeneral" cellpadding="2" cellspacing="2" width="100%">
	<!-- <table id="tablaTitulo" align="center" cellpadding="2" cellspacing="2" width="100%"> -->
		<tr width="100%">
			<td width="100%">
			<form class="formTitulo" name="f1" id="formSeleccionTitulo" action="" method="post">
			<fieldset id="tabla">
			<legend><FONT face="Cambria" size="4" color="#6E6E6E">Seleccione la Carrera de la solicitud que desea ver</FONT></legend>
			<table align="center" id="tablaGeneral1" width="100%">
			<tr width="100%">
				<td width="30%" align="right">
					<label for="cTitulo">Carrera: </label>
				</td>
				<td width="70%" align="left">
	            <select id="cTitulo" name="titulo_alumno" size="1" class="required" onChange="evaluaring()"  onkeyup=fn(this.form,this)>
				<option value="0">Seleccione un Título...</option>
					<?php
					include_once "conexion.php";
					//$titulo = $_REQUEST['titulo_alumno'];
						$consultaTitulo=pg_query("SELECT carrera_fk,nombre_carrera FROM seguimiento INNER JOIN carrera ON(seguimiento.carrera_fk = carrera.id_carrera) WHERE alumno_fk = $id_Alumno");
						while($rowTitulo=pg_fetch_array($consultaTitulo)){
							if ($titulo == $rowTitulo['carrera_fk']){
		                    	echo "<option value=".$rowTitulo['carrera_fk']." selected>".$rowTitulo['nombre_carrera']."</option>";
							}else{
								echo "<option value=".$rowTitulo['carrera_fk'].">".$rowTitulo['nombre_carrera']."</option>";
							}
						}
					?>	
				</select>
				</td>
			</tr>
			</table>
				</fieldset>
				</form>
			</td>
		</tr>
		<?php if($titulo != NULL AND $titulo != 0){ ?>
	<!-- </table> -->
	<tr width="100%">
		<td width="100%">
			<form class="formVerGraduado" id="FormVerAlumno" method="post">

			<?php
			include_once "conexion.php";
			// $id_Alumno = $_REQUEST['idAlumno'];
			$titulo = $_REQUEST['titulo_alumno'];

				$alumnos = pg_query("SELECT alumno.*,id_seguimiento,alumno_fk,carrera_fk,carrera.*,nivel_carrera.*,id_tipo_dni,nombre_tipo_dni FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(nivel_carrera.id_nivel_carrera = carrera.nivel_carrera_fk) INNER JOIN tipo_dni ON(tipo_dni.id_tipo_dni = alumno.tipodni_alumno) WHERE id_alumno = '$id_Alumno' AND carrera_fk = '$titulo'");
				$row=pg_fetch_array($alumnos,NULL,PGSQL_ASSOC);
					$nombre_alumno = $row['nombre_alumno'];
					$apellido_alumno = $row['apellido_alumno'];
					$nro_legajo = $row['nro_legajo'];
					$tipodni_alumno = $row['tipodni_alumno'];
					$numerodni_alumno = $row['numerodni_alumno'];
					$fechanacimiento_alumno = $row['fechanacimiento_alumno'];
					$provincia_viviendo_alumno = $row['provincia_viviendo_alumno'];
					$localidad_viviendo_alumno = $row['localidad_viviendo_alumno'];
					$cp_alumno = $row['cp_alumno'];
					$calle_alumno = $row['calle_alumno'];
					$numerocalle_alumno = $row['numerocalle_alumno'];
					$piso_alumno = $row['piso_alumno'];
					$dpto_alumno = $row['dpto_alumno'];
					$nivel_carrera = $row['nivel_carrera_fk'];
					$carrera_alumno = $row['carrera_fk'];
					$caracteristicaF_alumno = $row['caracteristicaf_alumno'];
					$telefono_alumno = $row['telefono_alumno'];
					$caracteristicaC_alumno = $row['caracteristicac_alumno'];
					$celular_alumno = $row['celular_alumno'];
					$mail_alumno = $row['mail_alumno'];
					$mail_alumno2 = $row['mail_alumno2'];
					$facebook_alumno = $row['facebook_alumno'];
					$twitter_alumno = $row['twitter_alumno'];
					$password_alumno = $row['password_alumno'];
					$provincia_trabajo_alumno = $row['provincia_trabajo_alumno'];
					$localidad_trabajo_alumno = $row['localidad_trabajo_alumno'];
					$cp_alumno2 = $row['cp_alumno2'];
					$empresa_trabaja_alumno = $row['empresa_trabaja_alumno'];
					$perfil_laboral_alumno = $row['perfil_laboral_alumno'];
					$foto_alumno = $row['foto_alumno'];
					$ancho_final = $row['ancho_final'];
					$alto_final = $row['alto_final'];
					$ultima_materia_alumno = $row['ultima_materia_alumno'];
					$fecha_ultima_mat_alumno = $row['fecha_ultima_mat_alumno'];

			$cadena= 'Desea eliminar el graduado seleccionado?';
				$utf= utf8_decode($cadena);
			$esp = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#8226; ';
			?>
			<script type="text/javascript">
					function confirmation() {
					var pregunta = confirm("<?php echo $utf= utf8_decode($cadena); ?>")
					 	if (pregunta){
					 		window.location = "eliminarAlumno.php?idAlumno=<?php echo $id_Alumno?>";
					 	}else{
					 		window.location = "listadoAlumno.php";
					 	}
					}
			</script>



				<fieldset id="tabla">
				<legend><FONT face="Cambria" size="4" color="#6E6E6E">Foto</FONT></legend>
					<table align="center">
						<tr>
							<td>
								<?php
								if($ancho_final>$alto_final){
								//foto horizontal
									$ancho_mostrar=200;
									$alto_mostrar=$alto_final*$ancho_mostrar/$ancho_final;
									echo '<img src='.$foto_alumno.' width="'.$ancho_mostrar.'" height="'.$alto_mostrar.'">';
								}else{
								//fotos verticales
									$alto_mostrar=200;
									$ancho_mostrar=$ancho_final*$alto_mostrar/$alto_final;
									echo '<img src='.$foto_alumno.' width="'.$ancho_mostrar.'" height="'.$alto_mostrar.'">';
								}
								?>
							</td>
						</tr>
					</table>
				</fieldset>
				<fieldset id="tabla">
				<legend><FONT face="Cambria" size="4" color="#6E6E6E">Datos Personales</FONT></legend>
				<table align="center" cellpadding="2" cellspacing="1" width="100%">
					<tr width="100%">
						<td width="100%">
							<label for="cNombre">Nombre: </label>
							<l1><?php echo $nombre_alumno; ?></l1>
						</td>
					</tr>
					<tr width="100%">
						<td width="100%">
						<label for="cApellido">Apellido: </label>
						<l1><?php echo $apellido_alumno; ?></l1>
						</td>
					</tr>
					<tr width="100%">
						<td width="100%">
							<label for="cLegajo">Nro Legajo: </label>
							<l1><?php echo $nro_legajo; ?></l1>
						</td>
					</tr>
					<tr width="100%">
						<td width="100%">
						<label for="cTipoDNI">Tipo DNI: </label>
								<?php
									$consultaTipoDNI=pg_query("SELECT * FROM tipo_dni");
									while($rowTipoDNI=pg_fetch_array($consultaTipoDNI)){
										$id = $rowTipoDNI['id_tipo_dni'];
										if ($id == $tipodni_alumno){
											//$id = '"'.$id.'"';
											echo '<l1>'.$rowTipoDNI['nombre_tipo_dni'].'</l1>';
										}
									}
								?>
						</td>
					</tr>
					<tr width="100%">
						<td width="100%">
							<label for="cNumeroDNI">N&uacute;mero DNI: </label>
							<l1><?php echo $numerodni_alumno; ?></l1>
						</td>
					</tr>
					<tr width="100%">
						<td width="100%">
							<label for="cFecha">Fecha de Nacimiento: </label>
							<l1><?php echo $fechanacimiento_alumno; ?></l1>
						</td>
					</tr>
					<tr width="100%">
						<td width="100%">
							<label for="cProvinciaViviendo">Provincia Viviendo: </label>
							<l1><?php echo $provincia_viviendo_alumno; ?></l1>
						</td>
					</tr>
					<tr width="100%">
						<td width="100%">
							<label for="cLocalidadViviendo">Localidad Viviendo: </label>
							<l1><?php echo $localidad_viviendo_alumno; ?></l1>
						</td>
					</tr>
					<tr width="100%">
						<td width="100%">
							<label for="cCP">C.P.: </label>
							<l1><?php echo $cp_alumno; ?></l1>
						</td>
					</tr>
					<tr width="100%">
						<td width="100%">
							<label for="cCalle">Calle: </label>
							<l1><?php echo $calle_alumno; ?></l1>
						</td>
					</tr>
					<tr width="100%">
						<td width="100%">
							<label for="cNumCalle">N&uacute;mero: </label>
							<l1><?php echo $numerocalle_alumno; ?></l1>
						</td>
					</tr>
					<tr>
						<td width="100%">
							<label for="cPiso">Piso: </label>
							<l1><?php echo $piso_alumno; ?></l1>
						</td>
					</tr>
					<tr>
						<td width="100%">
							<label for="cDpto">Dpto: </label>
							<l1><?php echo $dpto_alumno; ?></l1>
						</td>
					</tr>
				</table>
				</fieldset>
				<fieldset id="tabla">
				<legend><FONT face="Cambria" size="4" color="#6E6E6E">Datos Contacto</FONT></legend>
				<table align="center" cellpadding="2" cellspacing="1" width="100%">
					<tr>
						<td>
						<label for="cNivelCarrera">Nivel Carrera: </label>
								<?php
									$consultaNivelCarrera=pg_query("SELECT * FROM nivel_carrera");
									while($rowNivelCarrera=pg_fetch_array($consultaNivelCarrera)){
										$id = $rowNivelCarrera['id_nivel_carrera'];
										if($id == $nivel_carrera){
											echo '<l1>'.$rowNivelCarrera['nombre_nivel_carrera'].'</l1>';
										}
									}
								?>
						</td>
					</tr>
					<tr>
						<td>
							<label for="cCarrera">Carrera: </label>
							<?php
								$consultaTitulo=pg_query("SELECT carrera_fk,nombre_carrera FROM seguimiento INNER JOIN carrera ON(seguimiento.carrera_fk = carrera.id_carrera) WHERE alumno_fk = $id_Alumno");
								while($rowTitulo=pg_fetch_array($consultaTitulo)){
									if ($titulo == $rowTitulo['carrera_fk']){
										echo '<l1>'.$rowTitulo['nombre_carrera'].'</l1>';
									}
								}
							?>
						</td>
					</tr>
					<tr>
						<td>
							<label for="cTelefono">&Uacute;ltima Materia Rendida: </label>
							<l1><?php echo $ultima_materia_alumno; ?></l1>
						</td>
					</tr>
					<tr>
						<td>
							<label for="cTelefono">Fecha &Uacute;lt. Mat. Rendida: </label>
							<l1><?php echo $fecha_ultima_mat_alumno; ?></l1>
						</td>
					</tr>
					<tr>
						<td>
							<label for="cTelefono">Tel&eacute;fono: </label>
							<l1><?php echo $caracteristicaF_alumno.' - '.$telefono_alumno; ?></l1>
						</td>
					</tr>
					<tr>
						<td>
							<label for="cTelefono">Celular: </label>
							<l1><?php echo $caracteristicaC_alumno.' - '.$celular_alumno; ?></l1>
						</td>
					</tr>
					<tr>
						<td>
							<label for="cMail">Mail 1: </label>
							<l2><?php echo $mail_alumno; ?></l2>
						</td>
					</tr>
					<tr>
						<td>
							<label for="cMail">Mail 2: </label>
							<l2><?php echo $mail_alumno2; ?></l2>
						</td>
					</tr>
					<tr>
						<td>
						<label for="cFacebook">Facebook: </label>
						<l1><?php echo $facebook_alumno; ?></l1>
						</td>
					</tr>
					<tr>
						<td>
							<label for="cTwitter">Twitter: </label>
							<l1><?php echo $twitter_alumno; ?></l1>
						</td>
					</tr>
				</table>
				</fieldset>
				<fieldset id="tabla">
				<legend><FONT face="Cambria" size="4" color="#6E6E6E">Datos Laborales</FONT></legend>
				<table align="center" cellpadding="2" cellspacing="1" width="100%">
					<tr>
						<td>
							<label for="cProvinciaTrabajo">Provincia Trabajo: </label>
							<l1><?php echo $provincia_trabajo_alumno; ?></l1>
						</td>
					</tr>
					<tr>
						<td>
							<label for="cLocalidadTrabajo">Localidad Trabajo: </label>
							<l1><?php echo $localidad_trabajo_alumno; ?></l1>
						</td>
					</tr>
					<tr>
						<td>
							<label for="cCP2">C.P.: </label>
							<l1><?php echo $cp_alumno2; ?></l1>
						</td>
					</tr>
					<tr>
						<td>
							<label for="cEmpresaTrabaja">Empresa donde Trabaja: </label>
							<l1><?php echo $empresa_trabaja_alumno?></l1>
						</td>
					<tr>
					<tr>
						<td>
							<label for="cPerfilLaboral">Perfil Laboral: </label>
							<l1><?php echo $perfil_laboral_alumno; ?></l1>
						</td>
					</tr>
				</table>
			</form>
			</fieldset>
			<table align="center">
				<tr width="100%">
					<td width="100%" colspan="2">
						&nbsp;
					</td>
				</tr>
				<tr width="100%">
					<td width="50%" align="rigth">
						<?php echo '<a href="registrarGraduado.php?carrera_fk='.$titulo.'&idAlumno='.$id_Alumno.'"><input type="image" src="modificar.png" width="45" height="45" value="Modificar" /></a>';?>
					</td>
					<td width="50%" align="left">
						<?php
							if ($nivel_carrera == 1) {//carrera de grado
								echo '<a href="imprimirGraduado1.php?idAlumno='.$id_Alumno.'"><input type="image" src="print.png" width="45" height="45" value="Imprimir" /></a>';
							}
							if ($nivel_carrera == 2) {//carrera de posgrado
								echo '<a href="imprimirGraduado2.php?idAlumno='.$id_Alumno.'"><input type="image" src="print.png" width="45" height="45" value="Imprimir" /></a>';
							}
							if ($nivel_carrera == 3) {//carrera de pregrado
								echo '<a href="imprimirGraduado3.php?idAlumno='.$id_Alumno.'"><input type="image" src="print.png" width="45" height="45" value="Imprimir" /></a>';
							}
						?>
					</td>
				</tr>
				<tr width="100%">
					<td width="100%" colspan="2">
						&nbsp;
					</td>
				</tr>
				<tr width="100%">
					<td width="100%" align="center" colspan="2">
						<a href="validarDNI.php"><input type="button" value="Salir"></a>
					</td>
				</tr>
			</table>
			<?php } ?>
		</td>
	</tr>
</table>
</body>
</html>