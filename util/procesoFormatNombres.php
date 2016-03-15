<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<?php

include_once '../conexion.php';

$sqlGuardar = '';
$sql = 'SELECT id_alumno,nombre_alumno, apellido_alumno FROM alumno';

$s = pg_query($sql);
while($r = pg_fetch_array($s))
{
	$i = $r['id_alumno'];
	$n = ucwords(strtolower($r['nombre_alumno']));
	$a = ucwords(strtolower($r['apellido_alumno']));
	$sqlGuardar .= "UPDATE alumno SET nombre_alumno='$n',apellido_alumno='$a' WHERE id_alumno='$i';";
}

echo $sqlGuardar;

?>