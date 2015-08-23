<?php
//Librerías para el envío de mail
include_once('class.phpmailer.php');
include_once('class.smtp.php');
//include_once('libreria.php');
//require ("PHPMailer_5.2.1/class.phpmailer.php");

//Recibir todos los parámetros del formulario
$para = "sistemas.seu@gmail.com";
$asunto = "Reporte de error";
$nombre = $_REQUEST['nombre'];
$apellido = $_REQUEST['apellido'];
$email = $_REQUEST['email'];
$telefono = $_REQUEST['telefono'];
$error = $_REQUEST['error'];
$archivo = $_FILES['im-error'];
//$cuerpo = "De:".$nombre.", ".$apellido.". Tel: ".$telefono.". Email: ".$email.". Error: ".$error;

$cuerpo = "<div align='left'>
            <div align='left'>
                <h3>REPORTE ERROR</h3><br>
                <strong>Nombre<strong/> : reportante:$nombre, $apellido <br>
                <strong>Email<strong/> : $email <br>
                <strong>Telefono<strong/> : $telefono <br>
                <strong>Error<strong/> : $error <br>
            </div>
        </div>
        ";
 $mail = new PHPMailer();
 $mail->IsSMTP();
 $mail->SMTPAuth = true;
 $mail->SMTPSecure = "ssl"; 
 $mail->Host = "smtp.gmail.com"; // dirección del servidor
 $mail->Username = "sistemas.seu@gmail.com"; // Usuario //VA OTRO MAIL, HAY QUE CREAR UN GMAIL CREO.

 $mail->Password = "4537500SEU"; // Contraseña
 $mail->Port = 465; // Puerto a utilizar

 $mail->From = $para; // dirección remitente
 $mail->FromName = $nombre.", ".$apellido; // nombre remitente

 $mail->AddAddress($para, ''); // Esta es la dirección a donde enviamos
 $mail->IsHTML(true); // El correo se envía como HTML
 $mail->Subject = $asunto; // Asunto
 $mail->Body = $cuerpo; // Mensaje a enviar
 $exito = $mail->Send();

 /**if($exito){
	echo '<script language="JavaScript"> 
		alert("Verifique su casilla de correo, le hemos enviado un mail.");
		location ="enviarMail.php";
		</script>';	
}else{
	echo '<script language="JavaScript"> 
		alert("No se puedo enviar el correo, comuniquese con el administrador");
		location ="enviarMail.php";
		</script>';
}**/
include_once(redir.php);
header("Location:http://extension.frvm.utn.edu.ar/SeguimientoTitulo/botonmail/finreporte.php");  