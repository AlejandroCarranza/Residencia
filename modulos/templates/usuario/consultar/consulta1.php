<?php
include_once '../../../../includes/db_connect.php';
include_once '../../../../includes/functions.php'; 
sec_session_start();
?>

<!DOCTYPE html>
<html>

<head>
	
</head>

<body>
	<?php if ((login_check($mysqli) == true) && ($_SESSION['type'] == '1')): ?>
	<p class="etiquetaTit">Ingrese el nombre</p>
	<input type="text" class="inputBusc" id="bus" onkeyup="myFunction()" size="30" required="required" autofocus="autofocus" placeholder="Buscar" />
	<div id="lista" class="lista"></div>
	<br>
	<div id="pers" class="tarjetaCon"></div>
	

	<?php else : ?>
        <p>
            <span class="error">No estás autorizado para ver esta página.</span>
        </p>
    <?php endif; ?>
</body>
</html>