<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Validar DNI1</title>
</head>
<body>
<?php
include_once "conexion.php";

$numDNI = $_REQUEST['numDNI'];


//echo $numDNI.'<br>';
$consultaDNI = pg_query("SELECT count(id) AS total,id FROM persona WHERE dni = '$numDNI' GROUP BY id");
//echo $numDNI.'<br>';
$rowConsultaDni = pg_fetch_array($consultaDNI,NULL,PGSQL_ASSOC);
$cantidad = $rowConsultaDni['total'];

echo $cantidad;

	if($cantidad != 0){
		echo '<script language="JavaScript"> window.location = "solicitarPassword.php?idAlumno='.$rowConsultaDni['id'].'";</script>';
	}else{
		echo '<script language="JavaScript"> window.location = "registrarGraduado.php?numDNI='.$numDNI.'";</script>';
	}
	¨
?>
</body>
</html>