<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="../codeLibrary.js" type="text/javascript"></script>
<script type='text/javascript' src="jquery.min-1.9.1.js"></script>
<script src="jquery.mask.js" type="text/javascript"></script>
	<title>Registro de Graduado</title>
	<style type="text/css">
		body {
			background: #fff; 
			color: #000;
			font-family: "Varela Round", Arial, Helvetica, sans-serif;
			font-size: 14px;
			line-height: 1em;
		}
		.formNuevoGraduado {
			width: 840px;
			margin: 50px auto;  margen superior 
			padding: 20px;
			background: #FaFbFc;
		}
		legend{
			font-family: Calibri;
			font-size: 18px;
			font-weight: bold;
			color: #6E6E6E;
			padding-top: 10px;
			padding-bottom: 10px;
		}
		#leyenda{
			font-family: Calibri;
			font-size: 16px;
			font-weight: bold;
			color: #6E6E6E;
		}
		label {
			font-family: Calibri;
			font-size: 15px;
			font-weight: normal;
			color: #336699;
			text-transform: capitalize;
			padding-right: 5px;
		}
		l1 {
			font-family: Calibri;
			color: #424242;
			text-transform: capitalize;
			padding-left: 5px;
			font-size: 18px;
			font-weight: bold;
		}
		fieldset {
			padding: 10px;
		}
		#tit_sol{
			width: 100%;
		}
		#tit_sol .tdLabel{
			width: 30%;
			text-align: center;
		}
		#tit_sol .tdLblCar{
			width: 40%;
			text-align: center;
		}
		#tit_sol .tdCampo{
			width: 30%;
			text-align: center;
		}		
		#tit_sol .tdCarrera{
			width: 40%;
			text-align: center;
		}
		.campoTextTit{
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;
			color: #424242;
			padding: 5px;
			width: 200px;
			height: 15px;
			font-size: 16px;
			font-weight: normal;
			text-align: center;
			font-family: Calibri;
			position:relative;
			border: none;
			box-shadow:0px 0px 10px 1px  #ccc;
		}
		.campoText{
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;
			color: #424242;
			padding: 5px;
			width: 200px;
			height: 15px;
			font-size: 16px;
			font-weight: normal;
			text-align: left;
			font-family: Calibri;
			position:relative;
			border: none;
			box-shadow:0px 0px 10px 1px  #ccc;
		}
		.campoNro{
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;
			color: #424242;
			padding: 5px;
			width: 40px;
			height: 15px;
			font-size: 16px;
			font-weight: normal;
			text-align: left;
			font-family: Calibri;
			position:relative;
			border: none;
			box-shadow:0px 0px 10px 1px  #ccc;
		}
		.campoDate{
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;
			color: #424242;
			padding: 5px;
			width: 150px;
			height: 15px;
			font-size: 16px;
			font-weight: normal;
			text-align: left;
			font-family: Calibri;
			position:relative;
			border: none;
			box-shadow:0px 0px 10px 1px  #ccc;
		}
		.campoDateTit{
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;
			color: #424242;
			padding: 5px;
			width: 150px;
			height: 15px;
			font-size: 16px;
			font-weight: normal;
			text-align: center;
			font-family: Calibri;
			position:relative;
			border: none;
			box-shadow:0px 0px 10px 1px  #ccc;
		}
		.campoArea{
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;
			color: #424242;
			padding: 5px;
			width: 350px;
			height: 100px;
			font-size: 16px;
			font-weight: normal;
			text-align: left;
			font-family: Calibri;
			position:relative;
			border: none;
			box-shadow:0px 0px 10px 1px  #ccc;
		}
		.submit{
			-webkit-border-radius: 10px;
			-moz-border-radius: 10px;
			border-radius: 10px;
			background-color: #A4A4A4;
			color: #fff;
			display: block;
			margin: 10px auto;
			cursor: pointer;
			width: 120px;
			height: 40px;
			border: none;
			background-image: url('img/floppy.png');
			background-repeat: no-repeat;
			background-position: 12px;
			padding-left: 40px;
			-webkit-background-size: 30px 30px;           /* Safari 3.0 */
		    -moz-background-size: 30px 30px;           /* Gecko 1.9.2 (Firefox 3.6) */
		    -o-background-size: 30px 30px;           /* Opera 9.5 */
		    background-size: 30px 30px;           /* Gecko 2.0 (Firefox 4.0) and other CSS3-compliant browsers */
		    margin-left: 5px;
		}
		.submit:hover {
			box-shadow:0px 0px 15px 0px  #000;
		}
		#btn_cancelar{
			-webkit-border-radius: 10px;
			-moz-border-radius: 10px;
			border-radius: 10px;
			background-color: #8A0808;
			color: #fff;
			display: block;
			margin: 10px auto;
			cursor: pointer;
			width: 120px;
			height: 40px;
			border: none;
			background-image: url('img/cancelar.png');
			background-repeat: no-repeat;
			background-position: 12px;
			padding-left: 40px;
			-webkit-background-size: 30px 30px;           /* Safari 3.0 */
		    -moz-background-size: 30px 30px;           /* Gecko 1.9.2 (Firefox 3.6) */
		    -o-background-size: 30px 30px;           /* Opera 9.5 */
		    background-size: 30px 30px;           /* Gecko 2.0 (Firefox 4.0) and other CSS3-compliant browsers */
		    margin-right: 5px;
		}
		#btn_cancelar:hover {
			box-shadow:0px 0px 15px 0px  #DF0101;
		}
		a {
			text-decoration: none;
		}
		select{
			font-family: Calibri;
			font-size: 16px;
			padding: 3px;
			color: #424242;
			letter-spacing: 1px;
			text-shadow:0px 1px 0px #FAFAFA;
			-webkit-border-radius: 3px 3px 3px 3px; 
			-moz-border-radius: 3px 3px 3px 3px;
			border-radius: 3px 3px 3px 3px;
			border: 0;
			padding: 3px;
			-webkit-font-smoothing: antialiased;
			-webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.3);
			font-weight: normal;
			box-shadow:0px 0px 10px 1px  #ccc;
		}
		option{
			font-family: Calibri;
			padding: 3px;
			color: #424242;
			letter-spacing: 1px;
			text-shadow:0px 1px 0px #FAFAFA;
			-webkit-border-radius: 3px 3px 3px 3px; 
			-moz-border-radius: 3px 3px 3px 3px;
			border-radius: 3px 3px 3px 3px;
			-webkit-font-smoothing: antialiased;
			-webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.3);
		}
    </style>
    <script defer>

	    function addTwitter()
		{
			var valTwitter;

			valTwitter = $('#twitter_alumno').val();
			
			if(valTwitter != "")
			{
				if(valTwitter[0] != '@')
				{
					$('#twitter_alumno').val('@'+valTwitter);
					$('#twitter_alumno').focus();
				}
			}
			else
			{
				$('#twitter_alumno').val('@');
				$('#twitter_alumno').focus();
			}
		}

		function addTwitterBlur()
		{
			var valTwitter;

			valTwitter = $('#twitter_alumno').val();
			
			if(valTwitter != "")
			{
				if(valTwitter.length == 1)
				{
					if(valTwitter[0] == '@')
					{
						$('#twitter_alumno').val('');	
					}
				}
				else if(valTwitter.length > 1)
				{
					if(valTwitter[0] != '@')
					{
						$('#twitter_alumno').val('@'+valTwitter);
					}
				}
			}
		}

		$(document).ready(function(){

		$('#hidden1').val(getCode(30,1));
		$('#hidden2').val(getCode(30,1));

		});


		function pedirFoto(){
			var htmlToAdd = '';

			if (($('#carrera_alumno').val() > 5) || ($('#carrera_alumno').val() > 6 && $('#carrera_alumno').val() < 11)) {
				htmlToAdd = '<input id="fotoAlumno" type="file" name="fotoAlumno" />';
			}else{
				htmlToAdd = '<input id="fotoAlumno" type="file" name="fotoAlumno" required />';
			};
			$("#foto_nr").html(htmlToAdd);
		}

		function checkMail2(){
			var mail1 = $('#mail_alumno').val();
			var mail2 = $('#mail_alumno2').val();
			if(mail1 == mail2){
				alert("No se puede utilizar el mismo mail");
				$('#mail_alumno2').val("");
				$('#mail_alumno2').focus();
			}
		}

		function validar(idFuncion){

			var parametros = {
                "nro_dni" : $('#numerodni_alumno').val(),
                "mail_alumno" : $('#mail_alumno').val()
        	};

   			//var pasa;
			$.ajax({
				type: "POST",
				url: "validaciones.php",
				data: parametros,
				//async: false, //para que no se siga ejecutando sin la respuesta del ajax
				success:  function (response) { //Funcion que ejecuta si todo pasa bien. El response es los datos que manda el otro archivo
                        if(response == '1'){
                        	if (idFuncion == '1') {
                        		$('#control_form').val('2');
                        		alert("Este DNI ya se ha registrado anteriormente.");
                				$('#numerodni_alumno').val('');
                				$('#numerodni_alumno').focus();
                				//return false;
                        	};
                        	if (idFuncion == '2') {
                        		$('#control_form').val('2');
                        		alert("Este mail ya se ha registrado anteriormente.");
                				$('#mail_alumno').val('');
                				$('#mail_alumno').focus();
                				//return false;
                        	};
                        }else{
                        	$('#control_form').val('');
                        	//return true;
                        }
                },
				error: function (msg) {
					alert("No se pudo validar el n&uacute;mero de DNI. Contactarse con Secretar&iacute;a de Extensi&oacute;n");
				}
			});
		}

		function validarDNI(){
			if ($('#numerodni_alumno').val() != '') {
				validar('1');
			};
		}

		function validarMail(){
			if ($('#mail_alumno').val() != '') {
				validar('2');
			};
		}

		function control(){
			if ($('#control_form').val() == 2){
				alert("Ya se ha registrado anteriormente.");
				return false;
			}else{
				return true;
			}
		}

		function validarCarrera(){
			if ($('#carrera_alumno').val() == 0) {
				alert("Debe seleccionar una carrera.");
				$('#carrera_alumno').focus();
			};
		}

    </script>
