<?php

//Control usuario va a devolver una serie de numeros que representan exito o errores
/*
	1 - DNI
*/

include_once "conexion.php";
//include_once "scripts/libreria.php";

//$conn = pg_connect("host=localhost port=5432 user=postgres password=postgres dbname=visitasDepto") or die("Error de conexion.".pg_last_error());

$nro_dni = $_POST["nro_dni"];
$mail_alumno = $_POST["mail_alumno"];

$control = 0;

$sql = pg_query("SELECT count(id_alumno) as contar FROM alumno where numerodni_alumno = '$nro_dni' or mail_alumno = '$mail_alumno';");
//$sql = traerSql('*','usuario ORDER BY id');
while($rowSql = pg_fetch_array($sql)){
	
	$contar = $rowSql['contar'];

	if ($contar > 0){
		echo '1';
		break;
	}
}

include_once "cerrar_conexion.php";
?>