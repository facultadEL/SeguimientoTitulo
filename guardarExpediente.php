<?php

include_once 'conexion.php';
include_once 'libreriaPhp.php';

$idSeguimiento = $_REQUEST['idSeguimiento'];
$nroExpediente = $_REQUEST['nroExpediente'];

$sqlGuardar = "UPDATE seguimiento SET nro_expediente='$nroExpediente' WHERE id_seguimiento='$idSeguimiento';";

$error = guardarSql($sqlGuardar);
echo $error;

?>