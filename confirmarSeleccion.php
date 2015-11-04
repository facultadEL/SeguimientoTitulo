<?php
error_reporting(E_ALL);
include_once 'libreriaPhp.php';
include_once 'conexion.php';
?>
<html>
<head>
<title> Confirmar Seleccion </title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<style type="text/css">
	label {font-family: Cambria; text-transform: capitalize; padding: .5em; color: #0080FF;}
	#tabla {background: #F2F2F2;}
	#titulo3 { border-top: 2px solid #BDBDBD;border-bottom: 2px solid #BDBDBD;padding: 3px;}
	l1 {font-family: Cambria;color: #0B615E; text-transform: capitalize; font-size: 1.5em;}
	l2 {font-family: Cambria;color: #424242; text-transform: capitalize; padding: .12em;}
</style>
<script>

var alumnosSeleccionados = [];
var alumnosToAdd = "";
var nombreEtapa;
var numeroEtapa;
var redireccion;
var numeroControl = 0;
var fechaEtapa;
var addNumero = "";
var addArchivo = "";
var prevHtml;
var htmlConfRet;
var contador = 0;
var tieneArchivo = "";
var controlArchivo = 0;
var origen = "";
var fechaControl;
stringPasar = "guardarFechas.php?";

function setOrigen(s)
{
	origen = s;
}

function cargarAlumnos(stringAlumnos)
{
	contador = 0;
	var vStringAlumnos = stringAlumnos.split('/-/-/');
	for(var i = 0; i < vStringAlumnos.length - 1; i++)
	{
		contador++;
		//alumnosSeleccionados[contador] = vStringAlumnos[i];
		alumnosSeleccionados.push(vStringAlumnos[i]);
	}
}

function cargarTieneArchivo(control, direccion, textoAgregar)
{
	if(control == 0)
	{
		tieneArchivo = '<td id="titulo3" colspan="5" align="center"><l1>'+textoAgregar+'  <input type="file" id="archivoPdf" name="archivoPdf" onchange="validarArchivo();" /></l1></td>';
		controlArchivo = 0;
	}
	else
	{
		controlArchivo = 1;
		tieneArchivo = '<td id="titulo3" colspan="5" align="center"><l1>La '+textoAgregar+' ya cuenta con un archivo digital. <a href="'+direccion+'" target="_blank">Ver archivo</a></l1></td>';
	}
}

function loadTable()
{
	prevHtml = '<tr bgcolor="#FFFFFF">';
	prevHtml += '<td id="titulo3" colspan="5" align="center"><l1>Listado de Alumnos - Confirmar - '+nombreEtapa+'</l1></td>';
	prevHtml += '</tr>';
	prevHtml += addNumero;
	prevHtml += '<tr bgcolor="#FFFFFF" id="trFechaEtapa">';
	prevHtml += '<td id="titulo3" colspan="5" align="center"><l1>'+fechaEtapa+'</l1></td>';
	prevHtml += '</tr>';
	prevHtml += addArchivo;
	prevHtml += '<tr bgcolor="#000000">';
	prevHtml += '<td align="center"><strong><label>Alumno</label></strong></td>';
	prevHtml += '<td align="center"><strong><label>Carrera</label></strong></td>';
	prevHtml += '<td align="center"><strong><label>Nivel</label></strong></td>';
	prevHtml += '</tr>';
}

function mostrarAlumnos()
{
	loadTable();
	for(var i = 0; i < contador; i++)
	{
		vStringAlumno = alumnosSeleccionados[i].split('/--/');
		alumnosToAdd += '<tr><td align="center"><l2>'+vStringAlumno[1]+', '+vStringAlumno[2]+'</l2></td><td align="center"><l2>'+vStringAlumno[3]+'</l2></td><td align="center"><l2>'+vStringAlumno[4]+'</l2></td></tr>';
	}
	$('#tabla').html(prevHtml+alumnosToAdd);
	$('#returnId').html(htmlConfRet);
}

function cargarDatosEtapa(etapa, fecha, alumnosToReturn, numeroRecibido)
{
	numeroControl = numeroRecibido;
	switch(etapa)
	{
		case 1:
			nombreEtapa = "Solicitud de Título";
			redireccion = "solicitudTitulo.php?controlR=1&alumnosPasar="+alumnosToReturn;
			break;
		case 2:
			nombreEtapa = "Consejo Directivo";
			addNumero = '<tr bgcolor="#FFFFFF"  id="trNumero">';
 			addNumero += '<td id="titulo3" colspan="5" align="center"><l1>Numero Resoluci&oacute;n:  '+numeroRecibido+'</l1></td>';
 			addNumero += '</tr>';
			addArchivo = '<tr bgcolor="#FFFFFF" id="trArchivo">';
			addArchivo += tieneArchivo;
			addArchivo += '</tr>';
			redireccion = "resolucionCd.php?controlR=1&fecha="+fecha+"&alumnosPasar="+alumnosToReturn+"&nroResNot="+numeroRecibido;
			stringPasar += "nroNotORes="+numeroRecibido;
			break;
		case 3:
			nombreEtapa = "Nota Envio a Rectorado";
			addNumero = '<tr bgcolor="#FFFFFF"  id="trNumero">';
 			addNumero += '<td id="titulo3" colspan="5" align="center"><l1>Numero Nota a Rectorado:  '+numeroRecibido+'</l1></td>';
 			addNumero += '</tr>';
			addArchivo = '<tr bgcolor="#FFFFFF" id="trArchivo">';
			addArchivo += tieneArchivo;
			addArchivo += '</tr>';
			redireccion = "notaEnvioRectorado.php?controlR=1&fecha="+fecha+"&alumnosPasar="+alumnosToReturn+"&nroResNot="+numeroRecibido;
			stringPasar += "nroNotORes="+numeroRecibido;
			break;
		case 4:
			nombreEtapa = "Consejo Superior";
			addNumero = '<tr bgcolor="#FFFFFF"  id="trNumero">';
 			addNumero += '<td id="titulo3" colspan="5" align="center"><l1>Numero Resoluci&oacute;n:  '+numeroRecibido+'</l1></td>';
 			addNumero += '</tr>';
			addArchivo = '<tr bgcolor="#FFFFFF" id="trArchivo">';
			addArchivo += tieneArchivo;
			addArchivo += '</tr>';
			redireccion = "resolucionCs.php?controlR=1&fecha="+fecha+"&alumnosPasar="+alumnosToReturn+"&nroResNot="+numeroRecibido;
			stringPasar += "nroNotORes="+numeroRecibido;
			break;
		case 5:
			nombreEtapa = "Ingreso Diploma";
			redireccion = "ingresoDiploma.php?controlR=1&fecha="+fecha+"&alumnosPasar="+alumnosToReturn;
			break;
		case 6:
			nombreEtapa = "Ingreso Analítico";
			redireccion = "ingresoAnalitico.php?controlR=1&fecha="+fecha+"&alumnosPasar="+alumnosToReturn;
			break;
		case 7:
			nombreEtapa = "Entrega Diploma";
			addNumero = '<tr bgcolor="#FFFFFF" id="trNumero">';
 			addNumero += '<td id="titulo3" colspan="5" align="center"><l1>Numero Acta:  '+numeroRecibido+'</l1></td>';
 			addNumero += '</tr>';
			addArchivo = '<tr bgcolor="#FFFFFF" id="trArchivo">';
			addArchivo += tieneArchivo;
			addArchivo += '</tr>';
			redireccion = "entregaDiploma.php?controlR=1&fecha="+fecha+"&alumnosPasar="+alumnosToReturn+"&nroResNot="+numeroRecibido;
			stringPasar += "nroNotORes="+numeroRecibido;
			break;
		case 8:
			nombreEtapa = "Entrega Analítico";
			redireccion = "entregaAnalitico.php?controlR=1&fecha="+fecha+"&alumnosPasar="+alumnosToReturn;
			break;
	}
	if(fecha == "nada")
	{
		var d = new Date();

		var month = d.getMonth()+1;
		var day = d.getDate();
		
		fecha = (day<10 ? '0' : '') + day + '/' + (month<10 ? '0' : '') + month + '/' + d.getFullYear();
	}
	numeroEtapa = etapa;
	fechaPasar = fecha;
	fechaControl = fecha;
	fechaEtapa = "Fecha "+nombreEtapa+": "+fecha;
	htmlConfRet = '<center><input type="submit" value="Confirmar"/>&nbsp;&nbsp;<a href="'+redireccion+'"><input type="button" value="Atr&aacute;s"></a></center>';
	stringPasar += '&etapa='+etapa+'&fecha='+fecha;
}

function cargarConfirmData()
{
	//valAction = $('#form').attr('action');
	//Aca seteo los datos del stringPasar. Ya viene la etapa y la fecha
	//Hay que agregar si tiene un archivo y el string de todos los alumnos

	stringPasar += "&controlArchivo="+controlArchivo;
	stringAlumnosToSend = "";
	sep = '/--/';
	//Aca van todos los alumnos que vienen y se pasa el id
	for(var i=0;i<alumnosSeleccionados.length;i++)
	{
		vAlumno = alumnosSeleccionados[i].split('/--/');
		stringAlumnosToSend += vAlumno[0]+sep;
	}

	stringPasar += "&alumnosPasar="+stringAlumnosToSend;
	stringPasar += "&origen="+origen;
	$('#form').attr('action', stringPasar); //this fails silently
	//$('form').get(0).setAttribute('action', stringPasar); //this works
}

function validarForm()
{
	
	if(numeroEtapa == 2 || numeroEtapa == 3 || numeroEtapa == 4 || numeroEtapa == 7)
	{
		if(controlArchivo == 0)
		{
			nombreArchivoValidar = $('#archivoPdf').val();
			if(nombreArchivoValidar != "")
			{
				//No tenia ningun archivo cargado y cargo uno
				$('#controlArchivoHidden').val(1);
			}
			else
			{
				//No tenia ningun archivo y no cargo nada
				$('#controlArchivoHidden').val(0);
			}
		}
	}
	return true;
}

function validarArchivo()
{
	nombreArchivoValidar = $('#archivoPdf').val();
	if(nombreArchivoValidar != ""){
		vNombreArchivoValidar = nombreArchivoValidar.split('.');
		extension = vNombreArchivoValidar[vNombreArchivoValidar.length - 1];
		if(extension != "pdf" && extension != "doc" && extension != "docx"){
			alert("Debe ingresar un archivo pdf o doc!");
			$('#archivoPdf').val("");
		}
	}
}

function controlOcultar()
{
	if(numeroControl == 0)
	{
		$('#trArchivo').hide();
	}

	if(numeroControl == 0)
	{
		$('#trNumero').hide();
	}

	if(fechaControl == 0)
	{
		$('#trFechaEtapa').hide();
	}
}

$(document).ready(function(){
	mostrarAlumnos();
	cargarConfirmData(); //Este metodo carga los datos para el submit del formulario
	controlOcultar();
});

</script>
</head>
<?php
include_once 'conexion.php';
include_once 'libreriaPhp.php';

function controlArchivoPhp($etapaLocal,$nroRecibido)
{
	$controlTieneArchivo = 0;
	$nombreArchivo = "";
	$direccionArchivo = "";
	switch ($etapaLocal) {
		case 2: //Consejo directivo
			$condicion = "nombre='".$nroRecibido."' AND tipo=1 AND url IS NOT NULL";
			$cantidad = contarRegistro('id','archivo',$condicion);
			if($cantidad == 0)
			{
				$controlTieneArchivo = 0;
				$nombreArchivo = "Resolución: ";
				$direccionArchivo = "";
			}
			elseif ($cantidad == 1)
			{
				$rowIdNumeroRes = pg_fetch_array(traerSqlCondicion('id,url','archivo',$condicion));
				$controlTieneArchivo = 1;
				$nombreArchivo = "resolución";
				$direccionArchivo = $rowIdNumeroRes['url'];
			}
			break;
		case 3: //Nota a rectorado
			$condicion = "nombre='".$nroRecibido."' AND tipo=2 AND url IS NOT NULL";
			$cantidad = contarRegistro('id','archivo',$condicion);
			if($cantidad == 0)
			{
				$controlTieneArchivo = 0;
				$nombreArchivo = "Nota: ";
				$direccionArchivo = "";
			}
			elseif ($cantidad == 1)
			{
				$rowIdNumeroNota = pg_fetch_array(traerSqlCondicion('id,url','archivo',$condicion));
				$controlTieneArchivo = 1;
				$nombreArchivo = "nota";
				$direccionArchivo = $rowIdNumeroNota['url'];
			}
			break;
		case 4: //Consejo superior
			$condicion = "nombre='".$nroRecibido."' AND tipo=3 AND url IS NOT NULL";
			$cantidad = contarRegistro('id','archivo',$condicion);
			if($cantidad == 0)
			{
				$controlTieneArchivo = 0;
				$nombreArchivo = "Resolución: ";
				$direccionArchivo = "";
			}
			elseif ($cantidad == 1)
			{
				$rowIdNumeroRes = pg_fetch_array(traerSqlCondicion('id,url','archivo',$condicion));
				$controlTieneArchivo = 1;
				$nombreArchivo = "resolución";
				$direccionArchivo = $rowIdNumeroRes['url'];
			}
			break;
		case 7: //Acta retiro diploma
			$condicion = "nombre='".$nroRecibido."' AND tipo=4 AND url IS NOT NULL";
			$cantidad = contarRegistro('id','archivo', $condicion);
			if($cantidad == 0)
			{
				$controlTieneArchivo = 0;
				$nombreArchivo = "Acta: ";
				$direccionArchivo = "";
			}
			elseif ($cantidad == 1)
			{
				$rowIdNumeroActa = pg_fetch_array(traerSqlCondicion('id,url','archivo',$condicion));
				$controlTieneArchivo = 1;
				$nombreArchivo = "acta";
				$direccionArchivo = $rowIdNumeroActa['url'];
			}
			break;
	}
	echo '<script>cargarTieneArchivo('.$controlTieneArchivo.',"'.$direccionArchivo.'","'.$nombreArchivo.'")</script>';
}

$nroResNot = "";

$etapa = $_REQUEST['etapa'];
$origen = (empty($_REQUEST['origen'])) ? '' : $_REQUEST['origen'];

if($etapa == 2 || $etapa == 3 || $etapa == 4 || $etapa == 7)
{
	$nroResNot = (empty($_REQUEST['nroResNot'])) ? '0' : $_REQUEST['nroResNot'];
	controlArchivoPhp($etapa,$nroResNot);
}

$alumnosPasar = $_REQUEST['alumnosPasar'];
$fecha = (empty($_REQUEST['fecha'])) ? '0' : $_REQUEST['fecha'];


if($origen == 'me' || $origen == 'ra')
{
	$fecha = date('d').'/'.date('m').'/'.date('Y');
}


echo '<script>cargarAlumnos("'.$alumnosPasar.'")</script>';
echo '<script>cargarDatosEtapa('.$etapa.',"'.$fecha.'","'.$alumnosPasar.'","'.$nroResNot.'")</script>';
echo '<script>setOrigen("'.$origen.'")</script>';

?>
<body link="#000000" vlink="#000000" alink="#FFFFFF">
<form class="formSolTit" id="form" name="solicitud_titulo" action="guardarFechas.php"  onsubmit="return validarForm()" method="post" enctype="multipart/form-data">
<input type="hidden" id="controlArchivoHidden" value="" name="controlArchivoHidden" />
<table align="center" cellspacing="1" cellpadding="4" border="1" bgcolor=#585858 id="tabla">
</table>
<p id="returnId">
</p>
</form>
</body>
</html>