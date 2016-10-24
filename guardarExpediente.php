<?php

include_once 'conexion.php';
include_once 'libreriaPhp.php';

$idSeguimiento = $_REQUEST['idSeguimiento'];
$nroExpediente = $_REQUEST['nroExpediente'];

$sqlGuardar = "UPDATE seguimientotitulo SET nroexpediente='$nroExpediente' WHERE id='$idSeguimiento';";

$error = guardarSql($sqlGuardar);
echo $error;

?>