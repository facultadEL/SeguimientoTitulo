<html>
<head>
<title> Listado Graduados </title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--style type="text/css">
	label {font-family: Cambria; text-transform: capitalize; padding: .5em; color: #0080FF;}
	#tabla {background: #F2F2F2;}
	#titulo3 { border-top: 2px solid #BDBDBD;border-bottom: 2px solid #BDBDBD;padding: 3px;}
	l1 {font-family: Cambria;color: #0B615E; text-transform: capitalize; font-size: 1.5em;}
	l2 {font-family: Cambria;color: #424242; text-transform: capitalize; padding: .12em;}
</style-->
<script>
	
var alumnoDictionary = {};
var contadorAlumno = 0;
var sep = '/--/';

function setAlumno(datosAlumno)
{
	contadorAlumno++;
	alumnoDictionary[contadorAlumno] = datosAlumno;
}

function mostrarAlumnos()
{
	htmlToAdd = "";
	$.each(alumnoDictionary, function(index, value)
	{
		vDatosAlumno = value.split(sep);

		htmlToAdd += '<tr>';
			htmlToAdd += '<td><strong>'+index+'</strong></td>';
			htmlToAdd += '<td>'+vDatosAlumno[0]+'</td>';
			htmlToAdd += '<td>'+vDatosAlumno[1]+'</td>';
			htmlToAdd += '<td>'+vDatosAlumno[2]+'</td>';
			htmlToAdd += '<td>'+vDatosAlumno[3]+'</td>';
		htmlToAdd += '</tr>';

	});

	$('#idDatosAlumno').html(htmlToAdd);
}

function controlBuscar()
{
	palabraBuscar = $('#contenidoBuscar').val().toLowerCase().trim();
	contadorBuscar = 0;
	htmlToAdd = "";
	if(palabraBuscar != '')
	{
		$.each(alumnoDictionary, function(index, value)
		{
			vDatosAlumno = value.split(sep);

			if((vDatosAlumno[0].toLowerCase().indexOf(palabraBuscar) != -1) || (vDatosAlumno[1].toLowerCase().indexOf(palabraBuscar) != -1) || (vDatosAlumno[2].toLowerCase().indexOf(palabraBuscar) != -1))
			{
				contadorBuscar++;
				
				htmlToAdd += '<tr>';
					htmlToAdd += '<td><strong>'+contadorBuscar+'</strong></td>';
					htmlToAdd += '<td>'+vDatosAlumno[0]+'</td>';
					htmlToAdd += '<td>'+vDatosAlumno[1]+'</td>';
					htmlToAdd += '<td>'+vDatosAlumno[2]+'</td>';
					htmlToAdd += '<td>'+vDatosAlumno[3]+'</td>';
				htmlToAdd += '</tr>';
			}

		});

		$('#idDatosAlumno').html(htmlToAdd);
	}
	else
	{
		mostrarAlumnos();
	}
}

function printListado()
{
	//$('#listadoAlumnos').print();
     var printContents = document.getElementById('listadoAlumnos').innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;

}

$(document).ready(function()
{

mostrarAlumnos();

});

</script>
</head>
<?php
include_once 'conexion.php';
//$control = $_REQUEST['control'];
$consulta = "SELECT id_alumno,nombre_alumno,apellido_alumno,numerodni_alumno,carrera.nombre_carrera,nombre_nivel_carrera FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) ORDER BY id_nivel_carrera ASC,nombre_carrera ASC,apellido_alumno ASC,nombre_alumno ASC";
$sep = '/--/';

$sqlConsulta = pg_query($consulta);
while($rowConsulta = pg_fetch_array($sqlConsulta))
{
	$nombreA = ucwords(strtolower($rowConsulta['nombre_alumno']));
	$apellidoA = ucwords(strtolower($rowConsulta['apellido_alumno']));
	$dniA = $rowConsulta['numerodni_alumno'];
	$carreraA = $rowConsulta['nombre_carrera'];

	$datosAlumno = $apellidoA.$sep.$nombreA.$sep.$dniA.$sep.$carreraA;

	echo '<script>setAlumno("'.$datosAlumno.'");</script>';
}

?>
<body link="#000000" vlink="#000000" alink="#FFFFFF">
<?php
//echo '<a href="excelSeguimiento.php?control='.$control.'&palabra='.$palabra.'"><input type="button" value="Excel" /></a>';
?>
<div id="container">
	<div class="col-xs-12" align="center">
		<h4>Listado de Alumnos</h4>
	</div>
</div>
<div id="container">
	<div class="col-xs-2 col-sm-3 col-md-4"></div>
	<div class="col-xs-8 col-sm-6 col-md-4" align="center">
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Buscar..." id="contenidoBuscar" onkeyup="controlBuscar()">
			<span class="input-group-btn">
				<button class="btn btn-default" type="button">Buscar</button>
				<button class="btn btn-default" type="button" onclick="printListado()">Excel</button>
			</span>
		</div><!-- /input-group -->
	</div>
</div>
<div id="container">
	<div id="listadoAlumnos" class="col-xs-12">
		<table class="table table-striped table-responsive">
			<thead>
				<tr>
					<th colspan="5">
						Listado de Alumnos
					</th>
				</tr>
				<tr>
					<th>#</th>
					<th>Apellido</th>
					<th>Nombre</th>
					<th>DNI</th>
					<th>Carrera</th>
				</tr>
			</thead>
			<tbody id="idDatosAlumno">
				
			</tbody>
		</table>
	</div>
</div>
<!--p>
<a href="buscador.php"><center><input type="button" value="Atr&aacute;s"></center></a>
</p-->
</body>
</html>