</head>
<body>
<?php

$id_Alumno = (empty($_REQUEST['idAlumno'])) ? 0 : $_REQUEST['idAlumno'];
//echo 'idAlumno '.$id_Alumno.'<br>';
$volver = $_REQUEST['volver'];
$numDNI = (empty($_REQUEST['numDNI'])) ? '' : $_REQUEST['numDNI'];
//echo 'numDNI '.$numDNI.'<br>';
$dniExistente = $_REQUEST['dniExistente'];
//$numerodni_alumno = $numDNI;
//echo 'dniExistente '.$dniExistente.'<br>';
include_once "conexion.php";
include_once "libreria.php";

	if ($volver == 1){
		$sep = '/-/';
		$datosPasar = $_REQUEST['verDatos'];
		$mostrar = explode($sep,$datosPasar);
			$nombre_alumno = $mostrar[0];
			$apellido_alumno = $mostrar[1];
			$nro_legajo = $mostrar[2];
			$tipodni_alumno = $mostrar[3];
			$numerodni_alumno = $mostrar[4];
			$fecha_nacimiento_alumno = $mostrar[5];
			// $mostrar = explode('-',$fechanacimiento_alumno);
			// 		$anio = $mostrar[0];
			// 		$mes = $mostrar[1];
			// 		$dia = $mostrar[2];
			// $fecha_nacimiento_alumno = $dia.'-'.$mes.'-'.$anio;
			$provincia_viviendo_alumno = $mostrar[6];
			$localidad_viviendo_alumno = $mostrar[7];
			$cp_alumno = $mostrar[8];
			$calle_alumno = $mostrar[9];
			$numerocalle_alumno = $mostrar[10];
			$piso_alumno = $mostrar[11];
			$dpto_alumno = $mostrar[12];
			$carrera_alumno = $mostrar[13];
			$caracteristicaF_alumno = $mostrar[14];
			$telefono_alumno = $mostrar[15];
			$caracteristicaC_alumno = $mostrar[16];
			$celular_alumno = $mostrar[17];
			$mail_alumno = $mostrar[18];
			$mail_alumno2 = $mostrar[19];
			$facebook_alumno = $mostrar[20];
			$twitter_alumno = $mostrar[21];
			$password_alumno = $mostrar[22];
			$provincia_trabajo_alumno = $mostrar[23];
			$localidad_trabajo_alumno = $mostrar[24];
			$cp_alumno2 = $mostrar[25];
			$empresa_trabaja_alumno = $mostrar[26];
			$perfil_laboral_alumno = $mostrar[27];
			$destinoImagen = $mostrar[28];
			$localidad_nacimiento_alumno = $mostrar[29];
			$ultima_materia_alumno = $mostrar[30];
			$fecha_ultima_mat_alumno = $mostrar[31];
			$hidden1 = $mostrar[32];
			$hidden2 = $mostrar[33];
			$fecreg = $mostrar[34];
			// $ancho_final = $mostrar[29];
			// $alto_final = $mostrar[30];	
	}else{
		if ($id_Alumno != 0) {		
			$sqlAlumno = pg_query("SELECT alumno.*,carrera_fk FROM alumno INNER JOIN seguimiento ON(alumno.id_alumno = seguimiento.alumno_fk) WHERE id_alumno = $id_Alumno");
			$rowAlumno = pg_fetch_array($sqlAlumno);
				$id_Alumno = $rowAlumno['id_alumno'];
				$nombre_alumno = $rowAlumno['nombre_alumno'];
				$apellido_alumno = $rowAlumno['apellido_alumno'];
				$nro_legajo = $rowAlumno['nro_legajo'];
				$tipodni_alumno = $rowAlumno['tipodni_alumno'];
				$numerodni_alumno = $rowAlumno['numerodni_alumno'];
				// $fechanacimiento_alumno = $rowAlumno['fechanacimiento_alumno'];
				// 	$mostrar = explode('-',$fechanacimiento_alumno);
				// 		$anio = $mostrar[0];
				// 		$mes = $mostrar[1];
				// 		$dia = $mostrar[2];
				// $fecha_nacimiento_alumno = $dia.'-'.$mes.'-'.$anio;
				$fecha_nacimiento_alumno = $rowAlumno['fechanacimiento_alumno'];
				$localidad_nacimiento_alumno = $rowAlumno['localidad_nacimiento_alumno'];
				$provincia_viviendo_alumno = $rowAlumno['provincia_viviendo_alumno'];
				$localidad_viviendo_alumno = $rowAlumno['localidad_viviendo_alumno'];
				$cp_alumno = $rowAlumno['cp_alumno'];
				$calle_alumno = $rowAlumno['calle_alumno'];
				$numerocalle_alumno = $rowAlumno['numerocalle_alumno'];
				$piso_alumno = $rowAlumno['piso_alumno'];
				$dpto_alumno = $rowAlumno['dpto_alumno'];
				$carrera_alumno = $_REQUEST['carrera_fk'];
				$caracteristicaF_alumno = $rowAlumno['caracteristicaf_alumno'];
				$telefono_alumno = $rowAlumno['telefono_alumno'];
				$caracteristicaC_alumno = $rowAlumno['caracteristicac_alumno'];
				$celular_alumno = $rowAlumno['celular_alumno'];
				$mail_alumno = $rowAlumno['mail_alumno'];
				$mail_alumno2 = $rowAlumno['mail_alumno2'];
				$facebook_alumno = $rowAlumno['facebook_alumno'];
				$twitter_alumno = $rowAlumno['twitter_alumno'];
				$password_alumno = $rowAlumno['password_alumno'];
				$provincia_trabajo_alumno = $rowAlumno['provincia_trabajo_alumno'];
				$localidad_trabajo_alumno = $rowAlumno['localidad_trabajo_alumno'];
				$cp_alumno2 = $rowAlumno['cp_alumno2'];
				$empresa_trabaja_alumno = $rowAlumno['empresa_trabaja_alumno'];
				$perfil_laboral_alumno = $rowAlumno['perfil_laboral_alumno'];
				$destinoImagen = $rowAlumno['foto_alumno'];
				$ancho_final = $rowAlumno['ancho_final'];
				$alto_final = $rowAlumno['alto_final'];
				$ultima_materia_alumno = $rowAlumno['ultima_materia_alumno'];
				// $fecha_ultimamat_alumno = $rowAlumno['fecha_ultima_mat_alumno'];
				// $mostrar = explode('-',$fecha_ultimamat_alumno);
				// 		$anio = $mostrar[0];
				// 		$mes = $mostrar[1];
				// 		$dia = $mostrar[2];
				// $fecha_ultima_mat_alumno = $dia.'-'.$mes.'-'.$anio;
				$fecha_ultima_mat_alumno = $rowAlumno['fecha_ultima_mat_alumno'];
		}
	}
