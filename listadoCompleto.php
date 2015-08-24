<html>
<head>
<title> Listado Completo </title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<script src="jquery-latest.js"></script>
<script src="jquery.maskedinput.js" type="text/javascript"></script>
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
    }
</script>
<style type="text/css">
	label {font-family: Cambria; text-transform: capitalize; padding: .5em; color: #0080FF;}
	#tabla {background: #F2F2F2;}
	#titulo3 { border-top: 2px solid #BDBDBD;border-bottom: 2px solid #BDBDBD;padding: 3px;}
	l1 {font-family: Cambria;color: #0B615E; text-transform: capitalize; font-size: 1.5em;}
	l2 {font-family: Cambria;color: #424242; text-transform: capitalize; padding: .12em;}
	l4 {font-family: Cambria;color: #424242; padding: .12em;}
</style>
</head>
<?php
include_once 'conexion.php';
include_once 'libreriaPhp.php';
$vTipoListado[1] = "Solicitud de Titulo";
$vTipoListado[2] = "Consejo Directivo";
$vTipoListado[3] = "Nota de Rectorado";
$vTipoListado[4] = "Consejo Superior";
$vTipoListado[5] = "Ingreso de Diploma";
$vTipoListado[6] = "Entrega de Diploma";
$vTipoListado[7] = "Ingreso de Analítico";
$vTipoListado[8] = "Entrega de Analítico";

$control = $_REQUEST['control'];
switch ($control) {
	case 1:
		$palabra = NULL;
		break;
	case 2:
		$control = 1;
		break;
}

$controlResONota = 0;
$oTipoListado = $_REQUEST['oTipoListado'];
$nroBuscar = $_REQUEST['nroBuscar'];
$optionTipoListado = $oTipoListado;
$controlCant = 0;
switch ($oTipoListado) {
	case 2:
		$tipoListado = "Resoluciones Consejo Directivo";
		break;
	case 3:
		$tipoListado = "Nota de Envio a Rectorado";
		break;
	case 4:
		$tipoListado = "Resoluciones Consejo Superior";
		break;
	default:
		//Defaul se encarga de ver si el tipo de listado es 1, 5, 6, 7 u 8, ya que para esos listados se toman los nombres que estan en el vector de arriba y el codigo es el mismo
		$tipoListado = $vTipoListado[$oTipoListado];
		break;
}
if($control==1){
	$palabra = $_REQUEST['palabra'];
	switch ($oTipoListado) {
		case 1:
			if($palabra==NULL){
				$controlCant = contarRegistro('id_seguimiento','seguimiento','fecha_solicitud IS NOT NULL AND fecha_rescd IS NULL');
				$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud AS "fecha", caracteristicaf_alumno, telefono_alumno, caracteristicac_alumno, celular_alumno, mail_alumno, mail_alumno2 '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_solicitud IS NOT NULL AND fecha_rescd IS NULL ORDER BY fecha,apellido_alumno,nombre_alumno";
			}else{
				if ($palabra == "grado" || $palabra == "Grado"){
					$controlCant = contarRegistro('id_seguimiento','alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)',"fecha_solicitud IS NOT NULL AND fecha_rescd IS NULL AND seguimiento.carrera_fk = id_carrera AND  
						   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
						or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%'))");
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud AS "fecha", caracteristicaf_alumno, telefono_alumno, caracteristicac_alumno, celular_alumno, mail_alumno, mail_alumno2 '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_solicitud IS NOT NULL AND fecha_rescd IS NULL AND seguimiento.carrera_fk = id_carrera AND  
						   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
						or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY fecha,apellido_alumno,nombre_alumno";
				}else{
					$controlCant = contarRegistro('id_seguimiento','alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)',"fecha_solicitud IS NOT NULL AND fecha_rescd IS NULL AND seguimiento.carrera_fk = id_carrera AND  
					   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_nivel_carrera) LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%'))");
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud AS "fecha", caracteristicaf_alumno, telefono_alumno, caracteristicac_alumno, celular_alumno, mail_alumno, mail_alumno2 '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_solicitud IS NOT NULL AND fecha_rescd IS NULL AND seguimiento.carrera_fk = id_carrera AND  
					   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_nivel_carrera) LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY fecha,apellido_alumno,nombre_alumno";
				}
			}
			break;
		case 2:
			$controlResONota = 1;
			$valorColumna = "Resolución";
			$condicionResONota = 'SELECT numero_res AS "numeroMostrar",direccion_res AS "direccionMostrar" FROM numero_resolucion WHERE id_numero_resolucion=';
			if($palabra==NULL){
				$controlCant = contarRegistro('id_seguimiento','alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)',"fecha_rescd IS NOT NULL AND fecha_nota_envio_rec IS NULL");
				$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_rescd,  AS "fecha",num_res_cd_fk AS "resONota",caracteristicaf_alumno, telefono_alumno, caracteristicac_alumno, celular_alumno, mail_alumno, mail_alumno2 '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_rescd IS NOT NULL AND fecha_nota_envio_rec IS NULL ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
			}else{
				if ($palabra == "grado" || $palabra == "Grado"){
					$controlCant = contarRegistro('id_seguimiento','alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)',"fecha_rescd IS NOT NULL AND fecha_nota_envio_rec IS NULL AND seguimiento.carrera_fk = id_carrera AND  
						   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
						or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%'))");
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_rescd AS "fecha",num_res_cd_fk AS "resONota", caracteristicaf_alumno, telefono_alumno, caracteristicac_alumno, celular_alumno, mail_alumno, mail_alumno2 '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)WHERE fecha_rescd IS NOT NULL AND fecha_nota_envio_rec IS NULL AND seguimiento.carrera_fk = id_carrera AND  
						   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
						or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
				}else{
					$controlCant = contarRegistro('id_seguimiento','alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)',"fecha_rescd IS NOT NULL AND fecha_nota_envio_rec IS NULL AND seguimiento.carrera_fk = id_carrera AND  
						   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_nivel_carrera) LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%'))");
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_rescd AS "fecha",num_res_cd_fk AS "resONota", caracteristicaf_alumno, telefono_alumno, caracteristicac_alumno, celular_alumno, mail_alumno, mail_alumno2 '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_rescd IS NOT NULL AND fecha_nota_envio_rec IS NULL AND seguimiento.carrera_fk = id_carrera AND  
						   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_nivel_carrera) LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
				}
			}
			break;
		case 3:
			$controlResONota = 1;
			$valorColumna = "Nota de Envio";
			$condicionResONota = 'SELECT numero_nota AS "numeroMostrar",direccion_nota AS "direccionMostrar" FROM numero_nota_rectorado WHERE id_numero_nota_rectorado=';
			if($palabra==NULL){
				$controlCant = contarRegistro('id_seguimiento','alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)',"fecha_nota_envio_rec IS NOT NULL AND fecha_rescs IS NULL");
				$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_nota_envio_rec AS "fecha",num_nota_fk AS "resONota", caracteristicaf_alumno, telefono_alumno, caracteristicac_alumno, celular_alumno, mail_alumno, mail_alumno2 '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_nota_envio_rec IS NOT NULL AND fecha_rescs IS NULL ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
			}else{
				if ($palabra == "grado" || $palabra == "Grado"){
					$controlCant = contarRegistro('id_seguimiento','alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)',"fecha_nota_envio_rec IS NOT NULL AND fecha_rescs IS NULL AND seguimiento.carrera_fk = id_carrera AND  
						   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
						or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%'))");
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_nota_envio_rec AS "fecha",num_nota_fk AS "resONota", caracteristicaf_alumno, telefono_alumno, caracteristicac_alumno, celular_alumno, mail_alumno, mail_alumno2 '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)WHERE fecha_nota_envio_rec IS NOT NULL AND fecha_rescs IS NULL AND seguimiento.carrera_fk = id_carrera AND  
						   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
						or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
				}else{
					$controlCant = contarRegistro('id_seguimiento','alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)',"fecha_nota_envio_rec IS NOT NULL AND fecha_rescs IS NULL AND seguimiento.carrera_fk = id_carrera AND  
						   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_nivel_carrera) LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%'))");
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_nota_envio_rec AS "fecha",num_nota_fk AS "resONota", caracteristicaf_alumno, telefono_alumno, caracteristicac_alumno, celular_alumno, mail_alumno, mail_alumno2 '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_nota_envio_rec IS NOT NULL AND fecha_rescs IS NULL AND seguimiento.carrera_fk = id_carrera AND  
						   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_nivel_carrera) LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
				}
			}
			break;
		case 4:
			$controlResONota = 1;
			$valorColumna = "Resolución";
			$condicionResONota = 'SELECT numero_res AS "numeroMostrar",direccion_res AS "direccionMostrar" FROM numero_resolucion WHERE id_numero_resolucion=';
			if($palabra==NULL){
				$controlCant = contarRegistro('id_seguimiento','alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)',"fecha_rescs IS NOT NULL AND fecha_ingreso_analitico IS NULL AND fecha_ingreso_diploma IS NULL");
				$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_rescs AS "fecha",num_res_cs_fk AS "resONota", caracteristicaf_alumno, telefono_alumno, caracteristicac_alumno, celular_alumno, mail_alumno, mail_alumno2 '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_rescs IS NOT NULL AND fecha_ingreso_analitico IS NULL AND fecha_ingreso_diploma IS NULL ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
			}else{
				if ($palabra == "grado" || $palabra == "Grado"){
					$controlCant = contarRegistro('id_seguimiento','alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)',"fecha_rescs IS NOT NULL AND fecha_ingreso_analitico IS NULL AND fecha_ingreso_diploma IS NULL AND seguimiento.carrera_fk = id_carrera AND  
						   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
						or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%'))");
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_rescs AS "fecha",num_res_cs_fk AS "resONota", caracteristicaf_alumno, telefono_alumno, caracteristicac_alumno, celular_alumno, mail_alumno, mail_alumno2 '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)WHERE fecha_rescs IS NOT NULL AND fecha_ingreso_analitico IS NULL AND fecha_ingreso_diploma IS NULL AND seguimiento.carrera_fk = id_carrera AND  
						   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
						or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
				}else{
					$controlCant = contarRegistro('id_seguimiento','alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)',"fecha_rescs IS NOT NULL AND fecha_ingreso_analitico IS NULL AND fecha_ingreso_diploma IS NULL AND seguimiento.carrera_fk = id_carrera AND  
						   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_nivel_carrera) LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%'))");
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_rescs AS "fecha",num_res_cs_fk AS "resONota", caracteristicaf_alumno, telefono_alumno, caracteristicac_alumno, celular_alumno, mail_alumno, mail_alumno2 '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_rescs IS NOT NULL AND fecha_ingreso_analitico IS NULL AND fecha_ingreso_diploma IS NULL AND seguimiento.carrera_fk = id_carrera AND  
						   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_nivel_carrera) LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
				}
			}
			break;
		case 5:
			if($palabra==NULL){
				$controlCant = contarRegistro('id_seguimiento','alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)',"fecha_ingreso_diploma IS NOT NULL AND fecha_retiro_diploma IS NULL");
				$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_ingreso_diploma AS "fecha", caracteristicaf_alumno, telefono_alumno, caracteristicac_alumno, celular_alumno, mail_alumno, mail_alumno2 '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_ingreso_diploma IS NOT NULL AND fecha_retiro_diploma IS NULL ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
			}else{
				if ($palabra == "grado" || $palabra == "Grado"){
					$controlCant = contarRegistro('id_seguimiento','alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)',"fecha_ingreso_diploma IS NOT NULL AND fecha_retiro_diploma IS NULL AND seguimiento.carrera_fk = id_carrera AND  
					   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
					or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%'))");
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_ingreso_diploma AS "fecha", caracteristicaf_alumno, telefono_alumno, caracteristicac_alumno, celular_alumno, mail_alumno, mail_alumno2 '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)WHERE fecha_ingreso_diploma IS NOT NULL AND fecha_retiro_diploma IS NULL AND seguimiento.carrera_fk = id_carrera AND  
					   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
					or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
				}else{
					$controlCant = contarRegistro('id_seguimiento','alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)',"fecha_ingreso_diploma IS NOT NULL AND fecha_retiro_diploma IS NULL AND seguimiento.carrera_fk = id_carrera AND  
					   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_nivel_carrera) LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%'))");
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_ingreso_diploma AS "fecha", caracteristicaf_alumno, telefono_alumno, caracteristicac_alumno, celular_alumno, mail_alumno, mail_alumno2 '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_ingreso_diploma IS NOT NULL AND fecha_retiro_diploma IS NULL AND seguimiento.carrera_fk = id_carrera AND  
					   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_nivel_carrera) LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
				}
			}
			break;
		case 6:
			if($palabra==NULL){
				$controlCant = contarRegistro('id_seguimiento','alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)',"fecha_retiro_diploma IS NOT NULL");
				$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_retiro_diploma AS "fecha", caracteristicaf_alumno, telefono_alumno, caracteristicac_alumno, celular_alumno, mail_alumno, mail_alumno2 '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_retiro_diploma IS NOT NULL ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
			}else{
				if ($palabra == "grado" || $palabra == "Grado"){
					$controlCant = contarRegistro('id_seguimiento','alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)',"fecha_retiro_diploma IS NOT NULL AND seguimiento.carrera_fk = id_carrera AND  
					   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
					or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%'))");
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_retiro_diploma AS "fecha", caracteristicaf_alumno, telefono_alumno, caracteristicac_alumno, celular_alumno, mail_alumno, mail_alumno2 '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)WHERE fecha_retiro_diploma IS NOT NULL AND seguimiento.carrera_fk = id_carrera AND  
					   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
					or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
				}else{
					$controlCant = contarRegistro('id_seguimiento','alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)',"fecha_retiro_diploma IS NOT NULL AND seguimiento.carrera_fk = id_carrera AND  
					   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_nivel_carrera) LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%'))");
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_retiro_diploma AS "fecha", caracteristicaf_alumno, telefono_alumno, caracteristicac_alumno, celular_alumno, mail_alumno, mail_alumno2 '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_retiro_diploma IS NOT NULL AND seguimiento.carrera_fk = id_carrera AND  
					   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_nivel_carrera) LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
				}
			}
			break;
		case 7:
			if($palabra==NULL){
				$controlCant = contarRegistro('id_seguimiento','alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)',"fecha_ingreso_analitico IS NOT NULL AND fecha_retiro_analitico IS NULL");
				$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_ingreso_analitico AS "fecha", caracteristicaf_alumno, telefono_alumno, caracteristicac_alumno, celular_alumno, mail_alumno, mail_alumno2 '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_ingreso_analitico IS NOT NULL AND fecha_retiro_analitico IS NULL ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
			}else{
				if ($palabra == "grado" || $palabra == "Grado"){
					$controlCant = contarRegistro('id_seguimiento','alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)',"fecha_ingreso_analitico IS NOT NULL AND fecha_retiro_analitico IS NULL AND seguimiento.carrera_fk = id_carrera AND  
					   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
					or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%'))");
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_ingreso_analitico AS "fecha", caracteristicaf_alumno, telefono_alumno, caracteristicac_alumno, celular_alumno, mail_alumno, mail_alumno2 '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)WHERE fecha_ingreso_analitico IS NOT NULL AND fecha_retiro_analitico IS NULL AND seguimiento.carrera_fk = id_carrera AND  
					   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
					or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
				}else{
					$controlCant = contarRegistro('id_seguimiento','alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)',"fecha_ingreso_analitico IS NOT NULL AND fecha_retiro_analitico IS NULL AND seguimiento.carrera_fk = id_carrera AND  
					   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_nivel_carrera) LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%'))");
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_ingreso_analitico AS "fecha", caracteristicaf_alumno, telefono_alumno, caracteristicac_alumno, celular_alumno, mail_alumno, mail_alumno2 '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_ingreso_analitico IS NOT NULL AND fecha_retiro_analitico IS NULL AND seguimiento.carrera_fk = id_carrera AND  
					   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_nivel_carrera) LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
				}
			}
			break;
		case 8:
			if($palabra==NULL){
				$controlCant = contarRegistro('id_seguimiento','alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)',"fecha_retiro_analitico IS NOT NULL");
				$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_retiro_analitico AS "fecha", caracteristicaf_alumno, telefono_alumno, caracteristicac_alumno, celular_alumno, mail_alumno, mail_alumno2 '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_retiro_analitico IS NOT NULL ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
			}else{
				if ($palabra == "grado" || $palabra == "Grado"){
					$controlCant = contarRegistro('id_seguimiento','alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)',"fecha_retiro_analitico IS NOT NULL AND seguimiento.carrera_fk = id_carrera AND  
					   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
					or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%'))");
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_retiro_analitico AS "fecha", caracteristicaf_alumno, telefono_alumno, caracteristicac_alumno, celular_alumno, mail_alumno, mail_alumno2 '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)WHERE fecha_retiro_analitico IS NOT NULL AND seguimiento.carrera_fk = id_carrera AND  
					   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
					or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
				}else{
					$controlCant = contarRegistro('id_seguimiento','alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)',"fecha_retiro_analitico IS NOT NULL AND seguimiento.carrera_fk = id_carrera AND  
					   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_nivel_carrera) LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%'))");
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_retiro_analitico AS "fecha", caracteristicaf_alumno, telefono_alumno, caracteristicac_alumno, celular_alumno, mail_alumno, mail_alumno2 '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_retiro_analitico IS NOT NULL AND seguimiento.carrera_fk = id_carrera AND  
					   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_nivel_carrera) LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
				}
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
echo '<form class="formBuscador" id="commentForm" name="buscador" action="?control=1" method="post" >';
	echo '<tr bgcolor="#FFFFFF">';
		echo '<td id="titulo3" colspan="8" align="center"><l1>Listado '.$tipoListado.'</l1></td>';
	echo '</tr>';
	echo '<tr bgcolor="#FFFFFF">';
		echo '<td id="titulo3" colspan="8" align="center"><l1>Tipo Listado:</l1>&nbsp;&nbsp;&nbsp;&nbsp;';
		echo '<select name="oTipoListado" size="1" onChange="submit()">';
		echo '<option value="0">Seleccione un tipo</option>';
			for($i=1;$i<9;$i++){
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
echo '</form>';
echo '<form class="formBuscador" id="commentForm" name="buscador2" action="?control=2" method="post" >';
	echo '<tr bgcolor="#FFFFFF">';
		echo '<input type="hidden" name="oTipoListado" value="'.$oTipoListado.'" />';
		echo '<td id="titulo3" colspan="8" align="center"><l1>Buscar:</l1>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="palabra" value="'.$palabra.'" onChange="submit()" /></td>';
	echo '</tr>';
echo '</form>';

if($controlCant!=0){
	echo '<tr bgcolor="#FFFFFF">';
		echo '<td id="titulo3" colspan="8" align="center"><l1>'.$controlCant.' resultados encontrados</l1></td>';
	echo '</tr>';
	echo '<tr bgcolor="#FFFFFF">';
		echo '<td id="titulo3" colspan="8" align="center"><l1><a href="excelListadoCompleto.php?palabra='.$palabra.'&oTipoListado='.$oTipoListado.'&cantidad='.$controlCant.'"><input type="button" value="Excel"/></a>&nbsp;&nbsp;<a href="pantallaListadoCompleto.php?palabra='.$palabra.'&oTipoListado='.$oTipoListado.'&cantidad='.$controlCant.'"><input type="button" value="Imprimir"/></a></l1></td>';
	echo '</tr>';
}

	echo '<tr bgcolor="#000000">';
		echo '<td align="center"><strong><label></label></strong></td>';
		echo '<td align="center"><strong><label>Alumno</label></strong></td>';
		echo '<td align="center"><strong><label>Nivel Carrera</label></strong></td>';
		echo '<td align="center"><strong><label>Carrera</label></strong></td>';
		echo '<td align="center"><strong><label>Fecha</label></strong></td>';
		echo '<td align="center"><strong><label>Mail</label></strong></td>';
		echo '<td align="center"><strong><label>Tel&eacute;fono</label></strong></td>';
		if($controlResONota==1){
			echo '<td align="center"><strong><label>'.$valorColumna.'</label></strong></td>';
		}
		//echo '<td align="center"><strong><label>Ver Graduado</label></strong></td>';
	echo '</tr>';

	if($control!=0){
		if($controlCant!=0){
				$contarAlumno = 0;
				$val = pg_query($consulta);
				while($row=pg_fetch_array($val,NULL,PGSQL_ASSOC)){
				echo '<tr>';
					$contarAlumno++;
					echo '<td align="center"><l2>'.$contarAlumno.'</l2></td>';
					echo '<td align="center"><l2>'.$row['apellido_alumno'].', '.$row['nombre_alumno'].'</l2></td>';
					echo '<td align="center"><l2>'.$row['nombre_nivel_carrera'].'</l2></td>';
					echo '<td align="center"><l2>'.$row['nombre_carrera'].'</l2></td>';
					echo '<td align="center"><l2>'.setDate($row['fecha']).'</l2></td>';
					if(empty($row[mail_alumno]))
					{
						$mails = (empty($row['mail_alumno2'])) ? "" : $row['mail_alumno2'];
					}
					else
					{
						$mails = $row['mail_alumno'];
						$mails .= (empty($row[mail_alumno2])) ? "" : '<br>'.$row[mail_alumno2];
					}
					$mails = strtolower($mails);
					echo '<td align="center"><l4>'.$mails.'</l4></td>';
					if(empty($row['celular_alumno']))
					{
						$telefonos = (empty($row['telefono_alumno'])) ? "" : $row['caracteristicaf_alumno'].'-'.$row['telefono_alumno'];
					}
					else
					{
						$telefonos = $row['caracteristicac_alumno'].'-'.$row['celular_alumno'];
						$telefonos .= (empty($row[telefono_alumno])) ? "" : '<br>'.$row['caracteristicaf_alumno'].'-'.$row['telefono_alumno'];
					}
					echo '<td align="center"></l2>'.$telefonos.'</l2></td>';
					if($controlResONota==1){
						$idResONota = $row['resONota'];
						$sqlResONota = pg_query($condicionResONota.$idResONota);
						$rowResONota = pg_fetch_array($sqlResONota);
						if($oTipoListado==2||$oTipoListado==4){
							$numeroMostrarTemp = $rowResONota['numeroMostrar'];
							$vNumeroMostrarTemp = explode('-', $numeroMostrarTemp);
							$numeroMostrar = $vNumeroMostrarTemp[1];
						}else{
							$numeroMostrar = $rowResONota['numeroMostrar'];
						}
						echo '<td align="center"><l2><a href="'.$rowResONota['direccionMostrar'].'" target="_blank">'.$numeroMostrar.'</a></l2></td>';
					}
					//echo '<td align="center"><a href="verAlumno.php?idAlumno='.$row['id_alumno'].'"><input type="image" src="ver.png" width="50" height="50" value="Opciones" /></a></td>';
					//echo '<td align="center"><a href="listadoSeguimientoTitulo.php?idAlumno='.$row['id_alumno'].'"><input type="image" src="seguimiento.png" width="60" height="40" value="Opciones" /></a></td>';
				echo '</tr>';
			}
		}else{
				echo '<tr>';
					echo '<td align="center" colspan="8"><strong><label><i>No se encontraron resultados</i></label></strong></td>';
				echo '</tr>';
			}
		
	}else{
		echo '<tr>';
			echo '<td align="center" colspan="8"><strong><label><i>Realice una busqueda</i></label></strong></td>';
		echo '</tr>';
	}
echo '</table>';
?>
<p>
<a href="listadoCompleto.php?control=0"><center><input type="button" value="Atr&aacute;s"></center></a>
</p>
</body>
</html>