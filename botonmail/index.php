<!DOCTYPE html>
<html>
	<head>
        <title>Reporte Error</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	</head>
	<body>
        <div class="wrap">
            <header>
                Reportar error o sugerencia.
            </header>
            
           <section id="principal">
				<form id="formulario" method="post" action="php/enviar2.php" enctype="multipart/form-data">
					<div class="campos">			
						<label>Nombre:</label>
						<input type="text" name="nombre" required>
					</div>
					<div class="campos">			
						<label>Apellido:</label>
						<input type="text" name="apellido" required>
					</div>
					<div class="campos">
						<label>E-mail:</label>
						<input type="text" name="email">
					</div>
					<div class="campos">
						<label>Telefono:</label>
						<input type="text" name="telefono">
					</div>
					<div class="campos">
						<label>Descripcion de error:</label>
						<textarea name="error"></textarea>
					</div>
					<!--<label>Imagen de error:</label>
					<input type="file" name="im-error" id="imagen" />-->
								
					<input id="submit" type="submit" name="enviar" value="Enviar mail">

				</form>
				
			</section> 
		</div>
	</body>
</html>
