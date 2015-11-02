<html>
<head>
<title> Solicitud Titulo </title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!--script src="jquery-latest.js"></script-->
<script src="jquery.mask.js" type="text/javascript"></script>
<script>
/*
jQuery(function($){
	$("#numero1").mask("9,99", {

		// Generamos un evento en el momento que se rellena
		completed:function(){
			$("#numero1").addClass("ok")
		}
	});
	
	// Definimos las mascaras para cada input
	$("#date").mask("39/19/2999");
	$("#movil").mask("999 99 99 99");
	$("#letras").mask("aaa");
	*/
	//$("#resolucion").mask("****/**");
	/*
	$("#comodines").mask("?");
});
*/

var etapa = 1;
var fechaIngreso = "nada";
var alumnosSeleccionados = [];
var alumnosDiccionario = {};
var separador = '/--/';
//prevHtml = '<table align="center" cellspacing="1" cellpadding="4" border="1" bgcolor=#585858 id="tabla">';
prevHtml = '<tr bgcolor="#FFFFFF">';
prevHtml += '<td id="titulo3" colspan="5" align="center"><l1>Listado de Alumnos  - Solicitud Titulo</l1></td>';
prevHtml += '</tr>';
//prevHtml += '<tr bgcolor="#FFFFFF">';
//prevHtml += '<td id="titulo3" colspan="5" align="center"><l1>Fecha de resoluci&oacute;n:</l1>&nbsp;&nbsp;<input type="text" name="fechaIngreso" value="'+fechaIngreso+'" id="date" placeholder="dd/mm/aaaa" onBlur="setFecha()" class="fallback" data-mask-clearifnotmatch="true" autoComplete="off"/></td>';
//prevHtml += '</tr>';
prevHtml += '<tr bgcolor="#FFFFFF">';
prevHtml += '<td id="titulo3" colspan="5" align="center"><input type="button" value="Confirmar" onmouseup="confirmSeleccion()"/></td>';
prevHtml += '</tr>';
prevHtml += '<tr bgcolor="#000000">';
prevHtml += '<td align="center"><strong><label>Alumno</label></strong></td>';
prevHtml += '<td align="center"><strong><label>Carrera</label></strong></td>';
prevHtml += '<td align="center"><strong><label>Nivel</label></strong></td>';
prevHtml += '<td align="center"><strong><label>Selecci&oacute;n</label></strong></td>';
prevHtml += '</tr>';
finHtml = '</table>';
		
function setAlumnoSelectRedireccion(alumnosString)
{
	var vStringAlumnoRecibido = alumnosString.split('/-/-/');
	for(var i = 0; i < (vStringAlumnoRecibido.length - 1); i++)
	{
		vStringAlumnoEspecifico = vStringAlumnoRecibido[i].split('/--/');
		$.each(alumnosDiccionario, function(key,value)
		{
			var vStringAlumno = value.split(separador);
			if(vStringAlumnoEspecifico[0] == vStringAlumno[0])
			{
				alumnosSeleccionados.push(parseInt(key));
			}
		});
	}
}

/*
function setFechaRedireccion(fechaRecibida)
{
	fechaIngreso = fechaRecibida;
}
*/

function cargarAlumno(id, stringAlumno)
{
	alumnosDiccionario[id] = stringAlumno;
}

/*
function setFecha()
{
	fechaIngreso = $('#date').val();

}
*/

function setAlumnoSelect(idAlumno)
{
	if($.inArray(idAlumno, alumnosSeleccionados) == -1)
	{
		alumnosSeleccionados.push(idAlumno);
	}
	else
	{
		alumnosSeleccionados.splice(($.inArray(idAlumno, alumnosSeleccionados)), 1);
	}
}

function controlBusqueda()
{
	if(($('#cPalabra').val()) == '' || ($('#cPalabra').val()) == null)
	{
		mostrarAlumnos(false);
	}
	else
	{
		mostrarAlumnos(true);
	}
}

