<?php
//$conn = pg_connect("host=localhost port=5432 user=extension password=newgenius dbname=seguimiento_titulo") or die("Error de conexion.".pg_last_error());

$conn = pg_connect("host=localhost port=5432 user=postgres password=postgres dbname=seguimiento_titulo") or die("Error de conexion.".pg_last_error());
?>