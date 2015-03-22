<html>
	<head>
		<title> Olvido de Password </title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<script src="jquery-latest.js"></script>
		<script type="text/javascript" src="jquery.validate.js"></script>
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
			/*label {
				font-family: Calibri;
				font-size: 18px;
				font-weight: bold;
				color: #336699;
			}*/
			legend{
				font-family: Calibri;
				font-size: 18px;
				font-weight: bold;
				color: #6E6E6E;
			}
			fieldset {
				padding: 30px 30px 15px 30px;
			}
			#mail{
				-webkit-border-radius: 3px;
				-moz-border-radius: 3px;
				border-radius: 3px;
				color: #424242;
				padding: 15px;
				width: 400px;
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
				margin-top: 20px;
				cursor: pointer;
				width: 120px;
				height: 40px;
				border: none;
				background-image: url('img/mail.png');
				background-repeat: no-repeat;
				background-position: 15px;
				padding-left: 40px;
				-webkit-background-size: 40px 40px;           /* Safari 3.0 */
			    -moz-background-size: 40px 40px;           /* Gecko 1.9.2 (Firefox 3.6) */
			    -o-background-size: 40px 40px;           /* Opera 9.5 */
			    background-size: 40px 40px;           /* Gecko 2.0 (Firefox 4.0) and other CSS3-compliant browsers */
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
$correo = $_REQUEST['correo'];
$id_Alumno = $_REQUEST['idAlumno'];
?>
<form id="form" name="validarPassword" action="olvidoPassword.php?idAlumno=<?php echo $id_Alumno ?>" method="post">
<fieldset>
	<legend>Ingrese su Mail</legend>
		<table align="center" width="100%">
			<tr align="center">
				<!-- <td align="right" width="15%">
					<label for="cMail">Mail: </label>
				</td> -->
				<td width="100%">
					<input id="mail" type="email" name="mail" value="<?php echo $correo; ?>" autocomplete="off" autofocus required/>
				</td>
			</tr>
			<tr align="center">
				<td align="center">
					<input type="submit" name="validar" value="Enviar"/>
				</td>
			</tr>
		</table>
</fieldset>
</form>
</body>
</html>