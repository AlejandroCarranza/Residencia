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
	<!-- Lista de botones de subcomites -->
	<ul class="items">
		<li>
			<a href="#" onclick="btnsSubcomites(1)" class="listaBotones">
				<span class=" icon-study"></span>
				<p class="pSubcom">Educación</p>
			</a>
		</li>
		<li>
			<a href="#" onclick="btnsSubcomites(2)" class="listaBotones">
				<span class=" icon-heart"></span>
				<p class="pSubcom">Salud</p>
			</a>
		</li>
		<li>
			<a href="#" onclick="btnsSubcomites(3)" class="listaBotones">
				<span class=" icon-library"></span>
				<p class="pSubcom">GEMS</p>
			</a>
		</li>
		<li>
			<a href="#" onclick="btnsSubcomites(4)" class="listaBotones">
				<span class=" icon-books"></span>
				<p class="pSubcom">EMS</p>
			</a>
		</li>
		<li>
			<a href="#" onclick="btnsSubcomites(5)" class="listaBotones">
				<span class=" icon-user"></span>
				<p class="pSubcom">Enlaces Municipales</p>
			</a>
		</li>
		<li>
			<a href="#" onclick="btnsSubcomites(6)" class="listaBotones">
				<span class=" icon-users"></span>
				<p class="pSubcom">Delegados Federales</p>
			</a>
		</li>
		<li>
			<a href="#" onclick="btnsSubcomites(7)" class="listaBotones">
				<span class=" icon-user22"></span>
				<p class="pSubcom">Presidentes municipales</p>
			</a>
		</li>
		<li>
			<a href="#" onclick="btnsSubcomites(8)" class="listaBotones">
				<span class=" icon-user2"></span>
				<p class="pSubcom">Regidores</p>
			</a>
		</li>
		<li>
			<a href="#" onclick="btnsSubcomites(9)" class="listaBotones">
				<span class=" icon-user3"></span>
				<p class="pSubcom">Diputados</p>
			</a>
		</li>
		<li>
			<a href="#" onclick="btnsSubcomites(10)" class="listaBotones">
				<span class=" icon-flag"></span>
				<p class="pSubcom">Gobierno del estado</p>
			</a>
		</li>
	</ul>
	<div id="contenidoRes">
		
	</div>
	<form method="post" display="none" id="formPref">
		<input id="valor1" name="valor1" type="hidden" value="1">
		<input id="valor2" name="valor2" type="hidden" value="2">
	</form>

	<?php else : ?>
        <p>
         <span class="error">No estás autorizado para ver esta página.</span>
        </p>
    <?php endif; ?>
</body>
</html>