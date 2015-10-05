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
var alumnoE0 = {};
var alumnoE1 = {};
var alumnoE2 = {};
var alumnoE3 = {};
var alumnoE4 = {};
var alumnoE5 = {};
var alumnoE6 = {};
var alumnoE7 = {};
var alumnoE8 = {};
var alumnoE9 = {};

var contadorA0 = 0;
var contadorA1 = 0;
var contadorA2 = 0;
var contadorA3 = 0;
var contadorA4 = 0;
var contadorA5 = 0;
var contadorA6 = 0;
var contadorA7 = 0;
var contadorA8 = 0;
var contadorA9 = 0;

var sep = '/--/';

function setAlumno(datosAlumno,etapa)
{
	//contadorAlumno++;
	switch(etapa)
	{
		case '0':
			contadorA0++;
			alumnoE0[contadorA0] = datosAlumno;
			break;
		case '1':
			contadorA1++;
			alumnoE1[contadorA1] = datosAlumno;
			break;
		case '2':
			contadorA2++;
			alumnoE2[contadorA2] = datosAlumno;
			break;
		case '3':
			contadorA3++;
			alumnoE3[contadorA3] = datosAlumno;
			break;
		case '4':
			contadorA4++;
			alumnoE4[contadorA4] = datosAlumno;
			break;
		case '5':
			contadorA5++;
			alumnoE5[contadorA5] = datosAlumno;
			break;
		case '6':
			contadorA6++;
			alumnoE6[contadorA6] = datosAlumno;
			break;
		case '7':
			contadorA7++;
			alumnoE7[contadorA7] = datosAlumno;
			break;
		case '8':
			contadorA8++;
			alumnoE8[contadorA8] = datosAlumno;
			break;
		case '9':
			contadorA9++;
			alumnoE9[contadorA9] = datosAlumno;
			break;
	}
}

function getHtml(vDatos,c,etapa)
{

	html =  "";
	html += '<tr>';
		html += '<td><strong>'+c+'</strong></td>';
		html += '<td>'+vDatos[0]+'</td>';
		html += '<td>'+vDatos[1]+'</td>';
		html += '<td>'+vDatos[2]+'</td>';
		html += '<td>'+etapa+'</td>';
	html += '</tr>';
	return html;
};

