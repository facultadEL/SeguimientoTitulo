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
var fechaEtapa;
var addNumero = "";
var addArchivo = "";
var prevHtml;
var htmlConfRet;
var contador = 0;
var tieneArchivo = "";

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
		tieneArchivo = '<td id="titulo3" colspan="5" align="center"><l1>'+textoAgregar+'  <input type="file" name="archivoPdf" /></l1></td>';
	}
	else
	{
		tieneArchivo = '<td id="titulo3" colspan="5" align="center"><l1>La '+textoAgregar+' ya cuenta con un archivo digital. <a href="'+direccion+'" target="_blank">Ver archivo</a></l1></td>';
	}
}

function loadTable()
{
	prevHtml = '<tr bgcolor="#FFFFFF">';
	prevHtml += '<td id="titulo3" colspan="5" align="center"><l1>Listado de Alumnos - Confirmar - '+nombreEtapa+'</l1></td>';
	prevHtml += '</tr>';
	prevHtml += addNumero;
	prevHtml += '<tr bgcolor="#FFFFFF">';
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
	
	switch(etapa)
	{
		case 1:
			nombreEtapa = "Solicitud de Título";
			redireccion = "solicitudTitulo-jQuery.php?controlR=1&alumnosPasar="+alumnosToReturn;
			break;
		case 2:
			nombreEtapa = "Consejo Directivo";
			addNumero = '<tr bgcolor="#FFFFFF">';
 			addNumero += '<td id="titulo3" colspan="5" align="center"><l1>Numero Resoluci&oacute;n:  '+numeroRecibido+'</l1></td>';
 			addNumero += '</tr>';
			addArchivo = '<tr bgcolor="#FFFFFF">';
			addArchivo += tieneArchivo;
			addArchivo += '</tr>';
			redireccion = "resolucionCd-jQuery.php?controlR=1&fecha="+fecha+"&alumnosPasar="+alumnosToReturn+"&nroResNot="+numeroRecibido;
			break;
		case 3:
			nombreEtapa = "Nota Envio a Rectorado";
			addNumero = '<tr bgcolor="#FFFFFF">';
 			addNumero += '<td id="titulo3" colspan="5" align="center"><l1>Numero Nota a Rectorado:  '+numeroRecibido+'</l1></td>';
 			addNumero += '</tr>';
			addArchivo = '<tr bgcolor="#FFFFFF">';
			addArchivo += tieneArchivo;
			addArchivo += '</tr>';
			//redireccion = "resolucionCd-jQuery.php?controlR=1&fecha="+fecha+"&alumnosPasar="+alumnosToReturn+"&nroResNot="+numeroRecibido;
			break;
		case 4:
			nombreEtapa = "Consejo Superior";
			addNumero = '<tr bgcolor="#FFFFFF">';
 			addNumero += '<td id="titulo3" colspan="5" align="center"><l1>Numero Resoluci&oacute;n:  '+numeroRecibido+'</l1></td>';
 			addNumero += '</tr>';
			addArchivo = '<tr bgcolor="#FFFFFF">';
			addArchivo += tieneArchivo;
			addArchivo += '</tr>';
			//redireccion = "resolucionCd-jQuery.php?controlR=1&fecha="+fecha+"&alumnosPasar="+alumnosToReturn+"&nroResNot="+numeroRecibido;
			break;
		case 5:
			nombreEtapa = "Ingreso Diploma";
			redireccion = "ingresoDiploma-jQuery2.php?controlR=1&fecha="+fecha+"&alumnosPasar="+alumnosToReturn;
			break;
		case 6:
			nombreEtapa = "Ingreso Analítico";
			redireccion = "ingresoAnalitico-jQuery.php?controlR=1&fecha="+fecha+"&alumnosPasar="+alumnosToReturn;
			break;
		case 7:
			nombreEtapa = "Entrega Diploma";
			redireccion = "entregaDiploma-jQuery.php?controlR=1&fecha="+fecha+"&alumnosPasar="+alumnosToReturn;
			break;
		case 8:
			nombreEtapa = "Entrega Analítico";
			redireccion = "entregaAnalitico-jQuery.php?controlR=1&fecha="+fecha+"&alumnosPasar="+alumnosToReturn;
			break;
	}
	if(fecha == "nada")
	{
		var d = new Date();

		var month = d.getMonth()+1;
		var day = d.getDate();
		
		fecha = (day<10 ? '0' : '') + day + '/' + (month<10 ? '0' : '') + month + '/' + d.getFullYear();
	}
	fechaEtapa = "Fecha "+nombreEtapa+": "+fecha;
	htmlConfRet = '<center><input type="submit" value="Confirmar"/>&nbsp;&nbsp;<a href="'+redireccion+'"><input type="button" value="Atr&aacute;s"></a></center>';
	/*
	Control para cambiar la action del form - Ver si se le agrega un id al form para identificarlo
	<form action="foo">
	  <button name="action" value="bar">Go</button>
	</form>
	*/
	//<script type="text/javascript">
	  $('#form').attr('action', 'guardarFechas.php?etapa='+etapa); //this fails silently
	  //$('form').get(0).setAttribute('action', 'baz'); //this works
	/*</script>
	*/
}

