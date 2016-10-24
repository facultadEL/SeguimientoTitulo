
<?php
include 'conexion.php';

$id_Alumno = $_REQUEST['idAlumno'];

pg_query("DELETE FROM telefono WHERE persona_fk = $id_Alumno");
pg_query("DELETE FROM persona WHERE id = $id_Alumno");


echo '<script type="text/javascript">
		alert("El alumno ha sido eliminado");
		window.location="listadoAlumno.php"
	 </script>';
?>
