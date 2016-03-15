<?php

include_once '../conexion.php';
include_once '../libreriaPhp.php';

$idS = $_REQUEST['idSeguimiento'];
$date = $_REQUEST['date'];
$etapa = $_REQUEST['etapa'];

$sql = "UPDATE seguimiento SET ";

switch ($etapa) {
	case '1':
		$sql .= "fecha_solicitud=";
		break;
	case '2':
		$sql .= "fecha_resp_alumno=";
		break;
	case '3':
		$sql .= "fecha_rescd=";
		break;
	case '4':
		$sql .= "fecha_nota_envio_rec=";
		break;
	case '5':
		$sql .= "fecha_rescs=";
		break;
	case '6':
		$sql .= "fecha_ingreso_diploma=";
		break;
	case '7':
		$sql .= "fecha_ingreso_analitico=";
		break;
	case '8':
		$sql .= "fecha_retiro_diploma=";
		break;
	case '9':
		$sql .= "fecha_retiro_analitico=";
		break;
	default:
		echo '1';
}

$sql .= "'$date' WHERE id_seguimiento=$idS;";

echo strval(guardarSql($sql));
/*
if($error == 0)
{
	return '0';
}
else
{
	return '1';
}
*/

?>