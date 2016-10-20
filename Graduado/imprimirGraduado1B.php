<html>
    <head>
        <title> Listado Acto Colacion </title>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    </head>
<body onload="print()">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.min.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/printThis.js"></script>
<?php
include_once "conexion.php";
$id_Alumno = $_REQUEST['idAlumno'];
$idCarrera = $_REQUEST['idCarrera'];
	$sqlAlumno = pg_query("SELECT alumno.*,carrera_fk FROM alumno INNER JOIN seguimiento ON(alumno.id_alumno = seguimiento.alumno_fk) WHERE id_alumno = $id_Alumno AND carrera_fk=$idCarrera");
	$rowAlumno = pg_fetch_array($sqlAlumno);
		$nombre_alumno = $rowAlumno['nombre_alumno'];
		$apellido_alumno = $rowAlumno['apellido_alumno'];
		$nro_legajo = $rowAlumno['nro_legajo'];
		$tipodni_alumno = $rowAlumno['tipodni_alumno'];
		$numerodni_alumno = $rowAlumno['numerodni_alumno'];
		$fechanacimiento_alumno = $rowAlumno['fechanacimiento_alumno'];
			$mostrar = explode('-',$fechanacimiento_alumno);
				$anio = $mostrar[0];
				$mes = $mostrar[1];
				$dia = $mostrar[2];
		$fecha_nacimiento_alumno = $dia.'/'.$mes.'/'.$anio;
		$localidad_nacimiento_alumno = $rowAlumno['localidad_nacimiento_alumno'];
		$provincia_viviendo_alumno = $rowAlumno['provincia_viviendo_alumno'];
		$localidad_viviendo_alumno = $rowAlumno['localidad_viviendo_alumno'];
		$cp_alumno = $rowAlumno['cp_alumno'];
		$calle_alumno = $rowAlumno['calle_alumno'];
		$numerocalle_alumno = $rowAlumno['numerocalle_alumno'];
		$piso_alumno = $rowAlumno['piso_alumno'];
		$dpto_alumno = $rowAlumno['dpto_alumno'];
		$carrera_alumno = $rowAlumno['carrera_fk'];
		$caracteristicaF_alumno = $rowAlumno['caracteristicaf_alumno'];
		$telefono_alumno = $rowAlumno['telefono_alumno'];
		$caracteristicaC_alumno = $rowAlumno['caracteristicac_alumno'];
		$celular_alumno = $rowAlumno['celular_alumno'];
		$mail_alumno = $rowAlumno['mail_alumno'];
		$mail_alumno2 = $rowAlumno['mail_alumno2'];
		$facebook_alumno = $rowAlumno['facebook_alumno'];
		$twitter_alumno = $rowAlumno['twitter_alumno'];
		$password_alumno = $rowAlumno['password_alumno'];
		$provincia_trabajo_alumno = $rowAlumno['provincia_trabajo_alumno'];
		$localidad_trabajo_alumno = $rowAlumno['localidad_trabajo_alumno'];
		$cp_alumno2 = $rowAlumno['cp_alumno2'];
		$empresa_trabaja_alumno = $rowAlumno['empresa_trabaja_alumno'];
		$perfil_laboral_alumno = $rowAlumno['perfil_laboral_alumno'];
		$destinoImagen = $rowAlumno['foto_alumno'];
		$ancho_final = $rowAlumno['ancho_final'];
		$alto_final = $rowAlumno['alto_final'];
		$ultima_materia_alumno = $rowAlumno['ultima_materia_alumno'];
		$fechaUltimaMatAlumno = $rowAlumno['fecha_ultima_mat_alumno'];

		$codigo_impresion = $rowAlumno['codigo_impresion'];

			$mostrar = explode('-',$fechaUltimaMatAlumno);
					$anio = $mostrar[0];
					$mes = $mostrar[1];
					$dia = $mostrar[2];
			$fecha_ultima_mat_alumno = $dia.'/'.$mes.'/'.$anio;
		$diaActual = date('d');
		$mesActual = date('m');
		$anioActual = date('Y');
	
	if ($mesActual == 01 or $mesActual == 1){
		$mesActual = 'Enero';
	}
	if ($mesActual == 02 or $mesActual == 2){
		$mesActual = 'Febrero';
	}
	if ($mesActual == 03 or $mesActual == 3){
		$mesActual = 'Marzo';
	}
	if ($mesActual == 04 or $mesActual == 4){
		$mesActual = 'Abril';
	}
	if ($mesActual == 05 or $mesActual == 5){
		$mesActual = 'Mayo';
	}
	if ($mesActual == 06 or $mesActual == 6){
		$mesActual = 'Junio';
	}
	if ($mesActual == 07 or $mesActual == 7){
		$mesActual = 'Julio';
	}
	if ($mesActual == 08 or $mesActual == 8){
		$mesActual = 'Agosto';
	}
	if ($mesActual == 09 or $mesActual == 9){
		$mesActual = 'Septiembre';
	}
	if ($mesActual == 10){
		$mesActual = 'Octubre';
	}
	if ($mesActual == 11){
		$mesActual = 'Noviembre';
	}
	if ($mesActual == 12){
		$mesActual = 'Diciembre';
	}
    ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-6 text-left">
        Lala
        </div>
        <div class="col-xs-6 text-right">
            <h6>"2016 - Año del Bicentenario de la Declaración de la <br/>Independencia de la Nación"</h6>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            Al señor Decano,
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 text-center">
            SOLICITUD DE DIPLOMA
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            De mi consideración:
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            Al señor Decano,
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 text-justify">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tengo el agrado de dirigirme a usted a efectos de comunicarle que he concluido con todos los examenes correspondientes al plan de estudioas y por cuanto con el fin de solicitarle, tenga a bien disponer el tramite correspondiente al título de la carrera:
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?php
                    $consultaCarrera=pg_query("SELECT * FROM carrera");
                    while($rowCarrera=pg_fetch_array($consultaCarrera)){
                            $id = $rowCarrera['id_carrera'];
                            if($id == $carrera_alumno){						
                                $carrera = $rowCarrera['nombre_carrera'];
                            }
                    }
                    echo $carrera;
            ?>
        </div>
    </div>
    <div class="row" style="border: 1px solid black">
        <div class="col-xs-12 text-justify">
            IMPORTANTE:<br/>Los datos aquí declarados son los que aparecerán en el diploma una vez confeccionado el mismo. De manra que solicitamos al egresado que escriba sus datos completos con letra clara y comprensible, diferenciando mayúsculas y minúsculas, indicando acentos o signos ortográficos.
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12" style="border: 1px solid black">
            NOMBRES: <?php echo $nombre_alumno?>
        </div>
        <div class="col-xs-12" style="border: 1px solid black">
            APELLIDOS: <?php echo $apellido_alumno?>
        </div>
        <div class="col-xs-12" style="border: 1px solid black">
            <div class="col-xs-6">
                TIPO DE DOCUMENTO: <?php echo $tipodni_alumno?>
            </div>
            <div class="col-xs-6">
                NÚMERO DE DOCUMENTO: <?php echo $numerodni_alumno?>
            </div>
        </div>
        <div class="col-xs-12" style="border: 1px solid black">
            <div class="col-xs-6">
                FECHA DE NACIMIENTO: <?php echo $fechanacimiento_alumno?>
            </div>
            <div class="col-xs-6">
                SEXO: M-CAMBIAR
            </div>
        </div>
        <div class="col-xs-12" style="border: 1px solid black">
            <div class="col-xs-4">
                LUGAR DE NACIMIENTO:
            </div>
            <div class="col-xs-8">
                PAIS: Argentina
            </div>
            <div class="col-xs-8 col-xs-offset-4">
                PROVINCIA: Prov
            </div>
            <div class="col-xs-8 col-xs-offset-4">
                LOCALIDAD: <?php echo $localidad_nacimiento_alumno;?>
            </div>
        </div>
    </div>
</div>
</body>
</html>