function cargarConfirmData()
{
	valAction = $('#form').attr('action').val();
}

$(document).ready(function(){
	mostrarAlumnos();
	cargarConfirmData(); //Este metodo carga los datos para el submit del formulario
});

</script>
</head>
<?php
include_once 'conexion.php';
include_once 'libreriaPhp.php';

function controlArchivoPhp($etapaLocal)
{
	$controlTieneArchivo = 0;
	$nombreArchivo = "";
	$direccionArchivo = "";
	switch ($etapaLocal) {
		case 2:
			$condicion = "numero_res ='rec-".$nroResolucion."'";
			$cantidad = contarRegistro('id_numero_resolucion','numero_resolucion',$condicion);
			if($cantidad == 0){
				$controlTieneArchivo = 0;
				$nombreArchivo = "Resolución: ";
				$direccionArchivo = "";
			}else{
				$rowIdNumeroRes = pg_fetch_array(traerSqlCondicion('id_numero_resolucion,direccion_res','numero_resolucion',$condicion));
				$controlTieneArchivo = 1;
				$nombreArchivo = "resolución";
				$direcionArchivo = $rowIdNumeroRes['direccion_res'];
			}
			break;
		case 3:
			$condicion = "numero_nota ='".$nroNota."'";
			$cantidad = contarRegistro('id_numero_nota_rectorado','numero_nota_rectorado',$condicion);
			if($cantidad == 0){
				$controlTieneArchivo = 0;
				$nombreArchivo = "Nota ";
				$direccionArchivo = "";
			}else{
				$rowIdNumeroNota = pg_fetch_array(traerSqlCondicion('id_numero_nota_rectorado,direccion_nota','numero_nota_rectorado',$condicion));
				$controlTieneArchivo = 1;
				$nombreArchivo = "nota";
				$direcionArchivo = $rowIdNumeroNota['direccion_nota'];
			}
			break;
		case 4:
			$condicion = "numero_res ='res-".$nroResolucion."'";
			$cantidad = contarRegistro('id_numero_resolucion','numero_resolucion',$condicion);
			if($cantidad == 0){
				$controlTieneArchivo = 0;
				$nombreArchivo = "Resolución: ";
				$direccionArchivo = "";
			}else{
				$rowIdNumeroRes = pg_fetch_array(traerSqlCondicion('id_numero_resolucion,direccion_res','numero_resolucion',$condicion));
				$controlTieneArchivo = 1;
				$nombreArchivo = "resolución";
				$direcionArchivo = $rowIdNumeroRes['direccion_res'];
			}
			break;
	}
	echo '<script>cargarTieneArchivo('.$controlTieneArchivo.',"'.$direccionArchivo.'","'.$nombreArchivo.'")</script>';
}

//Traigo los datos de la ventana anterior(etapa,longVector,textPasar).
//Luego con la etapa, defino que muestro y donde vuelvo.
$numeroResNot = "";
$nroResNot = $_REQUEST['nroResNot'];
$etapa = $_REQUEST['etapa'];
$alumnosPasar = $_REQUEST['alumnosPasar'];
$fecha = $_REQUEST['fecha'];
if($fecha == '')
{
	$fecha = date('d').'/'.date('m').'/'.date('Y');
}

echo '<script>cargarAlumnos("'.$alumnosPasar.'")</script>';
echo '<script>cargarDatosEtapa('.$etapa.',"'.$fecha.'","'.$alumnosPasar.'","'.$nroResNot.'")</script>';
controlTienePhp();
?>
<body link="#000000" vlink="#000000" alink="#FFFFFF">
<form class="formSolTit" id="form" name="solicitud_titulo" action="guardarFechas.php" method="post" enctype="multipart/form-data">
<table align="center" cellspacing="1" cellpadding="4" border="1" bgcolor=#585858 id="tabla">
</table>
<p id="returnId">
</p>
</form>
</body>
</html>