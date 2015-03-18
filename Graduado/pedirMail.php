<html>
	<head>
		<title> Olvido de Password </title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<script src="jquery-latest.js"></script>
		<script type="text/javascript" src="jquery.validate.js"></script>
		<style type="text/css">
		{font-family: Cambria }
			form {padding: 20px; border: 1px Solid #D8D8D8;background: #F2F2F2;}
			label {color: #336699; font-family: Cambria; padding-left: .5em;}
			label.error {font-family: Cambria;float: none;vertical-align: top;color: #08298A;padding-left: .5em;}
			l1 {font-family: Cambria; color: #336699;}
		</style>
		<script>
		$(document).ready(function(){
		
		$("#form").validate();
			
		});
		</script>
	</head>
<body>
<?php
$correo = $_REQUEST['correo'];
$id_Alumno = $_REQUEST['idAlumno'];
?>
<form class="login" id="form" name="validarPassword" action="olvidoPassword.php?idAlumno=<?php echo $id_Alumno ?>" method="post">
<fieldset id="tabla">
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Ingrese su Mail</FONT></legend>
<table align="center" cellpadding="2" cellspacing="1" width="100%">
	<tr align="center">
		<td align="right" width="15%">
			<label for="cMail">Mail: </label>
		</td>
		<td width="85%">
			<input id="cMail" type="text" name="mail" value="<?php echo $correo; ?>" size="40" class="required email"/>
		</td>
	</tr>
	<tr align="center">
		<td colspan="2" align="center">
			<input type="submit" name="validar" value="Enviar"/>
		</td>
	</tr>
</table>
</fieldset>
</form>
</body>
</html>