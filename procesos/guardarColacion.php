<?php

include_once '../conexion.php';

$alumnosId = $_REQUEST['datosGuardar'];

$vAlumnos = explode('/-/', $alumnosId);

$year = empty($_REQUEST['year']) ? date('Y') : $_REQUEST['year'];

$sqlGuardar = '';

for($i = 0; $i < count($vAlumnos); $i++)
{
	$id = $vAlumnos[$i];
	$sqlGuardar .= "UPDATE alumno SET acto_colacion='TRUE',anio_colacion='$year' WHERE id_alumno='$id';";
}

$error = 0;
if (!pg_query($sqlGuardar)){
	$errorpg = pg_last_error($conn);
	$termino = "ROLLBACK";
	$error=1;
}else{
	$termino = "COMMIT";
}
pg_query($termino);

if ($error==1){
	echo '0';
}else{
	echo '1';
}


?>