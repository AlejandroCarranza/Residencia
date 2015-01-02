<?php
include_once '../../../../includes/db_connect.php';
include_once '../../../../includes/functions.php';
 
sec_session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Actualizar catalogos</title>
</head>
<body>
	<?php if ((login_check($mysqli) == true) && ($_SESSION['type'] == '2')): ?>
	<p class="etiquetaTit">Seleccione un catálogo a editar</p>
	<select name="catalago" id="catalago" onclick="myFunction6()">
		<option value="0" disabled selected>Catálogos</option>
		<option value="dependencias">Dependencia</option>
		<option value="subcomisiones">Subcomité</option>
		<option value="partidos">Partido</option>
	</select>

	<div class="listas" id="listas"></div>
	<?php else : ?>
            <p>
                <span class="error">No estás autorizado para ver esta página.</span>
            </p>
        <?php endif; ?>
</body>
</html>