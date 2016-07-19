<?php

$conGrad = pg_connect("host=localhost port=5432 user=extension password=newgenius dbname=graduados") or die("Error de conexion.".pg_last_error());

$idGrad = $_REQUEST['idGrad'];
$nombre = ucwords(strtolower($_REQUEST['nombre']));
$apellido = ucwords(strtolower($_REQUEST['apellido']));
$dni = $_REQUEST['dni'];
$mail = $_REQUEST['mail'];
$alto = $_REQUEST['alto'];
$ancho = $_REQUEST['ancho'];
$calle = $_REQUEST['calle'];
$dpto = $_REQUEST['dpto'];
$facebook = $_REQUEST['facebook'];
$fechanacimiento = $_REQUEST['fechanacimiento'];
$foto = $_REQUEST['foto'];
$foto = '../SeguimientoTitulo/'.$foto;
$mail2 = $_REQUEST['mail2'];
$numerocalle = $_REQUEST['numerocalle'];
$perfil = $_REQUEST['perfil'];
$piso = $_REQUEST['piso'];
$twitter = $_REQUEST['twitter'];
$caracF = $_REQUEST['caracF'];
$telF = $_REQUEST['telF'];
$caracC = $_REQUEST['caracC'];
$telC = $_REQUEST['telC'];

$c = "UPDATE alumno SET nombre_alumno='$nombre',apellido_alumno='$apellido',numerodni_alumno='$dni',mail_alumno='$mail',alto_final='$alto',ancho_final='$ancho',calle_alumno='$calle',gra_depto='$dpto',facebook_alumno='$facebook',fechanacimiento_alumno='$fechanacimiento',foto_alumno='$foto',mail_alumno2='$mail2',numerocalle_alumno='$numerocalle',perfil_laboral_alumno='$perfil',gra_piso='$piso',twitter_alumno='$twitter' WHERE id_alumno=$idGrad;";

$success = 't';
if (!pg_query($c)){
	$errorpg = pg_last_error($conn);
	$termino = "ROLLBACK";
	$success='f';
}else{
	$termino = "COMMIT";
}
pg_query($termino);

$outJson = '[{
    "success":"'.$success.'"
}]';

echo $outJson;

?>