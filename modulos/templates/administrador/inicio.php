<?php
include_once '../../../includes/db_connect.php';
include_once '../../../includes/functions.php';
include_once '../../../includes/psl-config.php';
sec_session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inicio</title>
</head>
<body>
	<?php if ((login_check($mysqli) == true) && ($_SESSION['type'] == '2')): ?>
	<h1>Bienvenido(a) <?php echo $_SESSION['nombre']; ?></h1>
	
	<?php
	
	//obtengo la fecha actual
	$fecha_actual = date("Y-m-d");
	//Imprimo la fecha Actual
	//echo $fecha_actual;

	//Creamos una conexion a mysql usando las variables declaradas en psl-config.php
	$con=mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		//Se crea la consulta mysql que nos obtendra los contactos que cumplan años el dia actual
		$result=mysqli_query($con,"SELECT * from contactos WHERE day(fecha_nacimiento)=day(NOW()) and month(fecha_nacimiento)=month(NOW()) ");
		//$result=mysqli_query($con,"SELECT * from contactos WHERE month(fecha_nacimiento)=month(NOW()) ");	
			if($result === FALSE) {
    			die(mysqli_error());
			}
			//Se guarda el resultado en un array y se imprimen los contactos que cumplan años.
			while($fila = mysqli_fetch_array($result))
			{
				//echo $fila['nombre'];
				//echo $comprueba;
			}
	?>

	<?php else : ?>
        <p>
            <span class="error">No estás autorizado para ver esta página.</span>
        </p>
<?php endif; ?>
</body>
</html>