?>
<center>
<form class="formNuevoGraduado" name="f1" id="form2" action="registrarDatosGraduado.php?idAlumno=<?php echo $id_Alumno ?>" method="post" onsubmit="return control();" enctype="multipart/form-data">
<table align="center" width="100%">
	<tr width="100%">
		<td width="100%">
			<fieldset>
				<legend>Carrera del T&iacute;tulo a Solicitar</legend>
					<table align="center" id="tit_sol">	
						<tr width="100%">
							<td class="tdLblCar">
								<label for="carrera_alumno">T&iacute;tulo a Solicitar: </label>
							</td>
							<td class="tdLabel">
								<label for="ultima_materia_alumno">&Uacute;ltima materia rendida: </label>
							</td>
							<td class="tdLabel">
								<label for="fecha_ultima_mat_alumno">Fecha &Uacute;lt. mat. rendida: </label>
							</td>
						</tr>
						<tr width="100%">
							<td class="tdCarrera">
								<?php 	if($id_Alumno == 0){ ?>
									<select id="carrera_alumno" name="carrera_alumno" onchange="pedirFoto();" onblur="validarCarrera();" size="1" autofocus required>
									<option value="0">Seleccione t&iacute;tulo</option>
										<?php
											//$consultaCarrera=pg_query("SELECT * FROM carrera ORDER BY nombre_carrera");
											$consultaCarrera=traerSql('*', 'carrera ORDER BY nombre_carrera', '');
											while($rowCarrera=pg_fetch_array($consultaCarrera)){
												if($carrera_alumno == $rowCarrera['id_carrera']){						
													echo '<option value="'.$rowCarrera['id_carrera'].'" selected>'.$rowCarrera['nombre_carrera'].'</option>';
												}else{
													echo '<option value="'.$rowCarrera['id_carrera'].'">'.$rowCarrera['nombre_carrera'].'</option>';
												}
											}
										?>
									</select>
								<?php 	}else{
											//$consultaCarrera=pg_query("SELECT * FROM carrera ORDER BY nombre_carrera");
											$consultaCarrera=traerSql('*', 'carrera ORDER BY nombre_carrera', '');
											while($rowCarrera=pg_fetch_array($consultaCarrera)){
												if ($carrera_alumno == $rowCarrera['id_carrera']){
													echo '<l1>'.$rowCarrera['nombre_carrera'].'</l1>';
												}
											}
											echo '<input id="carrera_alumno" name="carrera_alumno" type="hidden" value="'.$carrera_alumno.'"/>';
										}
								?>
							</td>
							
							<td class="tdCampo">
								<input id="ultima_materia_alumno" name="ultima_materia_alumno" class="campoTextTit" type="text" maxlength="60" title="Ingrese el nombre de la &uacute;ltima materia rendida" value="<?php echo $ultima_materia_alumno; ?>" required />
							</td>
							
							<td class="tdCampo">
								<input id="fecha_ultima_mat_alumno" name="fecha_ultima_mat_alumno" type="date" class="campoDateTit" value="<?php echo $fecha_ultima_mat_alumno; ?>" maxlength="10" size="6" required title="Ingrese la fecha en la que rindi&oacute; la &uacute;ltima materia" />
							</td>
						</tr>
					</table>
			</fieldset>
			<fieldset>
				<legend>Datos Personales</legend>
					<table align="center" width="100%">
						<tr width="100%">
							<td width="10%" align="right">
								<label for="nombre_alumno">Nombre: </label>
							</td>
							<td width="30%">
								<input type="hidden" id="control_form" name="hidden1" value="" />
								<input type="hidden" id="hidden1" name="hidden1" value="" />
								<input type="hidden" id="hidden2" name="hidden2" value="" />
								<input id="nombre_alumno" name="nombre_alumno" type="text" class="campoText" maxlength="20" value="<?php echo $nombre_alumno; ?>" title="Ingrese su nombre" required/>
							</td>
							<td width="10%" align="right">
								<label for="apellido_alumno">Apellido: </label>
							</td>
							<td width="30%">
								<input id="apellido_alumno" name="apellido_alumno" type="text" class="campoText" maxlength="30" value="<?php echo $apellido_alumno; ?>" title="Ingrese su apellido" required/>
							</td>
							<td width="10%" align="right">
								<label for="nro_legajo">N&deg; Legajo: </label>
							</td>
							<td width="10%" colspan="3">
								<input id="nro_legajo" name="nro_legajo" pattern="[0-9]{4,6}" type="text" class="campoNro" value="<?php echo $nro_legajo; ?>" size="4" minlength="4" maxlength="6" title="Ingrese su legajo" required/>
							</td>
						</tr>
						<tr width="100%">
							<td colspan="1" align="right">
								<label for="tipodni_alumno">Tipo DNI:</label>
							</td>
							<td colspan="1">
								<select id="tipodni_alumno" name="tipodni_alumno" size="1">
									<?php
										//$consultaTipoDNI=pg_query("select * FROM tipo_dni");
										$consultaTipoDNI=traerSql('*', 'tipo_dni', '');
										while($rowTipoDNI=pg_fetch_array($consultaTipoDNI)){
										if ($tipo_dni_alumno == $rowTipoDNI['id_tipo_dni']){
					                        echo "<option value=".$rowTipoDNI['id_tipo_dni']." selected>".$rowTipoDNI['nombre_tipo_dni']."</option>";
										}else{
											echo "<option value=".$rowTipoDNI['id_tipo_dni'].">".$rowTipoDNI['nombre_tipo_dni']."</option>";
											}
										}
									?>
								</select>
							</td>
							<td colspan="1" align="right">
								<label for="numerodni_alumno">N&deg; DNI:</label>
							</td>
							<td colspan="5">
								<?php
									if ($numerodni_alumno == ''){
										echo '<input id="numerodni_alumno" name="numerodni_alumno" onblur="validarDNI();" type="text" class="campoText" pattern="([0-9]{1}.|[0-9]{2}.)[0-9]{3}.[0-9]{3}" value="'.$numDNI.'" maxlength="10" title="Ingrese su n&uacute;mero de DNI con separador de miles, ejemplo: ##.###.###" required/>';
									}else{
										echo '<input id="numerodni_alumno" name="numerodni_alumno" onblur="validarDNI();" type="text" class="campoText" pattern="([0-9]{1}.|[0-9]{2}.)[0-9]{3}.[0-9]{3}" value="'.$numerodni_alumno.'" maxlength="10" title="Ingrese su n&uacute;mero de DNI con separador de miles, ejemplo: ##.###.###" required/>';
									}
								?>
							</td>
						</tr>
						<tr width="100%">
							<td colspan="1" align="right">
								<label for="fechanacimiento_alumno">Fecha Nac.: </label>
							</td>
							<td colspan="1">
								<input id="fechanacimiento_alumno" name="fechanacimiento_alumno" type="date" class="campoDate"  value="<?php echo $fecha_nacimiento_alumno; ?>" maxlength="10" title="Ingrese la fecha de su nacimiento" required/>
							</td>
							<td colspan="1" align="right">
								<label for="localidad_nacimiento_alumno">Lugar Nac.: </label>
							</td>
							<td colspan="5">
								<input id="localidad_nacimiento_alumno" name="localidad_nacimiento_alumno" type="text" spellcheck="true" class="campoText" value="<?php echo $localidad_nacimiento_alumno; ?>" maxlength="50" title="Ingrese la localidad donde naci&oacute;" required/>
							</td>
						</tr>
						<tr width="100%">
							<td  width="100%" colspan="8"><hr size="2" width="100%" align="center"/></td>
						</tr>
						<tr width="100%">
							<td  width="100%" colspan="8">
								<legend id="leyenda">*Domicilio donde vive</legend>
							</td>
						</tr>
						<tr width="100%">
							<td colspan="1" align="right">
								<label for="localidad_viviendo_alumno">Localidad:</label>
							</td>
							<td colspan="1">
								<input id="localidad_viviendo_alumno" name="localidad_viviendo_alumno" type="text" spellcheck="true" class="campoText" value="<?php echo $localidad_viviendo_alumno; ?>" maxlength="50" title="Ingrese la localidad donde vive" required/>
							</td>
							<td colspan="1" align="right">
								<label for="provincia_viviendo_alumno">Provincia:</label>
							</td>
							<td colspan="1">
								<input id="provincia_viviendo_alumno" name="provincia_viviendo_alumno" type="text" spellcheck="true" class="campoText" value="<?php echo $provincia_viviendo_alumno; ?>" maxlength="50" title="Ingrese la provincia donde naci&oacute;" required/>
							</td>
							<td colspan="1" align="right">
								<label for="cp_alumno">C.P.:</label>
							</td>
							<td colspan="3">
								<input id="cp_alumno" name="cp_alumno" type="text" class="campoNro" pattern="[0-9]{4,5}" value="<?php echo $cp_alumno; ?>" required maxlength="5" size="4" title="Ingrese el c&oacute;digo postal de la localidad donde vive" />
							</td>
						</tr>
						<tr width="100%">
							<td colspan="1" width="10%" align="right">
								<label for="calle_alumno">Calle: </label>
							</td>
							<td colspan="1" width="30%">
								<input id="calle_alumno" name="calle_alumno" type="text" class="campoText" value="<?php echo $calle_alumno; ?>" maxlength="50" title="Ingrese la calle de su domicilio" required/>
							</td>
							<td colspan="1" width="10%" align="right">
								<label for="numerocalle_alumno">N&deg;: </label>
							</td>
							<td colspan="1" width="10%">
								<input id="numerocalle_alumno" name="numerocalle_alumno" pattern="[0-9]{2,6}" type="text" class="campoNro" size="4" value="<?php echo $numerocalle_alumno; ?>" required title="Ingrese la altura de su domicilio" />
							</td>
							<td colspan="1" width="10%" align="right">
								<label for="piso_alumno">Piso: </label>
							</td>
							<td colspan="1" width="10%">
								<input id="piso_alumno" name="piso_alumno" type="text" pattern="[0-9]{0,2}" class="campoNro" size="4" value="<?php echo $piso_alumno; ?>" title="Ingrese el piso de su domicilio"/>
							</td>
							<td colspan="1" width="10%" align="right">
								<label for="dpto_alumno">Dpto: </label>
							</td>
							<td colspan="1" width="10%">
								<input id="dpto_alumno" name="dpto_alumno" type="text" size="1" class="campoNro" value="<?php echo $dpto_alumno; ?>" maxlength="3" title="Ingrese el identificador de su departamento" />
							</td>
						</tr>
						<tr width="100%">
							<td colspan="8" width="100%">
								<hr size="2" width="100%" align="center"/>
							</td>
						</tr>
						<tr width="100%">
							<td colspan="1" align="right">
								<label for="fotoAlumno">Foto: </label>
							</td>
							<td colspan="7">
								<div id="foto_nr">
									
								</div>
								<!-- <input id="fotoAlumno" type="file" name="fotoAlumno" required /> -->
							</td>
						</tr>
					</table>
			</fieldset>
			<fieldset>
				<legend>Datos Contacto</legend>
					<table align="center" width="100%">
						<tr width="100%">
							<td width="10%" align="right">
								<label for="caracteristicaF_alumno">Tel&eacute;fono Fijo: </label>
							</td>
							<td width="5%">
								<input id="caracteristicaF_alumno" name="caracteristicaF_alumno" type="text" class="campoNro" pattern="[1-9]{2,4}" placeholder="Sin 0" value="<?php echo $caracteristicaF_alumno; ?>" size="3" maxlength="5" title="Ingrese la caracter&iacute;stica de su nro. de tel&eacute;fono" />
							</td>
							<td width="35%">
								<input id="telefono_alumno" name="telefono_alumno" type="text" class="campoText" value="<?php echo $telefono_alumno; ?>"  title="Ingrese el nro. de su tel&eacute;fono" />
							</td>
							<td width="10%" align="right">
								<label for="caracteristicaC_alumno">Celular: </label>
							</td>
							<td width="5%">
								<input id="caracteristicaC_alumno" name="caracteristicaC_alumno" type="text" class="campoNro" pattern="[1-9]{2,4}" placeholder="Sin 0" value="<?php echo $caracteristicaC_alumno; ?>" size="3" maxlength="5" title="Ingrese la caracter&iacute;stica de su nro. de celular" required/>
							</td>
							<td width="35%">
								<input id="celular_alumno" name="celular_alumno" type="text" class="campoText" pattern="[0-9]{6,8}" placeholder="Sin 15" value="<?php echo $celular_alumno; ?>" title="Ingrese su nro. de celular" required/>
							</td>
						</tr>
						<tr width="100%">
							<td colspan="1" align="right">
								<label for="mail_alumno">Mail 1: </label>
							</td>
							<td colspan="2">
								<input id="mail_alumno" name="mail_alumno" onblur="validarMail();" type="email" class="campoText" value="<?php echo $mail_alumno; ?>" title="Ingrese su mail" maxlength="60" required/>
							</td>
							<td colspan="1" align="right">
								<label for="mail_alumno2">Mail 2: </label>
							</td>
							<td colspan="2">
								<input id="mail_alumno2" name="mail_alumno2" type="email" onchange="checkMail2();" class="campoText" value="<?php echo $mail_alumno2; ?>"  title="Ingrese un mail secundario" maxlength="60" />
							</td>
						</tr>
						<tr width="100%">
							<td colspan="1" align="right">
								<label for="facebook_alumno">Facebook: </label>
							</td>
							<td colspan="2">
								<input id="facebook_alumno" name="facebook_alumno" type="text" class="campoText" placeholder="&iquest;C&oacute;mo te encuentro&quest;" value="<?php echo $facebook_alumno; ?>"  maxlength="40" title="&iquest;C&oacute;mo te encontramos&quest;" />
							</td>
							<td colspan="1" align="right">
								<label for="twitter_alumno">Twitter: </label>
							</td>
							<td colspan="2">
								<input id="twitter_alumno" name="twitter_alumno" onfocus="addTwitter();" onblur="addTwitterBlur();" type="text" class="campoText" value="<?php echo $twitter_alumno; ?>" maxlength="40" title="Ingrese su twitter" />
							</td>
						</tr>
					</table>
			</fieldset>
			<fieldset>
				<legend>Datos Laborales</legend>
					<table align="center" width="100%">
						<tr width="100%">
							<td width="10%" align="right">
								<label for="localidad_trabajo_alumno">Localidad:</label>
							</td>
							<td width="30%">
								<input id="localidad_trabajo_alumno" name="localidad_trabajo_alumno" type="text" class="campoText" spellcheck="true" value="<?php echo $localidad_trabajo_alumno; ?>" maxlength="60" title="Ingrese la localidad d&oacute;nde trabaja" />
							</td>
							<td width="10%" align="right">
								<label for="provincia_trabajo_alumno">Provincia:</label>
							</td>
							<td width="30%">
								<input id="provincia_trabajo_alumno" name="provincia_trabajo_alumno" type="text" class="campoText" spellcheck="true" value="<?php echo $provincia_trabajo_alumno; ?>" maxlength="40" title="Ingrese la provincia d&oacute;nde trabaja" />
							</td>
							<td width="10%" align="right">
								<label for="cp_alumno2">C.P.:</label>
							</td>
							<td width="10%">
								<input id="cp_alumno2" name="cp_alumno2" type="text" class="campoNro" pattern="[0-9]{4,5}" value="<?php echo $cp_alumno2; ?>" maxlength="5" size="2" title="Ingrese el c&oacute;digo postal de la localidad d&oacute;nde trabaja" />
							</td>
						</tr>
						<tr width="100%">
							<td colspan="1" align="right">
								<label for="empresa_trabaja_alumno">Empresa: </label>
							</td>
							<td colspan="5">
								<input id="empresa_trabaja_alumno" name="empresa_trabaja_alumno" type="text" class="campoText" value="<?php echo $empresa_trabaja_alumno; ?>" maxlength="30" title="Ingrese el nombre de la empresa d&oacute;nde trabaja" />
							</td>
						</tr>
						<tr width="100%">
							<td colspan="1" align="right">
								<label for="perfil_laboral_alumno">Perfil Laboral: </label>
							</td>
							<td colspan="5">
								<textarea id="perfil_laboral_alumno" name="perfil_laboral_alumno" class="campoArea" value="" maxlength="300" title="Ingrese una breve descripci&oacute;n de su perfil laboral" spellcheck="true" ><?php echo $perfil_laboral_alumno; ?></textarea>
							</td>
						</tr>
					</table>
			</fieldset>
		</td>
	</tr>
