<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script src="jquery-latest.js"></script>
	<script type="text/javascript" src="jquery.validate.js"></script>
	<title>Validar DNI</title>
</head>
<body>
<?php
include_once "conexion.php";

$password = $_REQUEST['password'];
$id_Alumno = $_REQUEST['idAlumno'];
$consultaPassword = pg_query("SELECT count(id_alumno) AS total FROM alumno WHERE password_alumno = '$password' AND id_alumno = '$id_Alumno'");
$rowConsultaPass = pg_fetch_array($consultaPassword,NULL,PGSQL_ASSOC);
$cantidad = $rowConsultaPass['total'];

if($cantidad == 0){
	echo '<script type="text/javascript"> alert("La contrase&ntilde;a ingresada es incorrecta"); window.location = "solicitarPassword.php?idAlumno='.$id_Alumno.'";</script>';
}else{
	echo '<script type="text/javascript"> window.location="verAlumno.php?idAlumno='.$id_Alumno.'"; </script>';
}
?>
</body>
</html>