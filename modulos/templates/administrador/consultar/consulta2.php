<?php
include_once '../../../includes/db_connect.php';
include_once '../../../includes/functions.php'; 
sec_session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Consulta2</title>
	<script src="consultar/buscador.js"></script>
</head>
<body>
	<!-- Código php para dar seguridad y solo permitir que los usuarios autorizados accedan a este archivo-->
	<?php if ((login_check($mysqli) == true) && ($_SESSION['type'] == '2')): ?>
	<ul class="items">
		<li>
			<a href="#" class="listaBotones" onclick="educacion()">
				<span class=" icon-study"></span>
				<p class="pSubcom">Educación</p>
				<input type="hidden" name="valor1" value='VariableJavaScript'>
			</a>
		</li>
		<li>
			<a href="#" onclick="salud()" class="listaBotones">
				<span class=" icon-heart"></span>
				<p class="pSubcom">Salud</p>
			</a>
		</li>
		<li>
			<a href="#" onclick="gems()" class="listaBotones">
				<span class=" icon-library"></span>
				<p class="pSubcom">GEMS</p>
			</a>
		</li>
		<li>
			<a href="#" onclick="ems()" class="listaBotones">
				<span class=" icon-books"></span>
				<p class="pSubcom">EMS</p>
			</a>
		</li>
		<li>
			<a href="#" onclick="eMunicipales()" class="listaBotones">
				<span class=" icon-user"></span>
				<p class="pSubcom">Enlaces Municipales</p>
			</a>
		</li>
		<li>
			<a href="#" onclick="dFederales()" class="listaBotones">
				<span class=" icon-users"></span>
				<p class="pSubcom">Delegados Federales</p>
			</a>
		</li>
		<li>
			<a href="#" onclick="pMunicipales()" class="listaBotones">
				<span class=" icon-user22"></span>
				<p class="pSubcom">Presidentes minicipales</p>
			</a>
		</li>
		<li>
			<a href="#" onclick="regidores()" class="listaBotones">
				<span class=" icon-user2"></span>
				<p class="pSubcom">Regidores</p>
			</a>
		</li>
		<li>
			<a href="#" onclick="diputados()" class="listaBotones">
				<span class=" icon-user3"></span>
				<p class="pSubcom">Diputados</p>
			</a>
		</li>
		<li>
			<a href="#" onclick="gEstado()" class="listaBotones">
				<span class=" icon-flag"></span>
				<p class="pSubcom">Gobierno del estado</p>
			</a>
		</li>
	</ul>
	<div id="contenidoRes">
		
	</div>
		<input id="valor1" name="valor1" type="hidden" value="1">

	<?php else : ?>
        <p>
         <span class="error">No estás autorizado para ver esta página.</span>
        </p>
    <?php endif; ?>
</body>
</html>