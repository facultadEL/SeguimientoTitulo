<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="jquery-latest.js"></script>
<script type="text/javascript" src="jquery.validate.js"></script>
	<title>Solicitud de Contrase&ntilde;a</title>
	<style type="text/css">
		{font-family: Cambria }
			form {padding: 20px; border: 1px Solid #D8D8D8;background: #F2F2F2;}
			label {color: #336699; font-family: Cambria; padding-left: .5em;}
			label1 {color: #336699; font-family: Cambria; text-transform: capitalize; padding-left: .5em;}
			label.error {font-family: Cambria;float: none;vertical-align: top;color: #08298A;padding-left: .5em;}
			l1 {font-family: Cambria; color: #336699;}
    </style>
	<script>
		$(document).ready(function(){		
			$("#form").validate();
			}
		);
	</script>
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
<form class="formDNI" id="form" name="validarPassword" action="validarPasswordGraduado.php?idAlumno=<?php echo $id_Alumno ?>" method="post">
<fieldset id="tabla">
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Validar contrase&ntilde;a</FONT></legend>
<table align="center" cellpadding="2" cellspacing="1" width="100%">
	<tr align="center">
		<td align="center" colspan="2" width="100%">
			<label for="cInfo">Estimado/a<label1 for="cInfo"><?php echo $apellido_alumno.', '.$nombre_alumno ?></label1>, por favor ingrese su contrase&ntilde;a para poder acceder a sus datos: </label>
		</td>
	</tr>
	<tr><td colspan="2" width="100%">&nbsp;</td></tr>
	<tr align="center">
		<td align="right" width="35%">
			<label for="cPassword">Contrase&ntilde;a: </label>
		</td>
		<td align="left" width="65%">
			<input id="cPassword" type="password" name="password" value="" size="40" class="required"/>
		</td>
	</tr>
	<tr><td colspan="2" width="100%">&nbsp;</td></tr>
	<tr align="center">
		<td align="center" colspan="2" width="100%">
			<l1>&iquest;Olvid&oacute; su contrase&ntilde;a? haga click <a href="pedirMail.php?idAlumno=<?php echo $id_Alumno;?>">aqu&iacute;</a></l1>
		</td>
	</tr>
	<tr align="center">
		<td colspan="2" align="center">
			<input type="submit" name="validar" value="Siguiente"/>
		</td>
	</tr>
</table>
</fieldset>
</form>
</body>
</html>