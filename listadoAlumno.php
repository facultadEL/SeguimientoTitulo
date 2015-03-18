<html>
<head>
<title> Listado Graduados </title>
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
$control = $_REQUEST['control'];
if($control!=1){
	$consulta = "SELECT id_alumno,nombre_alumno,apellido_alumno,foto_alumno,carrera.nombre_carrera,nombre_nivel_carrera FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
}else{
	$palabra = $_REQUEST['palabra'];
	if ($palabra == "grado" || $palabra == "Grado"){
		$consulta = "SELECT id_alumno,nombre_alumno,apellido_alumno,foto_alumno,carrera.nombre_carrera,nombre_nivel_carrera FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE  
		   UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
		or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
		or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
		or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
		or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%') ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
	}else{
		$consulta = "SELECT id_alumno,nombre_alumno,apellido_alumno,foto_alumno,carrera.nombre_carrera,nombre_nivel_carrera FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE  
		   UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
		or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
		or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
		or UPPER(nombre_nivel_carrera) LIKE UPPER('%{$_REQUEST['palabra']}%')
		or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%') ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
	}

}

?>
<body link="#000000" vlink="#000000" alink="#FFFFFF">
<form class="formBuscador" id="commentForm" name="buscador" action="?control=1" method="post">
	<center>
		<input id="cPalabra" type="text" name="palabra" value="<?php echo $palabra;?>" class="required"/>
		<input type="submit" name="buscar" value="Buscar"/>
		<p>
		<?php
		if($control==1){
			echo $palabra;
			echo '<a href="?control=0"><font color="red">X</font></a>';
		}
		?>
		</p>
		<p>
		<?php
		echo '<a href="excelSeguimiento.php?control='.$control.'&palabra='.$palabra.'"><input type="button" value="Excel" /></a>';
		?>
		</p>
		</center>
</form>
<?php

echo '<table align="center" cellspacing="1" cellpadding="4" border="1" bgcolor=#585858 id="tabla">';
	echo '<tr bgcolor="#FFFFFF">';
		echo '<td id="titulo3" colspan="6" align="center"><l1>Listado de Graduados</l1></td>';
	echo '</tr>';
	echo '<tr bgcolor="#000000">';
		echo '<td align="center"><strong><label>Alumno</label></strong></td>';
		echo '<td align="center"><strong><label>Nivel Carrera</label></strong></td>';
		echo '<td align="center"><strong><label>Carrera</label></strong></td>';
		echo '<td align="center"><strong><label>Ver Graduado</label></strong></td>';
		echo '<td align="center"><strong><label>Seguimiento</label></strong></td>';
	echo '</tr>';
	$val = pg_query($consulta);
while($row=pg_fetch_array($val,NULL,PGSQL_ASSOC)){
	echo '<tr>';
		echo '<td align="center"><l2>'.$row['apellido_alumno'].', '.$row['nombre_alumno'].'</l2></td>';
		echo '<td align="center"><l2>'.$row['nombre_nivel_carrera'].'</l2></td>';
		echo '<td align="center"><l2>'.$row['nombre_carrera'].'</l2></td>';
		echo '<td align="center"><a href="verAlumno.php?idAlumno='.$row['id_alumno'].'"><input type="image" src="ver.png" width="50" height="50" value="Opciones" /></a></td>';
		echo '<td align="center"><a href="listadoSeguimientoTitulo.php?idAlumno='.$row['id_alumno'].'"><input type="image" src="seguimiento.png" width="60" height="40" value="Opciones" /></a></td>';
	echo '</tr>';
}
echo '</table>';
?>
<p>
<a href="buscador.php"><center><input type="button" value="Atr&aacute;s"></center></a>
</p>
</body>
</html>