<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Directorio en línea</title>
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
	<?php if ((login_check($mysqli) == true) && ($_SESSION['type'] == '1')): ?>
	<header>
		<div class="logos">
			<img src="images/logo.png" alt="Prospera" class="log">
			<img src="images/gobierno.png" alt="Gobierno de la republica">
		</div>
		<div class="titular">
			<h1 class="titulo">Nombre del sistema</h1>
		</div>
		<div class="usuario">
			<figure class="avatar">
					<img src="images/avatar.jpg" alt="mi foto" />
			</figure>
			<a class="name" href="#">Usuario</a>
			<a class="cerrarSesion" href="includes/logout.php">Cerrar Sesión</a>
		</div>
	</header>
	<nav>
		<ul class="menu">
			<li><a href="">Inicio</a></li>
			<li><a href="">Registrar</a></li>
			<li><a href="">Consultar</a></li>
			<li><a href="">Reportes</a></li>
			<li><a href="">Administrar</a></li>
		</ul>
	</nav>
	<div class="contenido">
		CLASE 1
	</div>
	        <?php else : ?>
            <p>
                <span class="error">No estás autorizado para ver esta página.</span>
            </p>
        <?php endif; ?>
</body>
</html>