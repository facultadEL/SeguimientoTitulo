<?php

include_once "conexion.php";
include_once "libreriaPhp.php";

$expedientes = $_REQUEST['expedientes'];
$vExpedientes = explode('/-/-/', $expedientes);

$sqlGuardar = "";
$redireccion = "asignarExpedienteAlumno.php";

for ($i=0; $i < (count($vExpedientes) - 1); $i++)
{
	$vDatosExpediente = explode('/--/', $vExpedientes[$i]);
	$idSeguimiento = $vDatosExpediente[0];
	$nroExpediente = $vDatosExpediente[1];

	$sqlGuardar .= "UPDATE seguimientotitulo SET nroexpediente='$nroExpediente' WHERE id='$idSeguimiento';";
}


if($sqlGuardar != '')
{
	$error = guardarSql($sqlGuardar);
	if($error == 0)
	{
		mostrarMensaje('Los datos se guardaron correctamente',$redireccion);
	}
	else
	{
		mostrarMensaje('Los datos no se pudieron guardar. Contactese con su administrador',$redireccion);
	}
}
else
{
	mostrarMensaje('Debe cargar por lo menos un expediente',$redireccion);
}

?>