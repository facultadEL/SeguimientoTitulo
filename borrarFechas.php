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
<body link="#000000" vlink="#000000" alink="#FFFFFF">
<form class="formBuscador" id="commentForm" name="buscador" action="busqueda.php" method="post">
	<center>
		<input id="cPalabra" type="text" name="palabra" value="" class="required"/>
	<p>
		<input type="submit" name="buscar" value="Buscar"/>
	</p>
		</center>
</form>
<?php
include_once 'conexion.php';
$val = pg_query("SELECT id_alumno,nombre_alumno,apellido_alumno,foto_alumno,carrera.nombre_carrera,nombre_nivel_carrera FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) ORDER BY id_nivel_carrera,apellido_alumno,nombre_alumno,id_alumno ASC");

/*SELECT persona.id,persona.nombre,persona.apellido,persona.foto,carrera.nombre,nivelcarrera.nombre
FROM persona
Inner Join personasistema ON(personasistema.persona_fk = persona.id)
Inner Join seguimientotitulo ON(seguimientotitulo.personasistema_fk = personasistema.id)
Inner Join carreraregional ON(carreraregional.id = seguimientotitulo.carrera_fk)
Inner Join carrera ON(carrera.id = carreraregional.carrera_fk)
Inner Join nivelcarrera ON(nivelcarrera.id = carrera.nivel_fk)
ORDER BY nivelcarrera.id, persona.apellido, persona.nombre, persona.id ASC*/

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