function mostrarAlumnos()
{
	htmlToAdd = "";
	contadorAlumno = 0;
	$.each(alumnoE0, function(index, value)
	{
		contadorAlumno++
		vDatosAlumno = value.split(sep);
		htmlToAdd += getHtml(vDatosAlumno, contadorAlumno,'Registrado');
	});
	$.each(alumnoE1, function(index, value)
	{
		contadorAlumno++
		vDatosAlumno = value.split(sep);
		htmlToAdd += getHtml(vDatosAlumno, contadorAlumno,'Solicitud de Titulo');
	});
	$.each(alumnoE2, function(index, value)
	{
		contadorAlumno++
		vDatosAlumno = value.split(sep);
		htmlToAdd += getHtml(vDatosAlumno, contadorAlumno,'Solicitud de Titulo - Responsable de Alumnos');
	});
	$.each(alumnoE3, function(index, value)
	{
		contadorAlumno++
		vDatosAlumno = value.split(sep);
		htmlToAdd += getHtml(vDatosAlumno, contadorAlumno,'Consejo Directivo');
	});
	$.each(alumnoE4, function(index, value)
	{
		contadorAlumno++
		vDatosAlumno = value.split(sep);
		htmlToAdd += getHtml(vDatosAlumno, contadorAlumno,'Nota a Rectorado');
	});
	$.each(alumnoE5, function(index, value)
	{
		contadorAlumno++
		vDatosAlumno = value.split(sep);
		htmlToAdd += getHtml(vDatosAlumno, contadorAlumno,'Consejo Superior');
	});
	$.each(alumnoE6, function(index, value)
	{
		contadorAlumno++
		vDatosAlumno = value.split(sep);
		htmlToAdd += getHtml(vDatosAlumno, contadorAlumno,'Ingreso de Diploma');
	});
	$.each(alumnoE7, function(index, value)
	{
		contadorAlumno++
		vDatosAlumno = value.split(sep);
		htmlToAdd += getHtml(vDatosAlumno, contadorAlumno,'Ingreso de Anal&iacute;tico');
	});
	$.each(alumnoE8, function(index, value)
	{
		contadorAlumno++
		vDatosAlumno = value.split(sep);
		htmlToAdd += getHtml(vDatosAlumno, contadorAlumno,'Retiro de Diploma');
	});
	$.each(alumnoE9, function(index, value)
	{
		contadorAlumno++
		vDatosAlumno = value.split(sep);
		htmlToAdd += getHtml(vDatosAlumno, contadorAlumno,'Retiro de Anal&iacute;tico');
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
		$.each(alumnoE0, function(index, value)
		{
			vDatosAlumno = value.split(sep);
			etapa = 'Registrado';
			if((vDatosAlumno[0].toLowerCase().indexOf(palabraBuscar) != -1) || (vDatosAlumno[1].toLowerCase().indexOf(palabraBuscar) != -1) || (vDatosAlumno[2].toLowerCase().indexOf(palabraBuscar) != -1) || (etapa.toLowerCase().indexOf(palabraBuscar) != -1))
			{
				contadorBuscar++;
				
				htmlToAdd += getHtml(vDatosAlumno,contadorBuscar,etapa);
			}
			
		});
		$.each(alumnoE1, function(index, value)
		{
			etapa = 'Solicitud de T&iacute;tulo';
			vDatosAlumno = value.split(sep);
			if((vDatosAlumno[0].toLowerCase().indexOf(palabraBuscar) != -1) || (vDatosAlumno[1].toLowerCase().indexOf(palabraBuscar) != -1) || (vDatosAlumno[2].toLowerCase().indexOf(palabraBuscar) != -1) || (etapa.toLowerCase().indexOf(palabraBuscar) != -1))
			{
				contadorBuscar++;
				
				htmlToAdd += getHtml(vDatosAlumno,contadorBuscar,etapa);
			}

		});
		$.each(alumnoE2, function(index, value)
		{
			etapa = 'Solicitud de T&iacute;tulo - Responsable de Alumnos';
			vDatosAlumno = value.split(sep);
			if((vDatosAlumno[0].toLowerCase().indexOf(palabraBuscar) != -1) || (vDatosAlumno[1].toLowerCase().indexOf(palabraBuscar) != -1) || (vDatosAlumno[2].toLowerCase().indexOf(palabraBuscar) != -1) || (etapa.toLowerCase().indexOf(palabraBuscar) != -1))
			{
				contadorBuscar++;
				
				htmlToAdd += getHtml(vDatosAlumno,contadorBuscar,etapa);
			}
		});
		$.each(alumnoE3, function(index, value)
		{
			etapa = 'Consejo Directivo';
			vDatosAlumno = value.split(sep);
			if((vDatosAlumno[0].toLowerCase().indexOf(palabraBuscar) != -1) || (vDatosAlumno[1].toLowerCase().indexOf(palabraBuscar) != -1) || (vDatosAlumno[2].toLowerCase().indexOf(palabraBuscar) != -1) || (etapa.toLowerCase().indexOf(palabraBuscar) != -1))
			{
				contadorBuscar++;
				
				htmlToAdd += getHtml(vDatosAlumno,contadorBuscar,etapa);
			}
		});
		$.each(alumnoE4, function(index, value)
		{
			etapa = 'Nota a Rectorado';
			vDatosAlumno = value.split(sep);
			if((vDatosAlumno[0].toLowerCase().indexOf(palabraBuscar) != -1) || (vDatosAlumno[1].toLowerCase().indexOf(palabraBuscar) != -1) || (vDatosAlumno[2].toLowerCase().indexOf(palabraBuscar) != -1) || (etapa.toLowerCase().indexOf(palabraBuscar) != -1))
			{
				contadorBuscar++;
				
				htmlToAdd += getHtml(vDatosAlumno,contadorBuscar,etapa);
			}
		});
		$.each(alumnoE5, function(index, value)
		{
			etapa = 'Consejo Superior';
			vDatosAlumno = value.split(sep);
			if((vDatosAlumno[0].toLowerCase().indexOf(palabraBuscar) != -1) || (vDatosAlumno[1].toLowerCase().indexOf(palabraBuscar) != -1) || (vDatosAlumno[2].toLowerCase().indexOf(palabraBuscar) != -1) || (etapa.toLowerCase().indexOf(palabraBuscar) != -1))
			{
				contadorBuscar++;
				
				htmlToAdd += getHtml(vDatosAlumno,contadorBuscar,etapa);
			}
		});
		$.each(alumnoE6, function(index, value)
		{
			etapa = 'Ingreso de Diploma'
			vDatosAlumno = value.split(sep);
			if((vDatosAlumno[0].toLowerCase().indexOf(palabraBuscar) != -1) || (vDatosAlumno[1].toLowerCase().indexOf(palabraBuscar) != -1) || (vDatosAlumno[2].toLowerCase().indexOf(palabraBuscar) != -1) || (etapa.toLowerCase().indexOf(palabraBuscar) != -1))
			{
				contadorBuscar++;
				
				htmlToAdd += getHtml(vDatosAlumno,contadorBuscar,etapa);
			}
		});
		$.each(alumnoE7, function(index, value)
		{
			etapa = 'Ingreso de Anal&iacute;tico';
			vDatosAlumno = value.split(sep);
			if((vDatosAlumno[0].toLowerCase().indexOf(palabraBuscar) != -1) || (vDatosAlumno[1].toLowerCase().indexOf(palabraBuscar) != -1) || (vDatosAlumno[2].toLowerCase().indexOf(palabraBuscar) != -1) || (etapa.toLowerCase().indexOf(palabraBuscar) != -1))
			{
				contadorBuscar++;
				
				htmlToAdd += getHtml(vDatosAlumno,contadorBuscar,etapa);
			}
		});
		$.each(alumnoE8, function(index, value)
		{
			etapa = 'Retiro de Diploma';
			vDatosAlumno = value.split(sep);
			if((vDatosAlumno[0].toLowerCase().indexOf(palabraBuscar) != -1) || (vDatosAlumno[1].toLowerCase().indexOf(palabraBuscar) != -1) || (vDatosAlumno[2].toLowerCase().indexOf(palabraBuscar) != -1) || (etapa.toLowerCase().indexOf(palabraBuscar) != -1))
			{
				contadorBuscar++;
				
				htmlToAdd += getHtml(vDatosAlumno,contadorBuscar,etapa);
			}
		});
		$.each(alumnoE9, function(index, value)
		{
			etapa = 'Retiro de Anal&iacute;tico';
			vDatosAlumno = value.split(sep);
			if((vDatosAlumno[0].toLowerCase().indexOf(palabraBuscar) != -1) || (vDatosAlumno[1].toLowerCase().indexOf(palabraBuscar) != -1) || (vDatosAlumno[2].toLowerCase().indexOf(palabraBuscar) != -1) || (etapa.toLowerCase().indexOf(palabraBuscar) != -1))
			{
				contadorBuscar++;
				
				htmlToAdd += getHtml(vDatosAlumno,contadorBuscar,etapa);
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

function getEtapa($row)
{
	$etapa = 0;
	if(is_null($row['fecha_retiro_analitico']))
	{
		if(is_null($row['fecha_retiro_diploma']))
		{
			if(is_null($row['fecha_ingreso_analitico']))
			{
				if(is_null($row['fecha_ingreso_diploma']))
				{
					if(is_null($row['fecha_rescs']))
					{
						if(is_null($row['fecha_nota_envio_rec']))
						{
							if(is_null($row['fecha_rescd']))
							{
								if(is_null($row['fecha_resp_alumno']))
								{
									if(is_null($row['fecha_solicitud']))
									{
										$etapa = 0;
									}
									else
									{
										$etapa = 1;
									}
								}
								else
								{
									$etapa = 2;
								}
							}
							else
							{
								$etapa = 3;
							}
						}
						else
						{
							$etapa = 4;
						}
					}
					else
					{
						$etapa = 5;
					}
				}
				else
				{
					$etapa = 6;
				}
			}
			else
			{
				$etapa = 7;
			}
		}
		else
		{
			$etapa = 8;	
		}
	}
	else
	{
		$etapa = 9;
	}

	return $etapa;
}

include_once 'conexion.php';
//$control = $_REQUEST['control'];
$consulta = "SELECT id_alumno,nombre_alumno,apellido_alumno,numerodni_alumno,carrera.nombre_carrera,nombre_nivel_carrera,seguimiento.* FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) ORDER BY apellido_alumno ASC,nombre_alumno ASC";
$sep = '/--/';

//echo $consulta;
//fecha_solicitud,fecha_resp_alumno,fecha_rescd,fecha_nota_envio_rec,fecha_rescs,fecha_ingreso_diploma,fecha_ingreso_analitico,fecha_retiro_diploma,fecha_retiro_analitico

$sqlConsulta = pg_query($consulta);

while($rowConsulta = pg_fetch_array($sqlConsulta))
{
	$nombreA = ucwords(strtolower($rowConsulta['nombre_alumno']));
	$apellidoA = ucwords(strtolower($rowConsulta['apellido_alumno']));
	$dniA = $rowConsulta['numerodni_alumno'];
	$etapaA = getEtapa($rowConsulta);
	
	$datosAlumno = $apellidoA.$sep.$nombreA.$sep.$dniA;

	echo '<script>setAlumno("'.$datosAlumno.'","'.$etapaA.'");</script>';
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
					<th>Etapa</th>
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