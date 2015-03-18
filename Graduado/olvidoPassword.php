<?php
$correo = $_REQUEST['mail'];
$id_Alumno = $_REQUEST['idAlumno'];
$correcto = 0;

include_once "conexion.php";

$alumno=pg_query("SELECT count(id_alumno) as total,password_alumno FROM alumno WHERE UPPER(mail_alumno)   LIKE UPPER('{$_POST['mail']}') OR UPPER(mail_alumno2) LIKE UPPER('{$_POST['mail']}') GROUP BY password_alumno");
while($row=pg_fetch_array($alumno,NULL,PGSQL_ASSOC)){
$total = $row['total'];
$password_alumno = $row['password_alumno'];
}
require ("PHPMailer_5.2.1/class.phpmailer.php");

		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl"; 
		$mail->Host = "smtp.gmail.com"; // dirección del servidor
		$mail->Username = "extensionfrvm@gmail.com"; // Usuario
		$mail->Password = "4537500frvm"; // Contraseña
		$mail->Port = 465; // Puerto a utilizar
		$mail->From = "s_extension@frvm.utn.edu.ar"; // dirección remitente
		$mail->FromName = "Extension"; // nombre remitente
		if ($total == 1){
			$correcto = 1;
			$mail->AddAddress($correo,''); // Esta es la dirección a donde enviamos
		}
		//$mail->AddCC("cuenta@dominio.com"); // Copia
		//$mail->AddBCC("cuenta@dominio.com"); // Copia oculta
		$mail->IsHTML(true); // El correo se envía como HTML
		$mail->Subject = "Solicitud de Contraseña"; // Asunto
		$body0 = '<FONT FACE="cambria" SIZE=4>Su contrase&ntilde;a es: </FONT>';
		$body1 .= "<br>";
		$body2 .= "<u>Contrase&ntilde;a:</u> <strong>$password_alumno</strong>";
		$body3 .= "</p>";
		$enter = '<br>';
		$body = $body0.$enter.$body1.$enter.$body2.$enter.$body3;
		$mail->Body = $body; // Mensaje a enviar
		//$mail->AltBody = "Hola mundo. Esta es la primer línean Acá continuo el mensaje"; // cuerpo alternativo del mensaje
		//$mail->AddAttachment("imagenes/imagen.jpg", "imagen.jpg");
		$exito = $mail->Send(); // Envía el correo.
if ($correcto == 1){
	if($exito){
		echo '<script language="JavaScript"> 
			alert("Verifique su casilla de correo, le hemos enviado un mail.");
			location ="solicitarPassword.php?idAlumno='.$id_Alumno.'";
			</script>';	
	}else{
		echo '<script language="JavaScript"> 
			alert("No se pudo enviar el correo correctamente, intente nuevamente");
			location ="pedirMail.php?idAlumno='.$id_Alumno.'";
			</script>';
	}
}else{
	echo '<script language="JavaScript"> 
		alert("El mail ingresado no coincide con el mail registrado para el graduado seleccionado, verifique que lo ingreso bien.");
		location ="pedirMail.php?idAlumno='.$id_Alumno.'&correo='.$correo.'";
		</script>';
}