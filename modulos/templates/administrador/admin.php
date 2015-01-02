<?php
include_once '../../../includes/db_connect.php';
include_once '../../../includes/functions.php';
 
sec_session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<!-- Le damos la habilidad al archivo para ser Responsivo -->
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<!-- Llamamos a normalizse.css para quitar los estilos que el navegador otorga predefinidamente -->
	<link rel="stylesheet" href="../../statics/css/estilos.css">
	<!-- Llamamos a estilos.css para darle el diseño al sitio web -->
	<link rel="stylesheet" href="../../statics/css/normalize.css">
	<title>Prospera</title>
</head>
<body>
	<!-- Código php para dar seguridad y solo permitir que los usuarios autorizados accedan a este archivo-->
	<?php if ((login_check($mysqli) == true) && ($_SESSION['type'] == '2')): ?>
	<header>
		<figure class="logo">
			<img src="../../statics/images/logo-mini.png" alt="">
		</figure>
		<div class="titular">
			<h2 class="titulo">Sistema para la administración de contactos</h2>
		</div>
		<div class="info">
			<img src="../../statics/images/user.png" alt="usuario" class="avatar">
			<div class="usuario">
				<span class="nombre"><?php echo $_SESSION['username']; ?></span>
				<a class="cerrarSesion" href="../../../includes/logout.php">Cerrar Sesión</a>
			</div>
		</div>
			

	</header>
	<nav>
		<ul class="menu">
           	<li><a href="#" id="btnInicio">Inicio</a></li>
           	<li><a href="#" id="btnInsertar">Insertar</a></li>
            <li class="li_submenu"><a href="#">Consultar</a>
                <div class="sub">
                    <ul class="ul_submenu">
                        <li><a href="#" id="btnConsulta1">Nombre</a></li>
                        <li><a href="#" id="btnConsulta2">Subcomité</a></li>
                    </ul>
                </div>
            </li>
           	<li class="li_submenu"><a href="#">Reportes</a>
                <div class="sub">
                    <ul class="ul_submenu">
                        <li><a href="#" id="btnReporte1">Subcomité</a></li>
                        
                    </ul>
                </div>
            </li>
           	<li class="li_submenu"><a href="#">Administrar</a>
                <div class="sub">
                    <ul class="ul_submenu">
                        <li><a href="#" id="btnCrearUsuario">Nuevo Usuario</a></li>
                        <li><a href="#" id="btnCrearTipos">Opciones</a></li>
                        <li><a href="#" id="btnActualizarCat">Catálogos</a></li>
                    </ul>
                </div>
            </li>	 	
           </ul>
	</nav>
	<div id="contenido">
		
	</div>
		<?php else : ?>
            <p>
                <span class="error">No estás autorizado para ver esta página.</span>
            </p>
        <?php endif; ?>

    <!-- Llamamos los scripts que usaremos para la transición de las páginas -->
	<script src="../../statics/js/jquery-2.1.0.min.js"></script>
   	<script src="../../statics/js/AJAX.js"></script>
   	<script src="../../statics/js/cargaPaginas.js"></script>
	<script src="../../statics/js/buscador.js"></script>
	<!-- Llamamos la función inicio() del archivo cargaPaginas para que nos de las funciones de cambiar entre páginas -->
	<script type="text/javascript">
	inicio();
	</script>

</body>
</html>