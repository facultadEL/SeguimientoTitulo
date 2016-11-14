<html>
<head>
<title>Asignar Expedientes</title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<script src="js/jquery-latest.js" type='text/javascript'></script>
<script src="js/jquery.mask.js" type="text/javascript"></script>

<script>

var alumnosDiccionario = {};
var expedienteDiccionario = {};
var separador = '/--/';

prevHtml = '<tr bgcolor="#FFFFFF">';
prevHtml += '<td id="titulo3" colspan="5" align="center"><l1>Asignar Expedientes</l1></td>';
prevHtml += '</tr>';
prevHtml += '<tr bgcolor="#FFFFFF">';
prevHtml += '<td id="titulo3" colspan="5" align="center"><input type="button" value="Asignar Todos" onmouseup="confirmSeleccion()"/></td>';
prevHtml += '</tr>';
prevHtml += '<tr bgcolor="#000000">';
prevHtml += '<td align="center"><strong><label>Alumno</label></strong></td>';
prevHtml += '<td align="center"><strong><label>Carrera</label></strong></td>';
prevHtml += '<td align="center"><strong><label>Nivel</label></strong></td>';
prevHtml += '<td align="center"><strong><label>Expediente</label></strong></td>';
prevHtml += '<td align="center"><strong><label></label></strong></td>';
prevHtml += '</tr>';

function cargarAlumno(id, stringAlumno)
{
	alumnosDiccionario[id] = stringAlumno;
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

function setExpedienteKey(idKey)
{
	var nombreKey = '#txtExpediente-'+idKey;
	var valorExpediente = $(nombreKey).val().trim();
	if(valorExpediente != '')
	{
		expedienteDiccionario[idKey] = valorExpediente;	
	}
	else
	{
		if(idKey in expedienteDiccionario)
		{
			delete expedienteDiccionario[idKey];
		}
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
			if(key in expedienteDiccionario)
			{
				expedienteAlumno = expedienteDiccionario[key];
			}
			else
			{
				expedienteAlumno = "";
			}
			
			alumnosToAdd += '<tr><td align="center"><l2>'+vStringAlumno[1]+', '+vStringAlumno[2]+'</l2></td><td align="center"><l2>'+vStringAlumno[3]+'</l2></td><td align="center"><l2>'+vStringAlumno[4]+'</l2></td><td align="center"><input id="txtExpediente-'+key+'" onblur="setExpedienteKey('+key+');" value="'+expedienteAlumno+'" type="text" size="5" /></td><td align="center"><a href=""><img src="img/save.png" title="Guardar" width="24" onClick="guardarExpediente('+key+','+vStringAlumno[0]+')"/></a></td></tr>';
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
				if(expedienteDiccionario.hasOwnProperty(key))
				{
					expedienteAlumno = expedienteDiccionario[key];
				}
				else
				{
					expedienteAlumno = "";
				}
				alumnosToAdd += '<tr><td align="center"><l2>'+vStringAlumno[1]+', '+vStringAlumno[2]+'</l2></td><td align="center"><l2>'+vStringAlumno[3]+'</l2></td><td align="center"><l2>'+vStringAlumno[4]+'</l2></td><td align="center"><input id="txtExpediente-'+key+'" onblur="setExpedienteKey('+key+');" value="'+expedienteAlumno+'" type="text" size="5" /></td><td align="center"><a href=""><img src="img/save.png" title="Guardar" width="24" onClick="guardarExpediente('+key+','+vStringAlumno[0]+')"/></a></td></tr>';
			}
		});
	}
	htmlToAdd = prevHtml + alumnosToAdd;
	$('#tabla').html(htmlToAdd);
	//$('#date').val(fechaIngreso);
}

function guardarExpediente(idKey,idSeguimiento)
{
	var nombreKey = '#txtExpediente-'+idKey;
	var valorExpediente = $(nombreKey).val().trim();
	if(valorExpediente != '')
	{
		var parametros = 
		{
			'idSeguimiento':idSeguimiento,
			'nroExpediente':valorExpediente
		}

		$.ajax({
			type: 'POST',
			url: 'guardarExpediente.php',
			data: parametros,
			success: function(response)
			{
				if(response == 0)
				{
					alert("Expediente actualizado exitosamente");	
				}
				else
				{
					alert("No se pudo guardar el expediente");
				}
				
			},
			error: function(msg)
			{
				alert(msg);
			}

		});
	}
}

function confirmSeleccion()
{
	separadorAlumnos = '/-/-/';
	separador
	expedientesPasar = "";
	if((Object.keys(expedienteDiccionario).length > 0))
	{
		$.each(expedienteDiccionario, function(key,value)
		{
			idSeguimiento = alumnosDiccionario[key].split(separador)[0];
			expediente = value;
			if(expedientesPasar != "")
			{
				expedientesPasar += separadorAlumnos;
			}

			expedientesPasar += idSeguimiento+separador+expediente;
		});
		document.location.href = "guardarExpedientesCompletos.php?expedientes=" + expedientesPasar;
	}
	return false;
}

$(document).ready(function(){
    mostrarAlumnos(false);
    
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
$consulta = "SELECT id_alumno,apellido_alumno,nombre_alumno,numerodni_alumno,nombre_carrera,nombre_nivel_carrera,id_seguimiento FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE nro_expediente IS NULL ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
//anda
/*SELECT persona.id,persona.apellido,persona.nombre,persona.dni,carrera.nombre,nivelcarrera.nombre,seguimientotitulo.id FROM persona Inner Join personasistema ON(personasistema.persona_fk = persona.id) Inner Join seguimientotitulo ON(seguimientotitulo.personasistema_fk = personasistema.id) 
Inner Join carreraregional ON(carreraregional.id = seguimientotitulo.carrera_fk) Inner Join carrera ON(carrera.id = carreraregional.carrera_fk) Inner Join nivelcarrera ON(nivelcarrera.id = carrera.nivel_fk) WHERE seguimientotitulo.nroexpediente is null or seguimientotitulo.nroexpediente = 0 
ORDER BY nivelcarrera.id, carrera.id, persona.apellido, persona.nombre, persona.id ASC*/

$val = pg_query($consulta);
$contador = 0;

while($row = pg_fetch_array($val)){
	$contador += 1;
	$stringAlumno = $row['id_seguimiento'].$sep.$row['apellido_alumno'].$sep.$row['nombre_alumno'].$sep.$row['nombre_carrera'].$sep.$row['nombre_nivel_carrera'].$sep.$row['numerodni_alumno'];
	echo '<script>cargarAlumno('.$contador.',"'.$stringAlumno.'")</script>';
}

/*
while($row = pg_fetch_array($val)){
	$contador += 1;
	$stringAlumno = $row['seguimientotitulo.id'].$sep.$row['persona.apellido'].$sep.$row['persona.nombre'].$sep.$row['carrera.nombre'].$sep.$row['nivelcarrera.nombre'].$sep.$row['persona.dni'];
	echo '<script>cargarAlumno('.$contador.',"'.$stringAlumno.'")</script>';
}
*/

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