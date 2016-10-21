<html>
    <head>
        <title> Listado Acto Colacion </title>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
        <style>
        .padded {
            padding-top: 8px;
            padding-bottom: 8px;
        }
        .inColPadded {
            padding-left: 0px !important;
            padding-right: 0px !important;
        }
        .onTop {
            border-top: 2px solid black !important;
        }
        .onBottom {
            border-bottom: 2px solid black !important;
        }
        </style>
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
	$sqlAlumno = pg_query("SELECT alumno.*,carrera_fk,td.nombre_tipo_dni as tdn FROM alumno INNER JOIN seguimiento ON(alumno.id_alumno = seguimiento.alumno_fk) INNER JOIN tipo_dni td ON(alumno.tipodni_alumno = td.id_tipo_dni) WHERE id_alumno = $id_Alumno AND carrera_fk=$idCarrera");
	$rowAlumno = pg_fetch_array($sqlAlumno);
		$nombre_alumno = $rowAlumno['nombre_alumno'];
		$apellido_alumno = $rowAlumno['apellido_alumno'];
		$nro_legajo = $rowAlumno['nro_legajo'];
		$tipodni_alumno = $rowAlumno['tipodni_alumno'];
        $tdn = $rowAlumno['tdn'];
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
        $provNac = $rowAlumno['provincia_nacimiento'];
        $paisNac = $rowAlumno['pais_nacimiento'];
        $sexo = ($rowAlumno['sexo'] == 'f') ? 'Femenino' : 'Masculino';
		$codigo_impresion = $rowAlumno['codigo_impresion'];
        $anioIngreso = empty($rowAlumno['anio_ingreso']) ? '' : $rowAlumno['anio_ingreso'];

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
        <div class="col-xs-3 text-left">
            <img src="minEdu.png" class="img-responsive" alt="UTN">
        </div>
        <div class="col-xs-9 text-center">
            <br/><br/>
            <h6>"2016 - Año del Bicentenario de la Declaración de la Independencia de la Nación"</h6>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12" style="padding-top:25px;">
            Al señor Decano,
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 text-center">
            <u>SOLICITUD DE DIPLOMA</u>
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
        <div class="col-xs-12 text-justify padded">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tengo el agrado de dirigirme a usted a efectos de comunicarle que he concluido con todos los examenes correspondientes al plan de estudioas y por cuanto con el fin de solicitarle, tenga a bien disponer el tramite correspondiente al título de la carrera:
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 padded">
            <strong style="font-size: 20px;">
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
            </strong>
        </div>
    </div>
    <div class="row onTop" style="border: 1px solid black">
        <div class="col-xs-12 text-justify padded">
            IMPORTANTE:<br/>Los datos aquí declarados son los que aparecerán en el diploma una vez confeccionado el mismo. De manera que solicitamos al egresado que escriba sus datos completos con letra clara y comprensible, diferenciando mayúsculas y minúsculas, indicando acentos o signos ortográficos.
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 padded" style="border: 1px solid black">
            NOMBRES: <strong><?php echo $nombre_alumno?></strong>
        </div>
        <div class="col-xs-12 padded" style="border: 1px solid black">
            APELLIDOS: <strong><?php echo $apellido_alumno?></strong>
        </div>
        <div class="col-xs-12 padded" style="border: 1px solid black">
            <div class="col-xs-6 inColPadded">
                TIPO DE DOCUMENTO: <?php echo $tdn?>
            </div>
            <div class="col-xs-6 inColPadded">
                NÚMERO DE DOCUMENTO: <?php echo $numerodni_alumno?>
            </div>
        </div>
        <div class="col-xs-12 padded" style="border: 1px solid black">
            <div class="col-xs-6 inColPadded">
                FECHA DE NACIMIENTO: <?php echo $fecha_nacimiento_alumno?>
            </div>
            <div class="col-xs-6 inColPadded">
                SEXO: <?php echo $sexo;?>
            </div>
        </div>
        <div class="col-xs-12 padded" style="border: 1px solid black">
            <div class="col-xs-4 inColPadded">
                LUGAR DE NACIMIENTO:
            </div>
            <div class="col-xs-8 inColPadded">
                PAIS: <?php echo $paisNac;?>
            </div>
            <div class="col-xs-8 col-xs-offset-4 inColPadded">
                PROVINCIA: <?php echo $provNac;?>
            </div>
            <div class="col-xs-8 col-xs-offset-4 inColPadded">
                LOCALIDAD: <?php echo $localidad_nacimiento_alumno;?>
            </div>
        </div>
        <div class="col-xs-12 padded" style="border: 1px solid black">
            <div class="col-xs-4 inColPadded">
                DOMICILIO ACTUAL:
            </div>
            <div class="col-xs-8 inColPadded">
                CALLE: <?php echo $calle_alumno.' '.$numerocalle_alumno;?>
            </div>
            <div class="col-xs-8 col-xs-offset-4 inColPadded">
                LOCALIDAD: <?php echo $localidad_viviendo_alumno;?>
            </div>
            <div class="col-xs-8 col-xs-offset-4 inColPadded">
                CÓDIGO POSTAL: <?php echo $cp_alumno;?>
            </div>
        </div>
        <div class="col-xs-12 padded" style="border: 1px solid black">
            <div class="col-xs-6 inColPadded">
                TELÉFONO: <?php echo $caracteristicaC_alumno.'-'.$telefono_alumno;?>
            </div>
            <div class="col-xs-6 inColPadded">
                TELÉFONO CELULAR: <?php echo $caracteristicaC_alumno.'-'.$celular_alumno;?>
            </div>
        </div>
        <div class="col-xs-12 padded" style="border: 1px solid black">
            <div class="col-xs-6 inColPadded">
                AÑO DE INGRESO: <?php echo $anioIngreso;?>
            </div>
            <div class="col-xs-6 inColPadded">
                FECHA DE ÚLTIMA MATERIA: <?php echo $fecha_ultima_mat_alumno;?>
            </div>
        </div>
        <div class="col-xs-12 padded" style="border: 1px solid black">
            E-MAIL: <?php echo $mail_alumno;?>
        </div>
    </div>
    <div class="row padded onBottom" style="border: 1px solid black">
        <div class="col-xs-12 text-justify">
            Declaro que los datos aquí compleados son correctos.
        </div>
        <br/>
        <div class="col-xs-6 col-xs-offset-6 text-right">
            ..............................<br/>
            Firma del egresado
        </div>
    </div>
</div>
</body>
</html>