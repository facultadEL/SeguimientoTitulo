<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<script type='text/javascript' src="js/jquery.min.js"></script>
	<title>Graduado</title>
	<style type="text/css">
		body {
			background: #fff; 
			color: #000;
			font-family: "Varela Round", Arial, Helvetica, sans-serif;
			font-size: 14px;
			line-height: 1em;
		}
		.formTitulo {
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
		.formVerGraduado {
			width: 100%;
			margin: 0px auto; /* margen superior */
			padding: 20px 20px 20px 20px;
			border: 1px Solid #D8D8D8;
			background: #F2F2F2;
			-webkit-border-radius: 10px 10px 10px 10px;
			-moz-border-radius: 10px 10px 10px 10px;
			border-radius: 10px 10px 10px 10px;
			box-shadow:0px 0px 20px 4px  #ccc;  /*3 nro. Es el difuminado. 4 nro. es el tamaño*/
		}
		img {
			box-shadow:0px 0px 20px 4px  #ccc;  /*3 nro. Es el difuminado. 4 nro. es el tamaño*/	
		}
		legend{
			font-family: Calibri;
			font-size: 18px;
			font-weight: bold;
			color: #6E6E6E;
		}
		label {
			font-family: Calibri;
			font-size: 18px;
			font-weight: bold;
			color: #336699;
			text-transform: capitalize;
			padding-right: 5px;
		}
		l1 {
			font-family: Calibri;
			color: #424242;
			text-transform: capitalize;
			padding-left: 5px;
		}
		l2 {
			font-family: Calibri;
			color: #424242;
			padding-left: 5px;
		}
		#tablaCar{
			padding: 15px 0px 15px 0px;
		}
		a {
			text-decoration:none
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
		}
		select:hover{
			background-color: #F5FBEF;
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
		#btn_editar{
			-webkit-border-radius: 10px;
			-moz-border-radius: 10px;
			border-radius: 10px;
			background-color: #489785;
			color: #fff;
			display: block;
			margin: 10px auto;
			cursor: pointer;
			width: 120px;
			height: 40px;
			border: none;
			background-image: url('img/modificar.png');
			background-repeat: no-repeat;
			background-position: 12px;
			padding-left: 40px;
			-webkit-background-size: 30px 30px;           /* Safari 3.0 */
		    -moz-background-size: 30px 30px;           /* Gecko 1.9.2 (Firefox 3.6) */
		    -o-background-size: 30px 30px;           /* Opera 9.5 */
		    background-size: 30px 30px;           /* Gecko 2.0 (Firefox 4.0) and other CSS3-compliant browsers */
		    margin-right: 5px;
		}
		#btn_editar:hover {
			box-shadow:0px 0px 15px 0px  #04B486;
		}
		#btn_print{
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
			background-image: url('img/print3.png');
			background-repeat: no-repeat;
			background-position: 12px;
			padding-left: 40px;
			-webkit-background-size: 30px 30px;           /* Safari 3.0 */
		    -moz-background-size: 30px 30px;           /* Gecko 1.9.2 (Firefox 3.6) */
		    -o-background-size: 30px 30px;           /* Opera 9.5 */
		    background-size: 30px 30px;           /* Gecko 2.0 (Firefox 4.0) and other CSS3-compliant browsers */
		    margin-left: 5px;
		}
		#btn_print:hover {
			box-shadow:0px 0px 15px 0px  #0489B1;
		}
		#btn_salir{
			-webkit-border-radius: 10px;
			-moz-border-radius: 10px;
			border-radius: 10px;
			background-color: #8A0808;
			color: #fff;
			display: block;
			margin: 10px auto;
			cursor: pointer;
			width: 250px;
			height: 40px;
			border: none;
			background-image: url('Graduado/img/power1.png');
			background-repeat: no-repeat;
			background-position: 95px;
			padding-left: 40px;
			-webkit-background-size: 30px 30px;           /* Safari 3.0 */
		    -moz-background-size: 30px 30px;           /* Gecko 1.9.2 (Firefox 3.6) */
		    -o-background-size: 30px 30px;           /* Opera 9.5 */
		    background-size: 30px 30px;           /* Gecko 2.0 (Firefox 4.0) and other CSS3-compliant browsers */
		}
		#btn_salir:hover {
			box-shadow:0px 0px 15px 0px  #DF0101;
		}
		#tablaBtn{
			margin-bottom: 50px;
		}
    </style>