function mostrarAlumnos(busqueda)
{
	var alumnosToAdd = '';
	var checked = '';
	var nombreCheck = '';
	if(busqueda == false)
	{
		//prevHtml = $('#tabla').html();		
		$.each(alumnosDiccionario, function(key,value)
		{
			var vStringAlumno = value.split(separador);
			if($.inArray(parseInt(key),alumnosSeleccionados) == -1)
			{
				checked = '';
			}
			else
			{
				checked = 'checked';
			}
			nombreCheck = "checkbox"+key;
			alumnosToAdd += '<tr><td align="center"><l2>'+vStringAlumno[1]+', '+vStringAlumno[2]+'</l2></td><td align="center"><l2>'+vStringAlumno[3]+'</l2></td><td align="center"><l2>'+vStringAlumno[4]+'</l2></td><td align="center"><input id="ctemario_general_curso" name="'+nombreCheck+'" type="checkbox" onChange="setAlumnoSelect('+key+')" '+checked+' /></td></tr>';
		});
	}
	else
	{
		var alumnoEncontrado = false;
		palabraABuscar = ($('#cPalabra').val()).toLowerCase();
		$.each(alumnosDiccionario, function(key,value)
		{
			alumnoEncontrado = false;
			var vStringAlumno = value.toLowerCase().split(separador);
			for(var i = 0; i < vStringAlumno.length; i++)
			{
				if(i != 0)
				{
					if(vStringAlumno[i].indexOf(palabraABuscar) != -1)
					{
						alumnoEncontrado = true;
						break;
					}
				}
			}
			if(alumnoEncontrado)
			{
				if($.inArray(parseInt(key),alumnosSeleccionados) == -1)
				{
					checked = '';
				}
				else
				{
					checked = 'checked';
				}
				alumnosToAdd += '<tr><td align="center"><l2>'+vStringAlumno[1]+', '+vStringAlumno[2]+'</l2></td><td align="center"><l2>'+vStringAlumno[3]+'</l2></td><td align="center"><l2>'+vStringAlumno[4]+'</l2></td><td align="center"><input id="ctemario_general_curso" name="'+nombreCheck+'" type="checkbox" onChange="setAlumnoSelect('+key+')" '+checked+'/></td></tr>';
			}
		});
	}
	htmlToAdd = prevHtml + alumnosToAdd;
	$('#tabla').html(htmlToAdd);
	//$('#date').val(fechaIngreso);
}

function confirmSeleccion()
{
	separadorAlumnos = '/-/-/';
	alumnosPasar = "";
	if((fechaIngreso != "") && (alumnosSeleccionados.length > 0))
	{
		for(var i = 0; i < alumnosSeleccionados.length; i++)
		{
			alumnosPasar += alumnosDiccionario[alumnosSeleccionados[i]] + separadorAlumnos;
		}
		document.location.href = "confirmarSeleccion.php?alumnosPasar=" + alumnosPasar + "&etapa=" + etapa + "&fecha=" + fechaIngreso + "&origen=ra";
	}
	return false;
}

$(document).ready(function(){
    mostrarAlumnos(false);
    //Ver si se pone desp de que se busquen los alumnos para una etapa
});

</script>
<style type="text/css">
	label {font-family: Cambria; text-transform: capitalize; padding: .5em; color: #0080FF;}
	#tabla {background: #F2F2F2;}
	#titulo3 { border-top: 2px solid #BDBDBD;border-bottom: 2px solid #BDBDBD;padding: 3px;}
	l1 {font-family: Cambria;color: #0B615E; text-transform: capitalize; font-size: 1.5em;}
	l2 {font-family: Cambria;color: #424242; text-transform: capitalize; padding: .12em;}
</style>
</head>
<?php

$sep = '/--/';
include_once 'conexion.php';
$consulta = "SELECT id_alumno,apellido_alumno,nombre_alumno,numerodni_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_solicitud IS NULL AND fecha_resp_alumno IS NOT NULL ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
$val = pg_query($consulta);
$contador = 0;
$controlR = 0;

$controlR = $_REQUEST['controlR'];	

while($row = pg_fetch_array($val)){
	$contador += 1;
	$stringAlumno = $row['id_seguimiento'].$sep.$row['apellido_alumno'].$sep.$row['nombre_alumno'].$sep.$row['nombre_carrera'].$sep.$row['nombre_nivel_carrera'].$sep.$row['numerodni_alumno'];
	echo '<script>cargarAlumno('.$contador.',"'.$stringAlumno.'")</script>';
}

if($controlR == 1)
{
	$alumnosRecibidos = $_REQUEST['alumnosPasar'];
	echo '<script>setAlumnoSelectRedireccion("'.$alumnosRecibidos.'")</script>';
	//Cargar alumnos seleccionados en caso de que vuelva
}

?>
<body link="#000000" vlink="#000000" alink="#FFFFFF">
<form class="formSolTit" id="form" name="solicitud_titulo" method="post">
	<center>
		<input id="cPalabra" type="text" name="palabra" value="" onchange="controlBusqueda()" onKeyUp="controlBusqueda()"  class="required"/>
	<p>
		<input type="submit" name="buscar" value="Buscar"/>
	</p>
		</center>
<table align="center" cellspacing="1" cellpadding="4" border="1" bgcolor=#585858 id="tabla">
</table>		
</form>
</body>
</html>