<?php
error_reporting(E_ALL);
include_once 'libreriaPhp.php';
include_once 'conexion.php';

$sqlUpdateNoResolucion = "";
$redireccion = "resolucionCs.php?controlR=0";
$alumnosPasar = $_REQUEST['alumnosPasar'];

$vAlumnosPasar = explode('/-/-/', $alumnosPasar);
for($i = 0; $i < count($vAlumnosPasar) - 1; $i++)
{
	$vAlumnoEspecifico = explode('/--/',$vAlumnosPasar[$i]);
	$sqlUpdateNoResolucion .= "UPDATE seguimiento SET noresolucion_seguimiento='true' WHERE id_seguimiento=$vAlumnoEspecifico[0];";
}

$sqlGuardar = $sqlUpdateNoResolucion;

$e = guardarSql($sqlGuardar);
	
if($e==1){
	mostrarMensaje('Los datos no se pudieron guardar. Contactese con su administrador',$redireccion);
}else{
	mostrarMensaje('Los datos se guardaron correctamente',$redireccion);
}
?>