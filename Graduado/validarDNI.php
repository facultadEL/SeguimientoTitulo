<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="jquery-latest.js"></script>
<script type="text/javascript" src="jquery.validate.js"></script>
	<title>Registro de Graduado</title>
	<style type="text/css">
		{font-family: Cambria }
			form {padding: 20px; border: 1px Solid #D8D8D8;background: #F2F2F2;}
			label {color: #336699; font-family: Cambria; padding-left: .5em;}
			label.error {font-family: Cambria;float: none;vertical-align: top;color: #08298A;padding-left: .5em;}
    </style>
	<script>
		$(document).ready(function(){		
			$('form').validate();
			}
		);
	</script>
</head>
<body>
<form class="formDNI" id="form" name="validarDNI" action="validarDNIgraduado.php" method="post">
<fieldset id="tabla">
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Verificar DNI</FONT></legend>
<table align="center" cellpadding="2" cellspacing="2" width="100%">
	<tr align="center">
		<!-- <td align="right" width="35%">
			<label for="Msj">Escribir msj de bienvenida: </label>
		</td> -->
		<td align="right" width="35%">
			<label for="cDNI">DNI: </label>
		</td>
		<td align="left" width="65%">
			<input id="cDNI" type="text" name="numDNI" value="" size="40" maxlength="8" class="required number"/>
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