<html>
<head>
<title> Listado Resoluciones Y Nota </title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<script src="js/jquery-latest.js"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>
<script type="text/javascript">
        jQuery(function($){
            $("#numero1").mask("9,99", {

                // Generamos un evento en el momento que se rellena
                completed:function(){
                    $("#numero1").addClass("ok")
                }
            });
            
            // Definimos las mascaras para cada input
            $("#date").mask("39/19/2999");
            $("#movil").mask("999 99 99 99");
            $("#letras").mask("aaa");
            $("#resolucion").mask("****/**");
            $("#nota").mask("****/**");
            $("#comodines").mask("?");
        });
</script>
<script type="text/javascript">
	function validarForm(f){
        if(formBuscador.oTipoListado.value==0){
                f.oTipoListado.focus();
                alert('Seleccione una resolucion o nota');
                return false;
        }
        return true;
</script>
<style type="text/css">
	label {font-family: Cambria; text-transform: capitalize; padding: .5em; color: #0080FF;}
	#tabla {background: #F2F2F2;}
	#titulo3 { border-top: 2px solid #BDBDBD;border-bottom: 2px solid #BDBDBD;padding: 3px;}
	l1 {font-family: Cambria;color: #0B615E; text-transform: capitalize; font-size: 1.5em;}
	l2 {font-family: Cambria;color: #424242; text-transform: capitalize; padding: .12em;}
</style>
</head>
<?php
include_once 'conexion.php';
include_once 'libreriaPhp.php';
$vTipoListado[1] = "Consejo Directivo";
$vTipoListado[2] = "Nota de Rectorado";
$vTipoListado[3] = "Consejo Superior";

$control = $_REQUEST['control'];
$oTipoListado = $_REQUEST['oTipoListado'];
$nroBuscar = $_REQUEST['nroBuscar'];
$optionTipoListado = $oTipoListado;
$controlCant = 0;
switch ($oTipoListado) {
	case 1:
		$tipoListado = "Resoluciones Consejo Directivo";
		break;
	case 2:
		$tipoListado = "Nota de Envio a Rectorado";
		break;
	case 3:
		$tipoListado = "Resoluciones Consejo Superior";
		break;
}
if($control==1){
	switch ($oTipoListado) {
		case 1:
			$nroBuscarConsulta = 'rec-'.$nroBuscar;
			$condicion = "numero_res='$nroBuscarConsulta'";
			$controlCant = contarRegistro('id_numero_resolucion','numero_resolucion',$condicion);
			if($controlCant!=0){
				$rowIdRes = pg_fetch_array(traerSqlCondicion('id_numero_resolucion, direccion_res AS "direccion"','numero_resolucion',$condicion));
				$idResolucion = $rowIdRes['id_numero_resolucion'];
				$direccion = $rowIdRes['direccion'];
				//Busco la fecha de la resolucion
				$condicionFecha = "num_res_cd_fk='$idResolucion'";
				$rowFecha = pg_fetch_array(traerSqlCondicion('fecha_rescd','seguimiento',$condicionFecha));
				$fechaBuscar = $rowFecha['fecha_rescd'];
				//Creo la consulta de los alumnos
				$consulta = "SELECT id_alumno,nombre_alumno,apellido_alumno,nombre_carrera,nombre_nivel_carrera FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk=alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE num_res_cd_fk=$idResolucion;";
			}
			break;
		case 2:
			$nroBuscarConsulta = $nroBuscar;
			$condicion = "numero_nota='$nroBuscarConsulta'";
			$controlCant = contarRegistro('id_numero_nota_rectorado','numero_nota_rectorado',$condicion);
			if($controlCant!=0){
				$rowIdNota = pg_fetch_array(traerSqlCondicion('id_numero_nota_rectorado,direccion_nota AS "direccion"','numero_nota_rectorado',$condicion));
				$idNota = $rowIdNota['id_numero_nota_rectorado'];
				$direccion = $rowIdNota['direccion'];
				//Busco la fecha de la resolucion
				$condicionFecha = "num_nota_fk='$idNota'";
				$rowFecha = pg_fetch_array(traerSqlCondicion('fecha_nota_envio_rec','seguimiento',$condicionFecha));
				$fechaBuscar = $rowFecha['fecha_nota_envio_rec'];
				//Creo la consulta de los alumnos
				$consulta = "SELECT id_alumno,nombre_alumno,apellido_alumno,nombre_carrera,nombre_nivel_carrera FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk=alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE num_nota_fk=$idNota;";
			}
			break;
		case 3:
			$nroBuscarConsulta = 'res-'.$nroBuscar;
			$condicion = "numero_res='$nroBuscarConsulta'";
			$controlCant = contarRegistro('id_numero_resolucion','numero_resolucion',$condicion);
			if($controlCant!=0){
				$rowIdRes = pg_fetch_array(traerSqlCondicion('id_numero_resolucion,direccion_res AS "direccion"','numero_resolucion',$condicion));
				$idResolucion = $rowIdRes['id_numero_resolucion'];
				$direccion = $rowIdRes['direccion'];
				//Busco la fecha de la resolucion
				$condicionFecha = "num_res_cs_fk='$idResolucion'";
				$rowFecha = pg_fetch_array(traerSqlCondicion('fecha_rescs','seguimiento',$condicionFecha));
				$fechaBuscar = $rowFecha['fecha_rescs'];
				//Creo la consulta de los alumnos
				$consulta = "SELECT id_alumno,nombre_alumno,apellido_alumno,nombre_carrera,nombre_nivel_carrera FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk=alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE num_res_cs_fk=$idResolucion;";
			}
			break;
		case 0:
			$control = 0;
	}
}

?>
<body link="#000000" vlink="#000000" alink="#FFFFFF">

<?php

echo '<table align="center" cellspacing="1" cellpadding="4" border="1" bgcolor=#585858 id="tabla">';
echo '<form class="formBuscador" id="commentForm" name="buscador" action="?control=1" method="post" onSubmit="return validarForm(this);">';
	echo '<tr bgcolor="#FFFFFF">';
		echo '<td id="titulo3" colspan="6" align="center"><l1>Listado '.$tipoListado.'</l1></td>';
	echo '</tr>';
	echo '<tr bgcolor="#FFFFFF">';
		echo '<td id="titulo3" colspan="6" align="center"><l1>Tipo Listado:</l1>&nbsp;&nbsp;&nbsp;&nbsp;';
		echo '<select name="oTipoListado" size="1">';
		echo '<option value="0">Seleccione un tipo</option>';
			for($i=1;$i<4;$i++){
				if($optionTipoListado == $i){
					$selected = "selected";
				}else{
					$selected = "";
				}
				echo '<option value="'.$i.'" '.$selected.' >'.$vTipoListado[$i].'</option>';
			}
		echo '</select>';
		echo '</td>';
	echo '</tr>';
	echo '<tr bgcolor="#FFFFFF">';
		echo '<td id="titulo3" colspan="6" align="center"><l1>Buscar:</l1>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="nroBuscar" value="'.$nroBuscar.'" id="nota" onChange="submit()" /></td>';
	echo '</tr>';
echo '</form>';

if($controlCant!=0){
	$vFechaBuscar = explode('-', $fechaBuscar);
	echo '<tr bgcolor="#FFFFFF">';
		echo '<td id="titulo3" colspan="6" align="center"><l1>Fecha: '.$vFechaBuscar[2].'/'.$vFechaBuscar[1].'/'.$vFechaBuscar[0].'</l1></td>';
	echo '</tr>';
	echo '<tr bgcolor="#FFFFFF">';
	if($oTipoListado==2){
		echo '<td id="titulo3" colspan="6" align="center"><a href="'.$direccion.'" target="_blank"><input type="button" value="Ver Nota" /></a></td>';
	}else{
		echo '<td id="titulo3" colspan="6" align="center"><a href="'.$direccion.'" target="_blank"><input type="button" value="Ver Resoluci&oacute;n" /></a></td>';
	}
	echo '</tr>';
}

	echo '<tr bgcolor="#000000">';
		echo '<td align="center"><strong><label>Alumno</label></strong></td>';
		echo '<td align="center"><strong><label>Nivel Carrera</label></strong></td>';
		echo '<td align="center"><strong><label>Carrera</label></strong></td>';
		echo '<td align="center"><strong><label>Ver Graduado</label></strong></td>';
		echo '<td align="center"><strong><label>Seguimiento</label></strong></td>';
	echo '</tr>';

	if($control!=0){
		if($controlCant!=0){
				$val = pg_query($consulta);
				while($row=pg_fetch_array($val,NULL,PGSQL_ASSOC)){
				echo '<tr>';
					echo '<td align="center"><l2>'.$row['apellido_alumno'].', '.$row['nombre_alumno'].'</l2></td>';
					echo '<td align="center"><l2>'.$row['nombre_nivel_carrera'].'</l2></td>';
					echo '<td align="center"><l2>'.$row['nombre_carrera'].'</l2></td>';
					echo '<td align="center"><a href="verAlumno.php?idAlumno='.$row['id_alumno'].'"><input type="image" src="ver.png" width="50" height="50" value="Opciones" /></a></td>';
					echo '<td align="center"><a href="listadoSeguimientoTitulo.php?idAlumno='.$row['id_alumno'].'"><input type="image" src="seguimiento.png" width="60" height="40" value="Opciones" /></a></td>';
				echo '</tr>';
			}
		}else{
				echo '<tr>';
					echo '<td align="center" colspan="6"><strong><label><i>No se encontraron resultados</i></label></strong></td>';
				echo '</tr>';
			}
		
	}else{
		echo '<tr>';
			echo '<td align="center" colspan="6"><strong><label><i>Realice una busqueda</i></label></strong></td>';
		echo '</tr>';
	}
echo '</table>';
?>
<p>
<a href="listadoResoluciones.php?control=0"><center><input type="button" value="Atr&aacute;s"></center></a>
</p>
</body>
</html>