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

if($idGrad == '0' || $idGrad == 0)
{
	$cId = "SELECT max(id_alumno) FROM alumno;";
	$sId = pg_query($cId);
	$rId = pg_fetch_array($sId);
	$id = $rId['max'] + 1;
	$c = "INSERT INTO alumno(id_alumno,nombre_alumno,apellido_alumno,numerodni_alumno,mail_alumno,alto_final,ancho_final,calle_alumno,gra_depto,facebook_alumno,fechanacimiento_alumno,foto_alumno,mail_alumno2,numerocalle_alumno,perfil_laboral_alumno,gra_piso,twitter_alumno) VALUES('$id','$nombre','$apellido','$dni','$mail','$alto','$ancho','$calle','$dpto','$facebook','$fechanacimiento','$foto','$mail2','$numerocalle','$perfil','$piso','$twitter');";
} else {
	$id = $idGrad;
	$c = "UPDATE alumno SET nombre_alumno='$nombre',apellido_alumno='$apellido',numerodni_alumno='$dni',mail_alumno='$mail',alto_final='$alto',ancho_final='$ancho',calle_alumno='$calle',gra_depto='$dpto',facebook_alumno='$facebook',fechanacimiento_alumno='$fechanacimiento',foto_alumno='$foto',mail_alumno2='$mail2',numerocalle_alumno='$numerocalle',perfil_laboral_alumno='$perfil',gra_piso='$piso',twitter_alumno='$twitter' WHERE id_alumno=$id;";
}

$cTel = "";
$cTelId = "SELECT max(id_telefonos_del_alumno) FROM telefonos_del_alumno;";
$sTelId = pg_query($cTelId);
$rTelId = pg_fetch_array($sTelId);
$idTel = $rTelId['max'];

if($caracF != '' && $caracF != '0' && $telF != '' && $telF != '0')
{
	//$cTel .= "INSERT INTO telefonos_del_alumno(caracteristica_alumno,telefono_alumno,duenio_del_telefono,alumno_fk) VALUES('$caracF','$telF','Fijo','$id');";
	$idTel = $idTel + 1;
	$cTel .= "INSERT INTO telefonos_del_alumno(id_telefonos_del_alumno,caracteristica_alumno,telefono_alumno,duenio_del_telefono,alumno_fk) (SELECT '$idTel','$caracF','$telF','Fijo','$id' WHERE NOT EXISTS(SELECT 1 FROM telefonos_del_alumno WHERE caracteristica_alumno='$caracF' AND telefono_alumno='$telf' AND alumno_fk='$id' AND duenio_del_telefono='Fijo'));";
	
}
if($caracC != '' && $caracC != '0' && $telC != '' && $telC != '0')
{
	//$cTel .= "INSERT INTO telefonos_del_alumno(caracteristica_alumno,telefono_alumno,duenio_del_telefono,alumno_fk) VALUES('$caracC','$telC','Celular','$id');";
	$idTel = $idTel + 1;
	$cTel .= "INSERT INTO telefonos_del_alumno(id_telefonos_del_alumno,caracteristica_alumno,telefono_alumno,duenio_del_telefono,alumno_fk) (SELECT '$idTel','$caracC','$telC','Celular','$id' WHERE NOT EXISTS(SELECT 1 FROM telefonos_del_alumno WHERE caracteristica_alumno='$caracC' AND telefono_alumno='$telC' AND alumno_fk='$id' AND duenio_del_telefono='Celular'));";
}

$sqlGuardar = $c.$cTel;

$success = 't';

if (!pg_query($sqlGuardar)){
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