<html>
<head>
<title> Seguimiento del alumno </title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<style type="text/css">
	label {font-family: Cambria; text-transform: capitalize; padding: .5em; color: #0080FF;}
	#tabla {background: #F2F2F2;}
	#titulo3 { border-top: 2px solid #BDBDBD;border-bottom: 2px solid #BDBDBD;padding: 3px;}
	#titulo2 { border-top: 2px solid #BDBDBD;border-bottom: 2px solid #BDBDBD;padding: 3px;}
	l1 {font-family: Cambria;color: #0B615E; text-transform: capitalize; font-size: 1.5em;}
	l3 {font-family: Cambria;color: #0040FF; text-transform: capitalize; font-size: 1.5em;}
	l2 {font-family: Cambria;color: #424242; text-transform: capitalize; padding: .12em;}
	a { text-decoration:none }
</style>
</head>
<body link="#000000" vlink="#000000" alink="#FFFFFF" onload=print()>
<?php
$vTipoListado[1] = "Solicitud de Titulo";
$vTipoListado[2] = "Consejo Directivo";
$vTipoListado[3] = "Nota de Rectorado";
$vTipoListado[4] = "Consejo Superior";
$vTipoListado[5] = "Ingreso de Diploma";
$vTipoListado[6] = "Entrega de Diploma";
$vTipoListado[7] = "Ingreso de Analítico";
$vTipoListado[8] = "Entrega de Analítico";

$palabra= $_REQUEST['palabra'];
$oTipoListado = $_REQUEST['oTipoListado'];
$cantidad = $_REQUEST['cantidad'];

switch ($oTipoListado) {
		case 1:
			if($palabra==NULL){
				$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud AS "fecha"  '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_solicitud IS NOT NULL AND fecha_rescd IS NULL ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
			}else{
				if ($palabra == "grado" || $palabra == "Grado"){
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud AS "fecha" '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_solicitud IS NOT NULL AND fecha_rescd IS NULL AND seguimiento.carrera_fk = id_carrera AND  
						   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
						or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
				}else{
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud AS "fecha" '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_solicitud IS NOT NULL AND fecha_rescd IS NULL AND seguimiento.carrera_fk = id_carrera AND  
					   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_nivel_carrera) LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
				}
			}
			break;
		case 2:
			$controlResONota = 1;
			$valorColumna = "Resolución";
			$condicionResONota = 'SELECT numero_res AS "numeroMostrar",direccion_res AS "direccionMostrar" FROM numero_resolucion WHERE id_numero_resolucion=';
			if($palabra==NULL){
				$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_rescd AS "fecha",num_res_cd_fk AS "resONota" '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_rescd IS NOT NULL AND fecha_nota_envio_rec IS NULL ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
			}else{
				if ($palabra == "grado" || $palabra == "Grado"){
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_rescd AS "fecha",num_res_cd_fk AS "resONota" '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)WHERE fecha_rescd IS NOT NULL AND fecha_nota_envio_rec IS NULL AND seguimiento.carrera_fk = id_carrera AND  
						   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
						or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
				}else{
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_rescd AS "fecha",num_res_cd_fk AS "resONota" '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_rescd IS NOT NULL AND fecha_nota_envio_rec IS NULL AND seguimiento.carrera_fk = id_carrera AND  
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
				$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_nota_envio_rec AS "fecha",num_nota_fk AS "resONota" '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_nota_envio_rec IS NOT NULL AND fecha_rescs IS NULL ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
			}else{
				if ($palabra == "grado" || $palabra == "Grado"){
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_nota_envio_rec AS "fecha",num_nota_fk AS "resONota" '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)WHERE fecha_nota_envio_rec IS NOT NULL AND fecha_rescs IS NULL AND seguimiento.carrera_fk = id_carrera AND  
						   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
						or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
				}else{
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_nota_envio_rec AS "fecha",num_nota_fk AS "resONota" '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_nota_envio_rec IS NOT NULL AND fecha_rescs IS NULL AND seguimiento.carrera_fk = id_carrera AND  
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
				$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_rescs AS "fecha"num_res_cs_fk AS "resONota" '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_rescs IS NOT NULL AND fecha_ingreso_analitico IS NULL AND fecha_ingreso_diploma IS NULL ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
			}else{
				if ($palabra == "grado" || $palabra == "Grado"){
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_rescs AS "fecha"num_res_cs_fk AS "resONota" '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)WHERE fecha_rescs IS NOT NULL AND fecha_ingreso_analitico IS NULL AND fecha_ingreso_diploma IS NULL AND seguimiento.carrera_fk = id_carrera AND  
						   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
						or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
						or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
				}else{
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_rescs AS "fecha"num_res_cs_fk AS "resONota" '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_rescs IS NOT NULL AND fecha_ingreso_analitico IS NULL AND fecha_ingreso_diploma IS NULL AND seguimiento.carrera_fk = id_carrera AND  
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
				$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_ingreso_diploma AS "fecha" '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_ingreso_diploma IS NOT NULL AND fecha_retiro_diploma IS NULL ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
			}else{
				if ($palabra == "grado" || $palabra == "Grado"){
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_ingreso_diploma AS "fecha" '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)WHERE fecha_ingreso_diploma IS NOT NULL AND fecha_retiro_diploma IS NULL AND seguimiento.carrera_fk = id_carrera AND  
					   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
					or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
				}else{
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_ingreso_diploma AS "fecha" '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_ingreso_diploma IS NOT NULL AND fecha_retiro_diploma IS NULL AND seguimiento.carrera_fk = id_carrera AND  
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
				$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_retiro_diploma AS "fecha" '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_retiro_diploma IS NOT NULL ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
			}else{
				if ($palabra == "grado" || $palabra == "Grado"){
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_retiro_diploma AS "fecha" '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)WHERE fecha_retiro_diploma IS NOT NULL AND seguimiento.carrera_fk = id_carrera AND  
					   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
					or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
				}else{
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_retiro_diploma AS "fecha" '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_retiro_diploma IS NOT NULL AND seguimiento.carrera_fk = id_carrera AND  
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
				$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_ingreso_analitico AS "fecha" '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_ingreso_analitico IS NOT NULL AND fecha_retiro_analitico IS NULL ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
			}else{
				if ($palabra == "grado" || $palabra == "Grado"){
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_ingreso_analitico AS "fecha" '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)WHERE fecha_ingreso_analitico IS NOT NULL AND fecha_retiro_analitico IS NULL AND seguimiento.carrera_fk = id_carrera AND  
					   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
					or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
				}else{
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_ingreso_analitico AS "fecha" '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_ingreso_analitico IS NOT NULL AND fecha_retiro_analitico IS NULL AND seguimiento.carrera_fk = id_carrera AND  
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
				$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_retiro_analitico AS "fecha" '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_retiro_analitico IS NOT NULL ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
			}else{
				if ($palabra == "grado" || $palabra == "Grado"){
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_retiro_analitico AS "fecha" '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera)WHERE fecha_retiro_analitico IS NOT NULL AND seguimiento.carrera_fk = id_carrera AND  
					   (UPPER(nombre_alumno)        LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(apellido_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_carrera)	   LIKE UPPER('%{$_REQUEST['palabra']}%')
					or UPPER(nombre_nivel_carrera) LIKE UPPER('{$_REQUEST['palabra']}')
					or UPPER(numerodni_alumno)	   LIKE UPPER('%{$_REQUEST['palabra']}%')) ORDER BY id_nivel_carrera,id_carrera,apellido_alumno,nombre_alumno,id_alumno ASC";
				}else{
					$consulta = 'SELECT id_alumno,apellido_alumno,nombre_alumno,nombre_carrera,nombre_nivel_carrera,foto_alumno,id_seguimiento,fecha_solicitud,fecha_retiro_analitico AS "fecha" '."FROM alumno INNER JOIN seguimiento ON(seguimiento.alumno_fk = alumno.id_alumno) INNER JOIN carrera ON(carrera.id_carrera = seguimiento.carrera_fk) INNER JOIN nivel_carrera ON(carrera.nivel_carrera_fk = nivel_carrera.id_nivel_carrera) WHERE fecha_retiro_analitico IS NOT NULL AND seguimiento.carrera_fk = id_carrera AND  
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

include_once 'conexion.php';
include_once 'libreriaPhp.php';
echo '<table align="center" cellspacing="1" cellpadding="4" border="1" bgcolor=#585858 id="tabla">';
	echo '<tr bgcolor="#FFFFFF">';
		echo '<td id="titulo3" colspan="6" align="center"><l1>Listado '.$vTipoListado[$oTipoListado].'</l1></td>';
	echo '</tr>';
	echo '<tr bgcolor="#FFFFFF">';
		echo '<td id="titulo3" colspan="6" align="left"><l1>Cantidad de alumnos: '.$cantidad.'</l1></td>';
	echo '</tr>';
	echo '<tr bgcolor="#C3C3C3">';
		echo '<td align="center"><strong><label></label></strong></td>';
		echo '<td align="center"><strong><label>Alumno</label></strong></td>';
		echo '<td align="center"><strong><label>Nivel Carrera</label></strong></td>';
		echo '<td align="center"><strong><label>Carrera</label></strong></td>';
		echo '<td align="center"><strong><label>Fecha</label></strong></td>';
		if($controlResONota==1){
			echo '<td align="center"><strong><label>'.$valorColumna.'</label></strong></td>';
		}
	echo '</tr>';
	$contarAlumno = 0;
	$val = pg_query($consulta);
				while($row=pg_fetch_array($val,NULL,PGSQL_ASSOC)){
					$contarAlumno++;
				echo '<tr>';
					echo '<td align="center"><l2>'.$contarAlumno.'</l2></td>';
					echo '<td align="center"><l2>'.$row['apellido_alumno'].', '.$row['nombre_alumno'].'</l2></td>';
					echo '<td align="center"><l2>'.$row['nombre_nivel_carrera'].'</l2></td>';
					echo '<td align="center"><l2>'.$row['nombre_carrera'].'</l2></td>';
					echo '<td align="center"><l2>'.setDate($row['fecha']).'</l2></td>';
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
						echo '<td align="center"><l2>'.$numeroMostrar.'</l2></td>';
					}
					//echo '<td align="center"><a href="verAlumno.php?idAlumno='.$row['id_alumno'].'"><input type="image" src="ver.png" width="50" height="50" value="Opciones" /></a></td>';
					//echo '<td align="center"><a href="listadoSeguimientoTitulo.php?idAlumno='.$row['id_alumno'].'"><input type="image" src="seguimiento.png" width="60" height="40" value="Opciones" /></a></td>';
				echo '</tr>';
			}
echo '</table>';
?>
</body>
</html>