<?php
include_once '../../../../includes/db_connect.php';
include_once '../../../../includes/functions.php';
include_once '../../../../includes/psl-config.php'; 
sec_session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<!-- Código php para dar seguridad y solo permitir que los usuarios autorizados accedan a este archivo-->
	<?php if ((login_check($mysqli) == true) && ($_SESSION['type'] == '2')): ?>
	
	<?php

	//Conexion a la base de datos
	$con=mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	if (mysqli_connect_errno()) {
  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	//Consultamos las subcomisiones
	$consultaSQL1 = "SELECT id_subcomision, nombre_subcomision FROM subcomisiones";

	$result1=mysqli_query($con, $consultaSQL1) or die (mysqli_error($con)); 
	if($result1 === FALSE) {
    	die(mysqli_error()); 
	}
	echo '<form name="formulario" method="post" action="reportes/pdf/reporte.php">';
	echo '<p class="etiquetaTit">Seleccione el subcomité</p>';
	echo '<select name="subcomite" id="subcomite">';
	echo '<option value="">...</option>';
	while($fila1 = mysqli_fetch_array($result1))
	{
		echo '<option value="'.$fila1['id_subcomision'].'"> '.utf8_encode($fila1['nombre_subcomision'].' ').'</option>';
	}
	echo '</select>';
	echo '<input class="btnEnviar" type="submit" value="Crear"/>';
	echo '</form>';
	?>

	<?php else : ?>
        <p>
        	<select name="" id="">
			<option value=""></option>
        	</select>
         <span class="error">No estás autorizado para ver esta página.</span>
        </p>
    <?php endif; ?>
</body>
</html>