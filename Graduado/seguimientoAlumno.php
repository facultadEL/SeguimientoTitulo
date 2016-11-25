<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<title>Graduado</title>
	<style type="text/css">
		body {
			background: #fff; 
			color: #000;
			font-family: "Varela Round", Arial, Helvetica, sans-serif;
			font-size: 14px;
			line-height: 1em;
			width: 100%;
		}
		#tablaGeneral{
			width: 80%;
			margin: 1% auto; /* margen superior */
			margin-top: 5%;
		}
		#FormVerAlumno {
			width: 96%;
			background: #F2F2F2;
			-webkit-border-radius: 10px 10px 10px 10px;
			-moz-border-radius: 10px 10px 10px 10px;
			border-radius: 10px 10px 10px 10px;
			box-shadow:0px 0px 20px 4px  #ccc;  /*3 nro. Es el difuminado. 4 nro. es el tamaño*/
		}
		.formVerGraduado {
			padding: 1.5%;
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
			padding-right: 0.6%;
		}
		labelTit {
			font-family: Calibri;
			font-size: 24px;
			font-weight: bold;
			color: #331144;
		}
		l1 {
			font-family: Calibri;
			color: #424242;
		}
		a {
			text-decoration:none
		}
		#btn_salir{
			-webkit-border-radius: 10px;
			-moz-border-radius: 10px;
			border-radius: 10px;
			background-color: #086A87;
			color: #fff;
			cursor: pointer;
			width: 10%;
			height: 40px;
			border: none;
			font-size: 14px;
			font-weight: bold;
		}
		#btn_salir:hover {
			box-shadow:0px 0px 15px 0px  #0489B1;
		}
		#tablaBtn{
			margin-bottom: 5%;
			text-align: center;
			width: 100%;
		}
    </style>
</head>
<body>
<?php
$titulo = $_REQUEST['titulo_alumno'];
$id_Alumno = $_REQUEST['idAlumno'];
include_once "conexion.php";
?>
<table id="tablaGeneral">
		<?php if($titulo != NULL AND $titulo != 0){ ?>
	<!-- </table> -->
	<tr width="100%">
		<td width="100%">
			<form class="formVerGraduado" id="FormVerAlumno" method="post">

			<?php
			// $id_Alumno = $_REQUEST['idAlumno'];
			$titulo = $_REQUEST['titulo_alumno'];

				$datosSeguimiento = pg_query("SELECT seguimiento.*, nombre_carrera FROM seguimiento INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) WHERE alumno_fk = '$id_Alumno' AND carrera_fk = '$titulo'");
				/*$datosSeguimiento = pg_query("SELECT seguimientotitulo.*, carrera.nombre As carrera FROM seguimientotitulo INNER JOIN carrera ON(carrera.id = seguimientotitulo.carrera_fk) INNER JOIN personasistema ON(personasistema.id = seguimientotitulo.personasistema_fk) WHERE personasistema.persona_fk = '$id_Alumno' AND seguimientotitulo.carrera_fk = '$titulo'");*/
				$row=pg_fetch_array($datosSeguimiento);
					$nombre_carrera = $row['nombre_carrera'];//$nombre_carrera = $row['carrera'];
					$fecha_solicitud = ($row['fecha_solicitud'] == null) ? "--/--/----" : $row['fecha_solicitud'];
					$fecha_rescd = ($row['fecha_rescd'] == null) ? "--/--/----" : $row['fecha_rescd'];//??????
					$fecha_nota_envio_rec = ($row['fecha_nota_envio_rec'] == null) ? "--/--/----" : $row['fecha_nota_envio_rec'];//$fecha_nota_envio_rec = ($row['fecha_notarectorado'] == null) ? "--/--/----" : $row['fecha_notarectorado'];
					$fecha_rescs = ($row['fecha_rescs'] == null) ? "--/--/----" : $row['fecha_rescs'];//??????
					$fecha_ingreso_diploma = ($row['fecha_ingreso_diploma'] == null) ? "--/--/----" : $row['fecha_ingreso_diploma'];//$fecha_ingreso_diploma = ($row['fecha_idiploma'] == null) ? "--/--/----" : $row['fecha_idiploma'];
					$fecha_ingreso_analitico = ($row['fecha_ingreso_analitico'] == null) ? "--/--/----" : $row['fecha_ingreso_analitico'];//$fecha_ingreso_analitico = ($row['fecha_ianalitico'] == null) ? "--/--/----" : $row['fecha_ianalitico'];
					$fecha_retiro_diploma = ($row['fecha_retiro_diploma'] == null) ? "--/--/----" : $row['fecha_retiro_diploma'];//$fecha_retiro_diploma = ($row['fecha_rdiploma'] == null) ? "--/--/----" : $row['fecha_rdiploma'];
					$fecha_retiro_analitico = ($row['fecha_retiro_analitico'] == null) ? "--/--/----" : $row['fecha_retiro_analitico'];//$fecha_retiro_analitico = ($row['fecha_ranalitico'] == null) ? "--/--/----" : $row['fecha_ranalitico'];
			?>
				<fieldset>
					<legend>Seguimiento</legend>
						<table align="center" width="100%">
							<tr width="100%">
								<td colspan="2" align="center">
									<labelTit><?php echo $nombre_carrera; ?></labelTit>
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
			<center>
			<table id="tablaBtn">
				<tr>
					<td>
						<?php echo '<a href="verAlumno.php?titulo_alumno='.$titulo.'&idAlumno='.$id_Alumno.'"><input type="button" id="btn_salir" value="Volver"></a>'; ?>
					</td>
				</tr>
			</table>
			</center>
			<?php } ?>
		</td>
	</tr>
</table>
</body>
</html>