</head>
<body>
<?php
$titulo = $_REQUEST['titulo_alumno'];
$id_Alumno = $_REQUEST['idAlumno'];
include_once "conexion.php";
?>
<table align="center" id="tablaGeneral" width="50%">
		<?php if($titulo != NULL AND $titulo != 0){ ?>
	<!-- </table> -->
	<tr width="100%">
		<td width="100%">
			<form class="formVerGraduado" id="FormVerAlumno" method="post">

			<?php
			// $id_Alumno = $_REQUEST['idAlumno'];
			$titulo = $_REQUEST['titulo_alumno'];

				$datosSeguimiento = pg_query("SELECT seguimiento.*, nombre_carrera FROM seguimiento INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) WHERE alumno_fk = '$id_Alumno' AND carrera_fk = '$titulo'");
				$row=pg_fetch_array($datosSeguimiento);
					$nombre_carrera = $row['nombre_carrera'];
					$fecha_solicitud = ($row['fecha_solicitud'] == null) ? "--/--/----" : $row['fecha_solicitud'];
					$fecha_rescd = ($row['fecha_rescd'] == null) ? "--/--/----" : $row['fecha_rescd'];
					$fecha_nota_envio_rec = ($row['fecha_nota_envio_rec'] == null) ? "--/--/----" : $row['fecha_nota_envio_rec'];
					$fecha_rescs = ($row['fecha_rescs'] == null) ? "--/--/----" : $row['fecha_rescs'];
					$fecha_ingreso_diploma = ($row['fecha_ingreso_diploma'] == null) ? "--/--/----" : $row['fecha_ingreso_diploma'];
					$fecha_ingreso_analitico = ($row['fecha_ingreso_analitico'] == null) ? "--/--/----" : $row['fecha_ingreso_analitico'];
					$fecha_retiro_diploma = ($row['fecha_retiro_diploma'] == null) ? "--/--/----" : $row['fecha_retiro_diploma'];
					$fecha_retiro_analitico = ($row['fecha_retiro_analitico'] == null) ? "--/--/----" : $row['fecha_retiro_analitico'];
			?>
				<fieldset>
					<legend>Seguimiento</legend>
						<table align="center" width="100%">
							<tr width="100%">
								<td colspan="2" align="center">
									<label><b><?php echo $nombre_carrera; ?></b></label>
								</td>
							</tr>
							<tr width="100%">
								<td colspan="2" align="center">
									<label>&nbsp;</label>
								</td>
							</tr>
							<tr width="100%">
								<td width="50%" align="right">
									<label>Solicitud de T&iacute;tulo: </label>
								</td>
								<td width="50%" align="left">
									<l1><?php echo $fecha_solicitud; ?></l1>
								</td>
							</tr>
							<tr width="100%">
								<td width="50%" align="right">
									<label>Resoluci&oacute;n Consejo Directivo: </label>
								</td>
								<td width="50%" align="left">
									<l1><?php echo $fecha_rescd; ?></l1>
								</td>
							</tr>
							<tr width="100%">
								<td width="50%" align="right">
									<label>Nota a Rectorado: </label>
								</td>
								<td width="50%" align="left">
									<l1><?php echo $fecha_nota_envio_rec; ?></l1>
								</td>
							</tr>
							<tr width="100%">
								<td width="50%" align="right">
									<label>Resoluci&oacute;n Consejo Superior: </label>
								</td>
								<td width="50%" align="left">
									<l1><?php echo $fecha_rescs; ?></l1>
								</td>
							</tr>
							<tr width="100%">
								<td width="50%" align="right">
									<label>Ingreso de Diploma: </label>
								</td>
								<td width="50%" align="left">
									<l1><?php echo $fecha_ingreso_diploma; ?></l1>
								</td>
							</tr>
							<tr width="100%">
								<td width="50%" align="right">
									<label>Ingreso de Anal&iacute;tico: </label>
								</td>
								<td width="50%" align="left">
									<l1><?php echo $fecha_ingreso_analitico; ?></l1>
								</td>
							</tr>
							<tr width="100%">
								<td width="50%" align="right">
									<label>Entrega de Diploma: </label>
								</td>
								<td width="50%" align="left">
									<l1><?php echo $fecha_retiro_diploma; ?></l1>
								</td>
							</tr>
							<tr width="100%">
								<td width="50%" align="right">
									<label>Entrega de Anal&iacute;tico: </label>
								</td>
								<td width="50%" align="left">
									<l1><?php echo $fecha_retiro_analitico; ?></l1>
								</td>
							</tr>
						</table>
					</fieldset>
			</form>
			<table id="tablaBtn" align="center">
				<tr width="100%">
					<td width="100%" colspan="2">
						&nbsp;
					</td>
				</tr>
				<tr width="100%">
					<td width="100%" align="center" colspan="2">
						<?php echo '<a href="Graduado/verAlumno.php?titulo_alumno='.$titulo.'&idAlumno='.$id_Alumno.'"><input type="button" id="btn_salir" value="Volver"></a>'; ?>
					</td>
				</tr>
			</table>
			<?php } ?>
		</td>
	</tr>
</table>
</body>
</html>