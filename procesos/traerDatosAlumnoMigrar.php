<?php

include_once '../conexion.php';

$conGrad = pg_connect("host=localhost port=5432 user=extension password=newgenius dbname=graduados") or die("Error de conexion.".pg_last_error());

$sqlSolicitud = pg_query($conn,'SELECT alumno.* FROM alumno ORDER BY apellido_alumno asc, nombre_alumno asc;');
$entro = false;
$outJson = '[';
while($r = pg_fetch_array($sqlSolicitud))
{
    
	if($outJson!= '[')
	{
		$outJson .= ',';
	}

    

    $idA=$r['id_alumno'];
    $nombreA=$r['nombre_alumno'];
    $apellidoA=$r['apellido_alumno'];
    $mailA=$r['mail_alumno'];
    $facebookA=$r['facebook_alumno'];
    $tipodniA=$r['tipodni_alumno'];
    $calleA=$r['calle_alumno'];
    $fotoA=$r['foto_alumno'];
    $anchoA=$r['ancho_final'];
    $altoA=$r['alto_final'];
    $numerocalleA=$r['numerocalle_alumno'];
    $mail2A=$r['mail_alumno2'];
    $twitterA=$r['twitter_alumno'];
    $perfil_laboralA=$r['perfil_laboral_alumno'];
    $numerodniA=$r['numerodni_alumno'];
    $numerodniA = implode('',explode('.',$numerodniA));
    $fechanacimientoA=$r['fechanacimiento_alumno'];
    $dptoA=$r['dpto_alumno'];
    $caracteristicafA=$r['caracteristicaf_alumno'];
    $telefonoA=$r['telefono_alumno'];
    $caracteristicacA=$r['caracteristicac_alumno'];
    $celularA=$r['celular_alumno'];
    $pisoA=$r['piso_alumno'];

    $cCarrera = "SELECT carrera_fk FROM seguimiento WHERE alumno_fk=$idA ORDER BY carrera_fk ASC LIMIT 1;";
    $sCarrera = pg_query($cCarrera);
    $rCarrera = pg_fetch_array($sCarrera);
    $carreraA=$rCarrera['carrera_fk'];

    $cGrad = "SELECT * FROM alumno WHERE numerodni_alumno='$numerodniA' LIMIT 1;";
    $sGrad = pg_query($conGrad,$cGrad);
    $entro = false;
    while($rG = pg_fetch_array($sGrad))
    {
        $entro = true;
        $idG=$rG['id_alumno'];
        $nombreG=$rG['nombre_alumno'];
        $apellidoG=$rG['apellido_alumno'];
        $mailG=$rG['mail_alumno'];
        $facebookG=$rG['facebook_alumno'];
        $tipodniG=$rG['tipodni_alumno'];
        $calleG=$rG['calle_alumno'];
        $fotoG=$rG['foto_alumno'];
        $anchoG=$rG['ancho_final'];
        $altoG=$rG['alto_final'];
        $numerocalleG=$rG['numerocalle_alumno'];
        $mail2G=$rG['mail_alumno2'];
        $twitterG=$rG['twitter_alumno'];
        $perfil_laboralG=$rG['perfil_laboral_alumno'];
        $numerodniG=$rG['numerodni_alumno'];
        $fechanacimientoG=$rG['fechanacimiento_alumno'];
        $dptoG=$rG['gra_depto'];
        $pisoG=$rG['gra_piso'];
    }

    if(!$entro)
    {
        $nombreL = strtolower($nombreA);
        $apellidoL = strtolower($apellidoA);
        $cGrad = "SELECT * FROM alumno WHERE LOWER(nombre_alumno)='$nombreL' AND LOWER(apellido_alumno)='$apellidoL' LIMIT 1;";
        $sGrad = pg_query($conGrad,$cGrad);
        while($rG = pg_fetch_array($sGrad))
        {
            $entro = true;
            $idG=$rG['id_alumno'];
            $nombreG=$rG['nombre_alumno'];
            $apellidoG=$rG['apellido_alumno'];
            $mailG=$rG['mail_alumno'];
            $facebookG=$rG['facebook_alumno'];
            $tipodniG=$rG['tipodni_alumno'];
            $calleG=$rG['calle_alumno'];
            $fotoG=$rG['foto_alumno'];
            $anchoG=$rG['ancho_final'];
            $altoG=$rG['alto_final'];
            $numerocalleG=$rG['numerocalle_alumno'];
            $mail2G=$rG['mail_alumno2'];
            $twitterG=$rG['twitter_alumno'];
            $perfil_laboralG=$rG['perfil_laboral_alumno'];
            $numerodniG=$rG['numerodni_alumno'];
            $fechanacimientoG=$rG['fechanacimiento_alumno'];
            $dptoG=$rG['gra_depto'];
            $pisoG=$rG['gra_piso'];
        }
    }

    if(!$entro)
    {
        $idG = 0;
        $nombreG = '';
        $apellidoG = '';
        $mailG = '';
        $facebookG = '';
        $tipodniG = '';
        $calleG = '';
        $fotoG = '';
        $anchoG = '';
        $altoG = '';
        $numerocalleG = '';
        $mail2G = '';
        $twitterG = '';
        $perfil_laboralG = '';
        $numerodniG = '';
        $fechanacimientoG = '';
        $dptoG = '';
        $pisoG = '';
    }

    
    $outJson .= '{ "seg" : {
            "id":"'.$idA.'",
            "nombre":"'.$nombreA.'",
            "apellido":"'.$apellidoA.'",
            "mail":"'.$mailA.'",
            "facebook":"'.$facebookA.'",
            "tipodni":"'.$tipodniA.'",
            "calle":"'.$calleA.'",
            "foto":"'.$fotoA.'",
            "ancho":"'.$anchoA.'",
            "alto":"'.$altoA.'",
            "numerocalle":"'.$numerocalleA.'",
            "mail2":"'.$mail2A.'",
            "twitter":"'.$twitterA.'",
            "perfil_laboral":"'.$perfil_laboralA.'",
            "numerodni":"'.$numerodniA.'",
            "fechanacimiento":"'.$fechanacimientoA.'",
            "dpto":"'.$dptoA.'",
            "caracteristicaf":"'.$caracteristicafA.'",
            "telefono":"'.$telefonoA.'",
            "caracteristicac":"'.$caracteristicacA.'",
            "celular":"'.$celularA.'",
            "piso":"'.$pisoA.'",
            "carrera":"'.$carreraA.'"
        },
        "grad" : {
            "id":"'.$idG.'",
            "nombre":"'.$nombreG.'",
            "apellido":"'.$apellidoG.'",
            "mail":"'.$mailG.'",
            "facebook":"'.$facebookG.'",
            "tipodni":"'.$tipodniG.'",
            "calle":"'.$calleG.'",
            "foto":"'.$fotoG.'",
            "ancho":"'.$anchoG.'",
            "alto":"'.$altoG.'",
            "numerocalle":"'.$numerocalleG.'",
            "mail2":"'.$mail2G.'",
            "twitter":"'.$twitterG.'",
            "perfil_laboral":"'.$perfil_laboralG.'",
            "numerodni":"'.$numerodniG.'",
            "fechanacimiento":"'.$fechanacimientoG.'",
            "dpto":"'.$dptoG.'",
            "piso":"'.$pisoG.'"
        }
    }';
}

if(substr($outJson, -1) == ',') {
    $outJson = substr($outJson,0,strlen($outJson ) - 1);
}

$outJson .= ']';

pg_close($conn);

echo $outJson;

?>