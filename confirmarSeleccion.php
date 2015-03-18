<html>
<head>
<title> Confirmar Seleccion </title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<style type="text/css">
	label {font-family: Cambria; text-transform: capitalize; padding: .5em; color: #0080FF;}
	#tabla {background: #F2F2F2;}
	#titulo3 { border-top: 2px solid #BDBDBD;border-bottom: 2px solid #BDBDBD;padding: 3px;}
	l1 {font-family: Cambria;color: #0B615E; text-transform: capitalize; font-size: 1.5em;}
	l2 {font-family: Cambria;color: #424242; text-transform: capitalize; padding: .12em;}
</style>
</head>
<?php
include_once 'conexion.php';
include_once 'libreriaPhp.php';
//Traigo los datos de la ventana anterior(etapa,longVector,textPasar).
//Luego con la etapa, defino que muestro y donde vuelvo.
$etapa = $_REQUEST['etapa'];
$longVector = $_REQUEST['longVector'];
$textPasar = $_REQUEST['textPasar'];
$vPasar = explode('/--/', $textPasar);
$controlF = 0;
switch ($etapa) {
	case 1:
		$nombreParaEtapa = 'Solicitud de Titulo';
		$fecha = date('d').'/'.date('m').'/'.date('Y');
		$redireccion = "solicitudTitulo.php?longVector=$longVector&textPasar=$textPasar&controlNoForm=1";
		break;
	case 2:
		$nombreParaEtapa = 'Consejo Directivo';
		$nroResolucion = $_REQUEST['nroResolucion'];
		$fecha = $_REQUEST['fechaResolucion'];
		$redireccion = "resolucionCd.php?longVector=$longVector&textPasar=$textPasar&controlNoForm=1&nroResolucion=$nroResolucion&fechaResolucion=$fecha";
		break;
	case 3:
		$nombreParaEtapa = 'Nota Envio Rectorado';
		$nroNota = $_REQUEST['nroNota'];
		$fecha = $_REQUEST['fechaNota'];
		$redireccion = "notaEnvioRectorado.php?nroNota=".$nroNota."&fechaNota=$fecha&controlNoForm=1&textPasar=$textPasar&longVector=$longVector";
		break;
	case 4:
		$nombreParaEtapa = 'Consejo Superior';
		$nroResolucion = $_REQUEST['nroResolucion'];
		$fecha = $_REQUEST['fechaResolucion'];
		$redireccion = "resolucionCd.php?longVector=$longVector&textPasar=$textPasar&controlNoForm=1&nroResolucion=$nroResolucion&fechaResolucion=$fecha";
		break;
	case 5:
		$nombreParaEtapa = 'Ingreso Diploma';
		//$fecha = date('d').'/'.date('m').'/'.date('Y');
		$fecha = $_REQUEST['fechaIngreso'];
		$redireccion = "ingresoDiploma.php?controlNoForm=1&textPasar=$textPasar&longVector=$longVector&fechaIngreso=$fecha";
		break;
	case 6:
		$nombreParaEtapa = 'Ingreso Anal&iacute;tico';
		//$fecha = date('d').'/'.date('m').'/'.date('Y');
		$fecha = $_REQUEST['fechaIngreso'];
		$redireccion = "ingresoAnalitico.php?controlNoForm=1&textPasar=$textPasar&longVector=$longVector&fechaIngreso=$fecha";
		break;
	case 7:
		$nombreParaEtapa = 'Retiro Diploma';
		$fecha = date('d').'/'.date('m').'/'.date('Y');
		$redireccion = "entregaDiploma.php?controlNoForm=1&textPasar=$textPasar&longVector=$longVector";
		break;
	case 8:
		$nombreParaEtapa = 'Retiro Anal&iacute;tico';
		$fecha = date('d').'/'.date('m').'/'.date('Y');
		$redireccion = "entregaAnalitico.php?controlNoForm=1&textPasar=$textPasar&longVector=$longVector";
		break;
}
?>
<body link="#000000" vlink="#000000" alink="#FFFFFF">
<form class="formSolTit" id="form" name="solicitud_titulo" action="guardarFechas.php" method="post" enctype="multipart/form-data">
<?php


echo '<table align="center" cellspacing="1" cellpadding="4" border="1" bgcolor=#585858 id="tabla">';
echo '<input type="hidden" name="etapa" value="'.$etapa.'" />';
echo '<input type="hidden" name="longVector" value="'.$longVector.'" />';
echo '<input type="hidden" name="textPasar" value="'.$textPasar.'" />';
	echo '<tr bgcolor="#FFFFFF">';
		echo '<td id="titulo3" colspan="5" align="center"><l1>Listado de Alumnos - Confirmar - '.$nombreParaEtapa.'</l1></td>';
	echo '</tr>';
	switch($etapa){
		case 2:
		case 4:
			echo '<tr bgcolor="#FFFFFF">';
				echo '<td id="titulo3" colspan="5" align="center"><l1>Numero Resoluci&oacute;n:  '.$nroResolucion.'</l1></td>';
			echo '</tr>';
			echo '<input type="hidden" name="nroResolucion" value="'.$nroResolucion.'" />';
			echo '<input type="hidden" name="fechaResolucion" value="'.$fecha.'" />';
			$textoMostrarFecha = 'Fecha resoluci&oacute;n: ';
			$controlF = 1;
			break;
		case 3:
			echo '<tr bgcolor="#FFFFFF">';
				echo '<td id="titulo3" colspan="5" align="center"><l1>Numero Nota:  '.$nroNota.'</l1></td>';
			echo '</tr>';
			echo '<input type="hidden" name="nroNota" value="'.$nroNota.'" />';
			echo '<input type="hidden" name="fechaNota" value="'.$fecha.'" />';
			$textoMostrarFecha = 'Fecha nota: ';
			$controlF = 1;
			break;
			/*
		case 4:
			echo '<tr bgcolor="#FFFFFF">';
				echo '<td id="titulo3" colspan="5" align="center"><l1>Numero Resoluci&oacute;n:  '.$nroResolucion.'</l1></td>';
			echo '</tr>';
			echo '<input type="hidden" name="nroResolucion" value="'.$nroResolucion.'" />';
			echo '<input type="hidden" name="fechaResolucion" value="'.$fecha.'" />';
			$controlF = 1;
			break;
			*/
		case 5:
			echo '<input type="hidden" name="fechaIngreso" value="'.$fecha.'" />';
			$textoMostrarFecha = 'Fecha ingreso diploma: ';
			$controlF = 1;
			break;
		case 6:
			echo '<input type="hidden" name="fechaIngreso" value="'.$fecha.'" />';
			$textoMostrarFecha = 'Fecha ingreso analítico: ';
			$controlF = 1;
			break;
	}
	echo '<tr bgcolor="#FFFFFF">';
		if($controlF==1){
					echo '<td id="titulo3" colspan="5" align="center"><l1>'.$textoMostrarFecha.$fecha.'</l1></td>';
		}else{
					echo '<td id="titulo3" colspan="5" align="center"><l1>Fecha:  '.$fecha.'</l1></td>';
		}
	echo '</tr>';
	echo '<tr bgcolor="#FFFFFF">';
		switch ($etapa) {
			case 2:
				$condicion = "numero_res ='rec-".$nroResolucion."'";
				$cantidad = contarRegistro('id_numero_resolucion','numero_resolucion',$condicion);
				if($cantidad == 0){
					echo '<td id="titulo3" colspan="5" align="center"><l1>Resoluci&oacute;n:  <input type="file" name="archivoPdf" /></l1></td>';
					echo '<input type="hidden" name="controlArchivo" value="0" />';
				}else{
					echo '<input type="hidden" name="controlArchivo" value="1" />';
					$rowIdNumeroRes = pg_fetch_array(traerSqlCondicion('id_numero_resolucion,direccion_res','numero_resolucion',$condicion));
					$idNumeroRes = $rowIdNumeroRes['id_numero_resolucion'];
					$direccion = $rowIdNumeroRes['direccion_res'];
					echo '<td id="titulo3" colspan="5" align="center"><l1>La resoluci&oacute;n ya cuenta con un archivo digital. <a href="'.$direccion.'" target="_blank">Ver archivo</a></l1></td>';
				}
				break;
			case 3:
				$condicion = "numero_nota ='".$nroNota."'";
				$cantidad = contarRegistro('id_numero_nota_rectorado','numero_nota_rectorado',$condicion);
				if($cantidad == 0){
					echo '<td id="titulo3" colspan="5" align="center"><l1>Nota:  <input type="file" name="archivoPdf" /></l1></td>';
					echo '<input type="hidden" name="controlArchivo" value="0" />';
				}else{
					echo '<input type="hidden" name="controlArchivo" value="1" />';
					$rowIdNumeroNota = pg_fetch_array(traerSqlCondicion('id_numero_nota_rectorado,direccion_nota','numero_nota_rectorado',$condicion));
					$idNumeroNota = $rowIdNumeroNota['id_numero_nota_rectorado'];
					$direccion = $rowIdNumeroNota['direccion_nota'];
					echo '<td id="titulo3" colspan="5" align="center"><l1>La nota ya cuenta con un archivo digital. <a href="'.$direccion.'" target="_blank">Ver archivo</a></l1></td>';
				}
				break;
			case 4:
				$condicion = "numero_res ='res-".$nroResolucion."'";
				$cantidad = contarRegistro('id_numero_resolucion','numero_resolucion',$condicion);
				if($cantidad == 0){
					echo '<td id="titulo3" colspan="5" align="center"><l1>Resoluci&oacute;n:  <input type="file" name="archivoPdf" /></l1></td>';
					echo '<input type="hidden" name="controlArchivo" value="0" />';
				}else{
					echo '<input type="hidden" name="controlArchivo" value="0" />';
					$rowIdNumeroRes = pg_fetch_array(traerSqlCondicion('id_numero_resolucion,direccion_res','numero_resolucion',$condicion));
					$idNumeroRes = $rowIdNumeroRes['id_numero_resolucion'];
					$direccion = $rowIdNumeroRes['direccion_res'];
					echo '<td id="titulo3" colspan="5" align="center"><l1>La resoluci&oacute;n ya cuenta con un archivo digital. <a href="'.$direccion.'" target="_blank">Ver archivo</a></l1></td>';
				}
				
				break;
		}
	echo '</tr>';
	echo '<tr bgcolor="#000000">';
		echo '<td align="center"><strong><label>Alumno</label></strong></td>';
		echo '<td align="center"><strong><label>Carrera</label></strong></td>';
		echo '<td align="center"><strong><label>Nivel</label></strong></td>';
	echo '</tr>';
for($i=0;$i<$longVector;$i++){
	$idAlumno = $vPasar[$i];
	if($idAlumno!=''){
		$sqlAlumno = pg_query("SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,id_seguimiento,fecha_solicitud FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE id_seguimiento='$idAlumno'");
		$row = pg_fetch_array($sqlAlumno);
		echo '<tr>';
			echo '<td align="center"><l2>'.$row['apellido_alumno'].', '.$row['nombre_alumno'].'</l2></td>';
			echo '<td align="center"><l2>'.$row['nombre_carrera'].'</l2></td>';
			echo '<td align="center"><l2>'.$row['nombre_nivel_carrera'].'</l2></td>';
		echo '</tr>';
	}
}
echo '</table>';
echo '<p>';
echo '<center><input type="submit" value="Confirmar"/>&nbsp;&nbsp;<a href="'.$redireccion.'"><input type="button" value="Atr&aacute;s"></a></center>';
echo '<p>';
?>
</form>
</body>
</html>