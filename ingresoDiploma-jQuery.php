<html>
<head>
<title> Ingreso Diploma </title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="jquery-latest.js"></script>
<script src="jquery.maskedinput.js" type="text/javascript"></script>
<script type="text/javascript">
var fechaIngreso = "";
var alumnosSeleccionados = [];
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
	$("#resolucion").mask("****/**");
	$("#comodines").mask("?");
});

function setFecha()
{
	fechaIngreso = $('#date').val();
}

function confirmSeleccion()
{
	if(fechaIngreso != "" &&)
}

$(document).ready(function(){
	
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
include_once 'conexion.php';
//Trae el control para ver si trae todos los alumnos o los filtra.
//Control = 1 -- Busca
$fechaIngreso = $_REQUEST['fechaIngreso'];
$control = $_REQUEST['control'];
if($control == 1){
	$volver = 1;
	$palabra = $_REQUEST['palabra'];
	if ($palabra == "grado" || $palabra == "Grado"){
		/*
		$val = pg_query("SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)WHERE fecha_solicitud IS NULL AND seguimiento.carrera_fk = id_carrera AND  
		   UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
		or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
		or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
		or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
		or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%') ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC");
		*/
	$consulta = "SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)WHERE fecha_rescs IS NOT NULL AND fecha_ingreso_diploma IS NULL AND seguimiento.carrera_fk = id_carrera AND  
		   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
		or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
		or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
		or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
		or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
	}else{
		/*
		$val = pg_query("SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_solicitud IS NULL AND seguimiento.carrera_fk = id_carrera AND  
		   UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
		or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
		or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
		or UPPER(nombre_nivel_carrera) LIKE UPPER('%{$_REQUEST['palabra']}%')
		or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%') ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC");
		*/
		$consulta = "SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_rescs IS NOT NULL AND fecha_ingreso_diploma IS NULL AND seguimiento.carrera_fk = id_carrera AND  
		   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
		or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
		or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
		or UPPER(nombre_nivel_carrera) LIKE UPPER('%{$_REQUEST['palabra']}%')
		or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
	}
}else{
	//$val = pg_query("SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_solicitud IS NULL ORDER BY apellido_alumno,nombre_alumno,id_alumno,id_nivel_carrera,id_carrera ASC");
	$consulta = "SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_rescs IS NOT NULL AND fecha_ingreso_diploma IS NULL ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
	$volver = 0;
}

$controlNoForm = $_REQUEST['controlNoForm'];
if($controlNoForm == 1){
	//echo 'NoForm1';
	$textPasar = $_REQUEST['textPasar'];
	$vPasar = explode('/--/', $textPasar);
	$longVector = $_REQUEST['longVector'];
}else{
//Hago el control para traer los datos cuando recarga la pagina
	//echo 'entroNoForm';
	//$etapa = $_REQUEST['etapa'];	
	//$vPasar[0] = $etapa;
	//i es igual a cero, para ir creando los indices del vector cada vez que encuentre un check tildado.
	//Se va a incrementar antes de usarlo, ya que el 0 representa al primer elemento que va a ser la etapa.
	if($control == 1){
		$longVector = $_REQUEST['longVector'];	
		$textPasar = $_REQUEST['textPasar'];
		$vPasar = explode('/--/', $textPasar);
	}else{
		$longVector = 0;
	}

	$sqlBuscarCheck = pg_query($consulta);
	while($rowBuscarCheck = pg_fetch_array($sqlBuscarCheck)){
		//echo 'entro al while';
		if($control == 1){
			$encontrado = 0;
			$restar = 0;
			for($i=0;$i<$longVector;$i++){
				if($rowBuscarCheck['id_seguimiento'] == $vPasar[$i]){
					//$seleccion = "checkbox".$rowBuscarCheck['id_alumno'];
					//$check = $_REQUEST[$seleccion];
					//if($check == 'on'){
					//	echo 'encontre';
					//	$vPasar[$longVector] = $rowBuscarCheck['id_alumno'];
					//	$longVector = $longVector + 1;
					//}
					//Si el check de ese id es igual a off, entonces lo saca y el long vector es uno menos
					//echo 'antes de resta y guardar'.$rowBuscarCheck['id_alumno'].'<br>';
					$seleccion = "checkbox".$rowBuscarCheck['id_seguimiento'];
					$check = $_REQUEST[$seleccion];
					//echo $check.'<br>';
					if($check != 'on'){
						$restar = $restar + 1;
						unset($vPasar[$i]);
						//echo 'resta';
					}else{
						$vPasar[$i] = $rowBuscarCheck['id_seguimiento'];
						//echo 'guarda';
					}
					$encontrado = 1;
				}
				if($encontrado==1){
					break;
				}
			}
			$longVector = $longVector - $restar;
			if($encontrado==0){
				$seleccion = "checkbox".$rowBuscarCheck['id_seguimiento'];
				$check = $_REQUEST[$seleccion];
				if($check == 'on'){
					//echo 'encontre';
					$vPasar[$longVector] = $rowBuscarCheck['id_seguimiento'];
					$longVector = $longVector + 1;
				}
			}
			//Si lo encontro y esta en el while de la busqueda, entonces que evalue el cambio de estado
		}else{
			$seleccion = "checkbox".$rowBuscarCheck['id_seguimiento'];
			$check = $_REQUEST[$seleccion];
			if($check == 'on'){
				//echo 'encontre';
				$vPasar[$longVector] = $rowBuscarCheck['id_seguimiento'];
				$longVector = $longVector + 1;
			}
		}
	}
}
?>
<body link="#000000" vlink="#000000" alink="#FFFFFF">
<form class="formBuscador" id="commentForm" name="buscador" action="?control=1&etapa=5&controlNoForm=1" method="post">
	<center>
		<input id="cPalabra" type="text" name="palabra" value="<?php echo $palabra;?>" class="required"/>
		<?php
		$textPasar = "";
		$sep = '/--/';
		for($i=0;$i<$longVector;$i++){
			if($i == 0){
				$textPasar = $vPasar[0];
			}else{
				$textPasar = $textPasar.$sep.$vPasar[$i];
			}
		}
		//echo $textPasar;
		?>
		<input type="hidden" name="textPasar" value="<?php echo $textPasar?>" />
		<input type="hidden" name="longVector" value="<?php echo $longVector;?>" />
		<input type="hidden" name="fechaIngreso" value="<?php echo $fechaIngreso;?>" />
	<p>
		<input type="submit" name="buscar" value="Buscar"/>
	</p>
		</center>
</form>
<form class="formSolTit" id="form" name="solicitud_titulo" onsubmit="confirmSeleccion()" action="?etapa=5" method="post">
<?php


echo '<table align="center" cellspacing="1" cellpadding="4" border="1" bgcolor=#585858 id="tabla">';
	echo '<tr bgcolor="#FFFFFF">';
		echo '<td id="titulo3" colspan="5" align="center"><l1>Listado de Alumnos - Ingreso Diploma</l1></td>';
	echo '</tr>';
	echo '<tr bgcolor="#FFFFFF">';
		echo '<td id="titulo3" colspan="5" align="center"><l1>Fecha de resoluci&oacute;n:</l1>&nbsp;&nbsp;<input type="text" name="fechaIngreso" value="'.$fechaIngreso.'" id="date" placeholder="dd/mm/aaaa" onChange="setFecha()"/></td>';
	echo '</tr>';
	if($longVector!=0 && $fechaIngreso != ''){
		$habilitarBoton = '<a href="confirmarSeleccion.php?etapa=5&longVector='.$longVector.'&textPasar='.$textPasar.'" ><input type="button" name="confirmar" value="Confirmar"/></a>';
	}else{
		$habilitarBoton = '<input type="button" name="confirmar" value="Confirmar"/>';
	}
	echo '<tr bgcolor="#FFFFFF">';
		echo '<td id="titulo3" colspan="5" align="center">'.$habilitarBoton.'</td>';
	echo '</tr>';
	echo '<tr bgcolor="#000000">';
		echo '<td align="center"><strong><label>Alumno</label></strong></td>';
		echo '<td align="center"><strong><label>Carrera</label></strong></td>';
		echo '<td align="center"><strong><label>Nivel</label></strong></td>';
		echo '<td align="center"><strong><label>Selecci&oacute;n</label></strong></td>';
	echo '</tr>';
$val = pg_query($consulta);
echo '<input type="hidden" name="consulta" value="'.$consulta.'"/>';
echo '<input type="hidden" name="control" value="'.$control.'"/>';
echo '<input type="hidden" name="palabra" value="'.$palabra.'"/>';
echo '<input type="hidden" name="textPasar" value="'.$textPasar.'"/>';
echo '<input type="hidden" name="longVector" value="'.$longVector.'"/>';
echo '<input type="hidden" name="controlSegunda" value="'.$controlSegunda.'"/>';
while($row=pg_fetch_array($val,NULL,PGSQL_ASSOC)){
	echo '<tr>';
		echo '<td align="center"><l2>'.$row['apellido_alumno'].', '.$row['nombre_alumno'].'</l2></td>';
		echo '<td align="center"><l2>'.$row['nombre_carrera'].'</l2></td>';
		echo '<td align="center"><l2>'.$row['nombre_nivel_carrera'].'</l2></td>';
		$idAlumnoControl = $row['id_seguimiento'];
		echo '<input type="hidden" name="idAlumnoControl" value="'.$idAlumnoControl.'" />';
		$seleccion = "checkbox".$idAlumnoControl;
		$checked = '';
		for($i=0;$i<$longVector;$i++){
			if($vPasar[$i] == $idAlumnoControl){
				$checked = 'checked';
			}
		}
		echo '<td align="center"><input id="ctemario_general_curso" name="'.$seleccion.'" type="checkbox" onChange="setAlumnoSelect('.$idAlumnoControl.')" '.$checked.' /></td>';
	echo '</tr>';
}
echo '</table>';
echo '<p>';
if($volver == 1){
	$redireccion = "ingresoDiploma.php?control=0&controlNoForm=1&textPasar=$textPasar&longVector=$longVector";
}else{
	$redireccion = "";
}
echo '<center><a href="'.$redireccion.'"><input type="button" value="Atr&aacute;s"></a></center>';
echo '<p>';
?>
</form>
</body>
</html>