<?php

include_once "../conexion.php";
include_once '../libreriaPhp.php';

$sqlAgregarResolucion = "";
$sqlActualizarSeguimientoResolucion = "";

$sqlResolucion = pg_query("SELECT * FROM numero_resolucion");

$idAgregar = traerId('archivo') - 1;

while($rowResolucion = pg_fetch_array($sqlResolucion))
{
	$nombreResolucion = $rowResolucion['numero_res'];
	$tipoAgregar = 99; //Agregar el tipo 99 a la base de datos con el nombre sin tipo
	$vNombreResolucion = explode('-', $nombreResolucion);

	$idAgregar++;

	if($vNombreResolucion[0] == 'rec')
	{
		$sqlActualizarSeguimientoResolucion .= "UPDATE seguimiento SET num_res_cd_fk='$idAgregar' WHERE num_res_cd_fk='".$rowResolucion['id_numero_resolucion']."';";
		$tipoAgregar = 1;
	}
	elseif ($vNombreResolucion[0] == 'res')
	{
		$sqlActualizarSeguimientoResolucion .= "UPDATE seguimiento SET num_res_cs_fk='$idAgregar' WHERE num_res_cs_fk='".$rowResolucion['id_numero_resolucion']."';";
		$tipoAgregar = 3;
	}

	$nombreAgregar = $vNombreResolucion[1];

	$urlAgregar = $rowResolucion['direccion_res'];

	$sqlAgregarResolucion .= "INSERT INTO archivo(id,nombre,url,tipo) VALUES('$idAgregar','$nombreAgregar','$urlAgregar','$tipoAgregar');";
	
}

$sqlNota = pg_query("SELECT * FROM numero_nota_rectorado");

$sqlAgregarNota = "";
$sqlActualizarSeguimientoNota = "";

while($rowNota = pg_fetch_array($sqlNota))
{
	$nombreAgregar = $rowNota['numero_nota'];
	$idAgregar++;
	$urlAgregar = $rowNota['direccion_nora'];

	$sqlAgregarNota .= "INSERT INTO archivo(id,nombre,url,tipo) VALUES('$idAgregar','$nombreAgregar','$urlAgregar',2);";
	$sqlActualizarSeguimientoNota .= "UPDATE seguimiento SET num_nota_fk='$idAgregar' WHERE num_nota_fk='".$rowNota['id_numero_nota_rectorado']."';";

}

$sqlFinal = $sqlAgregarResolucion.$sqlActualizarSeguimientoResolucion.$sqlAgregarNota.$sqlActualizarSeguimientoNota;

echo $sqlFinal;
?>