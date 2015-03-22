<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="jquery.mask.js" type="text/javascript"></script>
	<title>Validar DNI de Usuario</title>
	<style type="text/css">
		body {
			background: #e1e1e1 url('img/ruido.png') repeat; 
			color: #000;
			font-family: "Varela Round", Arial, Helvetica, sans-serif;
			font-size: 14px;
			line-height: 1em;
		}
		form {
			width: 960px;
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
			color: #336699;
			font-family: Calibri;
			padding-left: .5em;
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
		.nrodni{
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
    </style>
    <script>
		function maskDni()
		{
			valDni = $('#DNI').val();
			switch(valDni.length)
			{
				case 7:
					//mascara = "0.000.000";
					break;
				case 8:
					mascara = "00.000.000";
					break;
			}
			$('#DNI').mask(mascara);
		}
	</script>
</head>
<body>
<form id="form" name="validarDNI" action="validarDNIgraduado.php" method="post">
	<fieldset>
		<legend>Verificar DNI</legend>
			<table align="center" cellpadding="2" cellspacing="2" width="100%">
				<tr align="center">
		<!-- <td align="right" width="35%">
			<label for="Msj">Escribir msj de bienvenida: </label>
		</td> -->
					<!--<td align="right" width="35%">
						<label for="cDNI">N&deg; DNI: </label>
					</td> -->
					<td align="center" width="100%">
						<!-- <input id="DNI" class="nrodni" type="text" pattern="[0-9]{7,8}" placeholder="N&uacute;mero de DNI" onclick="this.value = '';" onblur="maskDni()" name="numDNI" value="" maxlength="10" title="Ingrese su documento correctamente." required/> -->
						<input id="DNI" class="nrodni" type="text" pattern="[0-9]{2}+[.]{1}[0-9]{3}+[.]{1}[0-9]{3}" placeholder="N&uacute;mero de DNI" onkeyup="maskDni()" onfocus="this.value = '';" name="numDNI" value="" maxlength="10" title="Ingrese su documento correctamente." autocomplete="off" autofocus required/>
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