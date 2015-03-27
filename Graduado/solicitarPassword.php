<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="jquery.mask.js" type="text/javascript"></script>
	<title>Solicitud de Contrase&ntilde;a</title>
	<style type="text/css">
		body {
			background: #fff;
			color: #000;
			font-family: "Varela Round", Arial, Helvetica, sans-serif;
			font-size: 14px;
			line-height: 1em;
		}
		form {
			width: 840px;
			margin: 50px auto; /* margen superior */
			padding: 20px;
			border: 1px Solid #D8D8D8;
			background: #F2F2F2;
			-webkit-border-radius: 10px 10px 10px 10px;
			-moz-border-radius: 10px 10px 10px 10px;
			border-radius: 10px 10px 10px 10px;
			box-shadow:0px 0px 20px 4px  #ccc;  /*3 nro. Es el difuminado. 4 nro. es el tamaño*/
		}
		label {
			font-family: Calibri;
			font-size: 18px;
			font-weight: bold;
			color: #336699;
		}
		legend{
			font-family: Calibri;
			font-size: 18px;
			font-weight: bold;
			color: #6E6E6E;
		}
		fieldset {
			padding: 30px 30px 15px 30px;
		}
		#password{
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;
			color: #424242;
			padding: 5px;
			width: 300px;
			height: 15px;
			font-size: 17px;
			font-weight: bold;
			text-align: center;
			font-family: courier new;
			position:relative;
			border: none;
			box-shadow:0px 0px 10px 1px  #ccc;
		}
		input[type="submit"] {
			-webkit-border-radius: 10px;
			-moz-border-radius: 10px;
			border-radius: 10px;
			background-color: #086A87;
			color: #fff;
			display: block;
			margin: 10px auto;
			cursor: pointer;
			width: 120px;
			height: 40px;
			border: none;
			background-image: url('img/arrow.png');
			background-repeat: no-repeat;
			background-position: 15px;
			padding-left: 40px;
			-webkit-background-size: 30px 30px;           /* Safari 3.0 */
		    -moz-background-size: 30px 30px;           /* Gecko 1.9.2 (Firefox 3.6) */
		    -o-background-size: 30px 30px;           /* Opera 9.5 */
		    background-size: 30px 30px;           /* Gecko 2.0 (Firefox 4.0) and other CSS3-compliant browsers */			
			box-shadow:0px 0px 10px 1px  #ccc;
		}
		input[type="submit"]:hover {
			background-color: #0489B1;
			box-shadow:0px 0px 15px 0px  #02BAF2;
		}
		label1{
			text-transform: capitalize;
		}
		l1{
			font-family: Calibri;
			font-size: 16px;
			font-weight: bold;
			color: #336699;
		}
		#olvidoPass{
			width: 100%;
			margin-top: 15px;
		}
		a{
			text-decoration: none;
		}
    </style>
</head>
<body>
<?php
$id_Alumno = $_REQUEST['idAlumno'];
include_once "conexion.php";
$consultaNombre=pg_query("SELECT id_alumno,nombre_alumno,apellido_alumno FROM alumno WHERE id_alumno = '$id_Alumno'");
$rowNombre=pg_fetch_array($consultaNombre);
	$nombre_alumno = $rowNombre['nombre_alumno'];
	$apellido_alumno = $rowNombre['apellido_alumno'];
?>
<form id="form" name="validarPassword" action="validarPasswordGraduado.php?idAlumno=<?php echo $id_Alumno ?>" method="post">
	<fieldset>
		<legend>Validar contrase&ntilde;a</legend>
			<table align="center" cellpadding="2" cellspacing="1" width="100%">
				<tr align="center">
					<td align="center" width="100%">
						<label>Estimado/a <label1><?php echo $apellido_alumno.' '.$nombre_alumno ?></label1>, por favor ingrese su contrase&ntilde;a para poder acceder a sus datos</label>
					</td>
				</tr>
				<tr><td width="100%">&nbsp;</td></tr>
				<tr align="center">
					<!-- <td align="right" width="35%">
						<label for="cPassword">Contrase&ntilde;a: </label>
					</td> -->
					<td align="center" width="100%">
						<input id="password" type="password" placeholder="Contrase&ntilde;a" name="password" value="" autofocus required/>
					</td>
				</tr>
			</table>
			<table id="olvidoPass" align="center">
				<tr align="center" width="100%">
					<td align="center" colspan="2" width="100%">
						<l1>&iquest;Olvid&oacute; su contrase&ntilde;a? haga click <a href="pedirMail.php?idAlumno=<?php echo $id_Alumno;?>">aqu&iacute;</a></l1>
					</td>
				</tr>
				<tr align="center" width="100%">
					<td align="center" width="100%">
						<input type="submit" name="validar" value="Siguiente"/>
					</td>
				</tr>
			</table>
</fieldset>
</form>
</body>
</html>