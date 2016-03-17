<html>
<head>
<title> Listado Completo </title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<script type='text/javascript' src="js/jquery.min.js"></script>
<style type="text/css">
	label {font-family: Cambria; text-transform: capitalize; padding: .5em; color: #0080FF;}
	#tabla {background: #F2F2F2;}
	#titulo3 { border-top: 2px solid #BDBDBD;border-bottom: 2px solid #BDBDBD;padding: 3px;}
	#titulo2 { border-top: 2px solid #BDBDBD;border-bottom: 2px solid #BDBDBD;padding: 3px;}
	l1 {font-family: Cambria;color: #0B615E; text-transform: capitalize; font-size: 1.5em;}
	l3 {font-family: Cambria;color: #0040FF; text-transform: capitalize; font-size: 1.5em;}
	l2 {font-family: Cambria;color: #424242; text-transform: capitalize; padding: .12em;}
	a { text-decoration:none }
</style>
<script>

tabla = '<tr bgcolor="#FFFFFF">';
tabla += '<td id="titulo3" colspan="16" align="center"><l1>Seguimiento</l1></td>';
tabla += '</tr>';
tabla += '<tr>';
tabla += '<td align="center"><strong><label>Expediente</label></strong></td>';
tabla += '<td align="center"><strong><label>Alumno</label></strong></td>';
tabla += '<td align="center"><strong><label>Carrera</label></strong></td>';
tabla += '<td align="center"><strong><label>Fecha Solicitud</label></strong></td>';
tabla += '<td align="center"><strong><label>Fecha Responsable de Alumnos</label></strong></td>';
tabla += '<td align="center"><strong><label>Fecha Resolucion CD</label></strong></td>';
tabla += '<td align="center"><strong><label>Nro Resolucion CD</label></strong></td>';
tabla += '<td align="center"><strong><label>Fecha Nota Envio Rectorado</label></strong></td>';
tabla += '<td align="center"><strong><label>Nro Nota</label></strong></td>';
tabla += '<td align="center"><strong><label>Fecha Resolucion CS</label></strong></td>';
tabla += '<td align="center"><strong><label>Nro Resolucion CS</label></strong></td>';
tabla += '<td align="center"><strong><label>Fecha Ingreso Diploma</label></strong></td>';
tabla += '<td align="center"><strong><label>Fecha Retiro Diploma</label></strong></td>';
tabla += '<td align="center"><strong><label>Nro Acta Retiro Diploma</label></strong></td>';
tabla += '<td align="center"><strong><label>Fecha Ingreso Anal&iacute;tico</label></strong></td>';
tabla += '<td align="center"><strong><label>Fecha Retiro Anal&iacute;tico</label></strong></td>';
tabla += '</tr>';

var sep = '/--/';

var seguimientoDir = {};

function cargarSeguimiento(id,datos)
{
	seguimientoDir[id] = datos;
}

function mostrarAlumnos(busqueda)
{
	seguimientoAdd = '';
	$.each(seguimientoDir, function(key,value)
	{
		var vS = value.split(sep);
		seguimientoAdd += '<tr>';
		seguimientoAdd += '<td align="center"><l2>'+vS[0]+'</l2></td>';
		seguimientoAdd += '<td align="center"><l2>'+vS[1]+'</l2></td>';
		seguimientoAdd += '<td align="center"><l2>'+vS[2]+'</l2></td>';
		seguimientoAdd += '<td align="center"><l2>'+vS[3]+'</l2></td>';
		seguimientoAdd += '<td align="center"><l2>'+vS[4]+'</l2></td>';
		seguimientoAdd += '<td align="center"><l2>'+vS[5]+'</l2></td>';
		seguimientoAdd += '<td align="center"><l2>'+vS[6]+'</l2></td>';
		seguimientoAdd += '<td align="center"><l2>'+vS[7]+'</l2></td>';
		seguimientoAdd += '<td align="center"><l2>'+vS[8]+'</l2></td>';
		seguimientoAdd += '<td align="center"><l2>'+vS[9]+'</l2></td>';
		seguimientoAdd += '<td align="center"><l2>'+vS[10]+'</l2></td>';
		seguimientoAdd += '<td align="center"><l2>'+vS[11]+'</l2></td>';
		seguimientoAdd += '<td align="center"><l2>'+vS[12]+'</l2></td>';
		seguimientoAdd += '<td align="center"><l2>'+vS[13]+'</l2></td>';
		seguimientoAdd += '<td align="center"><l2>'+vS[14]+'</l2></td>';
		seguimientoAdd += '<td align="center"><l2>'+vS[15]+'</l2></td>';
		seguimientoAdd += '</tr>';
	});
	htmlToAdd = tabla + seguimientoAdd;
	$('#tabla').html(htmlToAdd);
}

$(document).ready(function()
{
	mostrarAlumnos();
})

</script>
</head>
<?php
include_once 'conexion.php';
include_once 'libreriaPhp.php';

$sep = '/--/';
$contador = 0;

$datosTraer = 'a.apellido_alumno,a.nombre_alumno,s.nro_expediente,s.fecha_solicitud,s.fecha_resp_alumno,s.fecha_rescd,arcd.nombre as nro_rescd,s.fecha_nota_envio_rec,arnr.nombre as nro_nota,s.fecha_rescs,arcs.nombre as nro_rescs,s.fecha_ingreso_diploma,s.fecha_ingreso_analitico,s.fecha_entrega_diploma,arac.nombre as nro_acta,s.fecha_entrega_analitico,c.nombre_carrera';
$consulta = 'SELECT '.$datosTraer.' FROM seguimiento s LEFT JOIN alumno a ON(s.alumno_fk = a.id_alumno) LEFT JOIN carrera c ON(s.carrera_fk = c.id_carrera) LEFT JOIN archivo arcd ON(s.num_res_cd_fk = arcd.id) LEFT JOIN archivo arnr ON(s.num_nota_fk = arnr.id) LEFT JOIN archivo arcs ON(s.num_res_cs_fk = arcs.id) LEFT JOIN archivo arac ON(s.num_acta_d_fk = arac.id) ORDER BY c.nivel_carrera_fk,a.apellido_alumno,a.nombre_alumno';
//$sqlSeguimiento = traerSql($datosTraer,'seguimiento s INNER JOIN alumno a ON(s.alumno_fk = a.id_alumno) INNER JOIN carrera c ON(s.carrera_fk = c.id_carrera) INNER JOIN archivo arcd ON(s.num_res_cd_fk = arcd.id) INNER JOIN archivo arnr ON(s.num_nota_fk = arnr.id) INNER JOIN archivo arcs ON(s.num_res_cs_fk = arcs.id) INNER JOIN archivo arac ON(s.num_acta_d_fk = arac.id) ORDER BY c.nivel_carrera_fk,a.apellido_alumno,a.nombre_alumno');
echo $consulta;
$sqlSeguimiento = pg_query($consulta);
while($rowSeguimiento = pg_fetch_array($sqlSeguimiento))
{
	$contador++;
	$apellido = empty($rowSeguimiento['apellido_alumno']) ? '' : $rowSeguimiento['apellido_alumno'];
	$nombre = empty($rowSeguimiento['nombre_alumno']) ? '' : $rowSeguimiento['nombre_alumno'];
	$nroExpediente = empty($rowSeguimiento['nro_expediente']) ? '' : $rowSeguimiento['nro_expediente'];
	$fechaSolicitud = empty($rowSeguimiento['fecha_solicitud']) ? '' : $rowSeguimiento['fecha_solicitud'];
	$fechaRespAlumno = empty($rowSeguimiento['fecha_resp_alumno']) ? '' : $rowSeguimiento['fecha_resp_alumno'];
	$fechaResCd = empty($rowSeguimiento['fecha_rescd']) ? '' : $rowSeguimiento['fecha_rescd'];
	$nroResCd = empty($rowSeguimiento['nro_rescd']) ? '' : $rowSeguimiento['nro_rescd'];
	$fechaNotaRec = empty($rowSeguimiento['fecha_nota_envio_rec']) ? '' : $rowSeguimiento['fecha_nota_envio_rec'];
	$nroNota = empty($rowSeguimiento['nro_nota']) ? '' : $rowSeguimiento['nro_nota'];
	$fechaResCs = empty($rowSeguimiento['fecha_rescs']) ? '' : $rowSeguimiento['fecha_rescs'];
	$nroResCs = empty($rowSeguimiento['nro_rescs']) ? '' : $rowSeguimiento['nro_rescs'];
	$fechaIngresoDiploma = empty($rowSeguimiento['fecha_ingreso_diploma']) ? '' : $rowSeguimiento['fecha_ingreso_diploma'];
	$fechaIngresoAnalitico = empty($rowSeguimiento['fecha_ingreso_analitico']) ? '' : $rowSeguimiento['fecha_ingreso_analitico'];
	$fechaEntregaDiploma = empty($rowSeguimiento['fecha_entrega_diploma']) ? '' : $rowSeguimiento['fecha_entrega_diploma'];
	$nroActa = empty($rowSeguimiento['nro_acta']) ? '' : $rowSeguimiento['nro_acta'];
	$fechaEntregaAnalitico = empty($rowSeguimiento['fecha_entrega_analitico']) ? '' : $rowSeguimiento['fecha_entraga_analitico'];
	$carrera = empty($rowSeguimiento['nombre_carrera']) ? '' : $rowSeguimiento['nombre_carrera'];

	$datosSeguimiento = $nroExpediente.$apellido.', '.$nombre.$sep.$carrera.$sep.$fechaSolicitud.$sep.$fechaRespAlumno.$sep.$fechaResCd.$sep.$nroResCd.$sep.$fechaNotaRec.$sep.$nroNota.$sep.$fechaResCs.$sep.$nroResCs.$sep.$fechaIngresoDiploma.$sep.$fechaEntregaDiploma.$sep.$nroActa.$sep.$fechaIngresoAnalitico.$sep.$fechaEntregaAnalitico;

	echo '<script>cargarSeguimiento('.$contador.',"'.$datosSeguimiento.'")</script>';
}

?>
<body link="#000000" vlink="#000000" alink="#FFFFFF">
<table align="center" cellspacing="1" cellpadding="4" border="1" bgcolor=#585858 id="tabla">
</table>
</body>
</html>