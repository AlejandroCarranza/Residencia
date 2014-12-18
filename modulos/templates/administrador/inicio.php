<!-- Se importan los archivos php para obtener los datos de conexion para base de datos y para obtener acceso a las variables de sesion -->
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
	<!-- Comprobamos si el usuario a iniciado sesion y si su variable de sesion corresponde al modulo que trata de acceder -->
	<?php if ((login_check($mysqli) == true) && ($_SESSION['type'] == '2')): ?>
	<div id="contenidoRes">
	<h1>Bienvenido(a) <?php echo $_SESSION['nombre']; ?></h1>
	
	<?php
	
	//obtengo la fecha actual
	$fecha_actual = date("Y-F-d");
	//Imprimo la fecha Actual
	//echo $fecha_actual;

	//Creamos una conexion a mysql usando las variables declaradas en psl-config.php
	$con=mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		//Se crea la consulta mysql que nos obtendra los contactos que cumplan años el dia actual
		$query = "SELECT * from contactos WHERE day(fecha_nacimiento)=day(NOW()) and month(fecha_nacimiento)=month(NOW()) ";
		//Consulta para obtener los cumpleaños de todo el mes
		//$query = "SELECT * from contactos WHERE month(fecha_nacimiento)=month(NOW()) ";	
		if ($result = mysqli_query($con, $query)) {

    	/* determinar el número de filas del resultado */
    	$row_cnt = mysqli_num_rows($result);

    	//Pasamos el resultado a un array manipulable
    	if($row_cnt > 0){
    		//Imprimimos titulo, mensajes e imagen de globos
    		echo '<div class="cumpleanos">';
    			echo '<div class="cumpleanosMensajes">';
    				echo '<p class="cumpleMensaje">Compleaños para hoy</p>';
    				echo '<p class="cumpleMensaje">Enviale un email con tus felicitaciones</p>';
    			echo '</div>';
    		echo '<img src="../../statics/images/globos.png" class="globos">';
    		echo '</div>';

    		//Encabezado de la tabla
    		echo '<table border="1">';
 			echo '<tr>';
 			echo '<td>Nombre</td>';
 			echo '<td>Email</td>';
 			echo '<td>Más</td>';
 			echo '</tr>';

    		while($fila = mysqli_fetch_array($result))
			{
				//LLenamos la tabla con contenido segun la consulta
				echo '<tr>';
				echo '<td>'.utf8_encode($fila['titulo']." ".$fila['nombre']." ".$fila['apellido_paterno']." ".$fila['apellido_materno'].' '). '</td>';
				echo '<td>'.$fila['email'].'</td>';
				?>
				<td><a href="#" class="icon-profile icoVerMas" onclick="myFunction3(<?php echo $fila['id_contacto']; ?>)"></a></td>
				<?php
				echo '</tr>';
			}
    	}
    	else {
    		printf("Sin Novedades");
    	}

    	/* cerrar el resulset */
    	mysqli_free_result($result);
		}
		//Cierre de la conexion
		mysqli_close($con);
		echo '</table>';
	?>
</div>
	<?php else : ?>
        <p>
        	<!-- Si no el usuario no a iniciado sesion solo se despliga el mensaje-->
            <span class="error">No estás autorizado para ver esta página.</span>
        </p>
<?php endif; ?>
	<!--Div para la carga de la tarjeta -->
	<div id="pers" class=""></div>
	<!--Campo para almacenar el id del contacto seleccionado en la tabla -->
	<input type="hidden" value="" id="vcod" name="vcod" >
</body>
</html>