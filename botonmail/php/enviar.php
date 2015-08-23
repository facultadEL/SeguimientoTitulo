<?php
//Librerías para el envío de mail
include_once('class.phpmailer.php');
include_once('class.smtp.php');
include_once('libreria.php');

//Recibir todos los parámetros del formulario
$para = "luciponce17@gmail.com";
$asunto = "Reporte de error";
$nombre = $_REQUEST['nombre'];
$apellido = $_REQUEST['apellido'];
$email = $_REQUEST['email'];
$telefono = $_REQUEST['telefono'];
$error = $_REQUEST['error'];
$archivo = $_FILES['im-error'];

//Este bloque es importante
/**$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;

//Nuestra cuenta
$mail->Username ='';
$mail->Password = '';**/

//Agregar destinatario
$mail->AddAddress($para);
$mail->Subject = $asunto;
$mail->Body = "De:".$nombre.", ".$apellido.". Tel: ".$telefono.". Email: ".$email.". Error: ".$error;
//Para adjuntar archivo
//$mail->AddAttachment($archivo['tmp_name'], $archivo['im-error']); //que va en tmp_name
$mail->MsgHTML("De:".$nombre.", ".$apellido.". Tel: ".$telefono.". Email: ".$email.". Error: ".$error);

//Avisar si fue enviado o no y dirigir al index
if($mail->Send())
{
	echo'<script type="text/javascript">
			alert("Enviado Correctamente");
			window.location="http://localhost/maillocal/index.php"
		 </script>';
}
else{
	echo'<script type="text/javascript">
			alert("NO ENVIADO, intentar de nuevo");
			window.location="http://localhost/maillocal/index.php"
		 </script>';
}
?>