</table>
<fieldset>
	<legend>Esta Contrase&ntilde;a se le solicitar&aacute; para acceder a sus datos cargados en el formulario actual</legend>
		<table align="center" width="100%">
			<tr width="100%">
				<td width="10%" align="right">
					<label for="password_alumno">Contrase&ntilde;a: </label>
				</td>
				<td width="90%">
					<input id="password_alumno" name="password_alumno" type="password" pattern=".{6,}" title="M&iacute;nimo seis caracteres" minlength="6" maxlength="20" class="campoText" value="<?php echo $password_alumno; ?>" required/>
				</td>
			</tr>
		</table>
</fieldset>
<br>
<table id="tablaBtn" align="center">
	<tr width="100%">
		<td width="50%" align="right">
			<?php if($id_Alumno != 0){?>
				<a href="verAlumno.php?idAlumno=<?php echo $id_Alumno;?>&titulo_alumno=<?php echo $carrera_alumno;?>"><input type="button" id="btn_cancelar" value="Cancelar"></a>
			<?php }else{?>
				<a href="validarDNI.php"><input type="button" id="btn_cancelar" value="Cancelar"></a>
			<?php }; ?>
		</td>	
		<td width="50%" align="left">
			<input class="submit" type="submit" value="Guardar"/>
		</td>
	</tr>
</table>
</form>
</fieldset>
</center>
</body>
</html>